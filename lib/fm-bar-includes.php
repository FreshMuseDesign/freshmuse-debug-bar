<?php

require_once( FM_BAR_PLUGIN_DIR . 'lib/fm-bar-functions.php' );

/*
 * Custom DebugBar extension
 * 
 * Only include this if in wp-admin
 * OR if user has the bar enabled for the front end
 * 
 * HRM!!! THE $current_user VAR IS NOT AVAILABLE YET AT THIS POINT! GRR
 */
//if( is_admin() || get_user_meta( $current_user->ID, 'show_admin_bar_front', true ) ) {
if( is_admin() ) {

    // Fancy var_dump
    require_once( FM_BAR_PLUGIN_DIR . 'lib/dBug.php' );

    /*
    * Local extension to debug bar
    */
    require_once( FM_BAR_PLUGIN_DIR . 'lib/FMDebugBar.class.php' );
}
