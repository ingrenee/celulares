<?php
/*
Plugin Name: WP E-Commerce Elastic Slider
Plugin URI: http://wpecthemes.com/plugins/wpecelasitc/
Description: Amazing layered jQuery slider plugin.
Version: 1.0
Author: wpeCThemes
Author URI: http://wpecthemes.com
License: GPL2

Copyright 2012  wpecthemes.com  (email : support@wpecthemes.com)

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

if (!defined('PHP_VERSION_ID')) {

    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));

}

if (file_exists('../wp-admin/includes/plugin.php')){
    require_once('../wp-admin/includes/plugin.php');
}

define('WPECELASTIC_VERSION', '1.0');
define('WPECELASTIC_PLUGIN_PATH',   plugin_basename(__FILE__) );


if ( PHP_VERSION_ID < 50300 ) {

    wp_die('<div class="error"><p>'.__("The Wp E-Commerce Elastic plugin requieres PHP version not less then 5.3", 'wpecelasitc').'</p></div>');

    if(is_plugin_active(WPECELASTIC_PLUGIN_PATH)) {

        deactivate_plugins(WPECELASTIC_PLUGIN_PATH);

    }
}


class Elastic{
	
	public static $withWpec = false;
    
    function __construct(){
        add_action('plugins_loaded', array($this, 'init'), 9);
    }

    public function init(){
       	
       	
       	if (class_exists('WP_eCommerce')) Elastic::$withWpec = true;
       	
        add_action( 'wp_enqueue_scripts' ,  array($this, 'load_front_end_js') );
        add_action( 'admin_enqueue_scripts', array($this, 'load_back_end_js') );
        add_action( 'wp_head', array($this, 'load_front_end_css') );
        add_action( 'init', array($this, 'register_elastic_post_type'));
        add_action('admin_menu' , array($this, 'elastic_settings'));
        add_action('save_post', array($this,'save_meta_data'));
        add_shortcode( 'elastic', array($this, 'elastic_shortcode'));
        
        if ( function_exists( 'add_image_size' ) ) { 
        	add_image_size( 'elastic-thumb', 150, 9999 );
        }
        
        
        if ( is_admin() ) {
                 add_action( 'load-post.php', array($this, 'call_ElasticClass'));
                 register_setting('wpecelastic-options', 'elst_animation');
                 register_setting('wpecelastic-options', 'elst_autoplay');
                 register_setting('wpecelastic-options', 'elst_slideinterval');
                 register_setting('wpecelastic-options', 'elst_easing');
                 register_setting('wpecelastic-options', 'elst_speed');
                 register_setting('wpecelastic-options', 'elst_titlesfactor');
                 register_setting('wpecelastic-options', 'elst_titleeasing');
                 register_setting('wpecelastic-options', 'elst_titlespeed');
                 register_setting('wpecelastic-options', 'elst_showthumbs');
                 register_setting('wpecelastic-options', 'elst_desccut');
               //  register_setting('wpecelastic-options', 'elst_maxthumbwidth');
                 
            }
    }

    public function call_ElasticClass(){
        return $this;
    }
    
    public function elastic_settings(){
	    add_submenu_page('edit.php?post_type=elslide', 'Settings', 'Slider Settings', 'edit_posts', basename(__FILE__), array($this, 'settings_page'));
    }
    
    public function elastic_shortcode($atts){
		
		extract( shortcode_atts( array(
				
		), $atts ) );
		
	 	return Elastic::display_elastic();   
    }
    
    public function settings_page(){
	    
	    echo '<div class="wrap">';
	    
	    echo '<div class="icon32" style="background:url('.plugin_dir_url(__DIR__).plugin_basename(__DIR__).'/images/layers_b.png) center center no-repeat;"><br/></div>';
	    
	    echo '<h2>'.__('Elastic Settings', 'wpecelasitc').'</h2>';
	    	
	    echo '</div>';
	    
	    echo settings_errors();
	    echo '<form method="post" action="options.php">';
			
				settings_fields( 'wpecelastic-options' );
				do_settings_fields( 'wpecelastic-options', 'wpecelastic-options' );
				
				?>
				<table class="form-table">
			        <tr valign="top">
			        <th scope="row"><?php _e('Animate From', 'wpecelasitc'); ?></th>
			        <td>
			        
			        <select name="elst_animation">
			        	<option value="center" <?php echo (get_option('elst_animation') == 'center' ? 'selected' : '' ) ?> ><?php _e('Center', 'wpecelastic'); ?></option>
			        	<option value="sides" <?php echo (get_option('elst_animation') == 'sides' ? 'selected' : '' ) ?> ><?php _e('Sides', 'wpecelastic'); ?></option>
			        </select>
			        
			        <small><?php _e('"sides" : new slides will slide in from left / right', 'wpecelastic'); ?></small>&nbsp;
			        <small><?php _e('"center": new slides will appear in the center', 'wpecelastic'); ?></small>
			        
			        </td>
			        </tr>
			         
			        <tr valign="top">
			        <th scope="row"><?php _e('Autoplay', 'wpecelasitc'); ?></th>
			        <td>
			        <input type="checkbox" name="elst_autoplay" value="on" <?php echo (get_option('elst_autoplay') == 'on' ? 'checked="checked"' : ''); ?> />
			        <small><?php _e('if true the slider will automatically slide, and it will only stop if the user clicks on a thumb', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Slideshow Interval', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_slideinterval" value="<?php echo get_option('elst_slideinterval'); ?>" />
			        <small><?php _e('interval for the slideshow', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Easing', 'wpecelasitc'); ?></th>
			        <td><select name="elst_easing">
			        	<option value="easeInSine" <?php echo (get_option('elst_easing') == 'easeInSine' ? 'selected' : '' ) ?> ><?php _e('EaseInSine', 'wpecelastic'); ?></option>
			        	<option value="easeOutSine" <?php echo (get_option('elst_easing') == 'easeOutSine' ? 'selected' : '' ) ?> ><?php _e('EaseOutSine', 'wpecelastic'); ?></option>
			        	<option value="easeInOutSine" <?php echo (get_option('elst_easing') == 'easeInOutSine' ? 'selected' : '' ) ?> ><?php _e('EaseInOutSine', 'wpecelastic'); ?></option>
			        	<option value="easeInQuad" <?php echo (get_option('elst_easing') == 'easeInQuad' ? 'selected' : '' ) ?> ><?php _e('EaseInQuad', 'wpecelastic'); ?></option>
			        	<option value="easeInCubic" <?php echo (get_option('elst_easing') == 'easeInCubic' ? 'selected' : '' ) ?> ><?php _e('EaseInCubic', 'wpecelastic'); ?></option>
			        	<option value="easeOutCubic" <?php echo (get_option('elst_easing') == 'easeOutCubic' ? 'selected' : '' ) ?> ><?php _e('EaseOutCubic', 'wpecelastic'); ?></option>
			        </select>
			        <small><?php _e('easing for the sliding animation', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Slide Speed', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_speed" value="<?php echo get_option('elst_speed'); ?>" />
			        <small><?php _e('speed for the sliding animation', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Titles Factor', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_titlesfactor" value="<?php echo get_option('elst_titlesfactor'); ?>" />
			        <small><?php _e('percentage of speed for the titles animation. Speed will be speed * titlesFactor', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Titles Easing', 'wpecelasitc'); ?></th>
			        <td><select name="elst_titleeasing">
			        	<option value="easeInSine" <?php echo (get_option('elst_titleeasing') == 'easeInSine' ? 'selected' : '' ) ?> ><?php _e('EaseInSine', 'wpecelastic'); ?></option>
			        	<option value="easeOutSine" <?php echo (get_option('elst_titleeasing') == 'easeOutSine' ? 'selected' : '' ) ?> ><?php _e('EaseOutSine', 'wpecelastic'); ?></option>
			        	<option value="easeInOutSine" <?php echo (get_option('elst_titleeasing') == 'easeInOutSine' ? 'selected' : '' ) ?> ><?php _e('EaseInOutSine', 'wpecelastic'); ?></option>
			        	<option value="easeInQuad" <?php echo (get_option('elst_titleeasing') == 'easeInQuad' ? 'selected' : '' ) ?> ><?php _e('EaseInQuad', 'wpecelastic'); ?></option>
			        	<option value="easeInCubic" <?php echo (get_option('elst_titleeasing') == 'easeInCubic' ? 'selected' : '' ) ?> ><?php _e('EaseInCubic', 'wpecelastic'); ?></option>
			        	<option value="easeOutCubic" <?php echo (get_option('elst_titleeasing') == 'easeOutCubic' ? 'selected' : '' ) ?> ><?php _e('EaseOutCubic', 'wpecelastic'); ?></option>
			        </select>
			        <small><?php _e('titles animation easing', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Titles Speed', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_titlespeed" value="<?php echo get_option('elst_titlespeed'); ?>" />
			        <small><?php _e('titles animation speed', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Show Thumbs', 'wpecelasitc'); ?></th>
			        <td><input type="checkbox" name="elst_showthumbs" value="on" <?php echo (get_option('elst_showthumbs') == 'on' ? 'checked="checked"' : ''); ?> />
			        <small><?php _e('should the slides thumbnails be shown', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row"><?php _e('Description Limit', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_desccut" value="<?php echo get_option('elst_desccut'); ?>" />
			        <small><?php _e('number of words in description', 'wpecelastic'); ?></small>
			        </td>
			        </tr>
			        
			       <?php /* ?> <tr valign="top">
			        <th scope="row"><?php _e('Thumbs Maximum Width', 'wpecelasitc'); ?></th>
			        <td><input type="text" name="elst_maxthumbwidth" value="<?php echo get_option('elst_maxthumbwidth'); ?>" />
			        <small><?php _e('maximum width for the thumbs in pixels', 'wpecelastic'); ?></small>
			        </td>
			        </tr> <?php */ ?>
			        
			    </table>
				<?php
				submit_button();
					
		echo '</form>';
	  //  echo $output;

    }
    
    public function save_meta_data($post_id, $post = null){
	    
	    if(!isset($_POST['wpec-elastic'])) return $post_id;
	    
	    if (!isset($_POST['wpec-elastic']) && !(@wp_verify_nonce($_POST['wpec-elastic'], basename( __FILE__ ))))
	    return $post_id;
	    
	    if ($post) $post_type = get_post_type_object($post->post_type);
	    
	    if (!current_user_can('edit_post', $post_id))
	    	return $post_id;
	    	
	    $new_product_id = (int)(isset($_POST['_wpec_product_id'])  ? sanitize_html_class($_POST['_wpec_product_id']) : '');
	    $new_slide = (isset($_POST['_wpec_elastic_image'])  ? $_POST['_wpec_elastic_image'] : '');
	    $new_use_title = (isset($_POST['_wpec_elastic_title'])  ? sanitize_html_class($_POST['_wpec_elastic_title']) : '');
	    $new_use_desc = (isset($_POST['_wpec_elastic_desc'])  ? sanitize_html_class($_POST['_wpec_elastic_desc']) : '');
	    $new_use_price = (isset($_POST['_wpec_elastic_price'])  ? sanitize_html_class($_POST['_wpec_elastic_price']) : '');
	    

	    
	    
	    $current_product_id = get_post_meta($post_id, '_wpec_product_id', true);
	    $current_slide = get_post_meta($post_id, '_wpec_elastic_image', true);
	    $current_use_title = get_post_meta($post_id, '_wpec_elastic_title', true);
	    $current_use_desc = get_post_meta($post_id, '_wpec_elastic_desc', true);
	    $current_use_price = get_post_meta($post_id, '_wpec_elastic_price', true);  
	   
	  	    
	    
	    if ($new_product_id && '' == $current_product_id){
		    add_post_meta($post_id, '_wpec_product_id', $new_product_id, true);
	    } else if ($new_product_id && $new_product_id != $current_product_id){
		    update_post_meta( $post_id, '_wpec_product_id', $new_product_id );
	    } else if ('' == $new_product_id && $current_product_id) {
		    delete_post_meta( $post_id, '_wpec_product_id');
	    }
	    
	    if ($new_slide && '' == $current_slide){
		    add_post_meta($post_id, '_wpec_elastic_image', $new_slide, true);
	    } else if ($new_slide && $new_slide != $current_slide){
		    update_post_meta( $post_id, '_wpec_elastic_image', $new_slide );
	    } else if ('' == $new_slide && $current_slide) {
		    delete_post_meta( $post_id, '_wpec_elastic_image' );
	    }
	    
	    if ($new_use_title && '' == $current_use_title){
		    add_post_meta($post_id, '_wpec_elastic_title', $new_use_title, true);
	    } else if ($new_use_title && $new_use_title != $current_use_title){
		    update_post_meta( $post_id, '_wpec_elastic_title', $new_use_title );
	    } else if ('' == $new_use_title && $current_use_title) {
		    delete_post_meta( $post_id, '_wpec_elastic_title' );
	    }
	    
	    if ($new_use_desc && '' == $current_use_desc){
		    add_post_meta($post_id, '_wpec_elastic_desc', $new_use_desc, true);
	    } else if ($new_use_desc && $new_use_desc != $current_use_desc){
		    update_post_meta( $post_id, '_wpec_elastic_desc', $new_use_desc );
	    } else if ('' == $new_use_desc && $current_use_desc) {
		    delete_post_meta( $post_id, '_wpec_elastic_desc' );
		}
		
		if ($new_use_price && '' == $current_use_price){
		    add_post_meta($post_id, '_wpec_elastic_price', $new_use_price, true);
	    } else if ($new_use_price && $new_use_price != $current_use_price){
		    update_post_meta( $post_id, '_wpec_elastic_price', $new_use_price );
	    } else if ('' == $new_use_price && $current_use_price) {
		    delete_post_meta( $post_id, '_wpec_elastic_price' );
		} 
	    
	     	    
	    
    }

   
    public function register_elastic_post_type(){

        register_post_type( 'elslide',
        array(
            'labels' => array(
                'name' => __( 'Slide', 'wpecelasitc'),
                'singular_name' => __( 'Slide', 'wpecelasitc' ),
                'add_new' => __('Add Slide', 'wpecelasitc'),
                'all_items' => __('Slides', 'wpecelasitc'),
                'add_new_item' => __('Add new Slider', 'wpecelasitc'),
                'edit_item' => __('Edit Slider', 'wpecelasitc'),
                'new_item' => __('New Slider', 'wpecelasitc'),
                'view_item' => __('View Slider', 'wpecelasitc'),
                'menu_name' => __('Elastic Slider')
            ),
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'menu_position' => 65,
            'menu_icon' => plugins_url('/images/layers.png',__FILE__),
            'supports' => array('title', 'excerpt', 'thumbnail'),
            'register_meta_box_cb' => array( $this, 'add_wpec_product_box_call')
            
        )
    );
    }

    public function add_wpec_product_box_call() {
	   if (Elastic::$withWpec) add_meta_box('wpec_elasticproduct_box', __('Product Info', 'wpecelasitc'), array($this, 'add_wpec_product_box'), 'elslide', 'side', 'default');
	   // add_meta_box('wpec_elastic_slide', __('Slide Image', 'wpecelasitc'), array($this, 'add_wpec_elastic_slide'), 'elslide', 'normal', 'default');
	}
	
	public function add_wpec_elastic_slide($object, $box){
		
		wp_nonce_field( plugin_basename( __FILE__ ), 'wpec-elastic' );
		
		$output = '<p>
			Upload an Image! 
		</p>';
		
		$output .= '<input type="text" id="wpec_elastic_image" class="" name="_wpec_elastic_image" value="' . esc_attr( get_post_meta( $object->ID, '_wpec_elastic_image', true ) ) . '">';
		$output .= '<a href="#" id="upload_wpec_elastic_image" class="button wpec_elastic_image">'.__('Slide\'s Image', 'wpecelasitc').'</a>';
			
			$output .= '
				<script>
					jQuery(document).ready(function($){
						var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
						
						$("#upload_wpec_elastic_image").click(function(e){
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(this);
							var id = button.attr("id").replace("upload_", "");
							
							_custom_media = true;
							
							wp.media.editor.send.attachment = function(props, attachment){
								if (_custom_media) {
									$("#"+id).val(attachment.url);
								} else {
									return _orig_send_attachment.apply(this, [props, attachment]);
								}
							}
							
							wp.media.editor.open(button);
							return false;	
							
						});
						
						$(".add_media").on("click", function(){
							_custom_media = false;
						});
					
					});
				</script>
			
			';
		
		echo $output;
	}
	
	public function add_wpec_product_box($object, $box){
	  global $post;
	  $tmp_post = $post;
	  $args = array( 'post_type' => 'wpsc-product', 'numberposts' => -1, 'post_status' => 'publish'); 
	
	  $attachments = get_posts( $args );
	  	  
	  $output = '<p>'.__('Select a Product That is Linked to this slide','wpecelasitc').'</p>';
	  
	  wp_nonce_field( plugin_basename( __FILE__ ), 'wpec-elastic' );
	  
	  if ($attachments) {
	  
	  		$cur_prod_id = ((get_post_meta( $object->ID, '_wpec_product_id', true )) ? (get_post_meta( $object->ID, '_wpec_product_id', true )) : '');
	  		
			$output .= '<p>
			<label>'.__('Select a product associated with this slide:', 'wpecelasitc').'</label>
			<select name="_wpec_product_id">';
			foreach ( $attachments as $post ) {
				setup_postdata($post);
				$output .= "<option value='" . get_the_ID() . "' ".( $cur_prod_id == get_the_ID() ? 'selected' : '' )." >".get_the_title(). "</option>";
			}
			$output .= '</select></p><br/>';
			
		} 
	
	  $output .= '<p><label>'.__('Use product description:', 'wpecelasitc').'</label>
			<input id="show_desc" type="checkbox" size="6" name="_wpec_elastic_desc" '.(get_post_meta( $object->ID, '_wpec_elastic_desc', true ) == 'on' ? 'checked="checked"' : '' ).' /><br clear="both" />
			<small>'.__('Otherwise excerpt will be used', 'wpecelasitc').'</small>
			</p>';
			
	  $output .= '<p><label>'.__('Use product title:', 'wpecelasitc').'</label>
			<input id="show_title" type="checkbox" size="6" name="_wpec_elastic_title" '.(get_post_meta( $object->ID, '_wpec_elastic_title', true ) == 'on' ? 'checked="checked"' : '' ).' /><br/>
			<small>'.__('Otherwise post title will be used', 'wpecelasitc').'</small>
			</p>';
			
	  $output .= '<p><label>'.__('Use product price:', 'wpecelasitc').'</label>
			<input id="show_price" type="checkbox" size="6" name="_wpec_elastic_price" '.(get_post_meta( $object->ID, '_wpec_elastic_price', true ) == 'on' ? 'checked="checked"' : '' ).' /><br/>
			<small>'.__('Otherwise won\'t be shown', 'wpecelasitc').'</small>
			</p>';
		
	  
		
	    $output .= '<div class="clear"></div>';
	    
	    echo $output;
	    
	    $post = $tmp_post;
	    
	}

	static function cut_words($paragraph, $num_words) {
	      $paragraph = explode (' ', $paragraph);
	      $paragraph = array_slice ($paragraph, 0, $num_words);
	      return implode (' ', $paragraph);
	}
	
	public static function display_elastic(){
		global $post;
		$slide_id = uniqid();
		$html = '';
		
		global $wpdb; 
		
		$tmp_post = $post;
		$args = array( 'post_type' => 'elslide', 'numberposts' => -1, 'post_status' => 'publish', 'order' => 'ASC'); 
		
		$attachments = get_posts( $args );

		$animation = get_option('elst_animation');
        $autoplay = (get_option('elst_autoplay') == 'on' ? 'true' : 'false');
        $slideinterval = get_option('elst_slideinterval');
        $easing = get_option('elst_easing');
        $speed = get_option('elst_speed');
        $titlesfactor = get_option('elst_titlesfactor');
        $titleeasing = get_option('elst_titleeasing');
        $titlespeed = get_option('elst_titlespeed');
        $showthumbs = (get_option('elst_showthumbs') == 'on' ? true : false );
        $desccut = (((int) get_option('elst_desccut')) <= 0 ? 100 : (int) get_option('elst_desccut') );
        
        //$maxthumbwidth = get_option('elst_maxthumbwidth');
		
		if (!$showthumbs) $html .= '<style>
			.ei-slider-thumbs{
				display: none !important;
			}
		</style>';
		
		$html .= '<div class="wrapper">
                	<div id="ei-slider-'.$slide_id.'" class="ei-slider">
                    	<ul class="ei-slider-large">';
		
		foreach($attachments as $slide){
			
			
			$slide_product_id = get_post_meta($slide->ID, '_wpec_product_id', true);
		    $slide_image = get_post_meta($slide->ID, '_wpec_elastic_image', true);
		    $slide_use_title = get_post_meta($slide->ID, '_wpec_elastic_title', true);
		    $slide_use_desc = get_post_meta($slide->ID, '_wpec_elastic_desc', true);
		    $slide_use_price = get_post_meta($slide->ID, '_wpec_elastic_price', true);
			
			$the_title = '';
			
			if ($slide_use_title) {
				$the_title = get_the_title($slide_product_id);
			} else {
				$the_title = get_the_title($slide->ID);
			}
			
			$title_ar = split(' ', $the_title);
			
			if (count($title_ar) > 1) {
				$title_ar[1] = '<em>'.$title_ar[1].'</em>';
				$the_title = implode(' ', $title_ar);
			}
			
			if (Elastic::$withWpec) $the_title = '<a href="'.get_permalink($slide_product_id).'">'.$the_title.'</a>';
			
			$the_description = '';
			
			if ($slide_use_desc && Elastic::$withWpec) {
				$the_description = get_post_field('post_content', $slide_product_id);
			} else {
				$the_description = $slide->post_excerpt;
			}
			 
			$the_description = Elastic::cut_words($the_description, $desccut);
			
			$the_image = get_the_post_thumbnail($slide->ID, 'full');
			
			$the_price = '';
			
			if ($slide_use_price && Elastic::$withWpec) {
				$the_price = wpsc_the_product_price(false, false, $slide_product_id);
			}
			
			 
			$html .= '<li>';
			
			$html .= $the_image;
			$html .= '<div class="ei-title">';
            if ($the_title != '') $html .= '<h2><span>'.$the_title.'</span></h2>';
            if ($the_description != '') $html .= '<h3><span>'.$the_description.'</span></h3>';
            $html .= ($the_price != '' ? '<h2><span>'.$the_price.'</span></h2>' : '' );
            $html .= '</div>';               
			$html .= '</li>';
			
			
		}
		
		
		$html .= '		</ul>
					';
		
		$thumbs = '<ul class="ei-slider-thumbs">
                        <li class="ei-slider-element">Current</li>';
		
		foreach($attachments as $thumb){
			
			$the_title = '';
			
			if ($slide_use_title && Elastic::$withWpec) {
				$the_title = get_the_title($slide_product_id);
			} else {
				$the_title = $thumb->post_name;
			}
			
			$thumbs .= '<li><a href="#">'.$the_title.'</a>';
			
			$thumbs .= get_the_post_thumbnail($thumb->ID, 'elastic-thumb');
					
			$thumbs .= '</li>';
		
		}	
		
		$thumbs .= '</ul><!-- ei-slider-thumbs -->
                ';
		
		$html .= $thumbs;
		
		$html .= '</div><!-- ei-slider -->
				</div>';
		
				
		
		
		$html .= '<script type="text/javascript">
            jQuery(function() {
                jQuery(\'#ei-slider-'.$slide_id.'\').eislideshow({
					animation			: \''.$animation.'\', 
					autoplay			: '.$autoplay.',
					slideshow_interval	: '.$slideinterval.',
					speed				: '.$speed.',
					easing				: \''.$easing.'\',
					titlesFactor		: '.$titlesfactor.',
					titlespeed			: '.$titlespeed.',
					titleeasing			: \''.$titleeasing.'\',
					thumbMaxWidth		: 150
                });
            });
        </script>';
		
		$post = $tmp_post;
		
		return $html;	
	}

    public function load_front_end_js(){

       wp_enqueue_script('jquery');
       wp_enqueue_script('jqueryeasing', plugins_url('/js/jquery.easing.1.3.js',__FILE__), array('jquery'), '', false );
       wp_enqueue_script('wpecelasitc', plugins_url('/js/jquery.eislideshow.js',__FILE__), array('jquery'), '', false );
      

    }

    public function load_back_end_js(){
       wp_enqueue_script('jquery');
    }      

    public function load_front_end_css(){

       wp_register_style( 'elast-style', plugins_url('/css/elastislide.css', __FILE__) );
       wp_enqueue_style( 'elast-style' );

   }

}

//require_once('includes/functions.php');
require_once('elasticwidget.php');

$elastslider = new Elastic();
$elastslider->init();
