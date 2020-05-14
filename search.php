<?php

/**
 * Résultats de recherche
 *
 * @package KLX_BS4
 */
get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
  </div>
</div>

<div class="row no-gutters page-content">
  <div class="offset-1 col-10 px-sm-5 mt-xs-3">
    <header class="title-1-block shadow pb-2">
      <?php
        // fil d'ariane : la fonction est dans hook_wp_nav_menu.php
        if (function_exists('c6_nav_menu_breadcrumb')) {
          c6_nav_menu_breadcrumb();
        }
      ?>

      <h1 class="px-2 px-sm-5 py-2">
        Résultats de votre recherche
      </h1>
    </header>

    <div class="my-5 post-list">
      <?php while (have_posts()) : the_post(); ?>
        <a href="<?= get_the_permalink() ?>">
          <article class="my-5 row no-gutters align-items-center">
            <div class="col-2 p-2">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('thumbnail') ?>
                <?php else : ?>
                  <img class="w-100" src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
                <?php endif; ?>
            </div>

            <div class="col-10 p-4">
              <h3 class="mt-0"><?php the_title() ?></h3>
              <p><?= get_field('chapo') ? get_field('chapo') : get_the_excerpt() ?></p>
            </div>
          </article>
         </a>
      <?php endwhile; ?>
    </div>

    <nav class="mt-5 post-pagination mx-auto">
      <?php the_posts_pagination(array(
        'format' => '?paged=%#%',
        'prev_text' => 'Précédent',
        'next_text' => 'Suivant',
        'screen_reader_text' => 'Navigation des pages'
      )); ?>
    </nav>
  </div>
</div>

<?php get_footer();
