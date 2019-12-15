<?php
/**
 * Générateur de menu supprimer les ul et li de base mis par Wordpress.
 */
class Walker_Menu_No_Ul extends Walker_Nav_Menu
{
  /**
   * @var $linkClasses Classes à appliquer aux liens
   */
  private $linkClasses;

  /**
   * @param $linkClasses Classes à appliquer aux liens
   */
  function __construct($linkClasses)
  {
    $this->linkClasses = $linkClasses;
  }

  /**
   * @inheritdoc
   */
  function start_el(&$output, $item, $depth, $args)
  {
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    !empty($class_names) && $class_names = 'class="' . esc_attr($class_names) . '"';

    $attributes = '';

    !empty($item->attr_title) && $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
    !empty($item->target) && $attributes .= ' target="' . esc_attr($item->target) . '"';
    !empty($item->xfn) && $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
    !empty($item->url) && $attributes .= ' href="' . esc_attr($item->url) . '"';
    !empty($this->linkClasses) && $attributes .= ' class="' . esc_attr($this->linkClasses) . '"';

    $title = apply_filters('the_title', $item->title, $item->ID);
    
    $item_output = $args->before . "<a$attributes>" . $args->link_before . $title . '</a>' . $args->link_after . $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
