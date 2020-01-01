<?php /**
 * Front page
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <main class="front-page" id="site-content">



    <?php
      $activity = get_field('activity');
      $activity_ID = $activity->ID;
    ?>
    <section class="activity--front page-thumb page-thumb--green"
      style="--alt-img: url(<?php echo get_the_post_thumbnail_url($activity_ID); ?>);">
      <p class="activity--front__date">
        <?php
          $activity_begin = get_field('date_upcoming', $activity_ID);
          $activity_end = get_field('date_upcoming_end', $activity_ID);
          if (strtotime($activity_begin) > strtotime('today')) {
            echo "Op $activity_begin hebben we:";
          } elseif (strtotime($activity_end) >= strtotime('today')) {
            echo "Vandaag:";
          } else {
            echo "Op $activity_end hadden we:";
          }
        ?>
      </p>
      <h1 class="activity--front__title">
        <?php echo $activity->post_title; ?>
      </h1>
      <p class="activity--front__excerpt">
        <?php echo $activity->post_excerpt; ?>
        <a href="<?php the_permalink($activity_ID); ?>"
          class="button activity--front__button">
          Meer over <?php echo $activity->post_title; ?>
        </a>
      </p>
      <?php
        echo get_the_post_thumbnail(
          $activity_ID,
          'post-thumbnail',
          array( 'class' => 'activity--front__img')); ?>
    </section>



    <section class="past">
      <h1 class="past__title">Blijf op de hoogte</h1>

      <?php
        $recent_news = get_posts(array(
          'numberposts' => 1,
          'category' => 'nieuws'
        ));
        $recent_news = $recent_news[0];
        $recent_news_ID = $recent_news->ID;

        if ($recent_news->post_type):
      ?>

      <div class="past__part">
        <h2>Nieuws</h2>
        <p>Lees het laatste nieuwsbericht</p>

        <article class="past__item">
          <?php echo get_the_post_thumbnail($recent_news_ID, 'medium'); ?>
          <h3 class="past__post-title">
            <a href="<?php the_permalink($recent_news_ID); ?>">
              <?php echo $recent_news->post_title; ?>
            </a>
          </h3>
          <?php echo $recent_news->post_excerpt; ?>
        </article>
      </div>

      <?php endif; ?>



      <!-- <div class="past__part photos--front">
        <h2>Foto’s</h2>
        <p>Bekijk het nieuwste fotoalbum</p>

        <article class="past__item">
          [Fotoalbum]
        </article>
      </div> -->



      <?php
        $recent_lv_query = array(
          'post_type' => 'publicaties',
          'posts_per_page' => 1,
          'category' => 'nieuws'
        );
        $recent_lv = new WP_Query($recent_lv_query);

        if ($recent_lv->have_posts()): $recent_lv->the_post();
      ?>

      <div class="past__part lvs--front">
        <h2>Lopend Vuurtje</h2>
        <p>Lees de laatste editie van ons clubblad</p>
        <article class="past__item">
          <a href="<?php the_field('pdf'); ?>" target="_blank">
            <?php the_post_thumbnail('medium'); ?>
            <h3 class="past__post-title"><?php the_title(); ?></h3>
          </a>
        </article>
      </div>

      <?php endif; wp_reset_postdata();?>

    </section>



    <section class="front-members">
      <h1>Jeugdleden</h1>
      <div class="front-members__cont">
        <table class="front-members__speltakken">
          <thead>
            <th>Leeftijd</th>
            <th>Meisjes</th>
            <th>Jongens</th>
          </thead>
          <tbody>
            <tr>
              <td>4–7</td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Bevers' ) ); ?>">
                  Bevers
                </a>
              </td>
            </tr>
            <tr>
              <td>7–11</td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Kabouters' ) ); ?>">
                  Kabouters
                </a>
              </td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Welpen' ) ); ?>">
                  Welpen
                </a>
              </td>
            </tr>
            <tr>
              <td>11–15</td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Gidsen' ) ); ?>">
                  Gidsen
                </a>
              </td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Verkenners' ) ); ?>">
                  Verkenners
                </a>
              </td>
            </tr>
            <tr>
              <td>15–18</td>
              <td>
                <a href="<?php echo get_permalink(
                  get_page_by_title( 'Explorers' ) ); ?>">
                  Explorers
                </a>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="front-members__buttons">
          <a class="button" href="<?php echo get_permalink(
            get_page_by_title( 'Ledenadministratie' ) ); ?>?Actie=Aanmelden">
            Word lid</a>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_title( 'Ledenadministratie' ) ); ?>?Actie=Wijzigen">
            Uitschrijven</a>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_title( 'Ledenadministratie' ) ); ?>?Actie=Afmelden">
            Gegevens wijzigen</a>
        </div>
      </div>
    </section>



    <section class="front-end">
      <div class="front-end__cont">
        <div class="front-end__text">
          <?php the_content(); ?>
        </div>

        <nav class="continue">
          <h2>Ga verder...</h2>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_path( 'verhuur' ) ); ?>">
            Huur onze gebouwen</a>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_path( 'steunen' ) ); ?>">
            Steun Scouting Oost 1</a>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_path( 'agenda' ) ); ?>">
            Bekijk de agenda</a>
          <a class="button button--light" href="<?php echo get_permalink(
            get_page_by_path( 'contact' ) ); ?>">
            Neem contact op</a>
        </nav>
      </div>

    </section>



  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
