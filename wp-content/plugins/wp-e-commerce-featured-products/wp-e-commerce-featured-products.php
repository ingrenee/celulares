<?php
/*
Plugin Name: WP e-Commerce Featured Products
Plugin URI: http://mywebsiteadvisor.com/tools/wordpress-plugins/wp-e-commerce-featured-products/
Description: Featured Products Widget and Shortcode for WP e-Commerce
Version: 1.0.1
Author: MyWebsiteAdvisor
Author URI: http://MyWebsiteAdvisor.com
*/



class WP_Widget_Featured_Products extends WP_Widget {

	/**
	 * Widget Constuctor
	 */
	function WP_Widget_Featured_Products() {

		$widget_ops = array(
			'classname'   => 'widget_wpsc_featured_products',
			'description' => __( 'Featured Products Widget', 'wpsc' )
		);

		$this->WP_Widget( 'wpsc_featured_products', __( 'Featured Products', 'wpsc' ), $widget_ops );

	}

	/**
	 * Widget Output
	 *
	 * @param $args (array)
	 * @param $instance (array) Widget values.
	 *
	 */
	function widget( $args, $instance ) {

		global $wpdb, $table_prefix;

		extract( $args );

		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Featured Products', 'wpsc' ) : $instance['title'] );
		if ( $title )
			echo $before_title . $title . $after_title;

		wpsc_featured( $args, $instance );
		echo $after_widget;

	}

	/**
	 * Update Widget
	 *
	 * @param $new_instance (array) New widget values.
	 * @param $old_instance (array) Old widget values.
	 *
	 * @return (array) New values.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['number']           = (int) $new_instance['number'];
		$instance['show_thumbnails']  = (bool) $new_instance['show_thumbnails'];
		$instance['show_description'] = (bool) $new_instance['show_description'];
		$instance['show_old_price']   = (bool) $new_instance['show_old_price'];
		$instance['show_discount']    = (bool) $new_instance['show_discount'];

		return $instance;

	}

	/**
	 * Widget Options Form
	 *
	 * @param $instance (array) Widget values.
	 */
	function form( $instance ) {

		global $wpdb;

		// Defaults
		$instance = wp_parse_args( (array) $instance, array(
			'title'            			=> '',
			'show_description'	=> false,
			'show_thumbnails'  	=> false,
			'number'          		=> 5,
			'show_old_price'   	=> false,
			'show_discount'    	=> false,
		) );

		// Values
		$title = esc_attr( $instance['title'] );
		$number = (int) $instance['number'];
		$show_thumbnails  = (bool) $instance['show_thumbnails'];
		$show_description = (bool) $instance['show_description'];
		$show_discount    = (bool) $instance['show_discount'];
		$show_old_price   = (bool) $instance['show_old_price'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wpsc' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:', 'wpsc' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_description' ); ?>" name="<?php echo $this->get_field_name( 'show_description' ); ?>" <?php checked( $show_description ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_description' ); ?>"><?php _e( 'Show Description', 'wpsc' ); ?></label><br />
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnails' ); ?>" <?php checked( $show_thumbnails ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>"><?php _e( 'Show Thumbnails', 'wpsc' ); ?></label><br />
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_old_price' ); ?>" name="<?php echo $this->get_field_name( 'show_old_price' ); ?>" <?php checked( $show_old_price, '1' ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_old_price' ); ?>"><?php _e( 'Show Old Price', 'wpsc' ); ?></label><br />
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_discount' ); ?>" name="<?php echo $this->get_field_name( 'show_discount' ); ?>" <?php checked( $show_discount, '1' ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_discount' ); ?>"><?php _e( 'Show Discount', 'wpsc' ); ?></label>
		</p>
<?php
	}

}


add_action( 'widgets_init', '_wpsc_action_register_featured_widget' );

function _wpsc_action_register_featured_widget() {
	register_widget( 'WP_Widget_Featured_Products' );
}








/**
 * Products Widget content function
 *
 * Displays the latest products.
 */

