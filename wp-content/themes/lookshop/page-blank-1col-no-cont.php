<?php

/*

Template Name: 1 Col No Container

*/

?>
<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		
		<?php if ( ! dynamic_sidebar( 'Alert' ) ) : ?>
			<!--Wigitized 'Alert' for the home page -->
		<?php endif ?>
		
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		
	<?php endwhile; ?>
		<!--#content-->
			
	</div>	
</section>
<?php get_footer(); ?>
