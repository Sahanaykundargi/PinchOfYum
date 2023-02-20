<?php
 
    //Exit if directly acess
    defined('ABSPATH') or die('No script kiddies please!');

    if(!class_exists('BlockspareInit')){
        class BlockspareInit{
            /**
         * Member Variable
         *
         * @var instance
         */
        private static $instance;

        /**
         *  Initiator
         */
        public static function get_instance()
        {
            if (!isset(self::$instance))
            {
                self::$instance = new self();
            }
            return self::$instance;
        }
        public function __construct()
        {
            add_action('init', array($this, 'blockspare_blocks_block_assets' ));
            add_action('enqueue_block_editor_assets', array($this,'blockspare_create_block'));
            add_action('wp_enqueue_scripts', array($this,'blockspare_load_scripts'));
            add_action('plugins_loaded', array($this,'blockspare_blocks_loader'));
            add_action( 'rest_api_init', array($this,'blockspare_blocks_register_api_endpoints' ));
        }

        function blockspare_blocks_block_assets(){
            wp_enqueue_style(
                'blockspare-blocks-fontawesome-front',
                plugins_url('src/assets/fontawesome/css/all.css', dirname(__FILE__)),
                array(),
                filemtime(plugin_dir_path(__FILE__) . 'assets/fontawesome/css/all.css')
            );
            // Load the compiled styles.
            wp_enqueue_style(
                'blockspare-frontend-block-style-css',
                plugins_url('dist/style-blocks.css', dirname(__FILE__)),
                array()
            );
    
    
            wp_enqueue_style('slick-css', BLOCKSPARE_PLUGIN_URL . 'src/assets/slick/css/slick.css', array(), '', 'all');
        }

        function blockspare_load_scripts(){
            $min = (SCRIPT_DEBUG == true) ? '' : '.min';
            wp_enqueue_script('slick-js', BLOCKSPARE_PLUGIN_URL . 'src/assets/slick/js/slick.js', array('jquery'), '', true);
            wp_register_script('countup', BLOCKSPARE_PLUGIN_URL . 'src/assets/js/countup/jquery.counterup' . $min . '.js', array('waypoint'), true);
            wp_enqueue_script('waypoint', BLOCKSPARE_PLUGIN_URL . 'src/assets/js/countup/waypoints.min.js', array('jquery'), '', true);
            wp_enqueue_script('jquery-masonry');
            wp_enqueue_script('blockspare-script', BLOCKSPARE_PLUGIN_URL . 'src/assets/js/frontend.js', array('jquery', 'waypoint', 'countup'), '', true);
            wp_enqueue_script('blockspare-tabs', BLOCKSPARE_PLUGIN_URL . 'src/assets/js/tabs.js', array('jquery'), '', true);
        }

        function blockspare_create_block(){

            $script_dep_path = BLOCKSPARE_BASE_DIR . 'dist/blocks.asset.php';
            $script_info = file_exists($script_dep_path) ? include $script_dep_path : array(
                'dependencies' => array() ,
                'version' => BLOCKSPARE_VERSION,
            );
            if (version_compare(get_bloginfo('version') , '5.8', '<'))
            {
                $script_dep = array_merge($script_info['dependencies'],array(
                    'wp-blocks',
                    'wp-i18n',
                    'wp-element',
                    'wp-components',
                    'wp-editor',
                    'wp-api-fetch'
                ));
            }
            else
            {
                $script_dep = $script_info['dependencies'];
            }

            wp_enqueue_script('blockspare-blocks-block-js', // Handle.
            BLOCKSPARE_PLUGIN_URL . 'dist/blocks.js', $script_dep, // Dependencies, defined above.
            $script_info['version'], // AFT_PRICING_TABLE_VERSION.
            true
            // Enqueue the script in the footer.
            );

            if (is_admin()) :
                wp_enqueue_style(
                    'blockspare-block-edit-style',
                    BLOCKSPARE_PLUGIN_URL . 'dist/blocks.css',
                    array('wp-edit-blocks')
                );
            endif;
    
            
            $blockspare_priview_img_url = BLOCKSPARE_PLUGIN_URL . 'src/assets/blockspare-placeholder-img.jpg';
            $blockspare_food_img_url = BLOCKSPARE_PLUGIN_URL . 'src/assets/blockspare-placeholder-img-square.jpg';
    
            $taxonomies = get_categories();
            $txnm = array();
    
            foreach( $taxonomies as $type ) {
        
        
                $txnm[] = array(
                    'label' => $type->name,
                    'value' => $type->term_id,
                );
            }
    
    
            wp_localize_script(
                'blockspare-blocks-block-js',
                'blockspare_globals',
                array(
                    'srcUrl' => untrailingslashit(plugins_url('/', BLOCKSPARE_BASE_DIR . '/dist/')),
                    'rest_url' => esc_url(rest_url()),
                    'img' => $blockspare_priview_img_url,
                    'menu_img_url' => $blockspare_food_img_url,
                    'postTypes'      => $this->aft_get_post_types(),
			        'taxonomies'     => $this->aft_get_taxonomies(),
                    'postQueryEndpoint'=>'aft/v1/post-query',
                    'config'         => '',
                    'configuration'  => '',
                    'settings'       => '',
                )
            );
        }

        function aft_get_post_types(){
            $args = array(
                'public'       => true,
                'show_in_rest' => true,
            );
            $post_types = get_post_types( $args, 'objects' );
            $output = array();
            foreach ( $post_types as $post_type ) {
               
                if ( 'attachment' == $post_type->name ) {
                    continue;
                }
                $output[] = array(
                    'value' => $post_type->name,
                    'label' => $post_type->label,
                );
            }

            return apply_filters( 'aft_blocks_post_types', $output );
        }

        function aft_get_taxonomies() {
            $post_types = $this->aft_get_post_types();
            $output = array();
            foreach ( $post_types as $key => $post_type ) {
                $taxonomies = get_object_taxonomies( $post_type['value'], 'objects' );
                $taxs = array();
                foreach ( $taxonomies as $term_slug => $term ) {
                    if ( ! $term->public || ! $term->show_ui ) {
                        continue;
                    }
                    $taxs[ $term_slug ] = $term;
                    $terms = get_terms( $term_slug );
                    $term_items = array();
                    if ( ! empty( $terms ) ) {
                        foreach ( $terms as $term_key => $term_item ) {
                            $term_items[] = array(
                                'value' => $term_item->term_id,
                                'label' => $term_item->name,
                            );
                        }
                        $output[ $post_type['value'] ]['terms'][ $term_slug ] = $term_items;
                    }
                }
                $output[ $post_type['value'] ]['taxonomy'] = $taxs;
            }
           
            return apply_filters( 'aft_blocks_taxonomies', $output );
        }

        function blockspare_blocks_loader(){
            
        //Load Gutenberg Block php Files
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/social-sharing/index.php');
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/latest-posts-grid/index.php');
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/latest-posts-list/index.php');
        
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/latest-posts-express-grid/index.php');
        
        
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/latest-posts-carousel-grid/index.php');
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/latest-posts-slider/index.php');
        
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/banner-1/index.php');
        include(BLOCKSPARE_PLUGIN_DIR . '/src/blocks/banner-2/index.php');
        



            
            include(BLOCKSPARE_PLUGIN_DIR . 'src/inc/block-posts-config/class-post-rest-api.php');
            include(BLOCKSPARE_PLUGIN_DIR . 'src/inc/block-posts-config/tax-category.php');
            include(BLOCKSPARE_PLUGIN_DIR . 'src/inc/block-posts-config/class-bs-post.php');
            include(BLOCKSPARE_PLUGIN_DIR . 'src/blocks/utils/post-banner/frontend-render/post-banner-config.php');
            include(BLOCKSPARE_PLUGIN_DIR . 'src/blocks/utils/post-banner/frontend-render/post-banner-style.php');
        }

        function blockspare_blocks_register_api_endpoints(){
            
                $posts_controller = new Aft_Post_Rest_Controller();
                $posts_controller->register_routes();
            

        }

    }
    BlockspareInit::get_instance();
}
    
    
   