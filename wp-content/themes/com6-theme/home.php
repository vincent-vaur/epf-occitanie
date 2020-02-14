<?php

/**
 * Page des articles
 *
 */

// ID de la page des articles : actualités
$page_id = get_option('page_for_posts');

get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <?php if ( $entete_id = get_field('image_entete',$page_id)) : ?>
      <?= wp_get_attachment_image($entete_id, 'entete') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
    <?php endif; ?>
  </div>
</div>

<div class="row no-gutters page-content">
  <?php get_template_part("template-parts/sidebar") ?>

  <div class="col-xs-12 col-lg-8 p-0 px-2 px-md-5">
    <header class="title-1-block shadow pb-2">
      <?php
      // fil d'ariane : la fonction est dans hook_wp_nav_menu.php
      if (function_exists('c6_nav_menu_breadcrumb')) {
        c6_nav_menu_breadcrumb();
      }
      ?>

      <h1 class="px-5 py-2">
        <?= get_the_title($page_id) ?>
      </h1>

      <p class="px-5 mb-2">
        <?= get_field( 'chapo', $page_id ) ?>
      </p>
    </header>

    <section class="mt-5 news-list">
      <?= do_shortcode('[searchandfilter slug="recherche-actu"]') ?>

      <div class="row p-n5">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class("col-xs-12 col-md-6 px-3 my-5 position-relative") ?>>
              <div class="d-flex flex-column h-100 shadow">
                <?php if (has_term('', 'category')) : ?>
                  <div class="category-label">
                    <?php the_category('|') ?>
                  </div>
                <?php endif; ?>

                <?php if ( $image_id = get_field('image_entete') ) : ?>
                  <div class="thumbnail" style="background-image: url(<?= wp_get_attachment_image_url( $image_id, 'article') ?>)">
                    <?php //the_post_thumbnail('largeur-350', ['class' => 'sr-only']) ?>
                  </div>
                <?php endif; ?>

                <div class="p-4 flex-grow-1">
                  <h2>
                    <?php the_title() ?>
                  </h2>

                  <?php the_field( 'chapo' ); ?>
                </div>
              </div>

              <div class="w-100 position-absolute ml-n3 mt-n3 text-center">
                <a href="<?= get_permalink() ?>" class="btn btn-secondary font-weight-normal shadow">+ Lire la suite</a>
              </div>
            </article>
          <?php endwhile; ?>

          <nav class="mt-5 post-pagination mx-auto">
            <?php the_posts_pagination(array(
              'format' => '?paged=%#%',
              'prev_text' => 'Précédent',
              'next_text' => 'Suivant',
              'screen_reader_text' => 'Navigation des pages'
            )); ?>
          </nav>

        <?php else : ?>
          <div class="col">Nous n'avons trouvé aucune actualité correspondant à vos critères.</div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</div>

<?php get_footer();
