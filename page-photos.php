<?php /**
 * Template Name: Photos
 */ ?>

<?php $theme_info = wp_get_theme(); ?>
<?php wp_enqueue_script( 'fancybox',
  get_template_directory_uri() . '/vendor/fancybox.js',
  array('jquery'), $theme_info->version, true ); ?>

<?php wp_enqueue_style( 'fancybox',
  get_template_directory_uri() . '/vendor/fancybox.css' ); ?>

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
        if ( ! post_password_required() ):
        include('inc/get-photos.php');
        
        if (!isset($_GET['id'])) {
            $folder_id = "1f9X5XMH2YAn2HynZw3_c3WzL2KcxdWI9";
        } else {
            $folder_id = $_GET['id'];
        }
        
        $response = getFolder($folder_id);

        // print_r($response);
        $folders = array_key_exists('folders', $response['items']) ? $response['items']['folders'] : false;
        $photos = array_key_exists('photos', $response['items']) ? $response['items']['photos'] : false;

        if (!$folders && !$photos) { ?>
            <p>Er is hier helaas niks, ga terug naar <a href='./'>de hoofdmap</a> of <a href='/contact'>laat het ons weten</a>.</p>
        <?php } else { ?>

            <p class="photoalbum__button-cont">
                <button href="#" class="button" id="js-slideshow-button">
                    Start slideshow
                </button>
            </p>
                
            <?php if ($folders) { ?>
            <ul class="folders">
                <?php foreach ($folders as $key => $folder) { ?>
                    <li class="folder">
                        <a href="./?id=<?php echo $folder['id']; ?>">
                            <?php echo $folder['name']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <?php } ?>

            <?php if ($photos) { ?>
                <ul class="photos">
                <?php foreach ($photos as $key => $photo) { ?>
                    <li class="photo-cont">
                        <a href="<?php echo esc_url($photo['url']); ?>" class="photo fancybox fancybox.image" rel="group">
                            <img src="<?php echo esc_url($photo['thumbnail']); ?>">
                        </a>
                    </li>
                <?php } ?>
                </ul>
            <?php } ?>

        <?php } 
        endif; ?>


  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
