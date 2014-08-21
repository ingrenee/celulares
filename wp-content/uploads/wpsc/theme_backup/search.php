<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		<div class="grid_9 cont_col posts-default" id="posts">

	<div class="smaller-title">
		<h1 class="category-title lower-case"><?php _e('You were looking for','lookshop'); ?>: <?php the_search_query(); ?></h1>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article>
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
	<?php endwhile; else: ?>
	<div class="fance">
		<div class="no-results">
			<div class="heading">
				<h2><?php _e('No Results','lookshop'); ?></h2>
			</div>
			<div class="post-content">
				<p><?php _e('Please feel free try again!','lookshop'); ?></p>
			</div>
		</div><!--no-results-->
	</div>
	<?php endif; ?>

	<nav class="newer-older">
		<div class="older">
				<?php next_posts_link(__('<span>&laquo; Older Entries</span>','lookshop')) ?>
		</div><!--.older-->
		<div class="newer">
				<?php previous_posts_link(__('<span>Newer Entries &raquo;</span>','lookshop')) ?>
		</div><!--.older-->
	</nav><!--.oldernewer-->

</div><!-- #content -->
<div class="grid_3 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
</div>
		<div class="clear"></div>
	</div>	
</section>

<?php get_footer(); ?>
