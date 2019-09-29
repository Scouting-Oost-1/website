<?php

  /* Contents:
   * - Includes
   * - Add actions
   * - Image url function
   * - Register menus
   * - Security edits
   * - Removing emoji */


  /* INCLUDES */
  include( 'inc/CHANGE-post-type.php' );
  include( 'inc/CHANGE-custom-fields.php' );

  /* ADD ACTIONS */
  add_action( 'after_setup_theme', 'custom_theme_setup' );
  add_action( 'wp_enqueue_scripts', 'modify_jquery' );

  /* Add theme support for a few things */
  function custom_theme_setup() {
		add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
		add_theme_support( 'html5' ); // Make the search form input type="search"
		add_theme_support( 'title-tag' ); // Fix the document title tag
	}

  /* Replace Wordpress’s version of jQuery with Google API version, since most
   browsers will have it in their cache. */
  function modify_jquery() {
    if (!is_admin()) {
      wp_deregister_script('jquery');
      wp_register_script('jquery',
        'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
        false, '3.4.1', true);
      wp_enqueue_script('jquery');
    }
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
	add_filter( 'xmlrpc_enabled', '__return_false' );
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
