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
   * @param $linkClasses    Classes à appliquer aux liens
   * @param $linkAttributes Attributs à appliquer aux liens
   */
  function __construct($linkClasses, $linkAttributes = null)
  {
    $this->linkClasses = $linkClasses;
    $this->linkAttributes = $linkAttributes;
  }

  /**
   * @inheritdoc
   */
  function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
  {
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    !empty($class_names) && $class_names = 'class="' . esc_attr($class_names) . '"';

    $attributes = '';

    !empty($item->attr_title) && $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
    !empty($item->target) && $attributes .= ' target="' . esc_attr($item->target) . '"';
    !empty($item->xfn) && $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
    !empty($item->url) && $attributes .= ' href="' . esc_attr($item->url) . '"';

    $classes = !empty($item->classes) ? $item->classes : [];

    if (!empty($this->linkClasses)) {
      $classes[] = $this->linkClasses;
    }

    !empty($classes) && $attributes .= ' class="' . esc_attr(implode($classes, " ")) . '"';

    !empty($this->linkAttributes) && $attributes .= ' ' . $this->linkAttributes;

    $title = apply_filters('the_title', $item->title, $item->ID);
    
    $item_output = $args->before . "<a$attributes>" . $args->link_before . $title . '</a>' . $args->link_after . $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
