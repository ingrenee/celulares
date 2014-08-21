<?php
	// enables wigitized sidebars
	if ( function_exists('register_sidebar') )

	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array('name'=>'Sidebar',
		'before_widget' => '<div class="box  %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Header Widget
	// Location: right after the navigation
	register_sidebar(array('name'=>'Header',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	// Footer Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array('name'=>'Footer',
		'before_widget' => '<div class="%2$s inner-box box-3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// The Alert Widget
	// Location: displayed on the top of the home page, right after the header, right before the loop, within the contend area
	register_sidebar(array('name'=>'Top Search',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<!--',
		'after_title' => '<-->',
	));
	
	// The Slider Widget
	// Location: displayed on the top of the home page, right after the header within the contend area, primary purpose is to contain sliders 
	register_sidebar(array('name'=>'Sliders',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	// The Category Widget
	// Location: displayed under the sliders on home page only, primary purpose is to contain shop categories slider 
	register_sidebar(array('name'=>'Featured Products',
		'before_widget' => '<div class="featured_products_container">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="category-title">',
		'after_title' => '</h2>',
	));
	
	
	// The Home Sidebar Widget
	// Location: displayed in the content area floated right, only on home page 
	register_sidebar(array('name'=>'Home Sidebar',
		'before_widget' => '<div class="box  %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	// The Home Sidebar Widget
	// Location: displayed in the content area floated left, only on home page 
	register_sidebar(array('name'=>'Home Categories',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<!--',
		'after_title' => '-->',
	));
	
	
	// The Home Subcontent Widget
	// Location: displayed in the content area floated left, only on home page 
	register_sidebar(array('name'=>'Home Subcontent',
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="category-title">',
		'after_title' => '</h2>',
	));
	
	// The Home Supcontent Widget
	// Location: displayed in the content area floated left, only on home page 
	register_sidebar(array('name'=>'Home Supcontent',
		'before_widget' => '<div class="tagline">',
		'after_widget' => '</div>',
		'before_title' => '<!--',
		'after_title' => '-->',
	));
	
	// The Header Cart Widget
	// Location: displayed in header, primary goal is to show shopping cart widget 
	register_sidebar(array('name'=>'Shopping Cart',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<!--',
		'after_title' => '-->',
	));
	
	// The Contacts Page Sidebar
	// Location: displayed in header, primary goal is to show shopping cart widget 
	register_sidebar(array('name'=>'Contacts Sidebar',
		'before_widget' => '<div class="box  %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	// The Store Page Sidebar
	// Location: displayed in header, primary goal is to show shopping cart widget 
	register_sidebar(array('name'=>'Store Page Sidebar',
		'before_widget' => '<div class="box  %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	// The Banner Sidebar
	// Location: displayed in the top of the store page, primary goal is to show banners 
	register_sidebar(array('name'=>'Banner Holder',
		'before_widget' => '<div class="space">',
		'after_widget' => '</div>',
		'before_title' => '<!--',
		'after_title' => '-->',
	));
	
	// The Special Sidebar
	// Location: displayed on home page before footer, primary goal is to show specials widget 
	register_sidebar(array('name'=>'Home Before Footer',
		'before_widget' => '<div class="box-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="category-title border">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array('name'=>'Bottom',
		'before_widget' => '<div class="bottom">',
		'after_widget' => '</div>',
		'before_title' => '<!--',
		'after_title' => '-->',
	));
	
	register_sidebar(array('name'=>'Footer Upper',
		'before_widget' => '<div class="grid_3 footer-upper-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array('name'=>'Footer Lower',
		'before_widget' => '<div class="footer_lower">',
		'after_widget' => '</div>',
		'before_title' => '<!--',
		'after_title' => '-->',
	));

	register_sidebar(array('name'=>'Home Subcontent 2',
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="category-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array('name'=>'Home Subcontent Sidebar',
		'before_widget' => '<div class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="category-title">',
		'after_title' => '</h2>',
	));

//	add_custom_background();
//	add_custom_image_header();
	add_theme_support( 'custom-background');
	add_editor_style(get_bloginfo('stylesheet_url'));


	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');

function cut_words ($paragraph, $num_words) {
      $paragraph = explode (' ', $paragraph);
      $paragraph = array_slice ($paragraph, 0, $num_words);
      return implode (' ', $paragraph);
    }


if ( ! isset( $content_width ) ) $content_width = 940;


//------ Adding theme's java scripts-----------------------
function ti_enqueue_scripts() {

    wp_enqueue_script('jquery');  
    wp_deregister_script( 'jquery-ui-core' );
    wp_register_script( 'jquery-ui-core', get_template_directory_uri() .'/js/jquery-ui.min.js');
    wp_enqueue_script('ddsmoothmenu',get_template_directory_uri().'/js/ddsmoothmenu.js',array('jquery'));  
    wp_enqueue_script('capSlide',get_template_directory_uri().'/js/jquery.capSlide.js',array('jquery'));
    wp_enqueue_script('lookshop',get_template_directory_uri().'/js/lookshop.js',array('jquery','jquery-ui-core'));
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/elast/modernizr.custom.js');
	wp_enqueue_script('hovrizr', get_template_directory_uri().'/js/elast/jquery.hovrizr.js');
	wp_enqueue_script('elastislide', get_template_directory_uri().'/js/elast/jquery.elastislide.js');
/*-------CPanel--------*/	
	//	wp_enqueue_script('cpanel', get_template_directory_uri().'/cpanel/cpanel.js');
   		
}    
 
add_action('wp_enqueue_scripts', 'ti_enqueue_scripts'); 


//---------Adding theme's styles--------------------------

function ti_enqueue_styles(){
        wp_register_style('GoogleFonts', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700');
        wp_enqueue_style( 'GoogleFonts' );
       	wp_register_style('elastslidecss', get_template_directory_uri().'/css/elast/elastislide.css');
       	wp_enqueue_style( 'elastslidecss');
       	wp_register_style('ticolors', get_template_directory_uri().'/colors/colors.css');
        wp_enqueue_style('ticolors');
       	wp_register_style('patterns', get_template_directory_uri().'/patterns/patterns.css');
       	wp_enqueue_style( 'patterns');
 /*-------CPanel--------*/      
       //	wp_register_style('cpstyes', get_template_directory_uri().'/cpanel/cpanel.css');
       //	wp_enqueue_style( 'cpstyes');
       	
}

add_action( 'wp_enqueue_scripts', 'ti_enqueue_styles' );

if (!function_exists('curSimble')) {
    function curSimble($str){
        
          //  var_dump($str);
          $str = @preg_replace("/^.*(".(wpsc_get_currency_symbol() == '$' ? '\\'.wpsc_get_currency_symbol():wpsc_get_currency_symbol())."){1}.*?/", '<span class="csymb">'.wpsc_get_currency_symbol().'</span>', $str);
  
      return $str;
    }
}


function ti_enqueue_conditional_scripts($hook){

	if (is_home() || is_category() || is_archive()){
		
		wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.js', array('jquery'));
		wp_enqueue_script('uniform', get_template_directory_uri().'/js/jquery.uniform.min.js', array('jquery'));
		
	}
}


add_action('wp_enqueue_scripts', 'ti_enqueue_conditional_scripts');

function load_back_end_js(){

    if(function_exists( 'wp_enqueue_media' )){
   	
   		wp_enqueue_media();
	
	}else{
	    wp_enqueue_style('thickbox');
    	wp_enqueue_script('media-upload');
    	wp_enqueue_script('thickbox');
	}
}

add_action( 'admin_enqueue_scripts', 'load_back_end_js');


//add_filter('show_admin_bar', '__return_false'); 

	//----localization--------------------
	
	load_theme_textdomain( 'lookshop',  get_template_directory_uri() . '/languages/' );

	$locale = get_locale();
	$locale_file = get_template_directory_uri() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	
	// post excerpt
	function lookshop_excerpt_length( $length ) {
		return 25;
	}

	add_filter( 'excerpt_length', 'lookshop_excerpt_length', 999 );
	
	
	// post thumbnail support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300 );
	// custom menu support
	add_theme_support( 'automatic-feed-links' );
	
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'category-thumb', 300, 9999 ); 
		add_image_size( 'homepage-thumb', 214, 104, true );
		add_image_size( 'single-thumb', 692, 212, true ); 
		add_image_size( 'gallery-thumb', 313, 264, true);
		add_image_size( 'default-thumb', 223, 276, true);
		
		
	}

	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'subheader_menu', 'Top Menu' );
	}
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'header_menu', 'Main Menu' );
	}
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'sidebar_menu', 'Sidebar Menu' );
	}
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menu( 'footer_menu', 'Footer Menu' );
	}
	
//add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'css_attributes_filter', 100, 1);
//add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}
	
function sb_get_images_for_product($id){
   global $wpdb;
   $post_thumbnail = get_post_thumbnail_id();//read the thumbnail id
   $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = $id AND post_type = 'attachment' ORDER BY menu_order ASC", $id));
  	$i = 0;
   foreach ($attachments as $attachment){
      if ($attachment->ID <> $post_thumbnail){//if we haven't already got the attachment as the post thumbnail
         
         $i++;
         
         $image_attributes = wp_get_attachment_image_src($attachment->ID, array(91, 88));?>
   		<a rel="lightbox[<?php echo wpsc_the_product_title(); ?>]" href="<?php echo $attachment->guid; ?>" class="<?php if(!($i%4)) : ?> first_el <?php endif; ?> <?php echo wpsc_the_product_image_link_classes(); ?>">
			<img width="91" height="88" src="<?php echo $image_attributes[0]; ?>" alt="<?php echo wpsc_the_product_title(); ?>"/>
		</a>
  			
  		<?php if(!($i%3)) : ?> <div class="clear"></div> <?php endif; ?> <?php
  		
  		} 
 	}
}
	
	// custom background support
	//add_custom_background();
	
	// removes detailed login error information for security
	//add_filter('login_errors',create_function('$a', "return null;"));
		
	//show home page in menu options
	function ti_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'ti_page_menu_args' );
	
	// Removes Trackbacks from the comment cout
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $count ) {
		if ( ! is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			return count($comments_by_type['comment']);
		} else {
			return $count;
		}
	}
	
	
	// wrapping all images
	function ti_image_tag($html, $id , $alt, $title){
		$html = "<figure>".$html."</figure>";
		return $html;
	}
	//add_filter('get_image_tag','ti_image_tag', 1, 4);
	
	// custom excerpt ellipses for 2.9+
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');
	// no more jumping for read more link
	function no_more_jumping($post) {
		global $post;
				return '&nbsp;<div class="clear"></div><a href="'.get_permalink($post->ID).'" class="read-more">'.__('Read More', 'lookshop').'</a>';
	}
	add_filter('excerpt_more', 'no_more_jumping');
	
	// category id in body and post class
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');
	
	function ti_footer_function() {
    	echo '<script> setThemeURL("'.get_template_directory_uri().'"); </script>';
    	
	}
	add_action('wp_head', 'ti_footer_function');
	
	
	function is_sidebar_active( $index = 1 ) {
		global $wp_registered_sidebars;
	
		if ( is_int( $index ) ) :
			$index = "sidebar-$index";
		else :
			$index = sanitize_title( $index );
			foreach ( (array) $wp_registered_sidebars as $key => $value ) :
				if ( sanitize_title( $value['name'] ) == $index ) :
					$index = $key;
					break;
				endif;
			endforeach;
		endif;
	
		$sidebars_widgets = wp_get_sidebars_widgets();
	
		if ( empty( $wp_registered_sidebars[$index] ) || !array_key_exists( $index, $sidebars_widgets ) || !is_array( $sidebars_widgets[$index] ) || empty( $sidebars_widgets[$index] ) )
			return false;
		else
			return true;
	}	
	
	function ti_change_mce_options($initArray) {
		$ext = 'figure';
		if ( isset( $initArray['extended_valid_elements'] ) ) {
			$initArray['extended_valid_elements'] .= ',' . $ext;
		} else {
			$initArray['extended_valid_elements'] = $ext;
		}
		return $initArray;
	}
	
	
	
	
	add_filter('tiny_mce_before_init', 'ti_change_mce_options');
	
	/**
	 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
	 */
	
	
	
	add_filter('widget_text', 'do_shortcode');
	
	add_filter('body_class','add_colors');

	function add_colors($classes) {
		
		//if(isset($_COOKIE['cp_color'])) $classes[] = $_COOKIE['cp_color'];
		
		//else 
		
		if( TiAdminPanel::GetColorScheme() ) $classes[] = TiAdminPanel::GetColorScheme();
		
		return $classes;
	}
	
	add_filter('body_class','add_patterns');

	function add_patterns($classes) {
		
		//if (isset($_COOKIE['cp_pattern'])) $classes[] = $_COOKIE['cp_pattern'];
		
		//else
		
		if( TiAdminPanel::GetPattern() ) $classes[] = TiAdminPanel::GetPattern();
		
		return $classes;
	}
	
	
	function widget_first_last_classes($params) {
	
		global $my_widget_num; // Global a counter array
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
	
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
	
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
	
		$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
	
		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= 'alpha ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= 'omega ';
		}
	
		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
	
		return $params;
	
	}
	add_filter('dynamic_sidebar_params','widget_first_last_classes');
	
	
	
	
	//------Images Rewrite----------------------------- 
	add_action('parse_request', 'path_request' );
	
	function path_request($wp){
	
		if ( !array_key_exists('callback', $wp->query_vars) ) return;
		
		if ( $wp->query_vars['callback'] == 'path') {
			header("Location:".get_template_directory_uri().'/'.urldecode($wp->query_vars['p']));
			 
			exit;
		}
	
	} 
	
	//--wp-e-commerece utilities-----------------------
	function isOnWPSCpage(){
        global $post;
        
        if (class_exists('WP_eCommerce')) return  ($this->isOnWPSCList() || $this->isOnUserLogPage() || $this->isOnAccountPage() ||
                $this->isOnProductPage() || $this->isOnShoppingCartPage() || $this->isOnTransactionPage());
            
        return false;
    }
	
	
	//---- Custom menu Walker---------------------------
	
	class ti_menu_walker extends Walker_Nav_Menu
	{
	      function start_el(&$output, $item, $depth, $args)
	      {
	           global $wp_query;
	           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
				
				$description = '';

	           $class_names = $value = '';
	
	           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
				if ($item->menu_order == 1) {
					$classes[] = 'alpha';
				}
	           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	           $class_names = ' class="'. esc_attr( $class_names ) . '"';
	
	           $output .= $indent . '<li ' . $value . $class_names .'>';
	
	           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
	           $prepend = '';
	           $append = '';
	        	
	           $item_output = '';	
	        
	           if($depth != 0)
	           {
	                     $description = $append = $prepend = "";
	           }
				
				if (is_object($args)) {
		            $item_output = $args->before;
		            $item_output .= '<a'. $attributes .'><span>';
		            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		            $item_output .= $description.$args->link_after;
		            $item_output .= '</span></a>';
		            $item_output .= $args->after; 
	            }
	            else {
			            
			            if (isset($item->title)) {
			            
				            $item_output = '<a'. $attributes .'><span>';
				            $item_output .= $prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
				            $item_output .= $description;
				            $item_output .= '</span></a>';
			            
			           }
	            }
	            
	
	            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	            }
	}
	
	
	






