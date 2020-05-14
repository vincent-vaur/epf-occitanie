<?php

/**
 * Page d'une offre d'emploi
 *
 * @package KLX_BS4
 */


// on récupère l'image de la page Offres d'emploi
$entete_id  = get_field('image_entete', 'cpt-offre-emploi'); // id

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

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

    <div class="col-xs-12 col-lg-8 px-2 px-sm-5">
      <header class="title-1-block shadow pb-2">
        <?php
          // fil d'ariane : la fonction est dans hook_wp_nav_menu.php
          if (function_exists('c6_nav_menu_breadcrumb')) {
            c6_nav_menu_breadcrumb();
          }
        ?>

        <h1 class="px-5 py-2">
          <?php the_title() ?>
        </h1>

        <div class="d-flex">
          <div class="flex-grow-1">
            <p class="px-2 px-sm-5 mb-2"><?php the_field('type_contrat'); ?></p>

            <p class="px-2 px-sm-5 mb-2"><?php the_field('lieu'); ?></p>

            <p class="px-2 px-sm-5 mb-2 font-weight-bold">
              <span class="text-uppercase">Date limite de candidature : </span>
              <?= get_field('date_candidature') ?>
            </p>
          </div>

          <?= do_shortcode('[caldera_form_modal id="CF5df39a49cd33e"]Postuler[/caldera_form_modal]') ?>
        </div>
      </header>

      <article class="my-5">
        <?php the_content() ?>

        <div class="mt-5 text-center">
          <?= do_shortcode('[caldera_form_modal id="CF5df39a49cd33e"]Postuler[/caldera_form_modal]') ?>
        </div>
      </article>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer();
