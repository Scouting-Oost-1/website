<?php /**
 * Template Name: Events page
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

  <main class="page <?php the_field('palette_color') ?>" id="site-content">

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

    <?php
      $add_calendar_url = sprintf("https://calendar.google.com/calendar/u/0/r?cid=%s", CALENDAR_ID);
      $ics_calendar_url = sprintf("https://calendar.google.com/calendar/ical/%s/public/basic.ics", urlencode(CALENDAR_ID));
    ?>

    <aside class="calendar-links">
      <a class="referral referral--heavy referral--arrowed" href="<?php echo $add_calendar_url; ?>"
        target="_blank">
        Voeg deze agenda toe aan je <strong>Google Calendar</strong></a>
      <label class="text-label text-label--no-margin" for="ics-url">Of gebruik deze ICS-url:
        <input type="text" value="<?php echo $ics_calendar_url; ?>" disabled>
      </label>
    </aside>

    <?php 
        include('inc/get-events.php');
        $response = getEvents();
        $time_format = get_option( 'time_format' );
        $date_format = get_option( 'date_format' );
        foreach ($response['events'] as $key => $event) { ?>
      <article class="event">
        <p class="event__moment">
          <?php
            $compare_start = clone $event['start'];
            $compare_end = clone $event['end'];
            if ($event['has_time']) {
              $format = sprintf("%s %s", $date_format, $time_format);
            } else {
              $format = sprintf("%s", $date_format);
            }
            if (getNightsBetween($compare_start, $compare_end) > 0) {
              echo sprintf("🗓️&emsp;<strong>%s</strong> – %s",
              wp_date($format, $event['start']->format('U')),
              wp_date($format, $event['end']->format('U')));
            } else {
              echo sprintf("📅&emsp;<strong>%s</strong> – %s",
              wp_date($format, $event['start']->format('U')),
              wp_date($time_format, $event['end']->format('U')));
            }
          ?>

        </p>
        <h2 class="event__summary">
          <?php echo $event['summary']; ?>
        </h2>
        <?php if (!empty($event['location'])) { ?>
        <p class="event__location">
          📍 <?php echo $event['location']; ?>
        </p>
        <?php } ?>
        <?php if (!empty($event['description'])) { ?>
        <p class="event__description">
          <?php echo $event['description']; ?>
        </p>
        <?php } ?>
      </article>
    <?php } ?>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
