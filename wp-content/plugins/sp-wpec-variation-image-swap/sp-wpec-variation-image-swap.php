<?php
/*
Plugin Name: SP WPEC Variation Image Swap
Plugin URI: http://splashingpixels.com/plugins/wpec-variation-image-swap/
Description: Plugin that adds product variation image swapping function to Wordpress e-Commerce plugin (WPEC). Requires 3.8+ of WPEC plugin.
Version: 2.0.7
Author: Roy Ho (Splashingpixels.com)
Author URI: http://splashingpixels.com
*/

/*  Copyright 2013  Roy Ho  (email : roy@splashingpixels.com)

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

/**
 * file that defines and includes necessary files 
 *
 * @package SP WPEC Variation Image Swap
 */
 
define( 'SP_SWAP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'SP_SWAP_PLUGIN_VERSION', '2.0.7' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-core.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-admin-ui.php' );

// waits until plugins have been loaded
add_action( 'plugins_loaded', '_sp_swap_init' );

/**
 * instantiate the classes
 *
 * @access private
 * @since 2.0
 * @return boolean true
 */
function _sp_swap_init() {
	new SPswap;
	new SPswapAdmin;
		
	return true;
}

// adds set image function to the template redirect hook
add_action( 'template_redirect', '_sp_wpec_set_image_size' );

/**
 * function to get the image size and save in transient
 *
 * @access private
 * @since 2.0.5
 * @return boolean true
 */
function _sp_wpec_set_image_size() {
	// check if the page is single products page
	if ( wpsc_is_single_product() ) {
		$image_width  = get_option( 'single_view_image_width' );
		$image_height = get_option( 'single_view_image_height' );
	} else {
		$image_width = get_option( 'product_image_width' );
		$image_height = get_option( 'product_image_height' );
	}
	$image_size = array( 'width' => $image_width, 'height' => $image_height );
	
	// set the image size transient
	set_transient( 'sp_swap_dimensions', $image_size, 60 * 60 * 24 );		
	
	return true;
}

?>