<?php /**
 * Template Name: Poster builder
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

    <section class="builder">
      <aside class="controls">
        <div class="controls__actions">
          <button class="button js-save-pdf">
            <i class="fas fa-file-pdf"></i>
            &ensp;
            Opslaan als PDF
          </button>
          <a download="image.png">
            <button class="button js-save-png" download="image.png">
              <i class="fas fa-file-image"></i>
              &ensp;
              Opslaan als PNG
            </button>
          </a>
        </div>
        <div class="controls__image">
          <h2>Afbeelding</h2>
          <input class="js-change-image" type="file" name="hero-image">
        </div>
        <div class="controls__colors">
          <h2>Kleuren</h2>
          <button class="button controls__color--pink js-change-color">
            Roze</button>
          <button class="button controls__color--purple js-change-color">
            Paars</button>
          <button class="button controls__color--green js-change-color">
            Groen</button>
          <button class="button controls__color--yellow js-change-color">
            Geel</button>
          <button class="button controls__color--orange js-change-color">
            Oranje</button>
          <button class="button controls__color--red js-change-color">
            Rood</button>
          <button class="button controls__color--cyan js-change-color">
            Cyaan</button>
        </div>
      </aside>

      <div class="poster js-poster">
        <style class="js-poster-styling"></style>
        <div class="poster__hero">
          <img src="<?php echo image_url('transparent-pixel.png'); ?>" class="poster__image js-poster-hero">
        </div>
        <div class="poster__content">
          <h1 class="poster__title" contenteditable>Open dag Scouting Oost 1</h1>
          <ul class="poster__list">
            <li class="poster__date">
              <span class="poster__detail" contenteditable>31 december 2020</span>
              <svg class="poster__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 16"><defs><style>.cls-1{fill:var(--page-bg);}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M14,3.5V5H0V3.5A1.5,1.5,0,0,1,1.5,2H3V.5A.51.51,0,0,1,3.5,0h1A.51.51,0,0,1,5,.5V2H9V.5A.51.51,0,0,1,9.5,0h1a.51.51,0,0,1,.5.5V2h1.5A1.5,1.5,0,0,1,14,3.5ZM0,6H14v8.5A1.5,1.5,0,0,1,12.5,16H1.5A1.5,1.5,0,0,1,0,14.5Zm2,5.5a.51.51,0,0,0,.5.5h3a.51.51,0,0,0,.5-.5v-3A.51.51,0,0,0,5.5,8h-3a.51.51,0,0,0-.5.5Z"/></g></g></svg>
            </li>
            <li class="poster__time">
              <span class="poster__detail" contenteditable>18:00–19:00</span>
              <svg class="poster__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.5 15.5"><defs><style>.cls-1{fill:var(--page-bg);}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M15.5,7.75A7.75,7.75,0,1,1,7.75,0,7.75,7.75,0,0,1,15.5,7.75Zm-5.44,3.11.88-1.21a.38.38,0,0,0-.08-.53l-2-1.44V3.38A.38.38,0,0,0,8.5,3H7a.38.38,0,0,0-.38.38V8.63a.38.38,0,0,0,.16.31l2.75,2A.39.39,0,0,0,10.06,10.86Z"/></g></g></svg>
            </li>
            <li class="poster__audience">
              <span class="poster__detail" contenteditable>4–18 jaar</span>
              <svg class="poster__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 14"><defs><style>.cls-1{fill:var(--page-bg);}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M12,11.6v.9A1.5,1.5,0,0,1,10.5,14h-9A1.5,1.5,0,0,1,0,12.5v-.9A3.6,3.6,0,0,1,3.6,8h.26A4.83,4.83,0,0,0,8.14,8H8.4A3.6,3.6,0,0,1,12,11.6ZM2.5,3.5A3.5,3.5,0,1,1,6,7,3.5,3.5,0,0,1,2.5,3.5Zm17.5,8A1.5,1.5,0,0,1,18.5,13H13c0-.07,0-.13,0-.2V11.6a4.58,4.58,0,0,0-1.24-3.12A3.41,3.41,0,0,1,13.5,8h.12a3.93,3.93,0,0,0,2.76,0h.12A3.5,3.5,0,0,1,20,11.5ZM12,4a3,3,0,1,1,3,3A3,3,0,0,1,12,4Z"/></g></g></svg>
            </li>
            <li class="poster__location">
              <span class="poster__detail" contenteditable>Kruislaan 224</span>
              <svg class="poster__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.5 15.5"><defs><style>.cls-1{fill:var(--page-bg);}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M15.5,7.75A7.75,7.75,0,1,1,7.75,0,7.75,7.75,0,0,1,15.5,7.75ZM10.87,3.81,6.36,5.87a1.22,1.22,0,0,0-.49.49L3.81,10.87a.62.62,0,0,0,.82.82L9.14,9.63a1.28,1.28,0,0,0,.49-.49l2.06-4.51A.62.62,0,0,0,10.87,3.81ZM8.46,7A1,1,0,1,1,7,7,1,1,0,0,1,8.46,7Z"/></g></g></svg>
            </li>
          </ul>
          <p class="poster__description" contenteditable>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          </p>
        </div>
        <div class="poster__footer">
          <address class="poster__contact">
            Kruislaan 224-226B<br>
            1098 SL Amsterdam<br>
            info@scoutingoost1.nl<br>
            scoutingoost1.nl
          </address>
          <img src="<?php echo image_url('full-logo-poster.svg'); ?>" alt="Logo Scouting Oost 1" class="poster__logo">
        </div>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.1.1/jspdf.umd.min.js"
      async></script>
    <script src="https://unpkg.com/dompurify@0.8.9/dist/purify.min.js"></script>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
