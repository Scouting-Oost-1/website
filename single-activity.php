<?php /**
 * Single activity
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail() ) : ?>
    <header class="page-thumb">
      <?php the_post_thumbnail('post-thumbnail',
        array( 'class' => 'page-thumb__img')
      ); ?>
    </header>
  <?php endif; ?>

  <main class="activity--page" id="site-content">

    <h1 class="activity__title"><?php the_title(); ?></h1>

    <div class="activity__content">
      <?php the_content(); ?>
      [album of fotoalbum-link]
    </div>



    <?php if(get_field('show_date')): ?>
    <aside class="activity__date-time-place">
      <?php
        $date_upcoming = get_field('date_upcoming');
        $date_upcoming_end = get_field('date_upcoming_end');
        $time_upcoming = get_field('time_upcoming');
        $time_upcoming_end = get_field('time_upcoming_end');
        $location_upcoming = get_field('location_upcoming');

        $upcoming = false;
        if($date_upcoming) $upcoming = "<strong>$date_upcoming</strong>";
        if($time_upcoming) $upcoming .= ", " . $time_upcoming;
        if($date_upcoming_end || $time_upcoming_end) $upcoming .= " – ";
        if($date_upcoming_end) $upcoming .= $date_upcoming_end;
        if($time_upcoming_end) $upcoming .= ", " . $time_upcoming_end;
        if($location_upcoming) $upcoming .= ". " . $location_upcoming . ".";

        if($upcoming):
      ?>
      <h3 class="meta-head">
        De eerstvolgende keer:
      </h3>
      <p class="meta-content">
        <?php echo $upcoming; ?>
      </p>
      <?php endif; ?>

      <?php
        $date_last = get_field('date_last');
        $date_last_end = get_field('date_last_end');
        $location_last = get_field('location_last');

        $last = false;
        if($date_last) $last = "<strong>$date_last</strong>";
        if($date_last_end) $last .= " – " . $date_last_end;
        if($location_last) $last .= ". " . $location_last . ".";

        if($last):
      ?>
      <h3 class="meta-head">
        De vorige keer:
      </h3>
      <p class="meta-content">
        <?php echo $last; ?>
      </p>
      <?php endif; ?>
    </aside>
    <?php endif; ?>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
