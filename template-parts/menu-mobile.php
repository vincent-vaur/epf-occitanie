<header class="page-header-mobile d-flex d-lg-none mb-2">
  <?php $theme_logo_url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full') ?>

  <a href="/">
    <h1>
      <img class="shadow" src="<?= $theme_logo_url[0] ?>" alt="EPF Occitanie" width="60" height="65" />
    </h1>
  </a>

  <div class="flex-grow-1"></div>

  <i class="d-flex align-items-center burger-btn icon icon-menu"></i>

  <div class="menu-mobile">
    <?php get_search_form() ?>
    
    <div class="menu-top">
      <?php if (has_nav_menu("top")) : ?>
        <?php wp_nav_menu(array(
            'theme_location'  => "top",
            'container'       => false,
            'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
            'menu_class'      => "menu-lvl-1-mobile",
            'walker'          => new Walker_Menu_No_UL("mr-2 py-2 px-4 btn"),
          )); ?>
      <?php endif; ?>

      <div class="divider"></div>

      <?php if (has_nav_menu("social")) : ?>
        <?php wp_nav_menu(array(
            'theme_location'  => "social",
            'container'       => false,
            'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
            'menu_class'      => "menu-social-mobile",
            'link_before'     => '<span class="sr-only">',
            'link_after'      => '</span>',
            'walker'          => new Walker_Menu_No_UL("", 'target="_blank"'),
          )); ?>
      <?php endif; ?>
    </div>

    <?php if (has_nav_menu("primary")) : ?>
      <?php wp_nav_menu(array(
          'theme_location'  => "primary",
          'depth'           => 2,
          'container'       => false,
          'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
          'menu_class'      => "menu-lvl-2-mobile",
          'before'          => '<div class="link-wrapper"><i class="icon icon-plus"></i>',
          'after'          => '</div>',
          'walker'          => new Walker_Menu_Primary(),
        )); ?>
    <?php endif; ?>
  </div>
</header>
