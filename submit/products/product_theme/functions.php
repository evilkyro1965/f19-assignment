<?php

/* Enum Page Slug */
define("HOME_PAGE", "home");

define("PRODUCT_POST",'product');

add_theme_support( 'post-thumbnails' );


/* get page id by slug */
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function themesBaseUrl() {
	echo bloginfo( 'stylesheet_directory' );
}

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {	
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/**
 * enable menus feature
 */
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}

/**
 * add concept costom post type
 */
add_action('init', 'create_post_types');

/**
 * function to create concept custom post type and cutomer custom post type
 */
function create_post_types() {

	$postTypeTitle = "Products";
	$postType = "product";
    register_post_type( $postType,
        array(
            'labels' => array(
                'name' => __( $postTypeTitle ),
                'singular_name' => __( $postTypeTitle ),
        		'add_new' => _x('Add New', postType),
        		'add_new_item' => __('Add New '.$postTypeTitle),
        		'edit_item' => __('Edit '.$postTypeTitle),
        		'new_item' => __('New '.$postTypeTitle),
        		'view_item' => __('View '.$postTypeTitle),
        		'search_item' => __('Search '.$postTypeTitle),
        		'not_found' => __('No '.$postTypeTitle.' found'),
        		'menu_name' => __($postTypeTitle)
            ),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array('post_tag','category'),
            'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes')
        )
    );
		
		flush_rewrite_rules( false );

}

/**
 * 
 * get page link
 * @param string $path
 */
function get_page_link_by_path($path) {
    $p = get_page_by_path($path);
    if ($p == NULL) {
        return '#';
    } else {
        return get_page_link($p->ID);
    }
}

/* function convert category slug to category id  */
function getCategoryId($slug) {
  $idObj = get_category_by_slug($slug); 
  $id = $idObj->term_id;
  return $id;
} 

/**
 * wrap content to $len length content, and add '...' to end of wrapped conent
 */
function wrap_content($content, $len, $strip_html = false, $sp = '\n\r', $ending = '...') {
	if ($strip_html) {
		$content = strip_tags($content);
	}
	$c_title_wrapped = wordwrap($content, $len, $sp);
	$w_title = explode($sp, $c_title_wrapped);
    if (strlen($content) <= $len) { $ending = ''; }
	return $w_title[0].$ending;
}



?>