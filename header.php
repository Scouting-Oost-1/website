<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#82c14a">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php $theme_info = wp_get_theme(); ?>

    <?php wp_enqueue_script( 'scripts',
      get_template_directory_uri() . '/static/js/main.js',
      array('jquery'), $theme_info->version, true ); ?>

    <?php wp_enqueue_style( 'main',
      get_template_directory_uri() . '/static/css/main.css',
      array(), $theme_info->version ); ?>

    <meta name="ajaxurl" content="<?php echo admin_url( 'admin-ajax.php' ); ?>">

    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-regular.woff" as="font" type="font/woff" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-regular.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-italic.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-italic.woff" as="font" type="font/woff" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-italic.ttf" as="font" type="font/ttf" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-800.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-800.woff" as="font" type="font/woff" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/alegreya-sans-v13-latin-800.ttf" as="font" type="font/ttf" crossorigin>

    <?php wp_head(); ?>

  </head>
  <body>

    <a href="#site-content" class="skip">Ga naar de inhoud</a>

    <header class="site-header">

      <a href="<?php echo get_site_url(); ?>">
        <img alt="<?php bloginfo( 'name' ); ?>"
          class="logo"
          src="<?php echo image_url('full-logo-black.svg'); ?>">
      </a>

      <a href="#menu" class="js-menu-toggle menu-toggle">Menu</a>

      <nav class="site-menu" id="menu">
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'site-menu__list' ) ); ?>
      </nav>

    </header>
