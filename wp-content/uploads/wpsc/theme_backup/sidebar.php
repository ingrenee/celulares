	<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
			<div class="box">
				<h3><?php _e('navigation','lookshop'); ?></h3>
				<?php wp_nav_menu( array('menu' => 'Sidebar Menu', 'menu_class' => 'list' )); /* editable within the Wordpress backend */ ?>
			</div>
			<div class="box">
				<h3><?php _e('archives','lookshop'); ?></h3>
				<ul class="list">
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</div>
			<div class="box">		
				<h3><?php _e('Meta','lookshop'); ?></h3>
				<ul class="list">
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul></div>
	<?php endif; ?>
<!--sidebar-->