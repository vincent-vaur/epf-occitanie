<?php

/**
 * Paramètres du thème
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KLX_BS4
 */

// largeur du contenu
$content_width = 640;

function c6_theme_setup()
{
  // Déclaration des menus
  register_nav_menus(array(
    'top' => 'haut de page',
    'primary' => 'principal',
    'social'  => 'réseaux sociaux',
    'footer'  => 'pied de page',
    'expertises' => 'expertises & missions',
    'rapide' => 'accès rapide'
  ));

  add_theme_support('title-tag');

  add_theme_support('post-thumbnails');

  add_theme_support('automatic-feed-links');

  add_theme_support('responsive-embeds');

  /*
	* Elements à passer en html5
	*/
  add_theme_support('html5', array(
    'gallery',
    'caption',
    'search-form',
    'comment-form',
    'comment-list'
  ));

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  // Logo image
  add_theme_support('custom-logo', array(
    'height'      => 115,
    'width'       => 125,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array('site-title', 'site-description'),
  ));

  // taille des images
  add_image_size('entete', 1200, 458, true); // image d'entête
  add_image_size('slider', 1085, 400, true); // image d'entête
  add_image_size('article', 730, 200, true); // image article page home.php

  /* image des archives ( paysage) */

  /**
   * Ajout des couleurs du thème à Gutenberg
   */
  add_theme_support('editor-color-palette', array(
    array(
      'name'  => __('Titre 1', 'c6'),
      'slug'  => 'c6-primary',
      'color'  => '#e96607',
    ),
    array(
      'name'  => __('Titre 2', 'c6'),
      'slug'  => 'c6-secondary',
      'color' => '#1bbbc5',
    ),
    array(
      'name'  => __('Titre 3', 'c6'),
      'slug'  => 'c6-ternary',
      'color' => '#51479b',
    ),
    array(
      'name'  => __('Standard', 'c6'),
      'slug'  => 'c6-standard',
      'color' => '#212529',
    )
  ));
}

add_action('after_setup_theme', 'c6_theme_setup');

/**
 * Zones de widget
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action('widgets_init', function () {

  register_sidebar(array(
    'name'          => 'Pied de page',
    'id'            => 'sidebar-footer',
    'description'   => 'Zone de widgets du pied de page',
    'before_widget' => '<section id="%1$s" class="widget">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ));
});

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', function () {
  // Internet Explorer HTML5 support
  wp_enqueue_script('html5hiv', get_theme_file_uri() . '/assets/js/html5.js', array(), '3.7.0', false);
  wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');

  // bootstrap
  wp_enqueue_script('c6-bootstrap', get_theme_file_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0', true);
  wp_enqueue_script('c6-skip-link-focus-fix', get_theme_file_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true);

  if (is_front_page()) :
    // Slick Carousel
    wp_enqueue_style('slick-css', get_theme_file_uri('/assets/slick/slick.css'), '1.9');
    wp_enqueue_style('slick-theme', get_theme_file_uri('/assets/slick/slick-theme.css'), '1.9');
    wp_enqueue_script('slick-js', get_theme_file_uri('/assets/slick/slick.min.js'), array('jquery'), '1.9', true);

    // Waypoints
    wp_enqueue_script('waypoints', get_theme_file_uri('/assets/js/waypoints.min.js'), '1.9', true);

    // Scripts de la page d'accueil
    wp_enqueue_script('page-home-js', get_theme_file_uri('/assets/js/page-home.js'), array('jquery', 'slick-js'), filemtime(get_stylesheet_directory() . '/assets/js/page-home.js'), true);
  endif;

  // font css
  wp_enqueue_style('theme-fonts', get_theme_file_uri() . '/assets/fonts/fonts.css', false);

  // font des icones
  wp_enqueue_style('theme-fonts-icons', get_theme_file_uri() . '/assets/fonts/icons/css/epf-occitanie-icons.css', null, filemtime(get_stylesheet_directory() . '/assets/fonts/icons/css/epf-occitanie-icons.css'));

  // theme 
  wp_enqueue_style('theme-style', get_stylesheet_uri(), null, filemtime(get_stylesheet_directory() . '/style.css'));
  wp_enqueue_script('theme-script', get_theme_file_uri() . '/assets/js/theme-script.js', array('jquery', 'c6-bootstrap'), filemtime(get_stylesheet_directory() . '/assets/js/theme-script.js'), true);
  
  // Ajoute les bons prefixe au CSS (-webkit-flex ...) pour gérer correctement les flexbox sur iOS
  wp_enqueue_script('prefixfree', get_theme_file_uri('/assets/js/prefixfree.min.js'), [], null, false);

  // Leaflet
  wp_enqueue_style( 'leaflet', get_theme_file_uri() . '/assets/leaflet/leaflet.css', '1.4.0');
  wp_enqueue_style( 'leaflet-cluster', get_theme_file_uri() . '/assets/leaflet/MarkerCluster.css', '1.4.0');

  wp_enqueue_script('leaflet', get_theme_file_uri() . '/assets/leaflet/leaflet.js', NULL, '1.4.0', true );
  wp_enqueue_script('leaflet-cluster', get_theme_file_uri() . '/assets/leaflet/leaflet.markercluster.js', array('leaflet'), NULL, true );
  wp_enqueue_script('leaflet-script', get_theme_file_uri() . '/assets/leaflet/carte.js', array('leaflet'), NULL, true );

  wp_enqueue_script('carte-interactive-regions', get_theme_file_uri() . '/assets/leaflet/data/regions.js', array('leaflet'), NULL, true );
  wp_enqueue_script('carte-interactive-cities', get_theme_file_uri() . '/assets/leaflet/data/cities.js', array('leaflet'), NULL, true );
});

// supprime les sections inutiles du customizer
add_action('customize_register', function ($wp_customize) {
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  $wp_customize->remove_section('custom_css');
});

/**
 * Ajout/suppression de classes à <body>
 *
 * @param array $classes Classes de l'élément <body>
 * @return array
 */
function c6_body_classes($classes)
{
  if (is_home() || is_tax()) $classes[] = 'archive';
  return $classes;
}
add_filter('body_class', 'c6_body_classes');

/**
 * Hooks sur les plugins
 */
require get_template_directory() . '/inc/plugin-hooks.php';

// Fonctions utilisées dans le thème
require get_template_directory() . '/inc/template-functions.php';

// Ajout des différents walkers utilisé pour générer les menus du site
require_once get_template_directory() . '/inc/Walker_Menu_Primary.php';
require_once get_template_directory() . '/inc/Walker_Menu_No_UL.php';
