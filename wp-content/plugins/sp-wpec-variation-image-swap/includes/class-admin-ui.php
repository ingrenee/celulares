<?php
/**
 * Admin UI class
 *
 * @package SP WPEC Variation Image Swap
 */

class SPswapAdmin {
	/**
	 * loads necessary items on instantiation
	 *
	 * @access public
	 * @since 2.0
	 * @return boolean true;
	 */
	public function __construct() {
		// adds the meta boxes to the admin ui under product
		add_action( 'add_meta_boxes', array( &$this, '_sp_image_swap_meta_boxes' ) );
		add_action( 'save_post', array( &$this, '_sp_image_swap_meta_boxes_save' ) );
		
		return true;		
	}
	
	/**
	 * function that adds the meta boxes
	 *
	 * @access public
	 * @since 2.0
	 * @return boolean true;
	 */
	public function _sp_image_swap_meta_boxes() {
		add_meta_box( 
			'sp_image_swap_meta_box',
			__( 'SP WPEC Variation Image Swap', 'sp' ),
			array( &$this, '_sp_image_swap_meta_box_display' ),
			'wpsc-product',
			'side' 
		);
		
		return true;
	}
	
	/**
	 * function that displays the meta boxes
	 *
	 * @access public
	 * @since 2.0
	 * @return string html;
	 */
	public function _sp_image_swap_meta_box_display( $post ) {
		wp_nonce_field( __FILE__ , '_sp_image_swap' );	
	
		$checked = false;
		if ( $post->ID ) {
			$checked = get_post_meta( $post->ID, '_sp_image_swap', true );
		}
	
		echo '<div class="inside"><label for="sp_image_swap">Disable Variation Image Swap: <input type="checkbox" value="1" name="sp_image_swap" id="sp_image_swap"' . ( ( $checked ) ? ' checked="checked"' : '') . ' /></label></div>';
		
	}
	
	/**
	 * function that saves the meta boxes
	 *
	 * @access public
	 * @since 2.0
	 * @return boolean true;
	 */
	public function _sp_image_swap_meta_boxes_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;		
		
		if (isset($_POST['_sp_image_swap'])) {
		
		if ( ! wp_verify_nonce( $_POST['_sp_image_swap'], __FILE__  ) )
			return;		
		}
		// Check permissions
		
		
		
		if ( (isset($_POST['post_type'])) && ('page' == $_POST['post_type'])) {
		  if ( !current_user_can( 'edit_page', $post_id ) )
			  return;
		} else {
		  if ( !current_user_can( 'edit_post', $post_id ) )
			  return;
		}		
		
		
		$data = false;
		
		// settings for image swap
		if (isset($_POST['_sp_image_swap'])) $data = ( ( $_POST['sp_image_swap'] == 1 ) ? true : false );
		
		if ( $data ) {
			update_post_meta( $post_id, '_sp_image_swap', 1 );
		} else {
			delete_post_meta( $post_id, '_sp_image_swap' );
		}	
		
		return true; 
	}	
}
?>
