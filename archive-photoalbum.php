<?php /**
 * Photoalbum archive
 */ ?>
<?php get_header(); ?>

<header class="page-thumb page-thumb--green">
  <div class="page-thumb__spacer"></div>
</header>

<main class="archive green" id="site-content">

  <h1>Fotoalbum</h1>

<?php if(have_posts()) : ?>

  <p>
    <a class="referral referral--heavy referral--arrowed"
      href="https://www.flickr.com/photos/134051155@N05/albums">
      Bekijk alle albums
    </a>
  </p>

  <section class="photoalbums">

  <?php while(have_posts()) : the_post(); ?>

    <?php
      $title_opening = '</section><h2 class="photoalbums__title">';
      $title_closing = '</h2><section class="photoalbums">';
      echo the_date('F Y', $title_opening, $title_closing);
    ?>

    <article class="photoalbum--link">
      <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail('medium',
            array( 'class' => 'photoalbum__thumb')
          ); ?>
        <?php endif; ?>
        <h3 class="photoalbum__name">
          <?php the_title(); ?>
        </h3>
      </a>
    </article>

  <?php endwhile; ?>

  </section>

  <?php the_posts_pagination(); ?>

<?php else: ?>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

<?php endif; ?>

</main>
<?php get_footer(); ?>
