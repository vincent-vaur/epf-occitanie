<?php
/**
 * Résultats de recherche
 *
 * @package KLX_BS4
 */
/*
get_header(); ?>

        <div class="row no-gutters">
        	
            <div class="col-md-10">
            
            
            	<header class="page-header">
              		<div class="page-header-content">
                        <h1 class="page-title">Résultats de recherche pour&nbsp;:</h1>
                        
                        <div class="page-chapo">
                            <?php echo get_search_query(); ?>
                        </div>
        			</div>
                </header><!-- .entry-header -->
           <?php
			if ( function_exists( 'relevanssi_didyoumean' ) ) {
				relevanssi_didyoumean( get_search_query(), '<p>Vous cherchez peut-être&nbsp;: ', '</p>', 5 );
			};
			?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article class="entry-content">
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><small>'.get_post_type_name( $post ).'&nbsp;: </small><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header><!-- .entry-header -->
                
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                
                </article><!-- #post-## -->
            <?php
                endwhile;
				
				the_posts_pagination( array( 
					'show_all' => true,
					'before_page_number' => '<span class="sr-only">Page </span>',
					'prev_text' => '<i class="icon-angle-left" aria-hidden="true"></i><span class="sr-only">Page précédente</span>', 
					'next_text' => '<span class="sr-only">Page suivante</span><i class="icon-angle-right" aria-hidden="true"></i>',
					'screen_reader_text' => 'Navigation des pages'
				) );
    
            else :
    		?>
            <article class="entry-content">
                <header class="entry-header">
                    <h2 class="entry-title">Rien n'a été trouvé</h2>
                </header><!-- .page-header -->
            
                <div class="entry-content">
                
                    <p>Désolé, aucun contenu ne correspond à ce terme. Veuillez essayer avec un autre terme.</p>
                    
                </div><!-- .entry-content -->
            </article><!-- .no-results -->
    		<?php
            endif; ?>

    		</div><!-- col article -->
            
            <?php get_sidebar(); ?>
		
        </div>
        
<?php 

get_footer();
*/


/**
 * Résultats de recherche
 *
 * @package KLX_BS4
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <div class="row no-gutters">
    <div class="col-12 page-image-container">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail() ?>
      <?php else : ?>
        <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.jpg" ?>" alt="Image de l'article par défaut" />
      <?php endif; ?>
    </div>
  </div>

  <div class="row no-gutters page-content">
    <?php get_template_part("template-parts/sidebar") ?>

    <div class="col-xs-12 col-lg-8 px-5">
      <header class="title-1-block shadow pb-2">
        <?php
        // fil d'ariane : la fonction est dans hook_wp_nav_menu.php
        if (function_exists('c6_nav_menu_breadcrumb')) { c6_nav_menu_breadcrumb(); } 
		?>

        <h1 class="px-5 py-2">
          <?php the_title() ?>
        </h1>

        <p class="px-5 mb-2">
          <?= get_the_excerpt() ?>
        </p>
      </header>

      <article class="mt-5">
        <?php the_content() ?>
      </article>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer();
