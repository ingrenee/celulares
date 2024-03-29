<?php 

/* Template Name:2 Cols Right with wide sidebar */

?>
<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		<div class="grid_8 cont_col">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="fance">
			<div class="title border">
						<h2 class="category-title"><?php the_title(); ?></h2>
					</div>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</div><!--#content-->
<div class="grid_4 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
	<div class="clear"></div>
</div>
	</div>	
</section>
<?php get_footer(); ?>
