<?php
/**
	Plugin Name: Scroll Up
	Plugin URI: http://morshed9798.byethost33.com/plugin
	Description: This is small wordpress plugin for one click scroll to top. If you use this 	plugin you can go bottom to top your website one click. Happy using.
	Version: 1.1.0
	Author: Muhammad manjur morshed
	Author URI: http://morshed9798.byethost33.com/plugin
	License: GPL2
 */
 
 /*  Copyright 2014  Muhammad manjur morshed  (email : mmanjur38@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*Define the plugin directory*/

define('MORSHED_SCROLL_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

/*load essential script and css*/

function morshed_scroll_register_scripts() {

	wp_enqueue_script('morshed-scrollUp-up-jquery', MORSHED_SCROLL_PLUGIN_URL.'js/jquery.scrollUp.js', array('jquery'));
	wp_enqueue_style('morshed-scroll-css', MORSHED_SCROLL_PLUGIN_URL.'css/style.css');
		
}
add_action('init', 'morshed_scroll_register_scripts');

// Active scroll to top plugin in here

function scroll_to_top_active () {?>

	<script type="text/javascript">
	
		<?php global $morshed_scroll_top_options; $ppmscrollbar_settings = get_option( 'morshed_scroll_top_options', $morshed_scroll_top_options ); ?>
		jQuery(document).ready(function(){
			jQuery.scrollUp({
				scrollName: 'scrollUp',      // Element ID
				scrollDistance: <?php echo $ppmscrollbar_settings['scroll_distance']; ?>,         // Distance from top/bottom before showing element (px)
				scrollFrom: 'top',           // 'top' or 'bottom'
				scrollSpeed: <?php echo $ppmscrollbar_settings['scroll_speed']; ?>,            // Speed back to top (ms)
				easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
				animation: 'fade',           // Fade, slide, none
				animationSpeed: 200,         // Animation speed (ms)
				scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
				scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
				scrollText: '', // Text for element, can contain HTML
				scrollTitle: false,          // Set a custom <a> title if required.
				scrollImg: false,            // Set true to use image
				activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
				zIndex: 2147483647           // Z-Index for the overlay
			});
		}); 	
	</script>
<?php
}
add_action('wp_head','scroll_to_top_active');

// Register a menu for this plugin

function add_scroll_plugin_menu() {  
	add_menu_page('scroll option panel', 'Scroll To Top', 'manage_options', 'scroll-panel-option', 'scroll_option_function', $icon_url = 'dashicons-arrow-up-alt', 85 );	
}  
add_action('admin_menu', 'add_scroll_plugin_menu');


// Default options values

$morshed_scroll_top_options = array(
	'scroll_distance' => '300',
	'scroll_speed' => '250'
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function morshed_scroll_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'scroll_top_options', 'morshed_scroll_top_options', 'scroll_top_validate_options' );
}

add_action( 'admin_init', 'morshed_scroll_register_settings' );


// Function to generate options page

function scroll_option_function() {
	global $morshed_scroll_top_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	
	<h2>Custom Scroll To Top Options</h2>
	
	<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Options saved.') ?></strong></p>
    </div>
	<?php } ?>
	
	<form method="post" action="options.php">

	<?php $settings = get_option( 'morshed_scroll_top_options', $morshed_scroll_top_options ); ?>
	
	<?php settings_fields( 'scroll_top_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->

		<tr valign="top">
			<th scope="row"><label for="scroll_distance">Distance From Top</label></th>
			<td>
				<input id="scroll_distance" type="text" name="morshed_scroll_top_options[scroll_distance]" value="<?php echo stripslashes($settings['scroll_distance']); ?>" class="my-color-field" /><p class="description">Write Distance from top/bottom before showing element in pixel. Example: 250</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="scroll_speed">Scroll Top Speeed</label></th>
			<td>
				<input id="scroll_speed" type="text" name="morshed_scroll_top_options[scroll_speed]" value="<?php echo stripslashes($settings['scroll_speed']); ?>" /><p class="description">Write Speed back to top in milisecond. Example: 500</p>
			</td>
		</tr>
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function scroll_top_validate_options( $input ) {
	global $morshed_scroll_top_options;

	$settings = get_option( 'morshed_scroll_top_options', $morshed_scroll_top_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS

	$input['scroll_distance'] = wp_filter_post_kses( $input['scroll_distance'] );
	$input['scroll_speed'] = wp_filter_post_kses( $input['scroll_speed'] );

	return $input;
}

endif;  // EndIf is_admin()

?>