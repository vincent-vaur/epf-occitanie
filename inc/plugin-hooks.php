<?php
/*
 * Filtres et actions sur les plugins
 *
 */
// CATEGORIE -----------------------------------------------------------------------------------------------------------
add_filter('template_include', 'template_chooser');  

function template_chooser($template)   
{    
 	global $wp_query;
	$obj = get_queried_object();

  	if ( is_a( $obj, 'WP_Term' ) ) {
		if ( $obj->taxonomy == 'category' )  return locate_template('home.php');
	}
	
	return $template;   
}


// RELEVANSSI ----------------------------------------------------------------------------------------------------------
add_filter( 'relevanssi_indexing_restriction', 'rlv_no_image_attachments' );
function rlv_no_image_attachments( $restriction ) {
    global $wpdb;
    $restriction .= " AND post.ID NOT IN (SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image%' ) ";
    return $restriction;
}

// F4 Media Taxonomies --------------------------------------------------------------------------------------------------
add_action('init', function() {
    register_taxonomy(
        'media_category',
        'attachment'
    );
});


// SEO PRESS PRO --------------------------------------------------------------------------------------------------------

// supprime le séparateur du fil d'ariane ( sinon texte entre 2 <li> pas conforme )
add_filter('seopress_pro_breadcrumbs_sep', '__return_empty_string' );

// supprime le inline-css
add_filter('seopress_pro_breadcrumbs_css', '__return_false' );

add_filter('seopress_pro_breadcrumbs_crumbs', function( $crumbs ) {
	if ( is_singular('docutheque') ) {
		$type_media = get_field('type-media');
		if( $type_media ) {
			$crumbs[1][0] = $type_media->name;
			$crumbs[1][1] = get_term_link($type_media->slug, 'type-media');
		};
	};
	return $crumbs;
} );

add_filter('register_post_type_args', function( $args, $post_type ) {
	if ( $post_type == 'seopress_404' ) $args['rewrite'] = false;
	if ( $post_type == 'seopress_bot' ) $args['rewrite'] = false;
	if ( $post_type == 'seopress_backlinks' ) $args['rewrite'] = false;
	return $args;
}, 10, 2 );


// Tri par ordre alphabétique des contenus
add_filter( 'seopress_sitemaps_html_query', function( $args, $cpt_key ) {
	if ( in_array( $cpt_key, array( 'page' ) ) ) {
		$args['orderby'] = 'name';
		$args['order'] = 'ASC';
	}
	return $args;
},10,2);





// PAGES / ARTICLES AJOUT DE LA VIGNETTE DANS LA LISTE

// Supprime l'image à la une pour les articles / pages
function c6_remove_thumbnail_for_post_page() {
    remove_post_type_support( 'post', 'thumbnail' );
	remove_post_type_support( 'page', 'thumbnail' );
	remove_post_type_support( 'page', 'excerpt' );
	remove_post_type_support( 'post', 'excerpt' );
}
add_action( 'init', 'c6_remove_thumbnail_for_post_page' );

// edit.php : nom des colonnes
add_filter( 'manage_pages_columns', function( $columns ) {
	$columns['entete'] = 'entête';
	return $columns;
});			
	
// edit.php : contenu des colonnes
add_action( 'manage_pages_custom_column', function( $column, $post_id ) {
	if ( $column == 'entete' && $entete_id = get_field('image_entete', $post_id ) ) echo wp_get_attachment_image($entete_id, array(0,100));
}, 10, 2 );
// edit.php : nom des colonnes
add_filter( 'manage_post_posts_columns', function( $columns ) {
	$columns['entete'] = 'entête';
	return $columns;
});			
	
// edit.php : contenu des colonnes
add_action( 'manage_post_posts_custom_column', function( $column, $post_id ) {
	if ( $column == 'entete' && $entete_id = get_field('image_entete', $post_id ) ) echo wp_get_attachment_image($entete_id, array(0,100));
}, 10, 2 );	