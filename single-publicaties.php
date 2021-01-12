<?php /**
 * Single publicatie
 */ ?>

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

  <main class="photoalbum" id="site-content">

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

    <p class="photoalbum__button-cont">
      <a href="<?php the_field('pdf'); ?>" class="button">
        Download
      </a>
    </p>

  </main>

<?php endwhile; ?>

<?php else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
