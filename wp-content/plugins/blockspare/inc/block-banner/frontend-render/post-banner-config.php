<?php
if(!function_exists('blockspare_get_slider_template')){
    function blockspare_get_slider_template($attributes){

        $slider_categories = isset($attributes['sliderCategory']) ? $attributes['sliderCategory'] : '';
        $query = array(
            'post_type' => 'post',
            'posts_per_page' => $attributes['sliderPostsToShow'],
            'cat' => $slider_categories,
            'order' => $attributes['sliderOrder'],
            'orderby' => $attributes['sliderOrderBy'],
            'ignore_sticky_posts' => 1,
        );

        $blockspare_result = new WP_Query($query);
        $banner_slider_args = array(
            'loop' => true,
            'autoplay' => $attributes['sliderEnableAutoPlay'],
            'arrows' => $attributes['sliderNextPrevShow'],
            'speed' => $attributes['sliderSpeed'],
            'slidesToShow' => 1,

        );

        $next = $attributes['sliderNextIcon'];
        $prevstr = str_replace("-right", "-left", $attributes['sliderNextIcon']);

        $banner_args_encoded = wp_json_encode($banner_slider_args);
        $blockspare_classes = 'blockspare-banner-slider-wrapper';
        $blockspare_classes .= ' ' . $attributes['sliderNavigationShape'];
        $blockspare_classes .= ' ' . $attributes['sliderNavigationSize'];
        if ($attributes['sliderEnableNavInHover']) {
            $blockspare_classes .= ' nav-on-hover';
        }

        $category_class = 'blockspare-posts-block-post-category';
        if ($attributes['sliderCategoryLayoutOption'] == 'none') {
            $category_class .= ' has-no-category-style';
        }

        $titleHoverClass = '';
        if ($attributes['sliderTitleOnHover'] !== '') {
            $titleHoverClass = 'has-slider-title-hover';
        }?>
    <div class="<?php echo esc_attr($blockspare_classes); ?>">
        <div class="blockspare-banner-slider" data-slick=<?php echo esc_attr($banner_args_encoded); ?> data-next="<?php echo esc_attr($next); ?>" data-prev="<?php echo esc_attr($prevstr); ?>">
            <?php while ($blockspare_result->have_posts()) : $blockspare_result->the_post();
                $post_thumb_id = get_post_thumbnail_id(get_the_ID());
                $post_id = get_the_ID();

            ?>

                <div class='blockspare-post-items'>
                    <div class='blockspare-post-data'>
                        <figure class="blockspare-posts-block-post-img">
                            <?php
                            if(has_post_thumbnail($post_id)){
                            echo wp_kses_post(wp_get_attachment_image($post_thumb_id, 'large'));
                            }else{?>
                                    <div class="bs-no-thumbnail-img"> </div>
                           <?php  } ?>
                        </figure>
                        <div class='blockspare-posts-block-post-content <?php echo esc_attr($titleHoverClass); ?>'>
                            <?php if ($attributes['sliderDisplayPostCategory']) { ?>
                                <div class="<?php echo esc_attr($category_class); ?>">
                                    <?php
                                    $categories_list = get_the_category_list(' ', '', $post_id);
                                    if ($categories_list) {
                                        /* translators: 1: list of categories. */
                                        printf(esc_html__('%1$s', "blockspare"), $categories_list); // WPCS: XSS OK.
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                            <h4 class="blockspare-posts-block-post-grid-title">
                                <a href="<?php echo get_the_permalink(); ?>" class="blockspare-posts-block-title-link">
                                    <span><?php the_title(); ?></span>
                                </a>
                            </h4>

                            <div class="blockspare-posts-block-post-grid-byline">
                                <?php if ($attributes['sliderDisplayPostAuthor']) { ?>
                                    <span class="blockspare-posts-block-post-grid-author">
                                        <!-- <a class="blockspare-posts-block-text-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url" rel="author">
                                            <span itemprop="name"><i class="<?php echo esc_attr($attributes['sliderAuthorIcon']); ?>"></i><?php echo esc_html(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?></span>
                                        </a> -->
                                        <?php 
                                    $author_id = get_post_field( 'post_author', $post_id );
                                    $blockspare_get_multiauthor=  new BlocksapreMultiAuthorForFrontend();
                                    $blockspare_get_multiauthor->blockspare_front_by_author($post_id,$attributes['sliderAuthorIcon'],$author_id);
                                    ?>
                                    </span>
                                <?php } ?>
                                <?php if ($attributes['sliderDisplayPostDate']) { ?>
                                    <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>" class="blockspare-posts-block-post-grid-date" itemprop="datePublished">
                                        <i class="<?php echo esc_attr($attributes['sliderDateIcon']); ?>"></i><?php echo esc_html(get_the_date('', $post_id)); ?>
                                    </time>
                                <?php } ?>
                                <?php if ($attributes['sliderEnableComment']) { ?>
                                    <span class="comment_count">
                                        <i class="<?php echo esc_attr($attributes['sliderCommentIcon']); ?>"></i><?php echo esc_html(get_comments_number($post_id)); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;
            wp_reset_postdata();
            ?>

        </div>

    </div>

<?php }
}

//End Slider HTML
//Trending Html
if(!function_exists('blocspare_get_trending_template')){
    function blocspare_get_trending_template($attributes,$desingParmeter='',$noSlides=''){
    $trending_categories = isset($attributes['trendingCategory']) ? $attributes['trendingCategory'] : '';

            $trending_query = array(
                'post_type'=>'post',
                'posts_per_page'=>$attributes['trendingPostToshow'],
                'cat' => $trending_categories,
                'order'=>$attributes['sliderOrder'],
                'orderby'=>$attributes['sliderOrderBy'],
                'ignore_sticky_posts' => 1,
            );

            $blockspare_trending_result = new WP_Query($trending_query);
        
                
            $trending_slider_args = array(
                        
                
                    'loop'=>true,
                    'autoplay'=>$attributes['trendingEnableAutoPlay'],
                    'slidesToShow'=>$noSlides ,
                    'arrows'=>$attributes['trendingNextPrevShow'],
                    'speed'=>$attributes['trendingSpeed'],
            );

            $next = $attributes['trendingNextIcon'];
            $prevstr = str_replace("-right", "-left",$next);

            $trending_classes = "blockspare-banner-trending-carousel-wrapper ";
            $trending_classes .= ' '.$attributes['trendingNavigationShape'];
            $trending_classes .= ' '.$attributes['trendingNavigationSize'];
            $trending_classes .= ' '.'has-gutter-space-'.$attributes['trendingGutterSpace'];

            if($attributes['trendingEnableNavInHover']){
                $trending_classes .=' nav-on-hover';
            }

            $trendingHoverClass = '';
            if ($attributes['trendingTitleOnHover'] !== '') {
                $trendingHoverClass = 'has-trending-title-hover';
            }

            $trending_category_class = 'blockspare-posts-block-post-category';
            if($attributes['trendingCategoryLayoutOption'] =='none'){
                $trending_category_class .= ' has-no-category-style';
            }

            $trending_args_encoded = wp_json_encode($trending_slider_args);?>
            <div class="<?php echo esc_attr($trending_classes )?>">
                <div class="banner-trending-carousel" data-slick="<?php echo esc_attr($trending_args_encoded)?>"
                    data-next="<?php echo esc_attr($next);?>" data-prev="<?php echo esc_attr($prevstr);?>">
                    <?php while($blockspare_trending_result->have_posts()):$blockspare_trending_result->the_post();
                                $post_thumb_id = get_post_thumbnail_id(get_the_ID());
                                $post_id = get_the_ID();
                                ?>


                    <div class='blockspare-post-items <?php echo esc_attr($desingParmeter) ?>'>
                        <div class='blockspare-post-data'>
                            <figure class="blockspare-posts-block-post-img">
                            <?php
                            if(has_post_thumbnail($post_id)){
                            echo wp_kses_post(wp_get_attachment_image($post_thumb_id, 'large'));
                            }else{?>
                                    <div class="bs-no-thumbnail-img"> </div>
                           <?php  } ?>
                            </figure>
                            <div class='blockspare-posts-block-post-content <?php echo esc_attr($trendingHoverClass);?>'>
                            <?php if($attributes['trendingDisplayPostCategory']){?>
                                <div class="<?php echo esc_attr($trending_category_class);?>">
                                    <?php
                                                                $categories_list = get_the_category_list(' ', '', $post_id);
                                                                if ( $categories_list ) {
                                                                    /* translators: 1: list of categories. */
                                                                    printf(  esc_html__( '%1$s', "blockspare" ), $categories_list ); // WPCS: XSS OK.
                                                                }
                                                                ?>
                                </div>
                                <?php }?>
                                <h4 class="blockspare-posts-block-post-grid-title">
                                    <a href="<?php echo get_the_permalink(); ?>" class="blockspare-posts-block-title-link">
                                        <span><?php the_title(); ?></span>
                                    </a>
                                </h4>
                                <div class="blockspare-posts-block-post-grid-byline">
                                    <?php if ($attributes['trendingDisplayPostAuthor']) { ?>
                                        <span class="blockspare-posts-block-post-grid-author">
                                            <!-- <a class="blockspare-posts-block-text-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url" rel="author">
                                                <span itemprop="name"><i class="<?php echo esc_attr($attributes['trendingAuthorIcon']); ?>"></i><?php echo esc_html(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?></span>
                                            </a> -->
                                            <?php 
                                            $author_id = get_post_field( 'post_author', $post_id );
                                            $blockspare_get_multiauthor=  new BlocksapreMultiAuthorForFrontend();
                                            $blockspare_get_multiauthor->blockspare_front_by_author($post_id,$attributes['trendingAuthorIcon'],$author_id);
                                            ?>
                                        </span>
                                    <?php } ?>
                                    <?php if ($attributes['trendingDisplayPostDate']) { ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>" class="blockspare-posts-block-post-grid-date" itemprop="datePublished">
                                            <i class="<?php echo esc_attr($attributes['trendingDateIcon']); ?>"></i>
                                            <?php echo esc_html(get_the_date('', $post_id)); ?>
                                        </time>
                                    <?php } ?>
                                    <?php if ($attributes['trendingEnableComment']) { ?>
                                        <span class="comment_count">
                                            <i class="<?php echo esc_attr($attributes['trendingCommentIcon']); ?>"></i>
                                            <?php echo esc_html(get_comments_number($post_id)); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile;
                wp_reset_postdata();
                ?>

            </div>
        </div>
    <?php
    }

} //End Trending Html

if(!function_exists('blocspare_get_editor_template')){
    function blocspare_get_editor_template($attributes, $bsitem, $banner_name = 'banner-1'){
        $editor_categories = isset($attributes['editorCategory']) ? $attributes['editorCategory'] : '';



        $editorPostsToShows = $bsitem;
        $editor_query = array(
            'post_type' => 'post',
            'posts_per_page' => $editorPostsToShows, //$attributes['editorPostsToShow']
            'cat' => $editor_categories,
            'order' => $attributes['editorOrder'],
            'orderby' => $attributes['editorOrderBy'],
            'ignore_sticky_posts' => 1,
        );

        $editor_category_class = 'blockspare-posts-block-post-category';
        if ($attributes['editorCategoryLayoutOption'] == 'none') {
            $editor_category_class .= ' has-no-category-style';
        }




        $editorHoverClass = '';
        if ($attributes['editorTitleOnHover'] !== '') {
            $editorHoverClass = 'has-editor-title-hover';
        }

        $blockspare_image_size = 'medium';



        $blockspare_editor_result = new WP_Query($editor_query); ?>
        <div class="blockspare-banner-editor-picks-wrapper">
            <div class="blockspare-editor-picks-items ">

                <?php
                $blockspare_count = 1;
                while ($blockspare_editor_result->have_posts()) :
                    $blockspare_editor_result->the_post();
                    $post_thumb_id = get_post_thumbnail_id(get_the_ID());
                    $post_id = get_the_ID();                

                    if ($banner_name == 'banner-3' || $banner_name == 'banner-4' || $banner_name == 'banner-7' || $banner_name == 'banner-8') {
                        if ($blockspare_count == 1) {
                            $blockspare_image_size = 'large';
                        }
                    }
                ?>

                    <div class='blockspare-post-items'>
                        <div class='blockspare-post-data'>
                            <figure class="blockspare-posts-block-post-img">
                            <?php
                            if(has_post_thumbnail($post_id)){
                            echo wp_kses_post(wp_get_attachment_image($post_thumb_id, 'large'));
                            }else{?>
                                    <div class="bs-no-thumbnail-img"> </div>
                           <?php  } ?>
                            </figure>
                            <div class='blockspare-posts-block-post-content <?php echo esc_attr($editorHoverClass); ?>'>
                                <?php if ($attributes['editorDisplayPostCategory']) { ?>
                                    <div class="<?php echo esc_attr($editor_category_class); ?>">
                                        <?php
                                        $categories_list = get_the_category_list(' ', '', $post_id);
                                        if ($categories_list) {
                                            /* translators: 1: list of categories. */
                                            printf(esc_html__('%1$s', "blockspare"), $categories_list); // WPCS: XSS OK.
                                        }
                                        ?>
                                    </div>
                                <?php } ?>
                                <h4 class="blockspare-posts-block-post-grid-title">
                                    <a href="<?php echo get_the_permalink(); ?>" class="blockspare-posts-block-title-link">
                                        <span><?php the_title(); ?></span>
                                    </a>
                                </h4>
                                <div class="blockspare-posts-block-post-grid-byline">
                                    <?php if ($attributes['editorDisplayPostAuthor']) { ?>
                                        <span class="blockspare-posts-block-post-grid-author">
                                            <!-- <a class="blockspare-posts-block-text-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url" rel="author">
                                                <span itemprop="name"><i class="<?php echo esc_attr($attributes['editorAuthorIcon']); ?>"></i><?php echo esc_html(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?></span>
                                            </a> -->
                                            <?php 
                                            $author_id = get_post_field( 'post_author', $post_id );
                                            $blockspare_get_multiauthor=  new BlocksapreMultiAuthorForFrontend();
                                            $blockspare_get_multiauthor->blockspare_front_by_author($post_id,$attributes['editorAuthorIcon'],$author_id);
                                            ?>
                                        </span>
                                    <?php } ?>
                                    <?php if ($attributes['editorDisplayPostDate']) { ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>" class="blockspare-posts-block-post-grid-date" itemprop="datePublished">
                                            <i class="<?php echo esc_attr($attributes['editorDateIcon']); ?>"></i><?php echo esc_html(get_the_date('', $post_id)); ?>
                                        </time>
                                    <?php } ?>
                                    <?php if ($attributes['editorEnableComment']) { ?>
                                        <span class="comment_count">
                                            <i class="<?php echo esc_attr($attributes['editorCommentIcon']); ?>"></i><?php echo esc_html(get_comments_number($post_id)); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $blockspare_count++;
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    <?php 
    }
}

if(!function_exists('blockspare_checkalignment')){
    function blockspare_checkalignment($alignment = ''){
        $align_class = $alignment;
        if ($alignment == '') {
            $align_class = 'center';
        }

        return $align_class;
    }
}
