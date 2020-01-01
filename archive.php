<?php /**
 * News archive
 */ ?>
<?php get_header(); ?>

<header class="page-thumb page-thumb--green">
  <div class="page-thumb__spacer"></div>
</header>

<main class="archive green" id="site-content">

  <h1><?php single_cat_title(); ?></h1>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>


    <h2>
      <a href="<?php the_permalink(); ?>" class="archive__title">
        <?php the_title(); ?>
      </a>
    </h2>
    <p>
      <em><?php the_date(); ?></em>
    </p>
    <?php the_excerpt(); ?>
    <p>
      <a href="<?php the_permalink(); ?>">Lees verder</a>
    </p>

    <hr>


<?php endwhile; ?>

<?php the_posts_pagination(); ?>

<?php else: ?>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

<?php endif; ?>

</main>
<?php get_footer(); ?>
