<?php
/*
Plugin Name: FreshMuse DebugBar Extension
Description: Custom site functions
Version: 1
Author: FreshMuse
Author URI: http://freshmuse.com
Text Domain: fm-bar-textdomain
*/
define( 'FM_BAR_TEXTDOMAIN', 'fm-bar-textdomain' );
define( 'FM_BAR_PLUGIN_DIR', trailingslashit( dirname( __FILE__) ) );
define( 'FM_BAR_PLUGIN_URL', trailingslashit ( WP_PLUGIN_URL . "/" . basename( __DIR__  ) ) );
define( 'FM_BAR_PLUGIN_FILE', FM_BAR_PLUGIN_DIR . basename( __DIR__  ) . ".php" );

/*
 * Required fm-bar-plugin includes
 */
require_once( FM_BAR_PLUGIN_DIR . 'lib/fm-bar-includes.php' ); // Required to setup bl functionality


/*
 * **************************************************************************
 * **************************************************************************
 * ******** YOU MAY BEGIN YOUR CUSTOM PLUGIN CODE BELOW THIS COMMENT ********
 * **************************************************************************
 * **************************************************************************
 */

add_action( 'init', 'testage' );
function testage() {
    global $current_user;
    //die(BL_PLUGIN_URL);
   // bl_dump( 'user admin bar pref', get_user_meta( $current_user->ID, 'show_admin_bar_front', true ) );
    //bl_dump( 'current user info', $current_user);
    fm_bar_debug( 'plugin file', FM_BAR_PLUGIN_FILE );
    fm_bar_debug( 'wp plugin url', WP_PLUGIN_URL, 'log' );
    fm_bar_debug( 'plugin url', FM_BAR_PLUGIN_URL, 'warning' );
    fm_bar_debug( 'path to css', FM_BAR_PLUGIN_URL . 'css/debug-bar.css', 'error' );
    fm_bar_debug( 'wtf', 'this is a test of the emergency debugging system', 'notice' );
    fm_bar_debug( 'plugin file', array('this', 'some', 'stuff'), 'dump' );
}
