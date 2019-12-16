<?php

/**
 * Entête
 *
 * @package KLX_BS4
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <script src="https://kit.fontawesome.com/36c54b66e9.js" crossorigin="anonymous"></script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <?php if ($items = wp_get_nav_menu_items("acces-rapide")) : ?>
    <aside class="rapid-access d-none d-lg-block">
      <?php foreach ($items as $post) : ?>
        <?php setup_postdata($post) ?>
        <?php $isDocutheque = $post->object === 'docutheque' ?>

        <a class="d-block my-4 text-center" <?= $isDocutheque ? 'download' : '' ?> href="<?= $isDocutheque ? get_field('document', $post->object_id)['url'] : $post->url ?>">
          <img class="d-block" src="<?= get_field("icone-menu") ?>">
          <?= $post->title ?>
        </a>

        <?php wp_reset_postdata() ?>
      <?php endforeach; ?>
    </aside>
  <?php endif; ?>

  <div class="container-fluid overflow-hidden p-0">
    <header class="page-header d-flex flex-wrap mb-4">
      <?php $theme_logo_url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full') ?>

      <a href="/">
        <h1>
          <img class="shadow mr-4 mb-4" src="<?= $theme_logo_url[0] ?>" alt="EPF Occitanie" width="115" height="125" />
        </h1>
      </a>

      <div class="d-flex flex-grow-1 flex-column">
        <div class="d-flex align-self-baseline w-100">
          <div class="flex-grow-1"></div>

          <div class="menu-wrapper d-flex">
            <?php if (has_nav_menu("top")) : ?>
              <?php wp_nav_menu(array(
                  'theme_location'  => "top",
                  'container'       => "div",
                  'container_class' => "flex-grow-1",
                  'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
                  'menu_class'      => "menu-lvl-1 d-flex justify-content-end text-uppercase",
                  'walker'          => new Walker_Menu_No_UL("mr-2 py-2 px-4 btn"),
                )); ?>
            <?php endif; ?>

            <?php if (has_nav_menu("social")) : ?>
              <?php wp_nav_menu(array(
                  'theme_location'  => "social",
                  'container'       => false,
                  'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
                  'menu_class'      => "menu-social d-flex ml-4",
                  'link_before'     => '<span class="sr-only">',
                  'link_after'      => '</span>',
                  'walker'          => new Walker_Menu_No_UL("px-3 py-2 btn", 'target="_blank"'),
                )); ?>
            <?php endif; ?>
          </div>
        </div>

        <?php if (has_nav_menu("primary")) : ?>
          <?php wp_nav_menu(array(
              'theme_location'  => "primary",
              'depth'           => 2,
              'container'       => false,
              'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
              'menu_class'      => "menu-lvl-2 mt-4 mb-1 d-flex justify-content-center align-items-baseline position-relative w-100",
              'walker'          => new Walker_Menu_Primary(),
            )); ?>
        <?php endif; ?>
      </div>
    </header>

    <main id="content">