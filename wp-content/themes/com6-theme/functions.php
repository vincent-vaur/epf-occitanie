<?php

// Ajout des différents walkers utilisé pour générer les menus du site
require_once get_template_directory() . '/inc/Walker_Menu_Primary.php';
require_once get_template_directory() . '/inc/Walker_Menu_No_Ul.php';

/**
 * Menus de navigation
 */
function epf_occitanie_menus()
{
  register_nav_menus(array(
    'top'      => __('Menu du haut de page', 'epfoccitanie'),
    'primary'  => __('Menu principal', 'epfoccitanie'),
    'social'   => __('Menu réseaux sociaux', 'epfoccitanie'),
    'footer'   => __('Menu de bas de page', 'epfoccitanie'),
  ));
}

add_action('init', 'epf_occitanie_menus');

/**
 * CSS et Javascripts
 */
function epf_occitanie_register_styles()
{
  wp_enqueue_style(
    'epf-occitanie-style',
    get_stylesheet_directory_uri() . '/style.css',
    array(),
    wp_get_theme()->get('Version')
  );
}

add_action('wp_enqueue_scripts', 'epf_occitanie_register_styles');
