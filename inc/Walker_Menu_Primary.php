<?php
/**
 * Générateur du menu principal
 */
class Walker_Menu_Primary extends Walker_Nav_Menu
{
  /**
   * @inheritdoc
   */
  function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
  {
    if ($depth === 0) {
      $output .= '<div>';
    }

    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    !empty($class_names) && $class_names = 'class="' . esc_attr($class_names) . '"';

    $attributes = '';

    !empty($item->attr_title) && $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
    !empty($item->target) && $attributes .= ' target="' . esc_attr($item->target) . '"';
    !empty($item->xfn) && $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
    !empty($item->url) && $attributes .= ' href="' . esc_attr($item->url) . '"';

    $title = apply_filters('the_title', $item->title, $item->ID);
    
    $item_output = $args->before . "<a$attributes>" . $args->link_before . $title . '</a>' . $args->link_after . $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  /**
   * @inheritdoc
   */
  function end_el(&$output, $item, $depth = 0, $args = NULL)
  {
    if ($depth === 0) {
      $output .= '</div>';
    }
  }

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '<div class="sub-menu row shadow">';
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</div>';
  }
}
