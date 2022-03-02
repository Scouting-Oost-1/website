<?php

/* Contents:
 * - Includes
 * - Add actions
 * - Image url function
 * - Register menus
 * - Security edits
 * - Removing emoji
 * - AJAX address API */


/* INCLUDES */
include( 'inc/activity-post-type.php' );
include( 'inc/activity-custom-fields.php' );
include( 'inc/publication-post-type.php' );
include( 'inc/publication-custom-fields.php' );
include( 'inc/photoalbum-post-type.php' );
include( 'inc/photoalbum-custom-fields.php' );
include( 'inc/page-custom-fields.php' );
include( 'inc/send-mail.php' );
include( 'inc/administration-handling.php' );
include( 'inc/rental-handling.php' );
include( 'inc/rental-form.php' );
include( 'inc/clothes-handling.php' );
include( 'inc/clothes-form.php' );
include( 'inc/friends-handling.php' );
if (file_exists('inc/local-vars.php')) include( 'inc/local-vars.php' );

/* ADD ACTIONS */
add_action( 'after_setup_theme', 'custom_theme_setup' );

/* Add theme support for a few things */
function custom_theme_setup() {
  add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
  add_theme_support( 'html5' ); // Make the search form input type="search"
  add_theme_support( 'title-tag' ); // Fix the document title tag
}





/* Get url for image based on filename */
function image_url($filename) {
  return get_bloginfo('template_directory') . '/static/img/' . $filename;
}



/* Create menus */
register_nav_menus( array(
    'primary' => 'Primary Menu',
    'sitemap' => 'Footer Sitemap'
) );





/* Prevent some exploits and block username enum by
 * - disabling XML-RPC
 * - blocking unauthorized access to the JSON API
 * - removing author archives
 */
// add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'rest_authentication_errors', function( $result ) {
  if ( ! empty( $result ) ) {
      return $result;
  }
  if ( ! is_user_logged_in() ) {
      return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
  }
  return $result;
});
function disable_author_archives() {
  if (is_author()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
  } else {
    redirect_canonical();
  }
}
remove_filter('template_redirect', 'redirect_canonical');
add_action('template_redirect', 'disable_author_archives');





/* Stop loading emoji styles and scripts */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );





/* Remove comment support */
// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function so1_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'so1_admin_bar_render' );





function sort_activities( $query ) {
	// do not modify queries in the admin
	if( is_admin() ) return $query;

	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type'])
   && $query->query_vars['post_type'] == 'activiteiten' ) {
		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'date_upcoming');
		$query->set('order', 'ASC');
	}

	// return
	return $query;
}

add_action('pre_get_posts', 'sort_activities');





function show_publications( $query ) {
	// do not modify queries in the admin
	if( is_admin() ) return $query;
	// only modify queries for 'event' post type
	if( is_category() && $query->is_main_query() ) {
		$query->set('post_type', array(
      'post',
      'publicaties'
    ));
	}
	// return
	return $query;
}

add_action('pre_get_posts', 'show_publications');





add_action('wp_ajax_nopriv_address', 'address');
add_action('wp_ajax_address', 'address');

function address() {
  $curl = curl_init();
  $url = "http://json.api-postcode.nl";
  $data = array(
    'postcode' => $_GET['postcode'],
    'number' => $_GET['number']
  );
  $url = sprintf("%s?%s", $url, http_build_query($data));
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'token: ' . POSTAL_CODE_API_KEY
  ));
  $result = curl_exec($curl);
  curl_close($curl);
  echo $result;
  exit();
}




function dutch_strtotime($date_string) {
  return strtotime(
    strtr(
      strtolower($date_string),
      array(
        'januari' => 'jan',
        'februari' => 'feb',
        'maart' => 'march',
        'april' => 'apr',
        'mei' => 'may',
        'juni' => 'jun',
        'juli' => 'jul',
        'augustus' => 'aug',
        'september' => 'sep',
        'oktober' => 'oct',
        'november' => 'nov',
        'december' => 'dec'
      )
    )
  );
}
