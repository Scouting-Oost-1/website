<?php /**
 * Template Name: Index
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <main class="index" id="site-content">

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
