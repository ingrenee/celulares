<?php
/**
 * Core methods class
 *
 * @package SP WPEC Variation Image Swap
 */

class SPswap { 	
	/**
	 * loads the necessary scripts and localize variables including ajax
	 *
	 * @since 2.0
	 * @return boolean true;
	 */
	public function __construct() {
		// enqueue scripts and add ajax listeners
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( &$this, '_sp_wpec_variation_image_swap_scripts' ) );		
		}
		
		// adds functions to the ajax call
		if ( is_admin() ) {
			add_action( 'wp_ajax_nopriv_sp_wpec_variation_image_swap', array( &$this, 'sp_wpec_variation_image_swap' ) );
			add_action( 'wp_ajax_sp_wpec_variation_image_swap', array( &$this, 'sp_wpec_variation_image_swap' ) );
		}		
		
		return true;
	}
	
	/**
	 * loads the frontend scripts
	 *
	 * @access public
	 * @since 2.0
	 * @return boolean true;
	 */
	public function _sp_wpec_variation_image_swap_scripts() {
		wp_register_script( 'sp-wpec-variation-image-swap', trailingslashit( SP_SWAP_PLUGIN_URL ) . 'js/sp-wpec-variation-image-swap.js', array( "jquery" ), SP_SWAP_PLUGIN_VERSION, true );
		wp_enqueue_script( 'sp-wpec-variation-image-swap' );
		
		// checks to see if site is using ssl or else admin-ajax.php cannot be reached with wrong protocol
		$ssl = 'http';
		if ( is_ssl() ) {
			$ssl = 'https';	
		}				
		
		$localized_vars = array(
			'ajaxurl' => admin_url( 'admin-ajax.php', $ssl ),
			'ajaxCustomNonce' => wp_create_nonce( 'ajax_custom_nonce' )
		);		
		wp_localize_script( 'sp-wpec-variation-image-swap', 'sp_image_swap_ajax', $localized_vars );
		
		return true;
	}	
	
	/**
	 * an ajax callback function to perform the swap
	 *
	 * @access public
	 * @since 2.0
	 * @return string $image_url of the image URL;
	 */
	public function sp_wpec_variation_image_swap() {
		// gotta check the nonce!
		$nonce = $_POST['ajaxCustomNonce'];
		if ( ! wp_verify_nonce( $nonce, 'ajax_custom_nonce' ) ) 
			 die ('Busted!');
			
		// product id
		$product_id = absint( trim( $_POST['product_id'] ) );

		// variation ids (array)
		$var_ids = $_POST['var_ids'];
				
		// make sure id is set and not empty
		if ( isset( $product_id ) && $product_id != '' ) {
			// get the option setting per product level
			$option = get_post_meta( $product_id, '_sp_image_swap', true );

			// checks if WPEC plugin is not installed/active and if option is disabled then bail
			if ( ! class_exists( 'WP_eCommerce' ) || $option == '1' ) {
				echo false;
				exit;	
			}
		} else {
			echo false;
			exit;	
		}
		
		// if we made it this far, continue
		// get the image
		$image_url = $this->_sp_wpec_get_variation_image( $product_id, $var_ids );		

		// check if is false
		if ( false == $image_url ) {
			echo false;
		} else {
			echo json_encode( $image_url );
		}
		exit;
	}
	
	/**
	 * functiont that gets the variation image
	 *
	 * @access public
	 * @since 2.0
	 * @return string $image_url variation image URL
	 */
	public function _sp_wpec_get_variation_image( $product_id, $var_ids ) {
		// get the variation image
		$obj_id = wpsc_get_child_object_in_terms( $product_id, $var_ids, 'wpsc-variation' );	
		
		// get the variation image id from the post
		$attach_id = get_post_meta( $obj_id, '_thumbnail_id', true );
		
		// get the image size from transient (returns array)
		$image_size = get_transient( 'sp_swap_dimensions' );

		// get the image source
		//$image = wp_get_attachment_image_src( $attach_id, array( $image_size['width'], $image_size['height'] ) );
		$image = wp_get_attachment_image_src( $attach_id, 'category-thumb' );
		// get image full size
		$image_full = wp_get_attachment_image_src( $attach_id, 'full' );
	
		// if image is found
		if ( $image ) {
		  $image_url = array( 'thumb' => $image[0], 'full' => $image_full[0] );  
		} else {
		  $image_url = false;  
		}
		
		return $image_url;
	}
}
?>