<?php get_header(); ?>
<section id="content">
	<div class="container_12">
		<div class="grid_9 cont_col">
	<?php
		if(isset($_GET['author_name'])) :
			$curauth = get_userdatabylogin($author_name);
	    else :
			$curauth = get_userdata(intval($author));
		endif;
	?>
	<div class="title">
		<h1 class="category-title"><?php _e('About','lookshop')?>: <?php echo $curauth->display_name; ?></h1>
	</div>
	<div class="author box">
		
			<?php if(function_exists('get_avatar')) { echo '<figure>'; echo get_avatar( $curauth->user_email, $size = '180' ); echo '</figure>'; } /* Displays the Gravatar based on the author's email address. Visit Gravatar.com for info on Gravatars */ ?>
		
		<?php if($curauth->description !="") { /* Displays the author's description from their Wordpress profile */ ?>
			<p><?php echo $curauth->description; ?></a></p>
		<?php } ?>
	</div><!--.author-->

	<div class="title">
		<h2 class="category-title"><?php echo __('Recent Posts by','lookshop'); ?> <?php echo $curauth->display_name; ?></h2>
	</div>
	<div id="posts" class="posts-default">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); /* Displays the most recent posts by that author. Note that this does not display custom content types */ ?>
			<?php static $count = 0;
				if ($count == "5") // Number of posts to display
	            	{ break; }
				else { ?>
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
			<?php $count++; } ?>
		<?php endwhile; else: ?>
				<div class="fance">
					<?php printf(__('No posts by %s yet.','lookshop'), $curauth->display_name)  ?>
				</div>
		<?php endif; ?>
	</div><!--#recentPosts-->

	<div id="recent-author-comments" class="box">
		<h3><?php echo __('Recent Comments by','lookshop'); ?> <?php echo $curauth->display_name; ?></h3>
			<?php
				$number=5; // number of recent comments to display
				$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $number");
			?>
			<ul class="list">
				<?php
					if ( $comments ) : foreach ( (array) $comments as $comment) :
					echo  '<li class="recentcomments">' . sprintf(__('%1$s on %2$s','lookshop'), get_comment_date(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
				endforeach; else: ?>
                	<p>
                		<?php printf(__('No posts by %s yet.','lookshop'), $curauth->display_name);  ?>
                	</p>
				<?php endif; ?>
            </ul>
	</div><!--#recentAuthorComments-->
</div><!--#content-->
<div class="grid_3 side_col_right">
	<?php get_sidebar(); ?>
	<div class="shade"><div class="shade_in"><div class="shade_bg"></div></div></div>
</div>
<div class="clear"></div>
	</div>	
</section>
<?php get_footer(); ?>