function ti_get_related_posts( $post, $limit ) {
  global $wpdb; // wordpress database access
  
  // limit has to be a number
  $limit = (int)$limit;
  
  // get tags of the post
  $tags = wp_get_post_tags( $post->ID );
  if( is_wp_error($tags) )
    return false; // error
  if( count($tags)<=0 ) // we cannot get related posts without tags
    return array(); // no related posts

  // get term ids
  $termtaxonomyids = array();
  foreach( $tags as $tag ) {
    $termtaxonomyids[ $tag->term_taxonomy_id ] = $tag->term_taxonomy_id;
  }
  if( count($termtaxonomyids)<=0 ) // we cannot get related posts without the termtaxonomyids
    return array(); // no related posts
  
  // the query to get the related posts
  $query = "SELECT p.ID, COUNT(tr.object_id) AS cnt " // get post ids and count
          ."FROM $wpdb->term_relationships AS tr, $wpdb->posts AS p "
          ."WHERE tr.object_id = p.id " // build relations
            ."AND tr.term_taxonomy_id IN(".implode(',',$termtaxonomyids).") " // only with the same tags
            ."AND p.id!=$post->ID " // only other posts, not the post selfe
            ."AND p.post_status='publish' " // only published posts
          ."GROUP BY tr.object_id " // group by relation
          ."ORDER BY cnt DESC, p.post_date_gmt DESC " // order by count best matches first, and by date within same count
          ."LIMIT $limit "; // get only the top x

  // caching
  global $rp_cache;
  $rp_cache_id = md5( $query );
  if( !is_array($rp_cache) )
    $rp_cache = array();
  if( array_key_exists($rp_cache_id,$rp_cache) )
    return $rp_cache[$rp_cache_id];
  
  // run the query and return the result
  $posts = $wpdb->get_results( $query );
  
  // caching
  if( $posts ) {
  		$rp_cache[$rp_cache_id] = $posts; 
    	return $posts;
    }

  // return
  
}


