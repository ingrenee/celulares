<div id="cart_top_contents" class="itGeorgia">
	<div id="cart_icon"></div>
	<div id="switcher" class="arrow_close"></div>
	<div class="top_text">	
		
		<?php if(isset($cart_messages) && count($cart_messages) > 0) { ?>
	<?php foreach((array)$cart_messages as $cart_message) { ?>
	  <!--<span class="cart_message"><?php echo $cart_message; ?></span>-->
	<?php } ?>
<?php } ?>
		
		<a href="<?php echo get_option('shopping_cart_url'); ?>">
			<span id="cart_items_no"><?php 	if (wpsc_cart_item_count() > 0) echo wpsc_cart_item_count(); else echo __('No', 'lookshop'); ?>
					<?php if (wpsc_cart_item_count() == 1) echo __( 'item', 'lookshop'); else echo __(' items', 'lookshop'); ?>
			</span>
		</a>
		<span><?php echo __(' in your cart','lookshop') ?></span>
	</div>
</div>

<div id="cart_bottom_contents">
<?php if(wpsc_cart_item_count() > 0): ?>
 	 	
 	<table class='shoppingcart'>
		<?php $i = 0;?>	
		<?php $c = wpsc_cart_item_count(); ?>
		<?php while(wpsc_have_cart_items()): wpsc_the_cart_item(); $i++;?>
			<tr <?php if ($i == 1) echo "class=\"alpha\""; ?> >
				<td class="prod_img"><a href="<?php echo wpsc_cart_item_url(); ?>"><img class="product_img" src="<?php echo wpsc_cart_item_image(80, 90); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" /></a></td>
				<td class="prod_name">
				
					<a href="<?php echo wpsc_cart_item_url(); ?>"><?php echo wpsc_cart_item_name(); ?></a><br/>
					<span><?php _e('quantity: ', 'lookshop');?><span class="prod_qty"><?php echo wpsc_cart_item_quantity(); ?></span></span>
					<span class="prod_price"><?php _e('price: ', 'lookshop'); ?><?php echo wpsc_cart_item_price(); ?></span>
				
				</td>
				<td class="prod_del">
					<form action="" method="post" class="adjustform">
						<input type="hidden" name="quantity" value="0" />
						<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
						<input type="hidden" name="wpsc_update_quantity" value="true" />
						<input class="remove_button" type="submit" />
					</form>
				</td>

			</tr>
		<?php endwhile; ?>
	

<?php if(wpsc_cart_has_shipping() && !wpsc_cart_show_plus_postage()) : ?>
		<tr class="shipping"><td><?php echo __('Shipping', 'wpsc'); ?></td><td class="price"><?php echo wpsc_cart_shipping(); ?></td><td></td></tr>
<?php endif; ?>
<?php if( (wpsc_cart_tax(false) >0) && !wpsc_cart_show_plus_postage()) : ?>
<tr class="shipping">
	<td><?php echo wpsc_display_tax_label(true); ?></td>
	<td class="price"><?php echo wpsc_cart_tax(); ?></td><td></td>
</tr>
<?php endif; ?>
<?php if(wpsc_cart_show_plus_postage()) : ?>
	<tr class="total"><td colspan="3">
				<span class='pluspostagetax'> + <?php echo __('Postage &amp; Tax ', 'wpsc'); ?></span></td></tr>
	<?php endif; ?>
<tr class="total">
<td colspan="3"><?php echo __('Total&nbsp;:', 'wpsc'); ?>

<?php echo wpsc_cart_total_widget( false, false ,false ); ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" class="cart_excluding"><small><?php _e( 'excluding shipping and tax','lookshop'); ?></small></td>
	</tr>



	 </table>

	<div class="buts">
	<form action='' method='post' class='wpsc_empty_the_cart'>
		<input type='hidden' name='wpsc_ajax_action' value='empty_cart' />
		<span class='emptycart'>
			<a target="_parent" href="<?php echo htmlentities(add_query_arg('wpsc_ajax_action', 'empty_cart', remove_query_arg('ajax')), ENT_QUOTES, 'UTF-8'); ?>" class="emptycart itGeorgia" title="<?php _e('Empty Your Cart', 'wpsc'); ?>"><?php _e('Empty cart', 'wpsc'); ?></a>
		</span>                                                                                             
	</form>
	
	<div class="right">
		<a href="<?php echo get_option('shopping_cart_url'); ?>" class="button reverse"><span><?php echo __('Checkout', 'wpsc'); ?></span></a>
	</div>
	<?php
	//wpsc_google_checkout();
?>
</div>	
<?php else: ?>

	<div id="no_items" >
								<?php echo __('There are no products in your shopping cart!<br/>
								We hope it\'s not for long.', 'lookshop'); ?>
								<p> <a target='_parent' href="<?php echo get_option('product_list_url'); ?>"><?php echo __('Visit the shop', 'wpsc'); ?></a></p>
							</div>	
<?php endif; ?>
</div>

