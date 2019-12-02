<?php

add_action('wp_enqueue_scripts', 'epf_occitanie_enqueue_styles');

function epf_occitanie_enqueue_styles()
{

  $parent_style = 'twentytwenty-style';

  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');

  wp_enqueue_style(
    'epf-occitanie-style',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version')
  );
}
