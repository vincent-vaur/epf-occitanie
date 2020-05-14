<?php

/**
 * Affiche le fil d'arianne
 */
function c6_nav_menu_breadcrumb()
{
  // Get all locations
  $locations = get_nav_menu_locations();

  // Get object id by location
  $term_menu = wp_get_nav_menu_object($locations['primary']);

  $items = wp_get_nav_menu_items($term_menu);

  if (empty($items)) {
    return;
  }

  _wp_menu_item_classes_by_context($items); // Set up the class variables, including current-classes
  $crumbs = array();

  foreach ($items as $item) {
    if ($item->current_item_ancestor || $item->current) {
      $pos = count($crumbs) + 2;
      $class = $item->current ? ' active' : '';
      $crumbs[] = '<li class="breadcrumb-item' . $class . '" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href="' . $item->url . '"><span itemprop="name">' . $item->title . '</span></a><meta itemprop="position" content="' . $pos . '"></li>';

      if ($class) {
        break; // on a trouvé l'éléménent courrant
      }
    }
  }

  if (empty($crumbs)) {
    if (function_exists('seopress_display_breadcrumbs')) {
      seopress_display_breadcrumbs();
    }
    
    return;
  }

  $breadcrumb  = '<nav aria-label="breadcrumb">';
  $breadcrumb .= '<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
  $breadcrumb .= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href="' . home_url() . '"><span itemprop="name">Accueil</span></a><meta itemprop="position" content="1"></li>';
  $breadcrumb .= implode('', $crumbs);
  $breadcrumb .= '</ol>';
  $breadcrumb .= '</nav>';

  echo $breadcrumb;
}
