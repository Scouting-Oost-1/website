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

    <?php 
      $images = get_field('album');
      if ( $images ): ?>
        <ul class="album">
          <?php foreach( $images as $image ): ?>
            <li class="photo-cont">
              <a href="<?php echo esc_url($image['sizes']['large']); ?>" class="photo fancybox" rel="group">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>">
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
    <?php else: ?>
      <p class="referral">Er staan nog geen foto’s in dit album.</p>
    <?php endif; ?>

    <a class="back-to-albums"
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
