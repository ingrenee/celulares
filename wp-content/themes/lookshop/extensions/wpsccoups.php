<?php
/*
* Coupones Widget
*/

add_action( 'widgets_init', 'coupons_widget' );

function coupons_widget() {
	register_widget( 'Coupons_Widget' );
}


class Coupons_Widget extends WP_Widget{

	function Coupons_Widget(){
		 parent::WP_Widget(false, '');
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'coupons-widget', 'description' => 'Coupons widget - displays discount coupons and the time left untill it becomes inactive ' );

		/* Widget control settings. */
		$control_ops = array( 'coupon_id' => 0);

		/* Create the widget. */
		$this->WP_Widget( 'coupon-widget', 'Coupon Widget', $widget_ops, $control_ops );

	}
	
	
	function form( $instance ) {

		$defaults = array( 'coupon_id' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$coupons = $this->get_coupons();
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'coupon_id' ); ?>">Select a coupon to display:</label>
			<select id="<?php echo $this->get_field_id( 'coupon_id' ); ?>" name="<?php echo $this->get_field_name( 'coupon_id' ); ?>" > 
		<?php 
			foreach($coupons as $coupon):
				if ($coupon['active']):
		?>
				<option value="<?php echo $coupon['id']; ?>" <?php if($instance['coupon_id'] == $coupon['id']) echo 'selected'; ?> ><?php echo $coupon['coupon_code']; ?></option>
		<?php	
			endif;	
			 endforeach;
		?>
		</select>
		</p>
		
						
			<?php
	}
	
	
	function get_coupons(){
		global $wpdb;
		$coupon_data = $wpdb->get_results( "SELECT * FROM `" . WPSC_TABLE_COUPON_CODES . "` ", ARRAY_A );
		return $coupon_data;
	}
	
	function widget( $args, $instance ) {
		global $wpsc_coupons, $wpdb;
		
		echo '<div class="promo-widget"><div class="coupons_widget">';
		
		extract( $args );
		
		$atts = array('user'=>$instance['coupon_id']);
		
		$coupon_data = $wpdb->get_results( "SELECT * FROM `" . WPSC_TABLE_COUPON_CODES . "` WHERE id = ".$instance['coupon_id'], ARRAY_A );
		
		$conditions = unserialize($coupon_data[0]['condition']);
		echo '<span class="promo">';
		if($coupon_data[0]['is-percentage'] == 1 ) { printf('%d',$coupon_data[0]['value']); echo '%';
		if ($coupon_data[0]['every_product'] && empty($conditions)) _e(' of Everything', 'lookshop'); }
		else if ($coupon_data[0]['is-percentage'] == 0 ) {  echo wpsc_currency_display($coupon_data[0]['value']);
		if ($coupon_data[0]['every_product'] && empty($conditions)) _e(' of Everything', 'lookshop'); }
		
		else if ($coupon_data[0]['is-percentage'] == 2)  { 
			_e('Free shipping', 'lookshop'); 
		 	if ($coupon_data[0]['every_product'] && empty($conditions)) _e(' for Everything', 'lookshop');
		 }
		
		echo '</span>';
		
		if (!empty($conditions)) { 
		
		$prp = array('item_name'=>__('item name','lookshop'), 'item_quantity'=> __('item quantity','lookshop'), 'total_quantity'=>__('total quantity', 'lookshop'), 'subtotal_amount'=>__('subtotal amount', 'lookshop'));
		
		$lgl = array('equal'=>__('is equal to', 'lookshop'), 'greater'=>__('is greater than', 'lookshop'), 'less' => __('is less than', 'lookshop'), 'contains' => __('contains', 'lookshop'), 'not_contain'=>__('does not contain','lookshop'), 'begins' => __('begins with', 'lookshop'), 'ends'=>__('ends with', 'lookshop') );
		
			
			
		}
		
		function GetMonthString($n)
		{
    		$timestamp = mktime(0, 0, 0, $n, 1, 2005);
 		    return date("M", $timestamp);
		}
		
		echo '<div class="sale_end">';
			_e('SALE ENDS: ', 'lookshop');
			$exp = date_parse($coupon_data[0]['expiry']);
			echo $exp['day'].' '.GetMonthString($exp['month']).' '.$exp['year'];
			echo '<div id="the_code">'.__('Enter promo code: "', 'lookshop').$coupon_data[0]['coupon_code'].'" '.__('at checkout to save', 'lookshop').'</div>';
			if (!empty($conditions)) echo '<span class="conditions">'.__(' where','lookshop') .' '. $prp[$conditions[0]['property']]. ' '.$lgl[$conditions[0]['logic']].' '.$conditions[0]['value'].'</span>';
		echo '</div>';
		
		?>
			<div id="clock">
				<?php _e('Time left:', 'lookshop'); ?>
			<div id="count_down"></div></div>
			<script>
				jQuery('#count_down').countdown({until: new Date(<?php echo $exp['year'] ?>, <?php echo $exp['month']-1 ?>, <?php echo $exp['day']?>), format: 'dHMS',  timeSeparator:':', layout:'{dn} day(s) {hnn} : {mnn} : {snn}', labels: ['', '', '', '', '', '', '', '', ''], labels1:['', '', '', '', '', '', '']});
			</script>
			
		<?php
		
		echo '</div></div>';
				
	}

}

?>