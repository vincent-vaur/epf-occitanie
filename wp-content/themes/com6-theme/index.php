<?php
/**
 * Page 404
 *
 * @package KLX_BS4
 */
 

get_header(); ?>

        <div class="row no-gutters">
        	
            <div class="col-md-10">
            	
                <article <?php post_class(); ?>>
                
                    <header class="page-header">
                        <div class="page-header-content">
                        	<h1 class="page-title">Page non trouvée</h1> 
                        </div>
                    </header><!-- .entry-header -->
					
                    <article class="entry-content">
						<h2>Aucune page ne correspond à cette requête.</h2>
                        <p>Vous pouvez consulter le <a href="/plan-du-site">plan du site</a>,
                        <p>ou faire une recherche en utilisant ce formulaire : </p>
						<?php get_search_form();?>
                    </article><!-- .entry-content -->
                    

                </article><!-- #post-## -->
                
    		</div><!-- col article -->
            
            <?php get_sidebar(); ?>
         
         </div>
        
        
<?php 

get_footer();
