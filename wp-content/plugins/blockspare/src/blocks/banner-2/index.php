<?php 


    function blockspare_banner_two_render_block($attributes){
        ob_start();
        $unq_class = mt_rand(100000,999999);
        $blockuniqueclass = '';
        
        if(!empty($attributes['uniqueClass'])){
            $blockuniqueclass = $attributes['uniqueClass'];
        }else{
            $blockuniqueclass = 'blockspare-posts-block-list-'.$unq_class;
        }

        $desingParmeter = $attributes['bannerTwoLayout'];
        
        $numOfSlides = 1;
        if ($attributes['align'] == 'center' || $attributes['align'] == '') {
            $numOfSlides = 1;
        }
        else if ($attributes['align'] == 'full') {
            $numOfSlides = 2;
        }
        $alignclass = blockspare_checkalignment($attributes['align']);

        ?>
        <div class='<?php  echo esc_attr($blockuniqueclass);?> blockspare-banner-1-main-wrapper <?php echo esc_attr($attributes['bannerTwoLayout']) ?> align<?php echo esc_attr($alignclass) ?>'>
            <div class='blockspare-banner-col-wrap'>

                
                <div class="blockspare-banner-trending-wrap">
                    <?php
                                blockspare_get_slider_template($attributes);
                                blocspare_get_trending_template($attributes,$desingParmeter,$numOfSlides);
                                ?>
                </div>
                <?php blocspare_get_editor_template($attributes, '4', 'banner-2');?>
                
            </div>
        </div>
            <?php   
            $blockName = 'blockspare-banner-2'; 
            $data_content =  banner_control_slider($attributes,$blockuniqueclass ,$blockName );
            $data_content .= ob_get_clean();
            return $data_content;     
    }
    /**
     * Registers banner one on server
     */
    function blockspare_banner_two_register_block()
    {
    
        if (!function_exists('register_block_type')) {
            return;
        }
    
    
        ob_start();
         include BLOCKSPARE_PLUGIN_DIR . 'src/blocks/utils/post-banner/block.json';
         
        $metadata = json_decode(ob_get_clean(), true);

        $new_attributes['trendingDisplayPostCategory'] = array(
            "type"=>"boolean",
            "default"=>true
        );

        $attributes = array_merge($metadata['attributes'],$new_attributes);
       

        
        /* Block attributes */
        register_block_type(
            'blockspare/blockspare-banner-2',
            array(
                'attributes' =>$attributes,
                'render_callback' => 'blockspare_banner_two_render_block',
            )
        );
    }
    
    add_action('init', 'blockspare_banner_two_register_block');


    