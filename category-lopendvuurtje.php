<?php /**
 * Lopend Vuurtje archive
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : ?>

  <header class="archive-title">
    <h1 class="archive-title__head">Lopend Vuurtje</h1>
  </header>

  <main class="lopendvuurtje-archive" id="site-content">

    <div class="lopendvuurtje-archive__description">
      <p>Het Lopend Vuurtje, het clubblad van Scouting Oost 1, wordt gemaakt voor en door leden van onze vereniging. De inhoud bestaat met name uit stukken over allerlei (aankomende en afgelopen) activiteiten. Denk daarbij aan leuke opkomsten van de verschillende speltakken, weekenden weg, acties, enzovoort. Ook wordt er altijd ruimte gemaakt voor andere rubrieken, zoals een goed recept of een griezelverhaal. Heb je een leuk idee voor één van de volgende edities? Mail dan de redactie via <a href="mailto:lopendvuurtje@scoutingoost1.nl">lopendvuurtje@scoutingoost1.nl</a>.</p>
    </div>

    <?php while(have_posts()) : the_post(); ?>
      <article class="lopendvuurtje"
        style="--page-bg: <?php echo get_field('page-bg') ?>;">
        <a href="<?php the_field('pdf'); ?>">
          <?php the_post_thumbnail('medium',
            array( 'class' => 'lopendvuurtje__cover')
          ); ?>
          <h2 class="lopendvuurtje__edition">
            <?php the_title(); ?>
          </h2>
        </a>
      </article>
    <?php endwhile; ?>

  </main>

<?php else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
