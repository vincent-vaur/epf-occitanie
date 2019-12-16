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
    <?php if (has_post_thumbnail($page_id)) : ?>
      <?php get_the_post_thumbnail($page_id, 'medium') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
    <?php endif; ?>
  </div>
</div>

<div class="row no-gutters page-content">
  <?php get_template_part("template-parts/sidebar") ?>

  <div class="col-xs-12 col-lg-8 px-5">
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
        <?= get_the_excerpt($page_id) ?>
      </p>
    </header>

    <section class="mt-5">
      <?= do_shortcode('[searchandfilter slug="recherche-actu"]') ?>

      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class("row no-gutters") ?>>
            <div class="col-md-7">
              <div class="archive-content">
                <?php the_title('<h2 class="entry-title"><a class="post-link" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

                <?php if (has_term('', 'category')): ?>
                  <div class="entry-meta">
                    <?php list_terms_hierarchical('category', ', ', false) ?>
                  </div>
                <?php endif; ?>

                <div class="entry-content">
                  <?php the_excerpt(); ?>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <?php if (has_post_thumbnail()) : ?>
                <div class="page-thumbnail-wrapper">
                  <?php the_post_thumbnail('largeur-350') ?>
                </div>
              <?php endif; ?>
            </div>
          </article>
        <?php endwhile; ?>

        <?php the_posts_pagination(array(
          'mid_size' => 2,
          'before_page_number' => '<span class="sr-only">Page </span>',
          'prev_text' => '<i class="icon-angle-left" aria-hidden="true"></i><span class="sr-only">Page précédente</span>',
          'next_text' => '<span class="sr-only">Page suivante</span><i class="icon-angle-right" aria-hidden="true"></i>',
          'screen_reader_text' => 'Navigation des pages'
        )); ?>

      <?php else : ?>
        <div class="archive-content">Il n'y aucune actualité actuellement.</div>
      <?php endif; ?>
    </section>
  </div>
</div>

<?php get_footer();
