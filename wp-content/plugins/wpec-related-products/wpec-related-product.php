<?php
/**
  * Plugin Name: WP e-Commerce Related Product
  * Description: WPEC Related Products for WP e-Commerce uses information available within the Single Product template to display related Products that belong to the same Product Category.
  * Version: 1.3.2
  * Author: Onnay Okheng
  * Author URI: http://onnayokheng.com/
  **/

function on_wpec_related_add_settings_page($page_hooks, $base_page) {
	$page_hooks[] = add_submenu_page($base_page,__('- Related Products'), __('- Related Products'), 'manage_options', 'wpec-related-products', 'on_wpec_panel');
	return $page_hooks;
}

add_filter('wpsc_additional_pages', 'on_wpec_related_add_settings_page', 10, 2);

/**
 * Function for displaying the related products
 *
 * @global type $post 
 */
function on_wpec_related(){
    global $post;
    
        $display_on     = get_option('on_wpec_display', 'Single Product');
    
        // checking if on single product
        if(!is_singular('wpsc-product')) return;
    
        // get related from produt category.
        $product_cat = wp_get_object_terms(wpsc_the_product_id(), 'wpsc_product_category');
        $product_tag = wp_get_object_terms(wpsc_the_product_id(), 'product_tag');
        
        // cat in array
        foreach ($product_cat as $cat_item) {
            $cat_array_name_list[] = $cat_item->slug;
        }
        // tag in array
        foreach ($product_tag as $tag_item) {
            $tag_array_name_list[] = $tag_item->slug;
        }
        
        $number     = (get_option('on_wpec_number') == '')? 4: get_option('on_wpec_number');
        $title      = (get_option('on_wpec_title') == '')? 'Related Products': get_option('on_wpec_title');
        $related_by = get_option('on_wpec_related_by', 'wpsc_product_category');
        
        if($related_by == 'wpsc_product_category'){
            $tax    = 'wpsc_product_category';
            $terms  = $cat_array_name_list;
        }else{
            $tax    = 'product_tag';
            $terms  = $tag_array_name_list;            
        }

        if (empty($related_product)) {
             $query = array (
                'showposts' => $number,
                'orderby'   => 'rand',
                'post_type' => 'wpsc-product',
                'tax_query' => array(
                        array(
                                'taxonomy'  => $tax,
                                'field'     => 'slug',
                                'terms'     => $terms
                        )
                ),
                'post__not_in' => array ($post->ID),
            );
            $related_product = new WP_Query($query);

            if(!$related_product->have_posts()){

                 $query = array (
                    'showposts' => $number,
                    'orderby'   => 'rand',
                    'post_type' => 'wpsc-product',
                    'post__not_in' => array ($post->ID),
                );
                $related_product = new WP_Query($query);
            }

            if($related_product->have_posts()):
                
                echo "<div class='wpec-related-wrap'>";
            
                echo "<h2 class=\"top-20\">".$title."</h2>";
                
                $i = 1;
                
             
                
                while($related_product->have_posts()) : $related_product->the_post(); 
            ?>

                    <div class="grid_3 <?php if(($i-1)%$number==0): ?> alpha<?php elseif($i%$number==0): ?> omega<?php endif; ?>  wpec-related-product product-<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?>">

                        <?php if(get_option('on_wpec_image') == 'on') : ?>
                            <div class="wpec-related-image" id="related-pro-<?php echo wpsc_the_product_id(); ?>">
                                    <a href="<?php echo wpsc_the_product_permalink(); ?>">

                                        <?php if(wpsc_the_product_thumbnail()) : ?>
                                                    <img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(get_option('product_image_width'), get_option('product_image_height')); ?>"/>
                                        <?php else: ?>
                                                    <img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php get_option('product_image_width'); ?>" height="<?php get_option('product_image_height') ?>" />	
                                        <?php endif; ?>
                                    </a>
                            </div><!--close imagecol-->
                        <?php endif; ?>

                            <h3 class="prodtitle entry-title">
                                    <?php if(get_option('hide_name_link') == 1) : ?>
                                            <?php echo wpsc_the_product_title(); ?>
                                    <?php else: ?> 
                                            <a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
                                    <?php endif; ?>
                            </h3>


                        <?php if(get_option('on_wpec_price') == 'on') : ?>
                            <div class="product-info">
                                    <div class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><span class="price_price"><?php _e('Price', 'wpsc'); ?>:</span> <span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="currentprice pricedisplay"><?php echo wpsc_the_product_price(); ?></span></div>
                            </div>
                        <?php endif; ?>
                        
						<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>

                    </div><!-- close default_product_display -->

<?php $i++;           
                endwhile;
                
                echo "</div><div class='clear'></div>";
                
            endif;
            wp_reset_postdata();
        }
        
}


/**
 * This is style for related product, default.
 */
function on_wpec_related_style(){
?>
                    
<?php
}


/**
 * init, first time call the plugin.
 */
