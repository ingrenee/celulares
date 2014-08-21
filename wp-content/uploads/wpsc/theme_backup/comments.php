 <div id="comments">
	<!-- Prevents loading the file directly -->
	<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	    <?php die(__('Please do not load this page directly or we will hunt you down. Thanks and have a great day!','lookshop')); ?>
	<?php endif; ?>
	<div class="title"><h3 class="category-title"><?php comments_number(__('No comments','lookshop'), __('One comment:','lookshop'), __('% comments:','lookshop')); ?></h3></div>
	<!-- Password Required -->
	<?php if(!empty($post->post_password)) : ?>
	    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	    <?php endif; ?>
	<?php endif; ?>
	
	
	<?php if($comments) : ?>

	    <ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use twentyeleven_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define twentyeleven_comment() and that will be used instead.
				 * See twentyeleven_comment() in twentyeleven/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'lookshop_comment' ) );
			?>
		</ol>
	    
	    <!--<?php paginate_comments_links(); ?>-->
	    
	   
	<?php else : ?>
	    <p><?php __('No comments yet. You should be kind and add one!','lookshop'); ?></p>
	<?php endif; ?>
	
	<div id="commentForm">
	<?php comment_form(ti_contact_form()); ?>
		<div class="clear"></div>     
	</div><!--#commentsForm-->
</div><!--#comments-->