function wpsc_featured( $args = null, $instance ) {

	global $wpdb;

	$args = wp_parse_args( (array) $args, array( 'number' => 10 ) );

	$siteurl = get_option( 'siteurl' );

	if ( ! $number = (int) $instance['number'] )
		$number = 10;

	$show_thumbnails  = isset( $instance['show_thumbnails']  ) ? (bool) $instance['show_thumbnails']  : false;
	$show_description = isset( $instance['show_description'] ) ? (bool) $instance['show_description'] : false;
	$show_discount    = isset( $instance['show_discount']    ) ? (bool) $instance['show_discount']    : false;
	$show_old_price   = isset( $instance['show_old_price']   ) ? (bool) $instance['show_old_price']   : false;

	$featured = new WP_E_Commerce_Featured_Products;

	$args = array(
		'post_type'           		=> 'wpsc-product',
		'ignore_sticky_posts'	=> 1,
		'post_status'         		=> 'publish',
		'post_parent'         		=> 0,
		'posts_per_page'      	=> $number,
		'no_found_rows'      	=> true,
		'orderby'					=> 'post__in',
		'post__in' 					=> $featured->get_featured_product_ids()
	);

		
	$special_products = new WP_Query( $args );

	if ( ! $special_products->post_count ) {
		echo apply_filters( 'wpsc_featured_widget_no_items_message', __( 'We currently have no items on special.', 'wpsc' ) );
		return;
	}

	$product_ids = array();

	//$featured_products_data = $featured->get_featured_products();
		
	while ( $special_products->have_posts() ) :
		$special_products->the_post();
		
		//$id = wpsc_the_product_id();
		//$count = $featured_products_data[$id];
			
		?>
		<h4><strong><a class="wpsc_product_title" href="<?php echo wpsc_product_url( wpsc_the_product_id(), false ); ?>"><?php echo wpsc_the_product_title(); ?></a></strong></h4>

		<?php if ( $show_description ): ?>
			<div class="wpsc-special-description">
				<?php echo wpsc_the_product_description(); ?>
			</div>
		<?php endif; // close show description

		if ( ! in_array( wpsc_the_product_id(), $product_ids ) ) :
			$product_ids[] = wpsc_the_product_id();
			$has_children = wpsc_product_has_children( get_the_ID() );
			if( $show_thumbnails ):
				if ( wpsc_the_product_thumbnail() ) : ?>
					<a rel="<?php echo str_replace(array(" ", '"',"'", '&quot;','&#039;'), array("_", "", "", "",''), wpsc_the_product_title()); ?>" href="<?php echo wpsc_the_product_permalink(); ?>">
						<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/></a>
				<?php else : ?>
					<a href="<?php echo wpsc_the_product_permalink(); ?>">
						<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_URL; ?>/wpsc-theme/wpsc-images/noimage.png" width="<?php esc_attr_e( get_option('product_image_width') ); ?>" height="<?php esc_attr_e( get_option('product_image_height') ); ?>" /></a>
				<?php endif; ?>
				<br />
			<?php endif; // close show thumbnails ?>
			<div id="special_product_price_<?php echo wpsc_the_product_id(); ?>">
				<?php
					wpsc_the_product_price_display(
						array(
							'output_old_price' => $show_old_price,
							'output_you_save'  => $show_discount,
						)
					);
				?>
			</div><br />
			<?php
		endif;
	endwhile;
	wp_reset_postdata();
}




class WP_E_Commerce_Featured_Products {

