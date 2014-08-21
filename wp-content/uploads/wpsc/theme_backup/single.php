<?php get_header(); ?>
<section id="content"> 
	<div class="container_12"> 
		<div class="grid_9 cont_col single">
		
		
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<div class="no-back" id="post"> 
			<?php if ( get_post_type() == 'gallery' ) { /* if a gallery */ ?>
				
				<article>
				
					<?php the_content(); ?>
				
					<div class="title">
						<h1 class="category-title"><?php the_title(); ?></h1>
						
					</div>
					
					
					
					<div id="post-content">
					<?php if ( has_post_thumbnail()) : ?>
						<?php echo '<figure class="thumb">'; the_post_thumbnail('gallery-thumb'); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
					<?php endif; ?>	
						<?php the_content(); ?>
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--#post-content-->
				</article>

			<?php } else { /* if not a gallery */ ?>

				<article>

					<div class="title">
						<h1><?php the_title(); ?></h1>
					</div>

					<div class="post-meta">
						<div class="post-meta-taxonomy">
							<?php _e('by','lookshop'); ?> <?php the_author_posts_link() ?> 
							<?php _e('at','lookshop'); ?> <?php the_time('F j, Y'); ?>
							<?php _e('in', 'lookshop'); ?> <?php the_category(', ') ?>
							
							
						</div>
						<div class="post-meta-comments">
							<?php comments_popup_link(__('No comments','lookshop'), __('One comment','lookshop'), __('% comments','lookshop'), 'comments-link', __('Comments are closed','lookshop')); ?>
						</div>
					</div>

					
					
					
					
					<div class="post-content">
					<?php if ( has_post_thumbnail()) : ?>
						<?php echo '<figure class="thumb">'; the_post_thumbnail('single-thumb'); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
						<div class="clear"></div>
					<?php endif; ?>
					
						<?php the_content(); ?>
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
								
					</div><!--#post-content-->
					<div class="clear"></div>
					<?php if(function_exists('ctsocial_icons_template')): ?>
						<div class="s_share"><div class="s_inner"><?php _e('Share: ', 'lookshop'); ?></div><?php echo ctsocial_icons_template(); ?></div>
					<?php endif; ?>


					<?php if (the_tags(__('<div class="post-tags">Tags: <span>','lookshop'), '</span> <span>', '</span></div>')); ?>

				</article>
			
			</div><!-- #post-## -->
				
				

				<?php /* If a user fills out their bio info, it's included here */ ?>
				<div id="post-author">
					<div class="smallest-title border"><h3><?php _e('About the Author','lookshop'); ?></h3></div>
					<?php if(function_exists('get_avatar')) { echo '<figure>'; echo get_avatar( get_the_author_meta('email'), '107' ); echo '</figure>';   } ?>
					<h4><?php the_author_posts_link() ?></h4>
					<div id="authorDescription">
						<?php the_author_meta('description') ?> 
						<div id="author-link">
							<p><?php _e('View all posts by','lookshop'); ?>: <?php the_author_posts_link() ?></p>
						</div><!--#author-link-->
					</div><!--#author-description -->
				</div><!--#post-author-->
	
			
			</div>
			<div class="clear"></div>
			<br/>
			<div class="newer-older">
				<div class="older">
						<?php previous_post_link('%link', __('<span>Previous post</span>','lookshop')) ?>
				</div><!--.older-->
				<div class="newer">
						<?php next_post_link('%link', __('<span>Next Post</span>','lookshop')) ?>
				</div><!--.older-->
			</div><!--.newer-older-->

			
			<?php comments_template( '', true ); ?>
		<?php } /* end if-gallery */ ?>
		
	<?php endwhile; /* end loop */ ?>
</div>
<div class="grid_3 side_col_right">
<?php get_sidebar(); ?>
</div>
		
	</div>
	<div class="clear"></div>	
</section>
<?php get_footer(); ?>