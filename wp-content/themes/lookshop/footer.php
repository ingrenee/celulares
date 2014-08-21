<div class="clear"></div>
<footer>
	<div id="footback">
		<div class="container_12">
			<div class="grid_12 content">
				
				<div class="footer_container">
					<div id="footer_upper">
						<?php if ( ! dynamic_sidebar( 'Footer Upper' ) ) : ?>
							<!--Wigitized Footer Upper-->
						<?php endif ?>
						<div class="clear"></div>
					</div>
					
					<div id="footer_lower">
						<?php if ( ! dynamic_sidebar( 'Footer Lower' ) ) : ?>
							<!--Wigitized Footer Lower-->
						<?php endif ?>
						<div class="clear"></div>
					</div>
					
				</div>
				
			</div>	
		</div>
		<div class="clear"></div>
		</div>
		<div id="end">
			<div class="container_12">
			<div class="grid_12">
				<div class="bottom_content">
				
					<?php // wp_nav_menu( array('menu' => 'Footer Menu', 'depth'=>'1', 'container' => '', 'menu_id' => 'foot', 'walker' => new ti_menu_walker())); /* editable within the Wordpress backend */ ?> 
					<?php _e('Copyright', 'lookshop'); ?>	&copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"> <?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved. &nbsp;','lookshop') ?> 
				
				</div>
				<div id="bot_container">
				  	<?php if ( ! dynamic_sidebar( 'Bottom' ) ) : ?>
						<!--Wigitized Footer-->
					<?php endif ?>
				</div>
					
		</div>
		<div class="clear"></div>
		</div>
		</div>
		
	</footer>
<?php echo getAnalyticsCode(); /* Enables google analytics tracking */ ?>
<?php wp_footer(); /* this is used by many Wordpress features and for plugins to work proporly */ ?>
</body>
</html>