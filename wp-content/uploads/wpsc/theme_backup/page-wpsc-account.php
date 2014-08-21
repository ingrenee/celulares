<?php

/* Template Name: Store Page Account */

?>
<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		
		<?php if ( ! dynamic_sidebar( 'Alert' ) ) : ?>
			<!--Wigitized 'Alert' for the home page -->
		<?php endif ?>
		
		
			<div class="grid_3 side_col_left shop">
				<?php if ( ! dynamic_sidebar( 'Store Page Sidebar' )) : ?>
							
				<?php endif; ?>
				<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
				<div class="clear"></div>
			</div>

		
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="grid_9 account">
		<div class="boxee">
			<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
		<!--#content-->
		
	</div>	
</section>
<?php get_footer(); ?>
