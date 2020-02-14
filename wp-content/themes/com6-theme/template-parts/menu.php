<header class="page-header d-none d-lg-flex mb-4">
  <?php $theme_logo_url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full') ?>

  <a href="/">
    <h1>
      <img class="shadow mr-4 mb-4" src="<?= $theme_logo_url[0] ?>" alt="EPF Occitanie" width="115" height="125" />
    </h1>
  </a>

  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-self-baseline w-100">
      <div class="flex-grow-1"></div>
      
      <i class="d-flex d-lg-none align-items-center mr-3 burger-btn icon icon-menu"></i>

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
        
        <?php get_search_form() ?>
      </div>
    </div>

    <?php if (has_nav_menu("primary")) : ?>
      <?php wp_nav_menu(array(
          'theme_location'  => "primary",
          'depth'           => 2,
          'container'       => false,
          'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
          'menu_class'      => "menu-lvl-2 d-none d-lg-flex",
          'before'          => '<div class="link-wrapper"><i class="d-inline-block d-lg-none icon icon-plus"></i>',
          'after'          => '</div>',
          'walker'          => new Walker_Menu_Primary(),
        )); ?>
    <?php endif; ?>
  </div>
</header>
