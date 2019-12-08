<?php

/*-------------------------------------*\
  CHANGE POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_CHANGE_post_type' );

function create_CHANGE_post_type() {
  $args = array(
    'description' => 'CHANGE Post Type',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'labels' => array(
      'name'=> 'CHANGEs',
      'singular_name' => 'CHANGE',
      'add_new' => 'Add new CHANGE',
      'add_new_item' => 'Add new CHANGE',
      'edit' => 'Edit CHANGE',
      'edit_item' => 'Edit CHANGE',
      'new-item' => 'New CHANGE',
      'view' => 'View CHANGE',
      'view_item' => 'View CHANGE',
      'search_items' => 'Search CHANGEs',
      'not_found' => 'No CHANGEs found',
      'not_found_in_trash' => 'No CHANGEs found in the trash',
      'parent' => 'Parent CHANGE'
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-schedule',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
  );
  register_post_type( 'event' , $args );
}

function CHANGE_activate() {
  flush_rewrite_rules();
}

function CHANGE_deactivate() {
  flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'CHANGE_activate' );
register_deactivation_hook( __FILE__, 'CHANGE_deactivate' );
