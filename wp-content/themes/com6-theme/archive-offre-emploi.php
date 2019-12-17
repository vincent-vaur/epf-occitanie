<?php

/**
 * Page des offres d'emploi
 *
 */

$title   = get_field('titre', 'cpt-offre-emploi');
$excerpt = get_field('chapo', 'cpt-offre-emploi');
$entete_id  = get_field('image_entete', 'cpt-offre-emploi'); // id

get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <?php if ( $entete_id ) : ?>
      <?= wp_get_attachment_image($entete_id, 'entete') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.jpg" ?>" alt="Image de l'article par défaut" />
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
        <?php echo $title ? $title : post_type_archive_title( '', false ); ?>
      </h1>

      <p class="px-5 mb-2">
        <?= $excerpt ?>
      </p>
    </header>

    <section class="mt-5 emplois-list">

      <div class="row p-n5">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class("col-12 px-3 my-5 position-relative") ?>>
              <div class="h-100 shadow">

                <div class="p-4">
                  <h2>
                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                  </h2>

                  <p class=""><?php the_field('type_contrat'); ?></p>
                  
                  <p class="">Date limite de candidature&nbsp;: <?php the_field('date_candidature'); ?></p>
                </div>

                <div class="w-100 position-absolute mt-n5 text-right">
                  <a href="<?php the_permalink(); ?>" class="btn btn-secondary font-weight-normal shadow">Voir l'offre</a>
                </div>
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
          <div class="col">Nous n'avons actuellement aucune offre d'emploi.</div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</div>

<?php get_footer();
