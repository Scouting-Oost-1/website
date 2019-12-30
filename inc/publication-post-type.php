<?php

/*-------------------------------------*\
  PUBLICATION POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_publication_post_type' );

function create_publication_post_type() {
  $args = array(
    'description' => 'Publication Post Type',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'labels' => array(
      'name'=> 'Publicaties',
      'singular_name' => 'Publicatie',
      'add_new' => 'Voeg nieuwe publicatie toe',
      'add_new_item' => 'Voeg nieuwe publicatie toe',
      'edit' => 'Pas publicatie aan',
      'edit_item' => 'Pas publicatie aan',
      'new-item' => 'Nieuwe publicatie',
      'view' => 'Bekijk publicatie',
      'view_item' => 'Bekijk publicatie',
      'search_items' => 'Zoek publicaties',
      'not_found' => 'Geen publicaties gevonden',
      'not_found_in_trash' => 'Geen publicaties gevonden in de prullenbak',
      'parent' => 'Parent publicatie'
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-book',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'taxonomies' => array( 'category' ),
    'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
  );
  register_post_type( 'publicaties' , $args );
}

function publication_activate() {
  flush_rewrite_rules();
}

function publication_deactivate() {
  flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'publication_activate' );
register_deactivation_hook( __FILE__, 'publication_deactivate' );
