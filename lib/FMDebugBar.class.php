<?php
/**
 * Integrate debugging with debug bar plugin.
 *
 * @since 1.0
 * @author Ben Lobaugh
 */

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

add_filter( 'debug_bar_panels', 'fm_bar_load_debug_bar' );
function fm_bar_load_debug_bar($panels) {
	if (!class_exists('FMDebugBar') && class_exists('Debug_Bar_Panel')) {
		class FMDebugBar extends Debug_Bar_Panel {

			private static $debug_log = array();
			
			function init() {
                                // Title to display in left column of debug bar
				$this->title( __('FreshMuse', FM_BAR_TEXTDOMAIN) );
                                
                                // Custom styling for the debug bar output
				wp_enqueue_style( 'fm-bar-debug-bar-css', FM_BAR_PLUGIN_URL . 'css/debug-bar.css' );
                                
                                // Action hook called when new dbug info is submitted
                                add_action( 'fm_bar_debug', array( &$this, 'logDebug' ), 10, 3 );
                                
			}

			function prerender() {
				$this->set_visible( true );
			}

			function render() {
				echo '<div id="fm-bar-debug-bar">';
				if (count(self::$debug_log)) {// echo "<pre>";var_dump(self::$debug_log); echo '</pre>';
					echo '<ul>';
					foreach(self::$debug_log as $k => $v) {
						echo "<li class='fm-bar-debug-{$v['format']}'>";
						echo "<div class='fm-bar-debug-entry-title'>{$v['title']}</div>";
                                                
						if ( 'dump' != $v['format'] ) {
							echo '<div class="fm-bar-debug-entry-data">';
							echo $v['data'];
							echo '</div>';
						} else {
                                                    dBug( $v['data'] );
                                                }
						echo '</li>';
					}
					echo '</ul>';
				}
				echo '</div>';
			}

			/**
			 * log debug statements for display in debug bar
			 *
                         * @since 1.0
			 * @param string $title - message to display in log
			 * @param string $data - optional data to display
			 * @param string $format - optional format (log|warning|error|notice|dump)
			 * @return void
			 * @author Ben Lobaugh
			 */
			public function logDebug($title, $data, $format) { 
				self::$debug_log[] = array(
					'title' => $title,
					'data' => $data,
					'format' => $format,
				);
			}
		}
		$panels[] = new FMDebugBar;
	}
	return $panels;
}


