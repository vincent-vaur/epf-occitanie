<?php
/**
 * Template principal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Epf_Occitanie
 * @since 1.0.0
 */
get_header();

if ( have_posts() ) {

  while ( have_posts() ) {
    the_post();
    get_template_part( 'template-parts/content', get_post_type() );
  }
}

get_footer();
