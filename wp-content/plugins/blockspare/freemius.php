<?php
if ( ! function_exists( 'blockspare_fs' ) ) {
    // Create a helper function for easy SDK access.
    function blockspare_fs() {
        global $blockspare_fs;

        if ( ! isset( $blockspare_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $blockspare_fs = fs_dynamic_init( array(
                'id'                  => '5840',
                'slug'                => 'blockspare',
                'premium_slug'        => 'blockspare-pro',
                'type'                => 'plugin',
                'public_key'          => 'pk_d67f7ce3f4642fcd5999502d0ac11',
                'is_premium'          => true,
                'premium_suffix'      => 'Pro',
                'has_premium_version' => false,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'            => 'blockspare',
                    'first-path'      => 'admin.php?page=blockspare',
                    'account'    => true,
                    'pricing'    => false,
                    'contact'    => true,
                ),

            ) );
        }

        return $blockspare_fs;
    }

    // Init Freemius.
    blockspare_fs();
    // Signal that SDK was initiated.
    do_action( 'blockspare_fs_loaded' );
}