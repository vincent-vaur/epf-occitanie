<?php

/**
 * Carte des sites
 */
$title   = get_field('titre', 'cpt-site');
$excerpt = get_field('chapo', 'cpt-site');
$entete_id  = get_field('image_entete', 'cpt-site'); // id

get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <?php if ($entete_id) : ?>
      <?= wp_get_attachment_image($entete_id, 'entete') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
    <?php endif; ?>
  </div>
</div>

<div class="row no-gutters page-content">

  <?php get_template_part("template-parts/sidebar") ?>

  <div class="col-xs-12 col-lg-8 p-0 px-lg-5">
    <header class="title-1-block shadow pb-2">
      <?php
      // fil d'ariane : la fonction est dans template-function.php
      if (function_exists('c6_nav_menu_breadcrumb')) {
        c6_nav_menu_breadcrumb();
      }
      ?>

      <h1 class="px-5 py-2">
        <?php echo $title ? $title : post_type_archive_title('', false); ?>
      </h1>

      <p class="px-5 mb-2">
        <?= $excerpt ?>
      </p>
    </header>

    <section class="mt-5 news-list sites-list">

      <?php echo do_shortcode('[searchandfilter slug="recherche-sites"]'); ?>

      <div class="row p-n5">

        <?php if (have_posts()) : ?>
          <div id="carteInteractive"></div>

          <div id="results" class="d-none">
            <?php while (have_posts()) : the_post();
              $marker_url = get_theme_file_uri('/images/marker.png');
              /*
                $marker_id = get_term_thumbnail_id($annuaire->term_id);

                if ( $marker_id ) {
                  $marker = wp_get_attachment_image_src( $marker_id );
                  if ( is_array($marker) ) $marker_url = $marker[0];
                };
              */
              $latlng = get_field('localisation', $post->ID);

              if (empty($latlng)) continue;
            ?>
              <article id="post-<?php the_ID(); ?>" data-lat="<?php echo $latlng['lat']; ?>" data-lng="<?php echo $latlng['lng']; ?>" data-marker="<?php echo $marker_url; ?>">

                <h2 class="titre"><?php the_title(); ?></h2>

                <p class="commune"><?php the_field('commune'); ?></p>

                <?php // typologie  
                ?>
                <?php if (has_term('', 'typologie')) : ?>
                  <p class="categorie"><span class="sr-only">Typologie : "</span><?php klx_post_terms('typologie'); ?></p>
                <?php endif; ?>

                <?php // type de convention   
                ?>

                <?php if (has_term('', 'type-convention')) : ?>
                  <p class="categorie"><span class="sr-only">Typologie : "</span><?php klx_post_terms('type-convention'); ?></p>
                <?php endif; ?>

                <?php the_post_thumbnail('medium'); ?>
              </article>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</div>

<?php get_footer();
