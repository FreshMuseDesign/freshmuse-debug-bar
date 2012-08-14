<?php

if( !function_exists( 'fm_bar_debug' ) ) {
    /**
     * Sends debugging data to a custom debug bar extension
     * 
     * @since 1.0
     * @param String $title
     * @param Mixed $data
     * @param String $format Optional - (Default:log) log | warning | error | notice | dump
     */
    function fm_bar_debug( $title, $data, $format='log' ) { 
        do_action( 'fm_bar_debug', $title, $data, $format );
    }
}

if( !function_exists( 'fm_bar_dump' ) ) {
    /**
     * Sends an object to a custom debug bar extension to be dumped with a 
     * fancy var_dump variant
     * 
     * @since 1.0
     * @param String $title
     * @param Mixed $data 
     */
    function fm_bar_dump( $title, $data) { 
        do_action( 'fm_bar_debug', $title, $data, 'dump' );
    }
}

/*
 * Log that the plugin has initialized
 */
add_action( 'admin_init', 'new_log_init');
/**
 * Logs that the plugin has started
 * @since 1.0 
 */
function new_log_init() {
    $data = get_plugin_data( FM_BAR_PLUGIN_FILE );
    fm_bar_debug( 'Plugin loaded', 'Plugin ' . $data['Name'] . ' successfully loaded' );
}



/*
 * Load stuff that should ONLY happen in wp-admin
 */
if( is_admin() ) {
    wp_enqueue_style( 'fm-bar-wp-admin-css', FM_BAR_PLUGIN_URL . 'css/wp-admin.css' );
    wp_register_script('fm-bar-wp-admin-js', FM_BAR_PLUGIN_URL.'js/wp-admin.js', array('jquery'));
    wp_enqueue_script('fm-bar-wp-admin-js');
}