if ( ! function_exists( 'lookshop_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own lookshop_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function lookshop_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="comment-author vcard">
			<?php $ava = get_avatar( $comment, 69 );?>
			<?php if($ava): ?>
			<figure>
				<?php echo $ava; ?>
			</figure>
			<?php endif; ?>
		<div class="comment-container">
			<div class="com-icon"></div>
		<div class="comment-text">

			<div class="comment-title">
			
				<?php printf( __( '<h5>%s</h5>', 'lookshop' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			<!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
				
					<em class="comment-awaiting-moderation">: <?php _e( 'Your comment is awaiting moderation.', 'lookshop' ); ?></em>
					
				<?php endif; ?>

				<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'lookshop' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'lookshop' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</div>
		
		<div class="comment-body">
		<?php comment_text(); ?>
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
	</div><!-- #comment-##  -->
	</div>
	</div>
	</div>
	<div class="clear"></div>
	</div>
	
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'lookshop' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'lookshop' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;



function ti_contact_form(){
	
	global $user_identity, $id, $post_id, $args;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields =  array(
		'author' => '<div class="com_inputs"><input id="author" name="author" type="text" onblur="if (this.value==\'\'){this.value=\''.__('Name:', 'lookshop'). ( $req ? ' required' : '' ) .'\'}" onfocus="if (this.value==\''.__('Name:', 'lookshop').( $req ? ' required' : '' ) .'\'){this.value=\'\'}" value="' .( esc_attr( $commenter['comment_author'] ) ? esc_attr( $commenter['comment_author'] ): __('Name:', 'lookshop'). ($req ? ' required':'')).'" ' . $aria_req . ' />',
		'email'  => '<input id="email" name="email" type="text" onblur="if (this.value==\'\'){this.value=\''.__('Email:', 'lookshop'). ( $req ? ' required' : '' ) .'\'}" onfocus="if (this.value==\''.__('Email:', 'lookshop').( $req ? ' required' : '' ) .'\'){this.value=\'\'}" value="' .( esc_attr( $commenter['comment_author_email'] ) ? esc_attr( $commenter['comment_author_email'] ): __('Email:', 'lookshop'). ($req ? ' required':'')).'" ' . $aria_req . ' /></div>'
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', 'lookshop'), '<span class="required">*</span>' );
	$defaults = array(
		
		'comment_field'        => '<textarea id="comment" name="comment"  aria-required="true"></textarea>',
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'must_log_in'          => '' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '',
		'logged_in_as'         => '' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','lookshop' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '',
		'comment_notes_before' => '<div class="q-icon"></div>',
		
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply:', 'lookshop' ),
		'title_reply_to'       => __( 'Leave a Reply to %s :', 'lookshop' ),
		'cancel_reply_link'    => __( '<span>Cancel reply</span>', 'lookshop' ),
		'label_submit'         => __( '', 'lookshop' ),
		'comment_notes_after'  => '<button id="com_submit"><span>'.__('Post Comment', 'lookshop').'</span></button><div class="clear"></div>' ,
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	return $args;
}

add_action( 'comment_form_defaults', 't5_move_textarea' );
add_action( 'comment_form_top', 't5_move_textarea' );

/**
 * Take the textarea code out of the default fields and print it on top.
 *
 * @param  array $input Default fields if called as filter
 * @return string|void
 */




function t5_move_textarea( $input = array () )
{
    static $textarea = '';

    if ( 'comment_form_defaults' === current_filter() )
    {
        // Copy the field to our internal variable …
        $textarea = $input['comment_field'];
        // … and remove it from the defaults array.
        $input['comment_field'] = '';
        return $input;
    }

    print $textarea;
}


		
	
	
	include_once('tiadmin/tiadmin.php');
	include_once('extensions/contact7submit.php');
	include_once('extensions/gmapswidget.php');
	include_once('extensions/icl_utility.php');
	include_once('extensions/twidget.php');
	include_once('extensions/wpsccoups.php');
	include_once('extensions/wpsccategoriesslider.php');
	$iclUtility = new IclUtility();

	
	
	$nzshpcrt_gateways[$num]['name'] = 'Renee My New Gateway';
	$nzshpcrt_gateways[$num]['internalname'] = 'seguripago';
	$nzshpcrt_gateways[$num]['function'] = 'gateway_seguripago';
	$nzshpcrt_gateways[$num]['form'] = "form_seguripago";
	$nzshpcrt_gateways[$num]['submit_function'] = "submit_seguripago";
	
	
	function form_seguripago(){

$output ='<tr><td>';

$output.='<input name="my_new_gateway_username" type="text"/>';
$output.='Username';

$output.='<input name="my_new_gateway_password" type="text"/>';
$output.='Password';

$output .='</tr></td>';

return $output;

}


function submit_seguripago(){

if($_POST['my_new_gateway_username'] != null) {

update_option('my_new_gateway_username',
$_POST['my_new_gateway_username']);

}

if($_POST['my_new_gateway_password'] != null) {

update_option('my_new_gateway_password',
$_POST['my_new_gateway_password']);

}

return true;

}









function gateway_seguripago($seperator, $sessionid){

//$wpdb is the database handle,
//$wpsc_cart is the shopping cart object

global $wpdb, $wpsc_cart;

//This grabs the purchase log id from the database
//that refers to the $sessionid

$purchase_log = $wpdb->get_row(
"SELECT * FROM `".WPSC_TABLE_PURCHASE_LOGS.
"` WHERE `sessionid`= ".$sessionid." LIMIT 1"
,ARRAY_A) ;

//This grabs the users info using the $purchase_log
// from the previous SQL query

$usersql = "SELECT `".WPSC_TABLE_SUBMITED_FORM_DATA."`.value,
`".WPSC_TABLE_CHECKOUT_FORMS."`.`name`,
`".WPSC_TABLE_CHECKOUT_FORMS."`.`unique_name` FROM
`".WPSC_TABLE_CHECKOUT_FORMS."` LEFT JOIN
`".WPSC_TABLE_SUBMITED_FORM_DATA."` ON
`".WPSC_TABLE_CHECKOUT_FORMS."`.id =
`".WPSC_TABLE_SUBMITED_FORM_DATA."`.`form_id` WHERE
`".WPSC_TABLE_SUBMITED_FORM_DATA."`.`log_id`=".$purchase_log['id']."
ORDER BY `".WPSC_TABLE_CHECKOUT_FORMS."`.`order`";

$userinfo = $wpdb->get_results($usersql, ARRAY_A);

//Now we will store all the information into an associative array
//called $data to prepare it for sending via cURL

//please note that the key in the array may need to be changed
//to work with your gateway (refer to your gateways documentation).

$data = array();

$data['USER']	= get_option('my_new_gateway_username');

$data['PWD'] 	= get_option('my_new_gateway_password');

$data['AMT']	= number_format($wpsc_cart->total_price,2);

$data['ITEMAMT']= number_format($wpsc_cart->subtotal,2);

$data['SHIPPINGAMT']= number_format($wpsc_cart->base_shipping,2);

$data['TAXAMT']= number_format($wpsc_cart->total_tax);

foreach((array)$userinfo as $key => $value){

if(($value['unique_name']=='billingfirstname')
    && $value['value'] != ''){

$data['BILLFIRSTNAME']	= $value['value'];

}

if(($value['unique_name']=='billinglastname')
    && $value['value'] != ''){

$data['BILLLASTNAME']	= $value['value'];

}

if(($value['unique_name']=='billingaddress')
    && $value['value'] != ''){

$data['BILLADDRESS']	= $value['value'];

}

if(($value['unique_name']=='billingemail')
    && $value['value'] != ''){

$data['BILLEMAIL']	= $value['value'];

}

if(($value['unique_name']=='billingphone')
    && $value['value'] != ''){

$data['BILLPHONE']	= $value['value'];

}

if(($value['unique_name']=='shippingfirstname')
    && $value['value'] != ''){

$data['SHIPFIRSTNAME']	= $value['value'];

}

if(($value['unique_name']=='shippinglastname')
    &&$value['value'] != ''){

$data['SHIPLASTNAME']	= $value['value'];

}

if(($value['unique_name']=='shippingaddress')
    && $value['value'] != ''){

$data['SHIPADDRESS']	= $value['value'];

}

if(($value['unique_name']=='shippingemail')
    && $value['value'] != ''){

$data['SHIPEMAIL']	= $value['value'];

}

if(($value['unique_name']=='shippingphone')
     && $value['value'] != ''){

$data['SHIPPHONE']	= $value['value'];

}

}

// Ordered Products

foreach($wpsc_cart->cart_items as $i => $Item) {

$data['PROD_NAME'.$i] = $Item->product_name;

$data['PROD_AMT'.$i] = number_format($Item->unit_price,2);

$data['PROD_NUMBER'.$i]	= $i;

$data['PROD_QTY'.$i] = $Item->quantity;

$data['PROD_TAXAMT'.$i]	= number_format($Item->tax,2);

}

//now we add all the information in the array into a long string

$transaction = "";

foreach($data as $key => $value) {

if (is_array($value)) {

foreach($value as $item) {

if (strlen($transaction) > 0) $transaction .= $seperator;

$transaction .= "$key=".urlencode($item);

}

} else {

if (strlen($transaction) > 0) $transaction .= $seperator;

$transaction .= "$key=".urlencode($value);

}

}

//Now we have the information we want to send to the gateway in a nicely formatted string we can setup the cURL

curl_setopt($connection,CURLOPT_URL,"http://this.is.the.gateways.address");

$useragent = 'WP e-Commerce plugin';

curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($connection, CURLOPT_NOPROGRESS, 1);

curl_setopt($connection, CURLOPT_VERBOSE, 1);

curl_setopt($connection, CURLOPT_FOLLOWLOCATION,0);

curl_setopt($connection, CURLOPT_POST, 1);

curl_setopt($connection, CURLOPT_POSTFIELDS, $transaction);

curl_setopt($connection, CURLOPT_TIMEOUT, 30);

curl_setopt($connection, CURLOPT_USERAGENT, $useragent);

curl_setopt($connection, CURLOPT_REFERER, "https://".$_SERVER['SERVER_NAME']);

curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);

$buffer = curl_exec($connection);

curl_close($connection);

/*

* This is the trickiest part, gateways send back their data in many different ways, please refer to your gateways documentation.

* So now we have passed the information to the gateway and have received information back from the gateway (stored in $buffer),
All we have left is to find out whether the transaction was accepted by the gateway or whether the transaction failed.

* This next bit of code was borrowed from the people at http://shopplugin.net/tour/ and their paypal pro module

*/

$_ = new stdClass();

$r = array();

$pairs = split("&",$buffer);

foreach($pairs as $pair) {

list($key,$value) = split("=",$pair);

if (preg_match("/(w*?)(d+)/",$key,$matches)) {

if (!isset($r[$matches[1]])) $r[$matches[1]] = array();

$r[$matches[1]][$matches[2]] = urldecode($value);

} else $r[$key] = urldecode($value);

}

$response->ack = $r['ACK'];
//with paypal Pro, ACK holds the status of the payment either
//'Success' 'SuccessWithWarning' and other error messages as well.
//All we need at this time is 'Success and SuccessWithWarning

$response->errorcodes = $r['L_ERRORCODE'];

$response->shorterror = $r['L_SHORTMESSAGE'];

$response->longerror = $r['L_LONGMESSAGE'];

$response->severity = $r['L_SEVERITYCODE'];

$response->timestamp = $r['TIMESTAMP'];

$response->correlationid = $r['CORRELATIONID'];

$response->version = $r['VERSION'];

$response->build = $r['BUILD'];

$response->transactionid = $r['TRANSACTIONID'];

$response->amt = $r['AMT'];

$response->avscode = $r['AVSCODE'];

$response->cvv2match = $r['CVV2MATCH'];

if($response->ack == 'Success' || $response->ack == 'SuccessWithWarning'){

//redirect to  transaction page and store in DB as a order with
//accepted payment

$sql = "UPDATE `".WPSC_TABLE_PURCHASE_LOGS.
"` SET `processed`= '2' WHERE `sessionid`=".$sessionid;

$wpdb->query($sql);

$transact_url = get_option('transact_url');

unset($_SESSION['WpscGatewayErrorMessage']);

header("Location: ".$transact_url.$seperator."sessionid=".$sessionid);

}else{

//redirect back to checkout page with errors

$sql = "UPDATE `".WPSC_TABLE_PURCHASE_LOGS.
"` SET `processed`= '5' WHERE `sessionid`=".$sessionid;

$wpdb->query($sql);

$transact_url = get_option('checkout_url');

$_SESSION['WpscGatewayErrorMessage'] =
 __('Sorry your transaction did not go through successfully, please try again.');

header("Location: ".$transact_url);

}

}









?>