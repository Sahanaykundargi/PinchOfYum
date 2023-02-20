<?php
    
    if(!function_exists('blockspare_render_block_core_latest_posts_express_grid')){
    function blockspare_render_block_core_latest_posts_express_grid($attributes)
    {

        ob_start();
        $unq_class = mt_rand(100000,999999);
        $blockuniqueclass = '';
        
        if(!empty($attributes['uniqueClass'])){
            $blockuniqueclass = $attributes['uniqueClass'];
        }else{
            $blockuniqueclass = 'blockspare-posts-block-list-'.$unq_class;
        }

        $design = 'blockspare-posts-block-latestpost-express-grid ';
        
       
        $block_class = 'blockspare-posts-block-is-express';
        if($attributes['enableEqualHeight']){
            $block_class .= ' bs-has-equal-height';
        }
        
        if($attributes['displaySpotLightExceprt']){
            $block_class .= ' has-spotlight-excerpt ';
        }
        $design .= $attributes['express'];
        $blockName= 'express';
        
        blockspare_query_loop_and_wrapper($attributes,$block_class,$design,$blockName);
            $data_content =  blockspare_latest_posts_style_control($blockuniqueclass ,$attributes);
            $data_content .= ob_get_clean();
            return   $data_content;
        
       
    }
}
    
    /**
     * Registers the post grid block on server
     */

    if(!function_exists('blockspare_register_block_core_latest_posts_express_grid')){
    function blockspare_register_block_core_latest_posts_express_grid()
    {
    
        if (!function_exists('register_block_type')) {
            return;
        }
    
    
        ob_start();
        include BLOCKSPARE_PLUGIN_DIR . 'src/blocks/latest-posts-express-grid/block.json';
        $metadata = json_decode(ob_get_clean(), true);
    
        /* Block attributes */
        register_block_type(
            'blockspare/latest-posts-express-grid',
            array(
                'attributes' =>$metadata['attributes'],
                'render_callback' => 'blockspare_render_block_core_latest_posts_express_grid',
            )
        );
    }
    
    add_action('init', 'blockspare_register_block_core_latest_posts_express_grid');   
} 
    

    if(!function_exists('blockspare_latest_posts_style_control')){
    
    function blockspare_latest_posts_style_control($blockuniqueclass ,$attributes){  
    
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
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-excerpt-content, '.' .' . $blockuniqueclass . ' .comment_count{
                    color:' . $attributes['generalColor'] . ';
                  
                    }';


                    $layoutstyle = explode('-',$attributes['express']);

                     if($layoutstyle[6] >3){
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


                            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content{
                                padding-top:' . $attributes['contentPaddingTop'] . 'px;
                                padding-right:' . $attributes['contentPaddingRight'] . 'px;
                                padding-bottom:' . $attributes['contentPaddingBottom'] . 'px;
                                padding-left:' . $attributes['contentPaddingLeft'] . 'px;
                                }';
                               
                    }
            
        
            
        
        
       
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title{
                margin-top:' . $attributes['titleMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['titleMarginBottom'] . 'px' . ';
            }';
    
    
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-excerpt-content{
               margin-top:' . $attributes['exceprtMarginTop'] . 'px' . ';
                margin-bottom:' . $attributes['exceprtMarginBottom'] . 'px' . ';
                }';
    
    
    
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
    
      
            if($attributes['express']!='blockspare-posts-block-express-grid-layout-3'&&  $attributes['express']!='blockspare-posts-block-express-grid-layout-6' ){
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span{
              
                    font-size: ' . $attributes['spostTitleFontSize'] . $attributes['titleFontSizeType'] . ';
                    '.bscheckFontfamily($attributes['spostTitleFontFamily']).';
                    font-weight: ' . $attributes['spostTitleFontWeight'] . ';
                     }';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    
                    font-size: ' . $attributes['postTitleFontSize'] . $attributes['titleFontSizeType'] . ';
                    '.bscheckFontfamily($attributes['titleFontFamily']).';
                    font-weight: ' . $attributes['titleFontWeight'] . ';
                    }';
    
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content{
                        font-size:' . $attributes['descriptionFontSize'] . $attributes['descriptionFontSizeType'] . ';
                        '.bscheckFontfamily($attributes['descriptionFontFamily']).';
                        font-weight: ' . $attributes['descriptionFontWeight'] . ';
                        }';
            
            
            
                $block_content .= '@media (max-width: 1025px) { ';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['spostTitleFontSizeTablet'] . $attributes['titleFontSizeType'] . ';
                    }';
            
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['titleFontSizeTablet'] . $attributes['titleFontSizeType'] . ';
                    }';
    
                $block_content .= ' .' .  $blockuniqueclass .' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content{
                        font-size:' . $attributes['descriptionFontSizeTablet'].$attributes['descriptionFontSizeType'].'
                        }';
                
                
                $block_content .= '}';
                $block_content .= '@media (max-width: 768px) { ';
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['spostTitleFontSizeMobile'] . $attributes['titleFontSizeType'] . ';
                    }';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['titleFontSizeMobile'] . $attributes['titleFontSizeType'] . ';
                    }';
            
                $block_content .= '}';
            }else{
            
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span,'.' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(2) .blockspare-posts-block-post-grid-title a span{
              
                    font-size: ' . $attributes['spostTitleFontSize'] . $attributes['titleFontSizeType'] . ';
                    
                    '.bscheckFontfamily($attributes['spostTitleFontFamily']).';
                    font-weight: ' . $attributes['spostTitleFontWeight'] . ';
                     }';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    
                    font-size: ' . $attributes['postTitleFontSize'] . $attributes['titleFontSizeType'] . ';
                    '.bscheckFontfamily($attributes['titleFontFamily']).';
                    font-weight: ' . $attributes['titleFontWeight'] . ';
                    }';
    
    
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content{
                        font-size:' . $attributes['descriptionFontSize'] . $attributes['descriptionFontSizeType'] . ';
                        '.bscheckFontfamily($attributes['descriptionFontFamily']).';
                        font-weight: ' . $attributes['descriptionFontWeight'] . ';
                        }';
            
            
            
                $block_content .= '@media (max-width: 1025px) { ';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span,'.' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(2) .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['spostTitleFontSizeTablet'] . $attributes['titleFontSizeType'] . ';
                    }';
    
                $block_content .= ' .' .  $blockuniqueclass .' .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-excerpt .blockspare-posts-block-post-grid-excerpt-content{
                        font-size:' . $attributes['descriptionFontSizeTablet'].$attributes['descriptionFontSizeType'].'
                        }';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['titleFontSizeTablet'] . $attributes['titleFontSizeType'] . ';
                    }';
            
                $block_content .= '}';
                $block_content .= '@media (max-width: 768px) { ';
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(1) .blockspare-posts-block-post-grid-title a span,'.' .' . $blockuniqueclass . ' .blockspare-posts-block-post-single:nth-child(2) .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['spostTitleFontSizeMobile'] . $attributes['titleFontSizeType'] . ';
                    }';
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-grid-title a span{
                    font-size: ' . $attributes['titleFontSizeMobile'] . $attributes['titleFontSizeType'] . ';
                    }';
            
                $block_content .= '}';
            
            }

    
        $block_content .= '</style>';
        return $block_content;
    }
}