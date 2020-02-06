<?php

/*-------------------------------------*\
  PHOTOALBUM POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_photoalbum_post_type' );

function create_photoalbum_post_type() {
  $args = array(
    'description' => 'Photoalbum Post Type',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'labels' => array(
      'name'=> 'Fotoalbums',
      'singular_name' => 'Fotoalbum',
      'add_new' => 'Voeg nieuwe fotoalbum toe',
      'add_new_item' => 'Voeg nieuwe fotoalbum toe',
      'edit' => 'Pas fotoalbum aan',
      'edit_item' => 'Pas fotoalbum aan',
      'new-item' => 'Nieuwe fotoalbum',
      'view' => 'Bekijk fotoalbum',
      'view_item' => 'Bekijk fotoalbum',
      'search_items' => 'Zoek fotoalbums',
      'not_found' => 'Geen fotoalbums gevonden',
      'not_found_in_trash' => 'Geen fotoalbums gevonden in de prullenbak',
      'parent' => 'Parent publicatie'
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-format-gallery',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
  );
  register_post_type( 'photoalbum' , $args );
}

function photoalbum_activate() {
  flush_rewrite_rules();
}

function photoalbum_deactivate() {
  flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'photoalbum_activate' );
register_deactivation_hook( __FILE__, 'photoalbum_deactivate' );
