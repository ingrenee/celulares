<?php get_header(); ?>
<?php global $iclUtility; global $post;?>
<section id="content">
	<div class="container_12">
	
	<?php if ((!$iclUtility->isOnWPSCpage()) || (!$post->post_type == "wpsc-product")): ?>
	
		<div class="grid_9 cont_col">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<div class="fance" id="post">
				<article>
					
					<div class="title border">
						<h1 class="category-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<div class="post-meta-written">
							<?php the_time('F j, Y'); ?><br/><?php _e('at','lookshop'); ?> <?php the_time() ?><?php edit_post_link(__('&nbsp;|&nbsp;<small>Edit this entry</small>','lookshop'),'',''); ?>
						</div>
					</div>
					
					
					<div id="post-content">
						<?php if ( has_post_thumbnail()) : ?>

						<?php echo '<figure class="thumb">'; the_post_thumbnail(''); echo '<figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
					<?php endif; ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--#post-content-->
				</article>
				<div class="post-meta">
						<div class="post-meta-taxonomy">
							<b><?php _e('Categories','lookshop'); ?>:</b> <?php the_category(', ') ?> <br/> 
							<?php the_tags(__('<b>Tags:</b> ','lookshop'), ', ', ' '); ?><br/>
							<b><?php _e('Recieve new post updates:','lookshop'); ?></b>&nbsp;<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow"><?php _e('Entries (RSS)','lookshop'); ?></a>
							<br />
							<b><?php _e('Recieve follow up comments updates','lookshop');?>:</b>&nbsp;<?php post_comments_feed_link(); ?>
						</div>
						<div class="post-meta-comments">
							<?php comments_popup_link(__('No comments','lookshop'), __('One comment','lookshop'), __('% comments','lookshop'), 'comments-link', __('Comments are closed','lookshop')); ?>
						</div>
					</div>
				</div>
		</div><!--#post-# .post-->

		<?php comments_template( '', true ); ?>

	<?php endwhile; ?>
</div><!--#content-->
<div class="grid_3 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
</div>

<?php else : ?>


		<!-- Product Listing Page -->


		<?php if (get_option('list_sidebar') == 'left') : ?>
			<div class="grid_3 side_col_left shop">
				<?php if ( ! dynamic_sidebar( 'Store Page Sidebar' )) : ?>
							
				<?php endif; ?>
				<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

		<div class="grid_<?php echo (get_option('list_sidebar') == 'off') ? '12' : '9'   ?> cont_col">

			<?php if(!(wpsc_is_in_category())): ?>
				<?php if ( ! dynamic_sidebar( 'Banner Holder' )) : ?>
							
				<?php endif; ?>
			<?php endif; ?>


			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>

		<?php if (get_option('list_sidebar') == 'right') : ?>
			<div class="grid_3 side_col_left shop">
				<?php if ( ! dynamic_sidebar( 'Store Page Sidebar' )) : ?>
							
				<?php endif; ?>
				<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
				<div class="clear"></div>
			</div>

		<?php endif; ?>




	<?php endif; ?>

		
		<div class="clear"></div>
	</div>	
</section>
<?php get_footer(); ?>
