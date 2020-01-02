<?php /**
 * Template Name: Fotoalbum
 */ ?>
<?php wp_enqueue_style('fonts',
  get_template_directory_uri() . '/vendor/fancybox.css' ); ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <header class="page-thumb page-thumb--<?php the_field('palette_color') ?>">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('post-thumbnail',
        array( 'class' => 'page-thumb__img')
      ); ?>
    <?php else: ?>
      <div class="page-thumb__spacer"></div>
    <?php endif; ?>
  </header>

  <main class="page <?php the_field('palette_color') ?>" id="site-content">

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

    <script type="text/javascript">
      var photoAlbum = true;
    </script>

    <?php wp_localize_script( 'scripts', 'flickr', array(
      'user_id' => FLICKR_USER_ID,
      'api_key' => FLICKR_API_KEY ) ); ?>
    <?php wp_localize_script( 'scripts', 'folder', array(
      'static' => get_template_directory_uri() . '/vendor/' ) ); ?>

    <div class="photos">
      <p class="loading">
        De foto's worden geladen.
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      width="30px" height="30px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
          <path fill="#76CF2F" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
          <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
          </path>
        </svg>
      <p>
    </div>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
