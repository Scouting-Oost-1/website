<?php

/*-------------------------------------*\
  REDIRECT POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_redirect_post_type' );

function create_redirect_post_type() {
  $args = array(
    'description' => 'Redirect Post Type',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'labels' => array(
      'name'=> 'Verwijzingen',
      'singular_name' => 'Verwijzing',
      'add_new' => 'Voeg nieuwe verwijzing toe',
      'add_new_item' => 'Voeg nieuwe verwijzing toe',
      'edit' => 'Pas verwijzing aan',
      'edit_item' => 'Pas verwijzing aan',
      'new-item' => 'Nieuwe verwijzing',
      'view' => 'Bekijk verwijzing',
      'view_item' => 'Bekijk verwijzing',
      'search_items' => 'Zoek verwijzingen',
      'not_found' => 'Geen verwijzingen gevonden',
      'not_found_in_trash' => 'Geen verwijzingen gevonden in de prullenbak',
      'parent' => 'Parent verwijzing'
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-admin-links',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'taxonomies' => array( 'category' ),
    'supports' => array( 'revisions', 'title' )
  );
  register_post_type( 'qr' , $args );
}

function redirect_activate() {
  flush_rewrite_rules();
}

function redirect_deactivate() {
  flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'redirect_activate' );
register_deactivation_hook( __FILE__, 'redirect_deactivate' );
