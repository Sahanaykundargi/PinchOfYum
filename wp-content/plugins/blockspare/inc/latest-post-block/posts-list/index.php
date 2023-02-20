<?php
    if(!function_exists('blockspare_render_block_core_latest_posts_list')){
    function blockspare_render_block_core_latest_posts_list($attributes)
    {
        
        ob_start();
                $unq_class = mt_rand(100000,999999);
                $blockuniqueclass = '';
        
                if($attributes['enableTwoColumn']){
                    $design = $attributes['design'].' list-col-2';
                }else{
                    $design = $attributes['design'].' list-col-1';
                }
                
                if(!empty($attributes['uniqueClass'])){
                    $blockuniqueclass = $attributes['uniqueClass'];
                }else{
                    $blockuniqueclass = 'blockspare-posts-block-list-'.$unq_class;
                }
        
            $block_class = 'blockspare-posts-block-is-list';
            blockspare_query_loop_and_wrapper($attributes,$block_class,$design);
             
            $data_content =  blockspare_post_style_css($blockuniqueclass ,$attributes);
            $data_content .= ob_get_clean();
            return   $data_content;
        
    }
}
    
    /**
     * Registers the post grid block on server
     */
    if(!function_exists('blockspare_register_block_core_latest_posts_list')){
    function blockspare_register_block_core_latest_posts_list()
    {
    
        if (!function_exists('register_block_type')) {
            return;
        }
    
    
        ob_start();
        include BLOCKSPARE_PLUGIN_DIR . 'inc/latest-post-block/posts-list/block.json';
        $metadata = json_decode(ob_get_clean(), true);
        
    
        /* Block attributes */
        register_block_type(
            'blockspare/blockspare-latest-posts-list',
            array(
                'attributes' =>$metadata['attributes'],
                'render_callback' => 'blockspare_render_block_core_latest_posts_list',
            )
        );
    }
    
    add_action('init', 'blockspare_register_block_core_latest_posts_list');
}
    
    
    /**
     * Create API fields for additional info
     */
    if(!function_exists('blockspare_post_register_rest_fields')){
    function blockspare_post_register_rest_fields()
    {
        
        register_rest_field('post', 'featured_image_urls',
            array(
                'get_callback' => 'blockspare_featured_image_urls',
                'update_callback' => null,
                'schema' => array(
                    'description' => __('Different sized featured images', 'blockspare'),
                    'type' => 'array',
                ),
            )
        );
        
        // Excer
        
        /* Add author info */
        register_rest_field(
            'post',
            'author_info',
            array(
                'get_callback' => 'blockspare_get_author_infos',
                'update_callback' => null,
                'schema' => null,
            )
        );
        
        /* Add author info */
        register_rest_field(
            'post',
            'category_info',
            array(
                'get_callback' => 'blockspare_get_category_infos',
                'update_callback' => null,
                'schema' => null,
            )
        );
        
        /* Add author info */
        register_rest_field(
            'post',
            'tag_info',
            array(
                'get_callback' => 'blockspare_get_tag_infos',
                'update_callback' => null,
                'schema' => null,
            )
        );
    
        register_rest_field(
            'post',
            'comment_count',
            array(
                'get_callback' => 'blockspare_get_comment_count',
                'update_callback' => null,
                'schema' => null,
            )
        );
    }
    
    add_action('rest_api_init', 'blockspare_post_register_rest_fields');
}
    
    
    /**
     * Get author info for the rest field
     *
     * @param String $object The object type.
     * @param String $field_name Name of the field to retrieve.
     * @param String $request The current request object.
     */
    if(!function_exists('blockspare_get_author_infos')){
        function blockspare_get_author_infos($object, $field_name, $request){
            if(!isset($object['author']))
                return;
            global $post;
            $author_id = get_post_field( 'post_author', $object['author'] );
            $blocspare = new BlocksapreMultiAuthorForBackend();
            $author_data= $blocspare->blockspare_by_author($post);
            return $author_data;
        }
    }
    if(!function_exists('blockspare_get_category_infos')){
        function blockspare_get_category_infos($object, $field_name, $request){
            return get_the_category_list(' ', '', $object['id']);
            
        }
    }
    
    if(!function_exists('blockspare_get_tag_infos')){
        function blockspare_get_tag_infos($object, $field_name, $request) {
            
            ob_start();
            $cate_name = '';
            if (!empty($object)) {
                foreach ($object['categories'] as $cat_id) {
                    $cate_name = get_cat_name($cat_id);
                }
            }
            ob_clean();
            return $cate_name;
            
        }
    }
    
    if(!function_exists('blockspare_get_comment_count')){
        function blockspare_get_comment_count($object, $field_name, $reques){
            
            return  get_comments_number( $object['id'] );
            
        }
    }
    
    if (!function_exists('blockspare_featured_image_urls')) {
        /**
         * Get the different featured image sizes that the blog will use.
         * Used in the custom REST API endpoint.
         *
         * @since 1.7
         */
        function blockspare_featured_image_urls($object, $field_name, $request)
        {
            return blockspare_featured_image_urls_from_url(!empty($object['featured_media']) ? $object['featured_media'] : '');
        }
    }
    
    
    if (!function_exists('blockspare_featured_image_urls_from_url')) {
        /**
         * Get the different featured image sizes that the blog will use.
         *
         * @since 2.0
         */
        function blockspare_featured_image_urls_from_url($attachment_id)
        {
            
            $image = wp_get_attachment_image_src($attachment_id, 'full', false);
            $sizes = get_intermediate_image_sizes();
            
            $imageSizes = array(
                'full' => is_array($image) ? $image : '',
            );
            
            foreach ($sizes as $size) {
                $imageSizes[$size] = is_array($image) ? wp_get_attachment_image_src($attachment_id, $size, false) : '';
            }
            
            return $imageSizes;
        }
    }
    if(!function_exists('blockspare_post_style_css')){
    function blockspare_post_style_css($blockuniqueclass ,$attributes){
    
    
        $block_content ='';
        $block_content .= '<style type="text/css">';
        $block_content .= ' .' . $blockuniqueclass . '.blockspare-posts-block-latest-post-wrap{
                margin-top:' . $attributes['marginTop'] . 'px;
                margin-bottom:' . $attributes['marginBottom'] . 'px;
                }';
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content{
                padding-top:' . $attributes['contentPaddingTop'] . 'px;
                padding-right:' . $attributes['contentPaddingRight'] . 'px;
                padding-bottom:' . $attributes['contentPaddingBottom'] . 'px;
                padding-left:' . $attributes['contentPaddingLeft'] . 'px;
                }';
    

        if ($attributes['categoryLayoutOption'] == 'solid') {
           
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-category a{
                color:' . $attributes['categoryTextColor'] . "!important" . ';
                background-color:' . $attributes['categoryBackgroundColor'] . "!important" . ';
                border-radius:' . $attributes['categoryBorderRadius'] . "px" . ';
             }';
    
           
        } else if ($attributes['categoryLayoutOption'] == 'border') {
    
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-category a{
                color:' . $attributes['categoryTextColor'] . "!important" . ';
                background-color:' . "transparent" . ';
                border:' . "1px solid" . $attributes['categoryBorderColor'] . ';
                border-radius:' . $attributes['categoryBorderRadius'] . "px" . ';
                border-width:' . $attributes['categoryBorderWidth'] . "px" . ';
            }';
            
            
            
        } else {
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-category a{
                color:' . $attributes['categoryTextColor'] . "!important" . ';
                }';
        }
    
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-category{
                margin-top:' . $attributes['categoryMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['categoryMarginBottom'] . 'px' . ';
                }';
    
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-byline{
                
                 margin-top:' . $attributes['metaMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['metaMarginBottom'] . 'px' . ';
                }';
    
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-more-link{
                 margin-top:' . $attributes['moreLinkMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['moreLinkMarginBottom'] . 'px' . ';
                }';
    
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                color: ' . $attributes['postTitleColor'] . ';
                
                 }';
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-author a span{
                color:' . $attributes['linkColor'] . ';
                }';
        
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-more-link span{
                color:' . $attributes['linkColor'] . ';
                }';
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-date{
                color:' . $attributes['generalColor'] . ';
                }';
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-excerpt-content,'.' .' . $blockuniqueclass . '  .comment_count{
                color:' . $attributes['generalColor'] . ';
              
                }';
        
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title{
                margin-top:' . $attributes['titleMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['titleMarginBottom'] . 'px' . ';
            }';
    
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-excerpt-content{
               margin-top:' . $attributes['exceprtMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['exceprtMarginBottom'] . 'px' . ';
                }';
            
                $layoutstyle = explode('-',$attributes['design']);
                if($layoutstyle[5] >3){
                    $block_content .= ' .' . $blockuniqueclass . '  .blockspare-posts-block-post-single .blockspare-posts-block-post-img img{
                        border-radius:' . $attributes['borderRadius'] . 'px'.';
                      
                        }';
                    if($attributes['enableBoxShadow']){
                        $block_content .= ' .' . $blockuniqueclass . '  .blockspare-posts-block-post-single .blockspare-posts-block-post-img img{
                            box-shadow: ' . $attributes['xOffset'] . 'px ' . $attributes['yOffset'] . 'px ' . $attributes['blur'] . 'px ' . $attributes['spread'] . 'px ' . $attributes['shadowColor'] . ';
                            }';
                    }
                }else{
                    $block_content .= ' .' . $blockuniqueclass . '  .blockspare-posts-block-post-single{
                        border-radius:' . $attributes['borderRadius'] . 'px'.';
                        background-color:'.$attributes['backGroundColor'].'
                        }';
    
                        if($attributes['enableBoxShadow']){
                            $block_content .= ' .' . $blockuniqueclass . '  .blockspare-posts-block-post-single{
                                box-shadow: ' . $attributes['xOffset'] . 'px ' . $attributes['yOffset'] . 'px ' . $attributes['blur'] . 'px ' . $attributes['spread'] . 'px ' . $attributes['shadowColor'] . ';
                            }';
                        }
                }
        

            //Title Hover
    
      if($attributes['titleOnHover']=='lpc-title-hover') {
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content .blockspare-posts-block-title-link:hover span{
            color: ' . $attributes['titleOnHoverColor'] . ';
            
             }';
        }

    if($attributes['titleOnHover']=='lpc-title-border') {
        $block_content .= ' .' . $blockuniqueclass . ' .lpc-title-border .blockspare-posts-block-post-grid-title .blockspare-posts-block-title-link span:hover{
            box-shadow: inset 0 -2px 0 0 ' . $attributes['titleOnHoverColor'] . ';
            
             }';
    }
    
        
        
        //Font Settings
    
         
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
              
                font-size: ' . $attributes['postTitleFontSize'] . $attributes['titleFontSizeType'] . ';
                
                '.bscheckFontfamily($attributes['titleFontFamily']).';
                font-weight: ' . $attributes['titleFontWeight'] . ';
                 }';
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content {
                font-size:' . $attributes['descriptionFontSize'] . $attributes['descriptionFontSizeType'] . ';
                
                '.bscheckFontfamily($attributes['descriptionFontFamily']).';
                font-weight: ' . $attributes['descriptionFontWeight'] . ';
                }';
        
            $block_content .= '@media (max-width: 1025px) { ';
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                font-size: ' . $attributes['titleFontSizeTablet'] . $attributes['titleFontSizeType'] . ';
                }';
            $block_content .= ' .' .  $blockuniqueclass .' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content {
                font-size:' . $attributes['descriptionFontSizeTablet'].$attributes['descriptionFontSizeType'].'
                }';
            $block_content .= '}';
        
        
            $block_content .= '@media (max-width: 768px) { ';
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                font-size: ' . $attributes['titleFontSizeMobile'] . $attributes['titleFontSizeType'] . ';
                }';
            $block_content .= ' .' .  $blockuniqueclass .' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content {
            font-size:' . $attributes['descriptionFontSizeMobile'].$attributes['descriptionFontSizeType'].'
            }';
            $block_content .= '}';
        
            //Pagination
            if($attributes['enablePagination']){
                $block_content .=' .' . $blockuniqueclass . ' + .bs_blockspare_loadmore a.blockspare-readmore .load-btn{
                    color:'.$attributes['loadMoreTextColor'].';
                    background-color:'.$attributes['loadMoreTextBgColor'].';
                    '.bscheckFontfamily($attributes['titleFontFamily']).';
                }';
                $block_content .=' .' . $blockuniqueclass . ' + .bs_blockspare_loadmore a.blockspare-readmore .ajax-loader-enabled{
                    border-top-color:'.$attributes['loadMoreColor'].';
                }';
                $block_content .= '}';
                
            }
        
    
        $block_content .= '</style>';
        return $block_content;
    }
}
    
    