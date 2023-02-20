<?php
/*This file is part of Newsback child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function newsback_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'covernews-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Lato:400,300,400italic,900,700';
    wp_enqueue_style('newsback-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'newsback',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'newsback_enqueue_child_styles' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsback_widgets_init()
{

    register_sidebar(array(
        'name'          => esc_html__('Front-page Banner Ad Section', 'newsback'),
        'id'            => 'home-advertisement-widgets',
        'description'   => esc_html__('Add widgets for frontpage banner section advertisement.', 'newsback'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));
}

add_action('widgets_init', 'newsback_widgets_init');



function newsback_override_banner_advertisment_function(){
    remove_action('covernews_action_banner_advertisement', 'covernews_banner_advertisement', 10);


}

add_action('wp_loaded', 'newsback_override_banner_advertisment_function');

/**
 * Overriding Parent theme Advertisment section
 *
 * @since NewsQuare 1.0.0
 *
 */
function newsback_banner_advertisement()
{

    if (('' != covernews_get_option('banner_advertisement_section')) ) { ?>
        <div class="banner-promotions-wrapper">
            <?php if (('' != covernews_get_option('banner_advertisement_section'))):

                $covernews_banner_advertisement = covernews_get_option('banner_advertisement_section');
                $covernews_banner_advertisement = absint($covernews_banner_advertisement);
                $covernews_banner_advertisement = wp_get_attachment_image($covernews_banner_advertisement, 'full');
                $covernews_banner_advertisement_url = covernews_get_option('banner_advertisement_section_url');
                $covernews_banner_advertisement_url = isset($covernews_banner_advertisement_url) ? esc_url($covernews_banner_advertisement_url) : '#';
                $covernews_open_on_new_tab = covernews_get_option('banner_advertisement_open_on_new_tab');
                $covernews_open_on_new_tab = ('' != $covernews_open_on_new_tab) ? '_blank' : '';

                ?>
                <div class="promotion-section">
                    <a href="<?php echo esc_url($covernews_banner_advertisement_url); ?>" target="<?php echo esc_attr($covernews_open_on_new_tab); ?>">
                        <?php echo wp_kses_post($covernews_banner_advertisement); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
        <!-- Trending line END -->
        <?php
    }

    if (is_active_sidebar('home-advertisement-widgets')): ?>
        <div class="banner-promotions-wrapper">
            <div class="promotion-section">
                <?php dynamic_sidebar('home-advertisement-widgets'); ?>
            </div>
        </div>
    <?php endif;
}
add_action('covernews_action_banner_advertisement', 'newsback_banner_advertisement', 10);


function newsback_filter_default_theme_options($defaults) {
    $defaults['global_site_mode'] = 'dark';
    $defaults['select_main_banner_section_order_1'] = 'order-2';
    $defaults['site_title_font_size'] = 84;
    return $defaults;
}

add_filter('covernews_filter_default_theme_options', 'newsback_filter_default_theme_options', 1);


function newsback_custom_header_setup($default_custom_header){
    $default_custom_header['default-image'] = get_stylesheet_directory_uri() . '/assets/img/default-header-image.jpeg';
    $default_custom_header['default-text-color'] = 'f3f3f3';
    return $default_custom_header;
}
add_filter('covernews_custom_header_args', 'newsback_custom_header_setup', 1);