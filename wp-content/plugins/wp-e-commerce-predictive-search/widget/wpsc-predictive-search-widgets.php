<?php
/**
 * WPSC Predictive Search Widget
 *
 * Table Of Contents
 *
 * get_items_search()
 * __construct()
 * widget()
 * wpscps_results_search_form()
 * update()
 * form()
 */
class WPSC_Predictive_Search_Widgets extends WP_Widget {
	
	function get_items_search() {
		$items_search = array(
				'product'				=> array( 'number' => 6, 'name' => __('Product Name', 'wpscps') ),
				'p_sku'					=> array( 'number' => 0, 'name' => __('Product SKU', 'wpscps') ),
				'p_cat'					=> array( 'number' => 0, 'name' => __('Product Categories', 'wpscps') ),
				'p_tag'					=> array( 'number' => 0, 'name' => __('Product Tags', 'wpscps') ),
				'post'					=> array( 'number' => 0, 'name' => __('Posts', 'wpscps') ),
				'page'					=> array( 'number' => 0, 'name' => __('Pages', 'wpscps') )
			);
			
		return $items_search;
	}

	function __construct() {
		$widget_ops = array('classname' => 'widget_products_predictive_search', 'description' => __( "User sees search results as they type in a dropdown - links through to 'All Search Results Page' that features endless scroll.", 'wpscps') );
		parent::__construct('products_predictive_search', __('WPEC Predictive Search', 'wpscps'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if(empty($instance['number_items']) || is_array($instance['number_items']) || $instance['number_items'] <= 0) $number_items = 5; 
		else $number_items = $instance['number_items'];
		if(empty($instance['text_lenght']) || $instance['text_lenght'] < 0) $text_lenght = 100; 
		else $text_lenght = $instance['text_lenght'];
		$search_global = empty($instance['search_global']) ? 0 : $instance['search_global'];
		$show_price = empty($instance['show_price']) ? 0 : $instance['show_price'];
		$search_box_text = ( isset($instance['search_box_text']) ? $instance['search_box_text'] : '' );
		if (trim($search_box_text) == '') $search_box_text = get_option('ecommerce_search_box_text');

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo $this->wpscps_results_search_form($widget_id, $number_items, $text_lenght, '',$search_global, $search_box_text, $show_price);
		echo $after_widget;
	}
	
	public static function wpscps_results_search_form($widget_id, $number_items=5, $text_lenght=100, $style='', $search_global = 0, $search_box_text = '', $show_price = 1){
		
		// Add ajax search box script and style at footer
		add_action('wp_footer',array('WPSC_Predictive_Search_Hook_Filter','wpscps_add_frontend_script'));
		
		$id = str_replace('products_predictive_search-','',$widget_id);
		$wpscps_get_result_popup = wp_create_nonce("wpscps-get-result-popup");
		$cat_slug = '';
		$tag_slug = '';
		$row = 6;
		if ( $number_items > 0  ) $row = $number_items;
		
		ob_start();
		?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(document).on("click", "#bt_pp_search_<?php echo $id;?>", function(){
		if (jQuery("#pp_course_<?php echo $id;?>").val() != '' && jQuery("#pp_course_<?php echo $id;?>").val() != '<?php echo esc_js( $search_box_text ); ?>') {
			<?php if (get_option('permalink_structure') == '') { ?>jQuery("#fr_pp_search_widget_<?php echo $id;?>").submit();<?php } else { ?>var pp_search_url_<?php echo $id;?> = '<?php echo rtrim( get_permalink(get_option('ecommerce_search_page_id')), '/' );?>/keyword/'+ jQuery("#pp_course_<?php echo $id;?>").val().replace('(', '%28').replace(')', '%29');
			<?php if ($cat_slug != '') { ?> pp_search_url_<?php echo $id;?> += '/scat/<?php echo $cat_slug; ?>';
			<?php } elseif ($tag_slug != '') { ?> pp_search_url_<?php echo $id;?> += '/stag/<?php echo $tag_slug; ?>'; <?php } ?>
			window.location = pp_search_url_<?php echo $id;?>;
		<?php } ?>
		}
	});
	jQuery("#fr_pp_search_widget_<?php echo $id;?>").bind("keypress", function(e) {
		if (e.keyCode == 13) {
			if (jQuery("#pp_course_<?php echo $id;?>").val() != '' && jQuery("#pp_course_<?php echo $id;?>").val() != '<?php echo esc_js( $search_box_text ); ?>') {
				<?php if (get_option('permalink_structure') == '') { ?>jQuery("#fr_pp_search_widget_<?php echo $id;?>").submit();<?php } else { ?>var pp_search_url_<?php echo $id;?> = '<?php echo rtrim( get_permalink(get_option('ecommerce_search_page_id')), '/' );?>/keyword/'+ jQuery("#pp_course_<?php echo $id;?>").val().replace('(', '%28').replace(')', '%29');
				<?php if ($cat_slug != '') { ?> pp_search_url_<?php echo $id;?> += '/scat/<?php echo $cat_slug; ?>';
				<?php } elseif ($tag_slug != '') { ?> pp_search_url_<?php echo $id;?> += '/stag/<?php echo $tag_slug; ?>'; <?php } ?>
				window.location = pp_search_url_<?php echo $id;?>;
				<?php } ?>
				return false;
			} else {
				return false;
			}
		}
	});
	var ul_width = jQuery("#pp_search_container_<?php echo $id;?>").find('.ctr_search').innerWidth();
	var ul_height = jQuery("#pp_search_container_<?php echo $id;?>").height();
	var urls = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>'+'?action=wpscps_get_result_popup';
	jQuery("#pp_course_<?php echo $id;?>").autocomplete(urls, {
		/*width: ul_width,*/
		scrollHeight: 2000,
		max: <?php echo ($row + 2); ?>,
		extraParams: {'row':'<?php echo $row; ?>', 'text_lenght':'<?php echo $text_lenght;?>', 'security':'<?php echo $wpscps_get_result_popup;?>' <?php if($cat_slug != ''){ ?>, 'scat':'<?php echo $cat_slug ?>' <?php } ?> <?php if($tag_slug != ''){ ?>, 'stag':'<?php echo $tag_slug ?>' <?php } ?>, 'show_price':'<?php echo $show_price; ?>' },
		inputClass: "ac_input_<?php echo $id; ?>",
		resultsClass: "ac_results_<?php echo $id; ?>",
		loadingClass: "predictive_loading",
		highlight : false
	});
	jQuery("#pp_course_<?php echo $id;?>").result(function(event, data, formatted) {
		if(data[2] != ''){
			jQuery("#pp_course_<?php echo $id;?>").val(data[2]);
		}
		window.location.href(data[1]);
	});
});
</script>
        <div class="pp_search_container" id="pp_search_container_<?php echo $id;?>" style=" <?php echo $style; ?> ">
        <div style="display:none" class="chrome_xp"></div>
		<form autocomplete="off" action="<?php echo get_permalink(get_option('ecommerce_search_page_id'));?>" method="get" class="fr_search_widget" id="fr_pp_search_widget_<?php echo $id;?>">
        	<?php
			if (get_option('permalink_structure') == '') {
			?>
            <input type="hidden" name="page_id" value="<?php echo get_option('ecommerce_search_page_id'); ?>"  />
            <?php } ?>
			<div class="ctr_search">
            <input type="text" id="pp_course_<?php echo $id;?>" onblur="if (this.value == '') {this.value = '<?php echo esc_js( $search_box_text ); ?>';}" onfocus="if (this.value == '<?php echo esc_js( $search_box_text ); ?>') {this.value = '';}" value="<?php echo esc_attr( $search_box_text ); ?>" name="rs" class="txt_livesearch" /><span class="bt_search" id="bt_pp_search_<?php echo $id;?>"></span>
            </div>
            <?php
			if ($cat_slug != '') { ?>
            	<input type="hidden" name="scat" value="<?php echo $cat_slug; ?>"  />
            <?php
			} elseif ($tag_slug != '') { ?>
            	<input type="hidden" name="stag" value="<?php echo $tag_slug; ?>"  />
            <?php
			}
			?>
		</form>
        </div>
        <?php if (trim($style) == '') { ?>
        <div style="clear:both;"></div>
		<?php } ?>
    	<?php
		$search_form = ob_get_clean();
		return $search_form;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_items'] = $new_instance['number_items'];
		$instance['text_lenght'] = strip_tags($new_instance['text_lenght']);
		$instance['show_price'] = $new_instance['show_price'];
		$instance['search_global'] = 1;
		$instance['search_box_text'] = strip_tags($new_instance['search_box_text']);
		return $instance;
	}

