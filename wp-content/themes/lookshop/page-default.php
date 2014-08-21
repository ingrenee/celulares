<?php

/* Template Name: Wordpress default page */

?>
<?php get_header(); ?>
<?php global $post;?>
<section id="content">
	<div class="container_12">
		<div class="grid_9 cont_col">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
			<div class="fance" id="post">
				<article>

					<div class="title border">
						<h1 class="category-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						
					</div>

					<div class="post-meta">
						<div class="post-meta-written">
							<?php the_time('F j, Y'); ?> <?php _e('at','lookshop'); ?> <?php the_time() ?><?php edit_post_link(__('&nbsp;|&nbsp;<small>Edit this entry</small>','lookshop'),'',''); ?>
						</div>
						<div class="post-meta-taxonomy">
							 <?php the_category(', ') ?> <br/> 
							<?php the_tags(__('','lookshop'), ', ', ' '); ?><br/>
							<?php /* ><b><?php _e('Receive new post updates','lookshop'); ?>:</b>&nbsp;<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow"><?php _e('Entries (RSS)','lookshop'); ?></a>
							<br />
							<b><?php _e('Recieve follow up comments updates','lookshop');?>:</b>&nbsp;<?php post_comments_feed_link(); ?><?php */?>
						</div>
						<div class="post-meta-comments">
							<?php comments_popup_link(__('No comments','lookshop'), __('One comment','lookshop'), __('% comments','lookshop'), 'comments-link', __('Comments are closed','lookshop')); ?>
						</div>
					</div>

					
					
					
					<?php if ( has_post_thumbnail()) : ?>
						<?php echo '<figure class="thumb">'; the_post_thumbnail(); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
					<?php endif; ?>
					<div class="post-content">
						<?php the_content(); ?>
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--#post-content-->
				</article>
			</div>

		<?php comments_template( '', true ); ?>

	<?php endwhile; ?>
</div><!--#content-->
<div class="grid_3 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
</div>
	</div>	
</section>
<?php get_footer(); ?>