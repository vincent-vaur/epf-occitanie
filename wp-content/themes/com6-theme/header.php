<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">

  <meta name="description" content="">
  <meta name="author" content="Com6-Interactive">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="container p-0">
    <header class="page-header d-flex flex-wrap mb-4">
      <a href="">
        <img class="shadow mr-4 mb-4" src="assets/logo.png" alt="EPF Occitanie" width="115" height="125" />
      </a>

      <div class="d-flex flex-grow-1">
        <?php if (has_nav_menu("top")) : ?>
          <?php wp_nav_menu(array(
              'theme_location'    => "top",
              'container'         => "div",
              'container_class'   => "flex-grow-1",
              'items_wrap'        => '<nav class="%2$s">%3$s</nav>',
              'menu_class'        => "menu-lvl-1 d-flex justify-content-end text-uppercase",
              'walker'            => new Walker_Menu_No_Ul("mr-2 py-2 px-4 btn btn-secondary"),
            )); ?>
        <?php endif; ?>

        <?php if (has_nav_menu("social")) : ?>
          <?php wp_nav_menu(array(
              'theme_location'    => "social",
              'container'         => false,
              'items_wrap'        => '<nav class="%2$s">%3$s</nav>',
              'menu_class'        => "d-flex ml-4",
              'walker'            => new Walker_Menu_No_Ul("px-3 py-2 btn btn-secondary"),
            )); ?>
        <?php endif; ?>
      </div>

      <?php if (has_nav_menu("primary")) : ?>
        <?php wp_nav_menu(array(
            'theme_location'    => "primary",
            'container'         => false,
            'items_wrap'        => '<nav class="%2$s">%3$s</nav>',
            'menu_class'        => "menu-lvl-2 mt-4 mb-1 d-flex justify-content-center align-items-baseline position-relative w-100",
            'walker'            => new Walker_Menu_Primary(),
          )); ?>
      <?php endif; ?>
    </header>