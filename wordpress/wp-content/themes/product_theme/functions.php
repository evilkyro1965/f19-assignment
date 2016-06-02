<?php

/* Enum Page Slug */
define("HOME_PAGE", "home");
define("COMMUNITY_CAT", "community");
define("TRENDING_CAT", "trending");
define("COMMUNITY_UPDATE_CAT", "community-update");
define("CHANNEL_CAT", "channel");

define("PRODUCT_POST",'product');

add_theme_support( 'post-thumbnails' );

function image_shortcode( $atts , $content="" ){
	$ret = get_bloginfo( 'stylesheet_directory' )."/i/".$content;
	return $ret;
}
add_shortcode( 'imageDir', 'image_shortcode' );
remove_filter( 'the_content', 'wpautop' );

function baseUrl( $atts, $content="" ){
	$ret = get_bloginfo( 'wpurl' )."/".$content;
	return $ret;
}
add_shortcode( 'baseUrl', 'baseUrl' );

add_filter( 'comment_post_redirect', 'wpse_58613_comment_redirect' );
function wpse_58613_comment_redirect( $location )
{
    if ( isset( $_POST['redirectTo'] ) ) { 
			// Don't use "redirect_to", internal WP var
      return $_POST['redirectTo'];
		}
}

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

/**
 * Start of Theme Options
 */
add_action('admin_menu', 'themeoptions_admin_menu');
 
function themeoptions_admin_menu() {
	add_theme_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'themeoptions_page');
}

function themeoptions_page()
{
	if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }  //check options update
	// here's the main function that will generate our options page
	$brandx = "brandx_";
	$footerCopyright = $brandx."footerCopyright";
	?>

	<div class="wrap">
		<div id="icon-themes" class="icon32"><br /></div>
		<h2>Theme Options</h2>

		<form method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" name="update_themeoptions" value="true" />
			<h3>Footer</h3>
            <p>
                <label for="<?php echo $footerCopyright;?>"><strong>Footer Copyright</strong></label><br />
                <input type="text" name="<?php echo $footerCopyright;?>" size="100" value="<?php echo (get_option(''.$footerCopyright)!=null ? get_option(''.$footerCopyright) : "Copyright &copy; 2014 by Client, Inc. , All Rights Reserved. Client is a registered trademark of Client,Inc"); ?>"/>
            </p>
			<hr>
			<br />
			<p><input type="submit" name="submit" value="Update Options" class="button button-primary" /></p>
		</form>

	</div>
	<?php
}

// Update options function
function themeoptions_update() {	
	$brandx = "brandx_";
	$footerCopyright = $brandx."footerCopyright";
	
	update_option($footerCopyright, removeSlash($_POST[$footerCopyright]));

}

function removeSlash($str) {
	return str_replace("\'","'",$str);
}


?>