	private $plugin_name = "";
	
	
	/**
	 * Initialize class
	 */
	public function __construct(){
		
		$this->plugin_name = basename(dirname( __FILE__ ));
		
		// add links for plugin help, donations,...
		add_filter('plugin_row_meta', array(&$this, 'add_plugin_links'), 10, 2);
		
		// add plugin "Widgets" action on plugin list
		add_action('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'add_plugin_actions'));
		
		//register featured_products shortcode
		add_shortcode ( 'featured_products', array($this, 'featured_products_shortcode') ); 
		
	}



	/**
	 * Add "Widgets" action on installed plugin list
	 */
	public function add_plugin_actions($links) {
		array_unshift($links, '<a href="widgets.php">' . __('Widgets') . '</a>');
		
		return $links;
	}
	

	/**
	 * Add links on installed plugin list
	 */
	public function add_plugin_links($links, $file) {
		if($file == plugin_basename( __FILE__ )) {
			$upgrade_url = 'http://mywebsiteadvisor.com/tools/wordpress-plugins/' . $this->plugin_name . '/';
			$links[] = '<a href="'.$upgrade_url.'" target="_blank" title="Click Here to Upgrade this Plugin!">Upgrade Plugin</a>';
			
			$install_url = admin_url()."plugins.php?page=MyWebsiteAdvisor";
			$links[] = '<a href="'.$install_url.'" target="_blank" title="Click Here to Install More Free Plugins!">More Plugins</a>';
			
			$rate_url = 'http://wordpress.org/support/view/plugin-reviews/' . $this->plugin_name . '?rate=5#postform';
			$links[] = '<a href="'.$rate_url.'" target="_blank" title="Click Here to Rate and Review this Plugin on WordPress.org">Rate This Plugin</a>';
		}
		
		return $links;
	}
	

	
	
	


	public function get_featured_product_ids(){
		return get_option("sticky_products");	
	}
	
	
	public function featured_products_shortcode ( $atts ) {
	
		global $wpdb;
		
		ob_start();
		
		extract( shortcode_atts( array(
			'limit' 						=> '5',
			'show_old_price' 		=> false,
			'show_discount' 		=> false,
			'show_description'	=> false,
			'show_thumbnails'	=> false,
		), $atts ) );
		
		$featured = new WP_E_Commerce_Featured_Products;

		$args = array(
			'post_type'           		=> 'wpsc-product',
			'ignore_sticky_posts'	=> 1,
			'post_status'         		=> 'publish',
			'post_parent'         		=> 0,
			'posts_per_page'      	=> $limit,
			'no_found_rows'      	=> true,
			'orderby'					=> 'post__in',
			'post__in' 					=> $featured->get_featured_product_ids()
		);
		

			
		$featured_products = new WP_Query( $args );
	

		echo "<style> 
			.shortocde_widget h4 { margin: 0px;  } 
			.shortocde_widget p { margin: 0px;  } 
		</style>";
		
		echo "<div class='shortocde_widget'>";

		
		
		while ( $featured_products->have_posts() ) {
			$featured_products->the_post();


			 ?>
			<p>
				<h4><strong><a class="wpsc_product_title" href="<?php echo wpsc_product_url( wpsc_the_product_id(), false ); ?>"><?php echo wpsc_the_product_title(); ?></a></strong></h4>
                
                <?php if ( $show_description ): ?>
                    <div class="wpsc-special-description">
                        <?php echo wpsc_the_product_description(); ?>
                    </div>
                <?php endif; // close show description ?>
                
                
				<?php if( $show_thumbnails ):
					if ( wpsc_the_product_thumbnail() ) : ?>
						<a rel="<?php echo str_replace(array(" ", '"',"'", '&quot;','&#039;'), array("_", "", "", "",''), wpsc_the_product_title()); ?>" href="<?php echo wpsc_the_product_permalink(); ?>">
							<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/></a>
					<?php else : ?>
						<a href="<?php echo wpsc_the_product_permalink(); ?>">
							<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_URL; ?>/wpsc-theme/wpsc-images/noimage.png" width="<?php esc_attr_e( get_option('product_image_width') ); ?>" height="<?php esc_attr_e( get_option('product_image_height') ); ?>" /></a>
					<?php endif; ?>
					<br />
				<?php endif; // close show thumbnails ?>
                

                <div id="special_product_price_<?php echo wpsc_the_product_id(); ?>">
                    <?php
                        wpsc_the_product_price_display(
                            array(
                                'output_old_price' => $show_old_price,
                                'output_you_save'  => $show_discount,
                            )
                        );
						?>
				</div>
					
			</p>
			<br />
		<?php 
		}
		
		echo "</div>";
		
		return ob_get_clean();
	
	}


}



$wp_e_commerce_featured_products = new WP_E_Commerce_Featured_Products;

?>