<?php
/* 

Template Name: Home Page Products Only

*/ 

?>
<?php get_header(); ?>
<?php define('TI_IS_HOME', true); ?>
<?php if ( is_sidebar_active('Home Categories') ) : ?>
<section id="categories_sl">
	<div class="container_12">
		<div class="grid_12">
			
			<?php dynamic_sidebar( 'Home Categories' ); ?>
		</div>
	</div>
</section>		
<?php endif; ?>

		
<section id="content">
	<div class="container_12">
		<?php if( is_sidebar_active('Home Sidebar') ) : ?>
			<div class="grid_3">
				<?php dynamic_sidebar( 'Home Sidebar' ); ?>	
			</div>
		<?php endif; ?>

		<div class="grid_<?php if ( is_sidebar_active('Home Sidebar') ) echo '9'; else echo '12'; ?> cont_col">	
			
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								
								<?php if (get_post_type() == 'page') : ?>
								
									<article>
										<div class="post-content">
											<?php the_content();?>
										</div>
										<div class="clear"></div>
									</article>
								
								<?php else: ?>
								
								<article class="article-posts">
									<?php if ( has_post_thumbnail()) : ?>
									    <?php echo '<figure class="thumb">'; the_post_thumbnail('default-thumb'); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
									<?php endif; ?>			
									<div class="post-inner">
										<h2>
									 		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
									    		<?php $title = the_title('','', false);  if ($title != '') echo $title; else echo "Article"; ?>
									 		</a>
									 	</h2>
										<div class="post-meta">
										    		<?php the_time('F j, Y'); ?><?php _e('at','lookshop'); ?> <?php the_time() ?>, <?php _e('by','lookshop'); ?> <?php the_author_posts_link() ?><?php _e(' in ', 'lookshop'); ?><?php the_category(', ') ?>
										    		<?php if (the_tags(__('Tags: ','lookshop'), ', ', ' ')); ?>
										</div><!--.postMeta-->
										<div class="post-content">
										    <?php the_excerpt(__('Read more','lookshop'));?>
										</div>
										<div class="post-meta-comments">
											<?php comments_popup_link(__('No Comments','lookshop'), __('1 Comment','lookshop'), __('% Comments','lookshop')); ?>
										</div>
									</div>
									<div class="clear"></div>
									<div class="shade" style="bottom: -5px; height: 5px;"><div class="shade_in" style="bottom: -5px; height: 5px;"><div class="shade_bg" style="bottom: -5px; height: 5px;"></div></div></div>
								</article>
								
								<?php endif; ?>
								
						<?php endwhile; else: ?>
								<article>
									<div class="no-results">
										<p><strong><?php _e('There has been an error.','lookshop');?></strong></p>
										<p><?php _e('We apologize for any inconvenience, please','lookshop');?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page','lookshop'); ?></a> <?php _e('or use the search form below.','lookshop'); ?></p>
										<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
									</div><!--noResults-->
								</article>
						<?php endif; ?>
			
		<nav class="newer-older">
			<div class="older">
					<?php next_posts_link(__('<span>&laquo; Older Entries</span>','lookshop')) ?>
			</div><!--.older-->
			<div class="newer">
					<?php previous_posts_link(__('<span>Newer Entries &raquo;</span>','lookshop')) ?>
			</div><!--.older-->
		</nav><!--.oldernewer-->
		</div>
	</div>
</section>
<div class="clear"></div>

<?php get_footer(); ?>
