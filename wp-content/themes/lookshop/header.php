<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php if ( is_tag() ) {
			echo __('Tag Archive for &quot;','lookshop').$tag.'&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(); echo __(' Archive | ','lookshop'); bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo __('Search for &quot;','lookshop').wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo __('Error 404 Not Found | ','lookshop'); bloginfo( 'name' );
		} else {
			echo wp_title( ' | ', false, 'right' ); bloginfo( 'name' );
		} ?></title>
		
	<meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" name="viewport">
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="generator" content="WordPress" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="index" title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>/" />
	
	<?php if(get_option('favicon_ico')!="") : ?><link rel="icon" href="<?php echo get_option('favicon_ico'); ?>" type="image/x-icon" /><?php endif; ?>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	
	
	
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	
	
	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie.css"/>
	</script> 
	<![endif]-->
	
	<!--[if lt IE 9]>
		<script src="IE8.js">IE7_PNG_SUFFIX=".png";</script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/custom.css" />
		
	<?php  wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	 <!--<div id="chrome"></div>-->
	<header>
		<section class="chrome">	
			<div class="container_12">
				<div class="grid_12">
					<div class="top_head">
						<div id="header_sidebar"><?php dynamic_sidebar('Header');?></div>
						
						
                        
                        
                        
                        <div id="hidden_menu">
                    
                                           	<?php if (get_option('logo_image') != ''): ?>
						<div id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php echo get_option('logo_image'); ?>"  alt="<?php echo esc_attr(get_bloginfo( 'name', 'display' )) ?>"/>
							</a>
						</div>
				<?php endif ?>
                    
							<div id="smoothmenu_top" class="ddsmoothmenu">
								<?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'container' => '', 'walker' => new ti_menu_walker(), 'menu_id' => 'hid'));
						 /* editable within the Wordpress backend */ ?>
						 	
           
                            
                            
							</div>             
                            
         
							<script type="text/javascript">
						 		
						 		if (document.documentElement.clientWidth > 470) {
						 		
							 		ddsmoothmenu.init({
		    							mainmenuid: "smoothmenu_top", 
		    							orientation: 'h', 
		    							classname: 'ddsmoothmenu', 
		    							contentsource: "markup" 
									});
								
								}
						 	
						 	</script>
						</div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
						
					</div>
				
					<div id="head_right">
						<div class="shopping_cart">
							<div id="cart">
								<div id="cart_content">
									<?php dynamic_sidebar('Shopping Cart');	 ?>
								</div>
								<div id="shade">
										
								</div>
							</div>

							<br/>
						</div>
						
						<?php if(is_sidebar_active('Top Search')) : ?>
						<div id="srch">
							<div id="srch_hov">
								<a id="srch_zoom">

								</a>	
							</div>
							<div id="srch_form">
								<div id="inner_f">
									<?php  dynamic_sidebar('Top Search'); ?>
								</div>
							</div>
							<script type="text/javascript">
								SearchDropdown('#srch_form', '#srch_hov', '#inner_f', 68, 315);
							</script>
						</div>
						<?php endif ?>
						
						<nav id="sub_links">
							<?php wp_nav_menu( array('theme_location' => 'subheader_menu', 'container' => '', 'walker' => new ti_menu_walker() )); ?>
						</nav>
						
						
								
					</div>
					
					
                    <!-- -->
                    
                    <!-- -->
                    
                    
				</div>
			</div>
			<div class="clear"></div>
		</section>
		<div class="container_12">
			<div class="grid_5 header_container">
				<?php if (get_option('logo_image') != ''): ?>
						<div id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php echo get_option('logo_image'); ?>"  alt="<?php echo esc_attr(get_bloginfo( 'name', 'display' )) ?>"/>
							</a>
						</div>
				<?php else: ?>
						<hgroup>
						<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</hgroup>
				<?php endif; ?>
			</div>	
					
			<div class="grid_7 menu-container header_container">
					<div id="container">
						<nav id="main_menu">
							<div id="smoothmenu1" class="ddsmoothmenu">
								<?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'container' => '', 'walker' => new ti_menu_walker())); /* editable within the Wordpress backend */ ?>
							</div>
						</nav><!--#main_menu-->
						
						<script>
				
							if (document.documentElement.clientWidth > 470) {
								try{
									ddsmoothmenu.init({
				    					mainmenuid: "smoothmenu1", 
				    					orientation: 'h', 
				    					classname: 'ddsmoothmenu', 
				    					contentsource: "markup" 
									});
														
								} catch(error){
									if (window.console) {
										console.log(error)
									}
								}
							}
						</script>
						
						<nav id="responsive_main_menu">
							<div id="navigate-to"><?php _e('Navigate to', 'lookshop'); ?></div>
							<?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'container' => '', 'walker' => new ti_menu_walker())); /* editable within the Wordpress backend */ ?>
						</nav><!--#main_menu-->
						<script>
							jQuery('#responsive_main_menu').click(function(){
								jQuery('#responsive_main_menu .menu').toggle();	
							});
						</script>			
						<div class="clear"></div>
					</div>
			</div>
			
				
			</div>
		<div class="clear"></div>
	</header>
<?php //die(); ?>