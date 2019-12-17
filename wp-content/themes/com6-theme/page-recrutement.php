<?php

/**
 * Page recrutement
 *
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <div class="row no-gutters">
    <div class="col-12 page-image-container">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail() ?>
      <?php else : ?>
        <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.jpg" ?>" alt="Image de l'article par défaut" />
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

        <h1 class="px-2 px-sm-5 py-2">
          <?php the_title() ?>
        </h1>

        <p class="px-2 px-sm-5 mb-2">
          <?= get_the_excerpt() ?>
        </p>
      </header>

      <article class="mt-5">
        <?php the_content() ?>
      </article>

      <?php 
        $paged = max(1, get_query_var('paged'));

        $query = new WP_Query(array(
          'post_type' => 'offre-emploi',
          'posts_per_page' => get_option('posts_per_page'),
          'paged' => $paged
        ));
      ?>

      <?php if ($query->have_posts()) : ?>

        <?php while ($query->have_posts()) : $query->the_post(); ?>
          <article class="job_add d-flex my-5 px-5 py-4 w-100 shadow">
            <div class="flex-grow-1">
              <h2 class="m-0 text-body"><?php the_title() ?></h2>

              <p class="my-4"><?= get_field('type_contrat') ?></p>

              <p class="my-4"><?= get_field('lieu') ?></p>

              <p class="m-0 font-weight-bold">
                <span class="text-uppercase">Date limite de candidature : </span>
                <?= get_field('date_candidature') ?>
              </p>
            </div>

            <a class="btn btn-secondary align-self-end" href="<?= get_post_permalink() ?>">Voir l'offre</a>
          </article>
        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

        <nav class="post-pagination mx-auto">
          <?= paginate_links(array(
              'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'format' => '?paged=%#%',
              'current' => $paged,
              'total' => $query->max_num_pages,
              'show_all' => false,
              'prev_text' => 'Précédent',
              'next_text' => 'Suivant'
            )) ?>
        </nav>

      <?php else : ?>

        <p>Il n'y a actuellement aucune offre d'emploi</p>

      <?php endif; ?>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer();