function on_wpec_related_init(){
    if(!is_admin()){
        $place_related  = get_option('on_wpec_place', 'wpsc_product_addon_after_descr');
        $display_on     = get_option('on_wpec_display', 'Single Product');
        
        // adding style on header
        add_action('wp_head','on_wpec_related_style');
        
        // hoon into wpec page
        if($display_on != 'Manual')
            add_action($place_related, 'on_wpec_related');

    }
}
add_action('init', 'on_wpec_related_init');

/**
 * Function for display the Plugin Panel Options.
 */
function on_wpec_panel() { ?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>
    <h2><?php _e('WPEC Related Products Options', 'onnayokheng'); ?></h2>
    
    <div style="float: right; width: 300px; padding: 5px; background-color: #FFFBCC; border: 1px solid #E6DB55; color: #555;">
        <h3><?php _e('Thanks a lot', 'onnayokheng'); ?></h3>
        <p><?php _e('Thanks for using my plugin, you can contact me for say hello <a href="http://onnayokheng.com">Onnay Okheng</a> or buy me a cup of chocolate :)', 'onnayokheng'); ?></p>
        	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
    </div>

    <form method="post" action="options.php" id="options" style="float: left;">
    <?php wp_nonce_field('update-options') ?>
                
        <table class="form-table">
            <tbody>

                <tr valign="top">
                    <th scope="row"><?php _e('Title', 'onnayokheng'); ?></th>
                    <td>
                            <input type="text" name="on_wpec_title" placeholder="Your title here" value="<?php echo get_option('on_wpec_title'); ?>" />
                            <br/><?php _e('Default is "Related Products".', 'onnayokheng'); ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Number of related products', 'onnayokheng'); ?></th>
                    <td>
                            <input type="text" name="on_wpec_number" placeholder="Number of products" value="<?php echo get_option('on_wpec_number'); ?>" />
                            <br/><?php _e('Default is 4.', 'onnayokheng'); ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Show image', 'onnayokheng'); ?></th>
                    <td>                        
                            <?php $checked_image = (get_option('on_wpec_image') == 'on') ? ' checked="yes"' : ''; ?>                    
                            <label id="on_wpec_image" ><input type="checkbox" id="on_wpec_image" name="on_wpec_image"<?php echo $checked_image; ?> /> Enabled / Disabled</label>                                    
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Show price', 'onnayokheng'); ?></th>
                    <td>                        
                            <?php $checked_price = (get_option('on_wpec_price') == 'on') ? ' checked="yes"' : ''; ?>                    
                            <label id="on_wpec_price" ><input type="checkbox" id="on_wpec_price" name="on_wpec_price"<?php echo $checked_price; ?> /> Enabled / Disabled</label>                                    
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Related by', 'onnayokheng'); ?></th>
                    <td>
                        <?php $related_array  = array('wpsc_product_category', 'product_tag'); ?>
                        <?php $related        = get_option('on_wpec_related_by', 'wpsc_product_category'); ?>
                        <select name="on_wpec_related_by">
                        <?php 
                            foreach($related_array as $item):
                                $selected = ($related == $item)? ' selected="selected"':'';
                                echo '<option'.$selected.'>'.$item.'</option>';
                            endforeach;
                        ?>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Placement products', 'onnayokheng'); ?></th>
                    <td>
                        <?php $place_array  = array('wpsc_product_before_description', 'wpsc_product_addons', 'wpsc_product_addon_after_descr', 'wpsc_theme_footer'); ?>
                        <?php $place        = get_option('on_wpec_place', 'wpsc_product_addon_after_descr'); ?>
                        <select name="on_wpec_place">
                        <?php 
                            foreach($place_array as $item):
                                $selected = ($place == $item)? ' selected="selected"':'';
                                echo '<option'.$selected.'>'.$item.'</option>';
                            endforeach;
                        ?>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Display on', 'onnayokheng'); ?></th>
                    <td>
                        <?php $display_array  = array('Single Product', 'Manual'); ?>
                        <?php $display        = get_option('on_wpec_display', 'Single Product'); ?>
                        <select name="on_wpec_display">
                        <?php 
                            foreach($display_array as $item):
                                $selected = ($display == $item)? ' selected="selected"':'';
                                echo '<option'.$selected.'>'.$item.'</option>';
                            endforeach;
                        ?>
                        </select>
                        <?php _e('Put this code &lt;?php on_wpec_related() ?&gt;, if "Manual".', 'onnayokheng') ?>
                    </td>
                </tr>

            </tbody>
        </table>
        
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="on_wpec_image, on_wpec_number, on_wpec_title, on_wpec_price, on_wpec_related_by, on_wpec_place, on_wpec_display" />
        <div class="submit"><input type="submit" class="button-primary" name="submit" value="<?php _e('Save Settings', 'onnayokheng'); ?>"/></div>

    </form>

</div>

<?php } ?>