	function form( $instance ) {
		$global_search_box_text = get_option('ecommerce_search_box_text');
		$items_search_default = WPSC_Predictive_Search_Widgets::get_items_search();
		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number_items' => 5, 'text_lenght' => 100, 'show_price' => 1, 'search_global' => 1, 'search_box_text' => $global_search_box_text) );
		$title = strip_tags($instance['title']);
		$number_items = $instance['number_items'];
		if (empty($number_items) || is_array($number_items) ) $number_items = 5;
		else $number_items = strip_tags($instance['number_items']);
		$text_lenght = strip_tags($instance['text_lenght']);
		$show_price = $instance['show_price'];
		$search_global = $instance['search_global'];
		$search_box_text = $instance['search_box_text'];
?>		
		<style>
			#wpsc_predictive_upgrade_area { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; padding:5px; position:relative}
			#wpsc_predictive_upgrade_area legend {margin-left:4px; font-weight:bold;}
			.item_heading{ width:130px; display:inline-block;}
			ul.predictive_search_item li{padding-left:15px; background:url(<?php echo WPSC_PS_IMAGES_URL; ?>/sortable.gif) no-repeat left center; cursor:pointer;}
			ul.predictive_search_item li.ui-sortable-placeholder{border:1px dotted #111; visibility:visible !important; background:none;}
			ul.predictive_search_item li.ui-sortable-helper{background-color:#DDD;}
		</style>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpscps'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><label for="<?php echo $this->get_field_id('search_box_text'); ?>"><?php _e('Search box text message:', 'wpscps'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('search_box_text'); ?>" name="<?php echo $this->get_field_name('search_box_text'); ?>" type="text" value="<?php echo esc_attr($search_box_text); ?>" /></p>
            <p><label><input type="checkbox" name="<?php echo $this->get_field_name('show_price'); ?>" value="1" <?php checked( $show_price, 1 ); ?>  /> <?php _e('Show Product prices', 'wpscps'); ?></label>
            </p>
            <p><label for="<?php echo $this->get_field_id('number_items'); ?>"><?php _e('Number of results to show:', 'wpscps'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('number_items'); ?>" name="<?php echo $this->get_field_name('number_items'); ?>" type="text" value="<?php echo esc_attr($number_items); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('text_lenght'); ?>"><?php _e(' Results description character count:', 'wpscps'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('text_lenght'); ?>" name="<?php echo $this->get_field_name('text_lenght'); ?>" type="text" value="<?php echo esc_attr($text_lenght); ?>" /></p>
            <fieldset id="wpsc_predictive_upgrade_area"><legend><?php _e('Upgrade to','wpscps'); ?> <a href="<?php echo WPSC_PS_AUTHOR_URI; ?>" target="_blank"><?php _e('Pro Version', 'wpscps'); ?></a> <?php _e('to activate', 'wpscps'); ?></legend>
                <p><?php _e("Activate search 'types' for this widget by entering the number of results to show in the widget dropdown. &lt;empty&gt; = not activated. Sort order by drag and drop", 'wpscps'); ?></p>
                <ul class="ui-sortable predictive_search_item">
                <?php foreach ($items_search_default as $key => $data) { ?>
                    <li><span class="item_heading"><label><?php echo $data['name']; ?></label></span> <input disabled="disabled" id="" name="" type="text" value="<?php echo esc_attr($data['number']); ?>" style="width:50px;" /></li>
                <?php } ?>
                </ul>
                <p><label><?php _e(' Results description character count:', 'wpscps'); ?></label> <input disabled="disabled" class="widefat" id="" name="" type="text" value="100" /></p>
                <p><input disabled="disabled" type="radio" id="<?php echo $this->get_field_id('search_global'); ?>_1" name="<?php echo $this->get_field_name('search_global'); ?>" value="1" checked="checked" /> <label for="<?php echo $this->get_field_id('search_global'); ?>_1"><?php _e('Search All Products', 'wpscps'); ?></label><br />
                <input disabled="disabled" type="radio" id="<?php echo $this->get_field_id('search_global'); ?>_2" name="<?php echo $this->get_field_name('search_global'); ?>" value="0"  /> <label for="<?php echo $this->get_field_id('search_global'); ?>_2"><?php _e('Smart Search', 'wpscps'); ?></label>
                </p>
			</fieldset>
<?php
	}
}
?>