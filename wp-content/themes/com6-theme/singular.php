<?php
/**
 * Template des pages
 *
 * @package KLX_BS4
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

    <div class="col-xs-12 col-lg-8 px-2 px-sm-5 mt-xs-3">
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
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer();
