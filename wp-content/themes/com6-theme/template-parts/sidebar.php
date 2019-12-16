<?php
/**
 * Colonne latérale
 *
 * @package KLX_BS4
 */
?>
<aside class="col-xs-12 col-lg-3 px-2 px-md-5 px-lg-0 left">
  <?php if (!is_front_page()) get_template_part('bloc', 'partage'); ?>

  <?php
  // liste des sous-pages
  $current_menu_item = c6_get_current_menu_item('primary');
  $level = c6_get_current_menu_item_level($current_menu_item);
  $has_children = c6_current_menu_item_has_children($current_menu_item);

  if (!is_page_template('tpl-accueil-rubrique.php') && $current_menu_item && $has_children) : ?>
    <div class="related-menu shadow">
      <h4><?php echo $current_menu_item->title; ?></h4>

      <?php
        wp_nav_menu(array(
          'theme_location'  => 'primary',
          'container'      => 'nav',
          'container_class' => '',
          'menu_class'    => 'list-unstyled',
          'link_before'    => '<span>',
          'link_after'    => '</span><i class="icon-right-open" aria-hidden="true"></i>',
          'depth'        => 1,
          'level'        => $level + 1,
          'child_of'      => $current_menu_item->ID
        ));
        ?>
    </div>
  <?php endif; ?>
</aside>