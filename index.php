<?php /**
 * Index
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <main class="index" id="site-content">

    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('post-thumbnail',
        array( 'class' => 'index__thumb')
      ); ?>
    <?php endif; ?>

    <h1><?php the_title(); ?></h1>
    <p class="post-date">
      <?php the_date(); ?>
    </p>
    <?php the_content(); ?>

  </main>

<?php endwhile; ?>

<hr>

<nav class="pagination">
  <?php
    $prev_posts = get_previous_post_link();
    $next_posts = get_next_post_link();
    if ($prev_posts) echo sprintf("<p class='pagination__prev'>ouder<br>%s</p>", $prev_posts);
    if ($next_posts && $prev_posts) echo " – ";
    if ($next_posts) echo sprintf( "<p class='pagination__next'>nieuwer<br>%s</p>", $next_posts);
  ?>
</nav>

<?php else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
