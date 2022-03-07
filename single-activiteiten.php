<?php /**
 * Single activity
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail() ) : ?>
    <header class="page-thumb page-thumb--green">
      <?php the_post_thumbnail('post-thumbnail',
        array( 'class' => 'page-thumb__img')
      ); ?>
    </header>
  <?php endif; ?>

  <main class="activity--page" id="site-content">

    <h1 class="activity__title"><?php the_title(); ?></h1>

    <div class="activity__content">
      <?php the_content(); ?>
    </div>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
