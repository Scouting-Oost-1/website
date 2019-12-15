<?php

/*-------------------------------------*\
  ACTIVITY POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_activity_post_type' );

function create_activity_post_type() {
  $args = array(
    'description' => 'Activity Post Type',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'labels' => array(
      'name'=> 'Activiteiten',
      'singular_name' => 'Activiteit',
      'add_new' => 'Voeg nieuwe activiteit toe',
      'add_new_item' => 'Voeg nieuwe activiteit toe',
      'edit' => 'Pas activiteit aan',
      'edit_item' => 'Pas activiteit aan',
      'new-item' => 'Nieuwe activiteit',
      'view' => 'Bekijk activiteit',
      'view_item' => 'Bekijk activiteit',
      'search_items' => 'Zoek activiteiten',
      'not_found' => 'Geen activiteiten gevonden',
      'not_found_in_trash' => 'Geen activiteiten gevonden in de prullenbak',
      'parent' => 'Parent activiteit'
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon'   => 'dashicons-schedule',
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
  );
  register_post_type( 'activity' , $args );
}

function activity_activate() {
  flush_rewrite_rules();
}

function activity_deactivate() {
  flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activity_activate' );
register_deactivation_hook( __FILE__, 'activity_deactivate' );
