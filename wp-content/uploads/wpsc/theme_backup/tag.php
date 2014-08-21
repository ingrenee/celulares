<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		<div class="grid_9 cont_col" id="posts">
	<div class="smaller-title">
		<h1 class="category-title lower-case">
			<?php printf( __( 'Tag Archives: %s' ,'lookshop'), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
		</h1>
	</div>
	
	<?php $tag_desc = tag_description(); if ($tag_description) :?>	
		<div class="box">
			<?php echo tag_description(); /* displays the tag's description from the Wordpress admin */ ?>
		</div>
	<?php endif; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article>
			<?php if ( has_post_thumbnail()) : ?>
				<?php echo '<figure class="thumb">'; the_post_thumbnail(); echo '</figure>'; /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
			<?php endif; ?>
			<div class="heading">
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="post-meta-written">
					<?php the_time('F j, Y'); ?> <?php _e('at','lookshop'); ?> <?php the_time() ?>, <?php _e('by','lookshop'); ?> <?php the_author_posts_link() ?>
				</div>
			</div>
			
			<div class="post-content">
				<?php the_excerpt(__('Read more','lookshop'));?>
			</div>
			<div class="post-meta">
				<div class="post-meta-taxonomy">
					<b><?php _e('Categories','lookshop');?>:</b> <?php the_category(', ') ?><br/>
					<?php if (the_tags(__('<b>Tags:</b> ','lookshop'), ', ', ' ')); ?>
				</div>
				<div class="post-meta-comments">
					<?php comments_popup_link(__('No Comments','lookshop'), __('1 Comment','lookshop'), __('% Comments','lookshop')); ?>
				</div>
			</div><!--.postMeta-->
		</article>
		
	<?php endwhile; else: ?>
		<div class="no-results box">
			<p><strong><?php echo __('There has been an error.','lookshop'); ?></strong></p>
			<p><?php echo __('We apologize for any inconvenience, please','lookshop'); ?><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php echo __('return to the home page','lookshop'); ?></a> <?php echo __('or use the search form below.','lookshop'); ?></p>
			<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		</div><!--noResults-->
	<?php endif; ?>

	<nav class="oldernewer">
		<div class="older">
			<p>
				<?php next_posts_link(__('&laquo; Older Entries','lookshop')) ?>
			</p>
		</div><!--.older-->
		<div class="newer">
			<p>
				<?php previous_posts_link(__('Newer Entries &raquo;','lookshop')) ?>
			</p>
		</div><!--.older-->
	</nav><!--.oldernewer-->
	
</div><!--#content-->
<div class="grid_3 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
</div>
		<div class="clear"></div>
	</div>	
</section>
<?php get_footer(); ?>