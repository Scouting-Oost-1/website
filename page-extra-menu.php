<?php /**
 * Template Name: Extra menu
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

  <main class="page page--extra-menu <?php the_field('palette_color') ?>" id="site-content">

    <h1 class="activity__title"><?php the_title(); ?></h1>

    <div class="activity__content">
      <?php the_content(); ?>
    </div>

    <aside class="page__menu">
      <h2 class="meta-head">Andere pagina’s</h2>
      <nav>
        <ul class="page__menu-list">
          <?php
            $parent = get_post_ancestors($post->ID);
            if ($parent):
              $children = get_children($parent[0]); ?>
              <li>
                <a href="<?php echo the_permalink($parent[0]); ?>">
                  <?php echo get_the_title($parent[0]); ?>
                </a>
              </li>
            <?php
            else:
              $children = get_children($post->ID); ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </li>
            <?php
            endif;
            foreach ($children as $key => $child) { ?>
            <li>
              <a href="<?php echo $child->guid; ?>">
                <?php echo $child->post_title; ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </aside>

  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
