<?php
/* breadcrumb par wp_nav_menu */
function c6_nav_menu_breadcrumb() {
	var_dump('test');
    $items = wp_get_nav_menu_items('principal');
    _wp_menu_item_classes_by_context( $items ); // Set up the class variables, including current-classes
    $crumbs = array();

    foreach($items as $item) {
        if ($item->current_item_ancestor || $item->current) {
			$pos = count( $crumbs )+2;
			$class = $item->current ? ' active' : '';
            $crumbs[] = '<li class="breadcrumb-item'.$class.'" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href="'.$item->url.'"><span itemprop="name">'.$item->title.'</span></a><meta itemprop="position" content="'.$pos.'"></li>';
        	if ( $class ) break; // on a trouvé l'éléménent courrant
		}
    }
	var_dump( $crumbs );
	if ( empty( $crumbs ) ) {
		if (function_exists('seopress_display_breadcrumbs'))
        	seopress_display_breadcrumbs();
		return;
	}
	
    $breadcrumb  = '<nav aria-label="breadcrumb">';
	$breadcrumb .= '<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
	$breadcrumb .= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href="'.home_url().'"><span itemprop="name">Accueil</span></a><meta itemprop="position" content="1"></li>';
	$breadcrumb .= implode( '', $crumbs);
	$breadcrumb .= '</ol>';
	$breadcrumb .= '</nav>';
	
	echo $breadcrumb;
}


//----------------------------------------------------------------------------------------------------------------
//
// hooks des menus de navigation           https://wabeo.fr/hook-nav-menus/
//

// Filtre les arguments d'un menu
add_filter( 'wp_nav_menu_args', 'c6_nav_menu_args' );
function c6_nav_menu_args( $args ) {
	$args['fallback_cb'] = '__return_empty_string';
    if ( is_a( $args['menu'], 'WP_Term') && $args['menu']->slug == 'social'){
        $args['menu_class'] = 'nav';
    }
	return $args;
}



/**
 * ajout de classes(ul sous-menu)
 */
 
add_filter( 'nav_menu_submenu_css_class', 'c6_nav_menu_submenu_css_class', 10, 3 );

function c6_nav_menu_submenu_css_class( $classes, $args, $depth ) {

	if ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' ) {
		$classes = array("dropdown-menu", "level-".($depth+1));
	}
	return $classes;
}

/**
 * ajout de classes(li)
 */
 
add_filter( 'nav_menu_css_class', 'c6_nav_menu_css_class', 10, 4 );

function c6_nav_menu_css_class( $classes, $item, $args, $depth ) {

	// supprime les classes de wordpress
	$classes = array_values( $classes );
	$pos = array_search( "menu-item", $classes );
	$new_classes = array_slice( $classes, 0, $pos+1 );
	
	if ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' ) $new_classes[] = "level-".$depth;
	
	// bootstrap classes
	$new_classes[] = ( $depth == 0 ) ? 'nav-item' : ( ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' ) ? 'dropdown-item' : 'nav-item' );
	
	if ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' && in_array('menu-item-has-children', $classes ) ) {
        if ( $depth === 0 ) $new_classes[] = 'dropdown';
		if ( $depth === 1 ) $new_classes[] = 'dropdown-submenu';
	}
	
	
    if ( true == $item->current ) {
        $new_classes[] = 'current';
    }
	
	if ( in_array( 'current-menu-ancestor', $classes ) ) {
		$new_classes[] = 'current-parent';
	}
    return $new_classes;
}

// supprime les id des li ( ex: menu-item-128 )
add_filter( 'nav_menu_item_id', 'c6_nav_menu_item_id', 10, 4 );
function c6_nav_menu_item_id( $id, $item, $args, $depth ) {
	return null;
}

// Modifie la balise <a> 
add_filter( 'walker_nav_menu_start_el', 'c6_walker_nav_menu_start_el', 10, 4 );
function c6_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	
	// remplace le a par un button dropdown s'il y a un sous menu ( menu principal )
	if ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' && in_array('menu-item-has-children', $item->classes ) && $depth == 0 ) {
		$item_output = str_replace( array('<a ','</a>'), array('<button ','</button>'), $item_output );
	}
	return $item_output;
}


// Filtre les attributs appliqués au lien
add_filter( 'nav_menu_link_attributes', 'c6_nav_menu_link_attributes', 10, 4 );
function c6_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	
	// target blank
	if ( !empty($atts['target']) && $atts['target'] == "_blank" )
		$atts['rel'] = "noopener";
	
	$classes = array();

	// classes Bootstrap	
	if ( $depth == 0 ) {
		$classes[] = 'nav-link';
	}
	else
		$classes[] = "nav-link-$depth";
	
	// dropdown pour le menu principal
	if ( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' ) :
		if ( in_array('menu-item-has-children', $item->classes) && $depth < 2 ) {
			$atts['id'] = 'dropdown-'.$item->ID;
			$classes[] = 'dropdown-toggle';
			$atts['data-toggle']  = 'dropdown';
			$atts['aria-haspopup'] = "true";
			$atts['aria-expanded'] = "false";
			$atts['aria-label'] = "Ouvrir/Fermer le sous-menu";
			$atts['data-href'] = $atts['href'];
			if ( $depth == 0 ) unset( $atts['href'] ); else $atts['href'] = "#";
		}
	endif;
	
	
	// attribut aria-current
	if ( true == $item->current ) {
        $atts['aria-current'] = 'page';
    }
	
	if ( in_array( 'current-menu-ancestor',  $item->classes ) )
		$atts['aria-current'] = 'true';		
	
	if ( !empty( $classes ) ) $atts['class'] = join( ' ', $classes );
    
        
/*    if ( $args->menu->slug == 'logo-partenaires-footer'){
        $thumbnail = get_the_post_thumbnail($item->object_id, 'logo-partenaire');
        $post_meta = get_post_meta($item->object_id);
        if ($post_meta['_sponsor_url'][0]){
            $atts['href'] = $post_meta['_sponsor_url'][0];
            $args->after = '<div class="logo-wrapper">' . $thumbnail . '</div>';
        }
        
    }*/
	
	return $atts;
}



// Filtre le titre pour le menu social
// add_filter( 'nav_menu_item_title', 'c6_nav_menu_item_title', 10, 4 );
function c6_nav_menu_item_title( $title, $item, $args, $depth ) {
	if( $args->theme_location == 'social' || $args->menu->slug == 'social' ) {
		$title = '<span class="sr-only">'.$title.'</span>';
	}
	return $title;
}




// Ajout d'élément à un menu
add_filter('wp_nav_menu_items', 'c6_add_to_nav_menu', 10, 2);

function c6_add_to_nav_menu($items, $args) {
  if( $args->theme_location == 'primary' && $args->menu_class == 'navbar-nav' ) {
	  $items .= '<li class="menu-item nav-item dropdown search-item">
					  <button data-toggle="dropdown" class="nav-link dropdown-toggle" aria-controls="menu-search" aria-expanded="false"><i class="icon-loupe"></i><span class="sr-only">Moteur de recherche</span></button>
					  <ul class="dropdown-menu level-0" id="menu-search">
						  <li class="menu-item dropdown-item" id="search-menu">'.get_search_form(array('echo' => false)).'</li>
					  </ul>
				  </li>';
  };
  return $items;
}
