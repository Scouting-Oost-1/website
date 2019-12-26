<?php /**
 * Activities archive
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : ?>

  <header class="archive-title">
    <h1 class="archive-title__head">Activiteiten</h1>
  </header>

  <main class="activities--page" id="site-content">

    <a class="referral referral--arrowed activities--page__referral" href="<?php echo get_term_link('nieuws', 'category'); ?>">
      Wil je op de hoogte blijven van deze activiteiten? <strong>Ga naar nieuws!</strong>
    </a>

    <?php while(have_posts()) : the_post(); ?>
      <article class="activity--small">
        <?php the_post_thumbnail('medium',
          array( 'class' => 'activity__thumb')
        ); ?>
        <div class="activity__text">
          <p class="activity--small__date">
            <?php the_field('date_upcoming'); ?>
          </p>
          <h2 class="activity--small__title">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h2>
          <?php the_excerpt(); ?>
          <a href="<?php the_permalink(); ?>" class="button activity__button">
            Lees verder...
          </a>
        </div>
      </article>
    <?php endwhile; ?>

  </main>

<?php else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
