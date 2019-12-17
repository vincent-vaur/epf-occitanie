<?php

/**
/**
 * Template Name: Accueil de rubrique
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

    <div class="col-xs-12 col-lg-8 px-5">
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

        <p class="px-5 mb-2">
          <?= get_the_excerpt() ?>
        </p>
      </header>

      <article class="mt-5">
        <?php the_content() ?>
      </article>
      
<?php
  // liste des sous-pages
  $current_menu_item = c6_get_current_menu_item('primary');
  $level = c6_get_current_menu_item_level($current_menu_item);
  $has_children = c6_current_menu_item_has_children($current_menu_item);

  if ($current_menu_item && $has_children) : ?>

      <?php
        wp_nav_menu(array(
          'theme_location'  => 'primary',
          'container'      => 'nav',
          'container_class' => '',
          'menu_class'    => 'list-unstyled',
          //'link_before'    => '<span>',
          //'link_after'    => '</span><i class="icon-right-open" aria-hidden="true"></i>',
          'depth'        => 1,
          'level'        => $level + 1,
          'child_of'      => $current_menu_item->ID
        ));
        ?>

<?php endif; ?>


    </div>
  </div>

<?php endwhile; ?>

<?php get_footer();