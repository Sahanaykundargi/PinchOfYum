<?php 

function banner_control_slider($attributes,$blockuniqueclass,$blockName=''){
    $block_content = '';
    $block_content .= '<style type="text/css">';

    //Slider Title Meta Color
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-title a span{
        color:'.$attributes['sliderPostTitleColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-title{
        line-height:'.$attributes['sliderTitleLineHeight'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-author a span{
        color:'.$attributes['sliderPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .blockspare-posts-block-text-link a{
        color:'.$attributes['sliderPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-date{
        color:'.$attributes['sliderPostGeneralColor'].';
    }';
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-slider-wrapper .comment_count{
        color:'.$attributes['sliderPostGeneralColor'].';
    }';

    //sliderTitle Hover

  if($attributes['sliderTitleOnHover']=='lpc-title-hover') {
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content.has-slider-title-hover .blockspare-posts-block-title-link:hover span{
        color: ' . $attributes['sliderTitleOnHoverColor'] . ';
        
         }';
    }

if($attributes['sliderTitleOnHover']=='lpc-title-border') {
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content.has-slider-title-hover .blockspare-posts-block-post-grid-title .blockspare-posts-block-title-link span:hover{
        box-shadow: inset 0 -2px 0 0 ' . $attributes['sliderTitleOnHoverColor'] . ';
        
         }';
}
//slider title Gaps
$block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-banner-slider .blockspare-posts-block-post-grid-title{
   margin-top: ' . $attributes['sliderTitleMarginTop'] ."px". ';
   margin-Bottom: ' . $attributes['sliderTitleMarginBottom'] ."px". ';
    
     }';




    //slider Category color
    if ($attributes['sliderCategoryLayoutOption'] == 'solid') {
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
            color:' . $attributes['sliderCategoryTextColor'] . "!important" . ';
            background-color:' . $attributes['sliderCategoryBackgroundColor'] . "!important" . ';
            border-radius:' . $attributes['sliderCategoryBorderRadius'] . "px" . ';
        }';
  
        } else if ($attributes['sliderCategoryLayoutOption'] == 'border') {
            
                $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
                color:' . $attributes['sliderCategoryTextColor'] . "!important" . ';
                background-color:' . "transparent" . ';
                border:' . "1px solid" . $attributes['sliderCategoryBorderColor'] . ';
                border-radius:' . $attributes['sliderCategoryBorderRadius'] . "px" . ';
                border-width:' . $attributes['sliderCategoryBorderWidth'] . "px" . ';
            }';
            
            
            
        } else {
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
                color:' . $attributes['sliderCategoryTextColor'] . "!important" . ';
                }';
        }

    //slider nav color
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper span:before{
        color:' . $attributes['sliderNavigationColor'].';
        }';

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-wrap .blockspare-banner-slider-wrapper .slick-slider .slick-dots > li button{
        background-color:' . $attributes['sliderNavigationColor'].';
        }'; 

    if($attributes['sliderNextPrevShow']) {
        if($attributes['sliderNavigationShape'] === 'bs-navigation-1' ||  $attributes['sliderNavigationShape']  === 'bs-navigation-2' ) {
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider .slick-arrow:after{
                background-color:' . $attributes['sliderNavigationShapeColor'].';
                }'; 
        }elseif($attributes['sliderNavigationShape']  === 'bs-navigation-3' ||  $attributes['sliderNavigationShape']  === 'bs-navigation-4' ){
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider .slick-arrow{
                border-color:' . $attributes['sliderNavigationShapeColor'].';
                }'; 
        }else{
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider .slick-slider .slick-arrow{
                border-color:'."transparent".';
                background-color:'."transparent".';
                }'; 

        }
    }   
    
    //trending Bg color

    $bg = 'transparent';
    
    if($blockName == 'blockspare-banner-1'){
        $bg = $attributes['bannerOneTrendingBg'];
    }
    else if($blockName == 'blockspare-banner-2'){
        $bg = $attributes['bannerTwoTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-3'){
        $bg = $attributes['bannerThreeTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-4'){
        $bg = $attributes['bannerFourTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-5'){
        $bg = $attributes['bannerFiveTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-6'){
        $bg = $attributes['bannerSixTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-7'){
        $bg = $attributes['bannerSevenTrendingBg']; 
    }
    else if($blockName == 'blockspare-banner-8'){
        $bg = $attributes['bannerEightTrendingBg']; 
    }

    $block_content .=' .'.$blockuniqueclass. ' .banner-trending-carousel .blockspare-post-items.has-bg-layout{
        background-color:'.$bg.';
    }';
    
    //Trending Title Meta Color
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-grid-title a span{
        color:'.$attributes['trendingPostTitleColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-title{
        line-height:'.$attributes['trendingTitleLineHeight'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-grid-author a span{
        color:'.$attributes['trendingPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-text-link a{
        color:'.$attributes['trendingPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-grid-date{
        color:'.$attributes['trendingPostGeneralColor'].';
    }';
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .comment_count{
        color:'.$attributes['trendingPostGeneralColor'].';
    }';

     //trending Title Hover

  if($attributes['trendingTitleOnHover']=='lpc-title-hover') {
    $block_content .= ' .' .$blockuniqueclass. ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-content.has-trending-title-hover .blockspare-posts-block-title-link:hover span{
        color: ' . $attributes['trendingTitleOnHoverColor'] . ';
        
         }';
    }

    //trending title Gaps
$block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-grid-title{
    margin-top: ' . $attributes['trendingTitleMarginTop'] ."px". ';
    margin-Bottom: ' . $attributes['trendingTitleMarginBottom'] ."px". ';
     
      }';

    
if($attributes['trendingTitleOnHover']=='lpc-title-border') {
    
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-content.has-trending-title-hover .blockspare-posts-block-post-grid-title .blockspare-posts-block-title-link span:hover{
        box-shadow: inset 0 -2px 0 0 ' . $attributes['trendingTitleOnHoverColor'] . ';
        
         }';
}



    //Trending nav color
    $block_content .= ' .' . $blockuniqueclass . '  .banner-trending-carousel span:before{
        color:' . $attributes['trendingNavigationColor'].';
        }';

    $block_content .= ' .' . $blockuniqueclass . ' .banner-trending-carousel .slick-slider .slick-dots > li button{
        background-color:' . $attributes['trendingNavigationColor'].';
        }'; 

    if($attributes['trendingNextPrevShow']) {
        if($attributes['trendingNavigationShape'] == 'bs-navigation-1' ||  $attributes['trendingNavigationShape']  == 'bs-navigation-2' ) {
            $block_content .= ' .' . $blockuniqueclass . '  .blockspare-banner-trending-carousel-wrapper .slick-slider .slick-arrow:after{
                background-color:' . $attributes['trendingNavigationShapeColor'].';
                }'; 
        }elseif($attributes['trendingNavigationShape']  == 'bs-navigation-3' ||  $attributes['trendingNavigationShape']  == 'bs-navigation-4' ){
            $block_content .= ' .' . $blockuniqueclass . '  .blockspare-banner-trending-carousel-wrapper .slick-slider .slick-arrow{
                border-color:' . $attributes['trendingNavigationShapeColor'].';
                }'; 
        }else{
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-wrap .blockspare-banner-trending-carousel-wrapper .slick-slider .slick-arrow{
                border-color:'."transparent".';
                background-color:'."transparent".';
                }'; 

        }
    } 
    
    
    //Editor Picks Title Meta Color
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-title a span{
        color:'.$attributes['editorPostTitleColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-editor-picks-wrapper .blockspare-posts-block-post-content .blockspare-posts-block-post-grid-title{
        line-height:'.$attributes['editorTitleLineHeight'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-author a span{
        color:'.$attributes['editorPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-text-link a{
        color:'.$attributes['editorPostLinkColor'].';
    }';

    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-date{
        color:'.$attributes['editorPostGeneralColor'].';
    }';
    $block_content .=' .'.$blockuniqueclass. ' .blockspare-banner-editor-picks-wrapper .comment_count{
        color:'.$attributes['editorPostGeneralColor'].';
    }';

     //sliderTitle Hover

  if($attributes['editorTitleOnHover']=='lpc-title-hover') {
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content.has-editor-title-hover .blockspare-posts-block-title-link:hover span{
        color: ' . $attributes['editorTitleOnHoverColor'] . ';
        
         }';
    }

if($attributes['editorTitleOnHover']=='lpc-title-border') {
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-posts-block-post-content.has-editor-title-hover .blockspare-posts-block-post-grid-title .blockspare-posts-block-title-link span:hover{
        box-shadow: inset 0 -2px 0 0 ' . $attributes['editorTitleOnHoverColor'] . ';
        
         }';
}

    //editor title Gaps
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-editor-picks-items  .blockspare-posts-block-post-grid-title{
        margin-top: ' . $attributes['editorTitleMarginTop'] ."px". ';
        margin-Bottom: ' . $attributes['editorTitleMarginBottom'] ."px". ';
         
          }';


    //Editor picks Category Color
    if ($attributes['editorCategoryLayoutOption'] == 'solid') {
        
       
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-category a{
        color:' . $attributes['editorCategoryTextColor'] . "!important" . ';
        background-color:' . $attributes['editorCategoryBackgroundColor'] . "!important" . ';
        border-radius:' . $attributes['editorCategoryBorderRadius'] . "px" . ';
    }';

    } else if ($attributes['editorCategoryLayoutOption'] == 'border') {
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-category a{
            color:' . $attributes['editorCategoryTextColor'] . "!important" . ';
            background-color:' . "transparent" . ';
            border:' . "1px solid" . $attributes['editorCategoryBorderColor'] . ';
            border-radius:' . $attributes['editorCategoryBorderRadius'] . "px" . ';
            border-width:' . $attributes['editorCategoryBorderWidth'] . "px" . ';
        }';
        
        
        
    } else {
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-category a{
            color:' . $attributes['editorCategoryTextColor'] . "!important" . ';
            }';
    }


    //Trending carousel Category Color
    if ($attributes['trendingCategoryLayoutOption'] == 'solid') {
        
       
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-category a{
        color:' . $attributes['trendingCategoryTextColor'] . "!important" . ';
        background-color:' . $attributes['trendingCategoryBackgroundColor'] . "!important" . ';
        border-radius:' . $attributes['trendingCategoryBorderRadius'] . "px" . ';
    }';

    } else if ($attributes['trendingCategoryLayoutOption'] == 'border') {
        
            $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-category a{
            color:' . $attributes['trendingCategoryTextColor'] . "!important" . ';
            background-color:' . "transparent" . ';
            border:' . "1px solid" . $attributes['trendingCategoryBorderColor'] . ';
            border-radius:' . $attributes['trendingCategoryBorderRadius'] . "px" . ';
            border-width:' . $attributes['trendingCategoryBorderWidth'] . "px" . ';
        }';
        
        
        
    } else {
        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-category a{
            color:' . $attributes['trendingCategoryTextColor'] . "!important" . ';
            }';
    }

    /**
     * Font Size styles
     */

    //Slider Title Font size
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
          
        font-size: ' . $attributes['sliderTitleFontSize'] . $attributes['sliderTitleFontSizeType'] . ';
        '.bscheckFontfamily($attributes['sliderTitleFontFamily']).';
        font-weight: ' . $attributes['sliderTitleFontWeight'] . ';
      
         }';

    //Category Fornt
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
          
        font-size: ' . $attributes['sliderCategoryFontSize'] . $attributes['sliderTitleFontSizeType'] . ';
        '.bscheckFontfamily($attributes['sliderCategoryFontFamily']).';
        font-weight: ' . $attributes['sliderCategoryFontWeight'] . ';
          
             }';

    //Editor picks
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
          
        font-size: ' . $attributes['editorTitleFontSize'] . $attributes['editorTitleFontSizeType'] . ';
        
        '.bscheckFontfamily($attributes['editorTitleFontFamily']).';
        font-weight: ' . $attributes['editorTitleFontWeight'] . ';
      
         }';

         $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-category a{
          
            font-size: ' . $attributes['editorCategoryFontSize'] . $attributes['editorTitleFontSizeType'] . ';
            '.bscheckFontfamily($attributes['editorCategoryFontFamily']).';
            font-weight: ' . $attributes['editorCategoryFontWeight'] . ';
              
                 }';
    //Trending Carousel


    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title {
          
        font-size: ' . $attributes['trendingTitleFontSize'] . $attributes['trendingTitleFontSizeType'] . ';
        
        '.bscheckFontfamily($attributes['trendingTitleFontFamily']).';
        font-weight: ' . $attributes['trendingTitleFontWeight'] . ';
          
        }';

        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-posts-block-post-category a{
          
            font-size: ' . $attributes['trendingCategoryFontSize'] . $attributes['trendingTitleFontSizeType'] . ';
            '.bscheckFontfamily($attributes['trendingCategoryFontFamily']).';
            font-weight: ' . $attributes['trendingCategoryFontWeight'] . ';
              
                 }';

    //Slider Meta
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-author a span{
            
        font-size: ' . $attributes['sliderMetaFontSize'] . $attributes['sliderMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['sliderMetaFontFamily']).';
        font-weight: ' . $attributes['sliderMetaFontWeight'] . ';
    
    }'; 
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-date{
        
        font-size: ' . $attributes['sliderMetaFontSize'] . $attributes['sliderMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['sliderMetaFontFamily']).';
        font-weight: ' . $attributes['sliderMetaFontWeight'] . ';
    
    }'; 

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .comment_count{
    
        font-size: ' . $attributes['sliderMetaFontSize'] . $attributes['sliderMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['sliderMetaFontFamily']).';
        font-weight: ' . $attributes['sliderMetaFontWeight'] . ';
    
    }'; 
    //Editor picks Meta
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-author a span{
          
        font-size: ' . $attributes['editorMetaFontSize'] . $attributes['editorTitleFontSizeType'] . ';
        '.bscheckFontfamily($attributes['editorMetaFontFamily']).';
        font-weight: ' . $attributes['editorMetaFontWeight'] . ';
      
    }'; 
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-date{
          
        font-size: ' . $attributes['editorMetaFontSize'] . $attributes['editorTitleFontSizeType'] . ';
        '.bscheckFontfamily($attributes['editorMetaFontFamily']).';
        font-weight: ' . $attributes['editorMetaFontWeight'] . ';
      
    }'; 
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .comment_count{
          
        font-size: ' . $attributes['editorMetaFontSize'] . $attributes['editorTitleFontSizeType'] . ';
        '.bscheckFontfamily($attributes['editorMetaFontFamily']).';
        font-weight: ' . $attributes['editorMetaFontWeight'] . ';
      
    }'; 

    //Trending Carousel Meta
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-author a span{
            
        font-size: ' . $attributes['trendingMetaFontSize'] . $attributes['trendingMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['trendingMetaFontFamily']).';
        font-weight: ' . $attributes['trendingMetaFontWeight'] . ';
        
    }';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-date{
            
        font-size: ' . $attributes['trendingMetaFontSize'] . $attributes['trendingMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['trendingMetaFontFamily']).';
        font-weight: ' . $attributes['trendingMetaFontWeight'] . ';
        
    }';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper  .comment_count{
            
        font-size: ' . $attributes['trendingMetaFontSize'] . $attributes['trendingMetaFontSizeType'] . ';
        '.bscheckFontfamily($attributes['trendingMetaFontFamily']).';
        font-weight: ' . $attributes['trendingMetaFontWeight'] . ';
        
    }';

    $block_content .= '@media (max-width: 1025px) { ';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
        font-size: ' . $attributes['sliderTitleFontSizeTablet'] . $attributes['sliderTitleFontSizeType'] . ';
        }';

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
          
        font-size: ' . $attributes['sliderCategoryFontSizeTablet'] . $attributes['sliderTitleFontSizeType'] . ';    
    }';

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
        font-size: ' . $attributes['editorTitleFontSizeTablet'] . $attributes['editorTitleFontSizeType'] . ';
        }'; 

        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-editor-picks-wrapper .blockspare-posts-block-post-category a{
          
            font-size: ' . $attributes['editorCategoryFontSizeTablet'] . $attributes['editorTitleFontSizeType'] . ';    
            }';
        
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
          
        font-size: ' . $attributes['trendingTitleFontSizeTablet'] . $attributes['trendingTitleFontSizeType'] . ';          
        }';

         $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
          
        font-size: ' . $attributes['trendingTitleFontSizeTablet'] . $attributes['trendingTitleFontSizeType'] . ';          
        }';
    
    //Meta
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-author a span, .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-date, .blockspare-banner-slider-wrapper .comment_count{
        font-size: ' . $attributes['sliderMetaFontSizeTablet'] . $attributes['sliderTitleFontSizeType'] . ';
        }';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-author a span, .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-date, .blockspare-banner-editor-picks-wrapper .comment_count{
        font-size: ' . $attributes['editorMetaFontSizeTablet'] . $attributes['sliderTitleFontSizeType'] . ';
        }'; 
    
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-author a span, .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-date, .blockspare-banner-trending-carousel-wrapper  .comment_count{
        font-size: ' . $attributes['trendingMetaFontSizeTablet'] . $attributes['trendingMetaFontSizeType'] . ';
        }';
    //End Meta    
    
    $block_content .= '}';

    $block_content .= '@media (max-width: 767px) { ';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
        font-size: ' . $attributes['sliderTitleFontSizeMobile'] . $attributes['sliderTitleFontSizeType'] . ';
        }';

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-category a{
          
        font-size: ' . $attributes['sliderCategoryFontSizeMobile'] . $attributes['sliderTitleFontSizeType'] . ';    
        }';

    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
        font-size: ' . $attributes['editorTitleFontSizeMobile'] . $attributes['editorTitleFontSizeType'] . ';
        }';


        $block_content .= ' .' . $blockuniqueclass . ' .blockspare-editor-picks-wrapper .blockspare-posts-block-post-category a{
          
            font-size: ' . $attributes['editorCategoryFontSizeMobile'] . $attributes['editorTitleFontSizeType'] . ';    
            }';
    
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper .blockspare-post-items .blockspare-posts-block-post-grid-title{
        font-size: ' . $attributes['trendingTitleFontSizeMobile'] . $attributes['trendingTitleFontSizeType'] . ';          
        }';

    //Meta
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-author a span, .blockspare-banner-slider-wrapper .blockspare-posts-block-post-grid-date, .blockspare-banner-slider-wrapper .comment_count{
        font-size: ' . $attributes['sliderMetaFontSizeMobile'] . $attributes['sliderTitleFontSizeType'] . ';
        }';
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-author a span, .blockspare-banner-editor-picks-wrapper .blockspare-posts-block-post-grid-date, .blockspare-banner-editor-picks-wrapper .comment_count{
        font-size: ' . $attributes['editorMetaFontSizeMobile'] . $attributes['sliderTitleFontSizeType'] . ';
        }'; 
    
    $block_content .= ' .' . $blockuniqueclass . ' .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-author a span, .blockspare-banner-trending-carousel-wrapper  .blockspare-posts-block-post-grid-date, .blockspare-banner-trending-carousel-wrapper  .comment_count{
        font-size: ' . $attributes['trendingMetaFontSizeMobile'] . $attributes['trendingMetaFontSizeType'] . ';
        }';
    
    


     


    $block_content .='</style>';
    return $block_content;
}