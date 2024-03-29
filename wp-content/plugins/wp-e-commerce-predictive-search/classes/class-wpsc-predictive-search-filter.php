<?php
/**
 * WPSC Predictive Search Hook Filter
 *
 * Hook anf Filter into ecommerce plugin
 *
 * Table Of Contents
 *
 * wpscps_add_frontend_script()
 * add_query_vars()
 * add_rewrite_rules()
 * custom_rewrite_rule()
 * search_by_title_only()
 * predictive_posts_orderby()
 * posts_request_unconflict_role_scoper_plugin()
 * a3_wp_admin()
 * plugin_extra_links()
 */
class WPSC_Predictive_Search_Hook_Filter 
{
	
	/*
	* Include the script for widget search and Search page
	*/
	public static function wpscps_add_frontend_script() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'ajax-wpsc-autocomplete-script', WPSC_PS_JS_URL . '/ajax-autocomplete/jquery.autocomplete.js', array(), false, true );
	}
	
	public static function wpscps_add_frontend_style() {
		wp_enqueue_style( 'ajax-wpsc-autocomplete-style', WPSC_PS_JS_URL . '/ajax-autocomplete/jquery.autocomplete.css' );
	}
	
	public static function add_query_vars($aVars) {
		$aVars[] = "keyword";    // represents the name of the product category as shown in the URL
		$aVars[] = "scat";
		$aVars[] = "stag";
		return $aVars;
	}
	
	public static function add_rewrite_rules($aRules) {
		//var_dump($_SERVER);
		$ecommerce_search_page_id = get_option('ecommerce_search_page_id');
		$search_page = get_page($ecommerce_search_page_id);
		if (!empty($search_page)) {
			$search_page_slug = $search_page->post_name;
			if (stristr($_SERVER['REQUEST_URI'], $search_page_slug) !== FALSE) {
				//$url_text = stristr($_SERVER['REQUEST_URI'], $search_page_slug);
				$position = strpos($_SERVER['REQUEST_URI'], $search_page_slug);
				$new_url = substr($_SERVER['REQUEST_URI'], ($position + strlen($search_page_slug.'/') ) );
				$parameters_array = explode("/", $new_url);
				
				if (is_array($parameters_array) && count($parameters_array) > 1) {
					$array_key = array();
					$array_value = array();
					$number = 0;
					foreach ($parameters_array as $parameter) {
						$number++;
						if (trim($parameter) == '') continue;
						if ($number%2 == 0) $array_value[] = $parameter;
						else $array_key[] = $parameter;
					}
					if (count($array_key) > 0 && count($array_value) > 0 ) {
						$rewrite_rule = '';
						$original_url = '';
						$number_matches = 0;
						foreach ($array_key as $key) {
							$number_matches++;
							$rewrite_rule .= $key.'/([^/]*)/';
							$original_url .= '&'.$key.'=$matches['.$number_matches.']';
						}
						
						//var_dump($search_page_slug.'/'.$rewrite_rule.'?$ => index.php?pagename='.$search_page_slug.$original_url);
						
						//$aNewRules = array($search_page_slug.'/rs/([^/]*)/search_in/([^/]*)/?$' => 'index.php?pagename='.$search_page_slug.'&rs=$matches[1]&search_in=$matches[2]');
						
						$aNewRules = array($search_page_slug.'/'.$rewrite_rule.'?$' => 'index.php?pagename='.$search_page_slug.$original_url);
						$aRules = $aNewRules + $aRules;
						
					}
				}
			}
		}
		return $aRules;
	} 
	
	public static function custom_rewrite_rule() {
		// BEGIN rewrite
		// hook add_query_vars function into query_vars
		add_filter('query_vars', array('WPSC_Predictive_Search_Hook_Filter', 'add_query_vars') );
	
		add_filter('rewrite_rules_array', array('WPSC_Predictive_Search_Hook_Filter', 'add_rewrite_rules') );
		
		$ecommerce_search_page_id = get_option('ecommerce_search_page_id');
		$search_page = get_page($ecommerce_search_page_id);
		if (!empty($search_page)) {
			$search_page_slug = $search_page->post_name;
			if (stristr($_SERVER['REQUEST_URI'], $search_page_slug) !== FALSE) {
				global $wp_rewrite;
				$wp_rewrite->flush_rules();
			}
		}
		// END rewrite
	}
	
	public static function remove_special_characters_in_mysql( $field_name ) {
		if ( trim( $field_name ) == '' ) return '';
		
		$field_name = 'REPLACE( '.$field_name.', "(", "")';
		$field_name = 'REPLACE( '.$field_name.', ")", "")';
		$field_name = 'REPLACE( '.$field_name.', "{", "")';
		$field_name = 'REPLACE( '.$field_name.', "}", "")';
		$field_name = 'REPLACE( '.$field_name.', "<", "")';
		$field_name = 'REPLACE( '.$field_name.', ">", "")';
		$field_name = 'REPLACE( '.$field_name.', "©", "")'; 	// copyright
		$field_name = 'REPLACE( '.$field_name.', "®", "")'; 	// registered
		$field_name = 'REPLACE( '.$field_name.', "™", "")'; 	// trademark
		$field_name = 'REPLACE( '.$field_name.', "£", "")'; 
		$field_name = 'REPLACE( '.$field_name.', "¥", "")';	
		$field_name = 'REPLACE( '.$field_name.', "§", "")';
		$field_name = 'REPLACE( '.$field_name.', "¢", "")';
		$field_name = 'REPLACE( '.$field_name.', "µ", "")';
		$field_name = 'REPLACE( '.$field_name.', "¶", "")';
		$field_name = 'REPLACE( '.$field_name.', "–", "")'; 
		$field_name = 'REPLACE( '.$field_name.', "¿", "")'; 
		$field_name = 'REPLACE( '.$field_name.', "«", "")'; 
		$field_name = 'REPLACE( '.$field_name.', "»", "")'; 
		 
	
		$field_name = 'REPLACE( '.$field_name.', "&lsquo;", "")'; 	// left single curly quote
		$field_name = 'REPLACE( '.$field_name.', "&rsquo;", "")'; 	// right single curly quote
		$field_name = 'REPLACE( '.$field_name.', "&ldquo;", "")'; 	// left double curly quote
		$field_name = 'REPLACE( '.$field_name.', "&rdquo;", "")'; 	// right double curly quote
		$field_name = 'REPLACE( '.$field_name.', "&quot;", "")'; 	// quotation mark
		$field_name = 'REPLACE( '.$field_name.', "&ndash;", "")'; 	// en dash
		$field_name = 'REPLACE( '.$field_name.', "&mdash;", "")'; 	// em dash
		$field_name = 'REPLACE( '.$field_name.', "&iexcl;", "")'; 	// inverted exclamation
		$field_name = 'REPLACE( '.$field_name.', "&iquest;", "")'; 	// inverted question mark
		$field_name = 'REPLACE( '.$field_name.', "&laquo;", "")'; 	// guillemets
		$field_name = 'REPLACE( '.$field_name.', "&raquo;", "")'; 	// guillemets
		$field_name = 'REPLACE( '.$field_name.', "&gt;", "")'; 		// greater than
		$field_name = 'REPLACE( '.$field_name.', "&lt;", "")'; 		// less than
		
		return $field_name;
	}
	
	public static function search_by_title_only( $search, &$wp_query ) {
		global $wpdb;
		$q = $wp_query->query_vars;
		if ( empty( $search) || !isset($q['s']) )
			return $search; // skip processing - no search term in query
		$search = '';
		$term = esc_sql( like_escape( trim($q['s']) ) );
		$term_nospecial = preg_replace( "/[^a-zA-Z0-9_.\s]/", "", $term );
		$search_nospecial = false;
		if ( $term != $term_nospecial ) $search_nospecial = true;
		
		$search .= "( ".WPSC_Predictive_Search_Hook_Filter::remove_special_characters_in_mysql( "$wpdb->posts.post_title" )." LIKE '{$term}%' OR ".WPSC_Predictive_Search_Hook_Filter::remove_special_characters_in_mysql( "$wpdb->posts.post_title" )." LIKE '% {$term}%')";
		if ( $search_nospecial ) $search .= " OR ( ".WPSC_Predictive_Search_Hook_Filter::remove_special_characters_in_mysql( "$wpdb->posts.post_title" )." LIKE '{$term_nospecial}%' OR ".WPSC_Predictive_Search_Hook_Filter::remove_special_characters_in_mysql( "$wpdb->posts.post_title" )." LIKE '% {$term_nospecial}%')";
		
		if ( ! empty( $search ) ) {
			$search = " AND ({$search}) ";
		}
		return $search;
	}
	
	public static function predictive_posts_orderby( $orderby, &$wp_query ) {
		global $wpdb;
		$q = $wp_query->query_vars;
		if (isset($q['orderby']) && $q['orderby'] == 'predictive' && isset($q['s']) ) {
			$term = esc_sql( like_escape( trim($q['s']) ) );
			$orderby = "$wpdb->posts.post_title NOT LIKE '{$term}%' ASC, $wpdb->posts.post_title ASC";
		}
		
		return $orderby;
	}
	
	public static function posts_request_unconflict_role_scoper_plugin( $posts_request, &$wp_query ) {
		$posts_request = str_replace('1=2', '2=2', $posts_request);
		
		return $posts_request;
	}
	
	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WPSC_PS_CSS_URL . '/a3_wp_admin.css' );
	}
		
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WPSC_PS_NAME) {
			return $links;
		}
		$links[] = '<a href="'.WPSC_PREDICTIVE_SEARCH_DOCS_URI.'" target="_blank">'.__('Documentation', 'wpscps').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/wp-e-commerce-predictive-search/" target="_blank">'.__('Support', 'wpscps').'</a>';
		return $links;
	}
}
?>