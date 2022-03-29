<?php /**
 * Single photoalbum
 */ ?>

<?php $theme_info = wp_get_theme(); ?>
<?php wp_enqueue_script( 'fancybox',
  get_template_directory_uri() . '/vendor/fancybox.js',
  array('jquery'), $theme_info->version, true ); ?>

<?php wp_enqueue_style( 'fancybox',
  get_template_directory_uri() . '/vendor/fancybox.css' ); ?>

<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <header class="page-thumb page-thumb--<?php the_field('palette_color') ?>">
    <div class="page-thumb__spacer"></div>
  </header>

  <main class="photoalbum" id="site-content">

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

    <p class="photoalbum__button-cont">
      <button href="#" class="button" id="js-slideshow-button">
        Start slideshow
      </button>
    </p>

    <div class="album">
      <?php $album_id = get_field('flickr_album_id') ?>
      <?php include('inc/get-flickr-photos.php'); ?>
    </div>

    <a class="referral"
      href="<?php echo get_post_type_archive_link('photoalbum'); ?>">
      ← Terug naar alle albums</a>

  </main>

<?php endwhile; ?>

<?php else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
