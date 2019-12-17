<?php

/**
 * Pages docuthèque publicatiosn/photos/videos
 *
 */
$current_term = get_queried_object();
$entete_id  = get_field('image_entete', $current_term); // id

get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <?php if ($entete_id) : ?>
      <?= wp_get_attachment_image($entete_id, 'entete') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.jpg" ?>" alt="Image de l'article par défaut" />
    <?php endif; ?>
  </div>
</div>

<div class="row no-gutters page-content">
  <?php get_template_part("template-parts/sidebar") ?>

  <div class="col-xs-12 col-lg-8 p-0 px-2 px-md-5">
    <header class="title-1-block shadow pb-2">
      <?php
      // fil d'ariane : la fonction est dans template-function.php
      if (function_exists('c6_nav_menu_breadcrumb')) {
        c6_nav_menu_breadcrumb();
      }
      ?>

      <h1 class="px-5 py-2">
        <?php single_term_title(); ?>
      </h1>

      <p class="px-5 mb-2">
        <?= term_description(); ?>
      </p>
    </header>

    <section class="mt-5 medias-list <?= $current_term->slug ?>-list">
      <ul class="medias-nav mb-5 list-unstyled">
        <li class="cat-item flex-grow-1"></li>
        <?php wp_list_categories(
          array(
            'show_option_none' => "",
            'orderby' => 'term_id',
            'taxonomy' => $current_term->taxonomy,
            'current_category' => $current_term->term_id,
            'hide_empty' => 0,
            'title_li' => false
          )
        ); ?>
      </ul>

      <?= do_shortcode('[searchandfilter slug="recherche-docutheque"]'); ?>

      <div id="results" class="row p-n5">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post();
            $type_media = get_type_media(get_the_ID()); ?>
            
            <div class="px-3 my-5 col-xs-12 col-md-6 <?= ($type_media != 'videos') ? 'col-xl-4' : '' ?>">
              <?php get_template_part('template-parts/content', $type_media); ?>
            </div>
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
          <div class="col">Aucun document ne correspond à cette requête.</div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</div>

<?php get_footer();
