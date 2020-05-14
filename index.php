<?php

/**
 * Page 404
 *
 * @package KLX_BS4
 */


get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
  </div>
</div>

<div class="row no-gutters page-content">
  <div class="offset-1 col-10 px-sm-5 mt-xs-3">
    <header class="title-1-block shadow pb-2">
      <?php
        // fil d'ariane : la fonction est dans hook_wp_nav_menu.php
        if (function_exists('c6_nav_menu_breadcrumb')) {
          c6_nav_menu_breadcrumb();
        } 
      ?>
        
      <h1 class="px-2 px-sm-5 py-2">
        Page non trouvée
      </h1>

      <p class="px-2 px-sm-5 mb-2">
        Aucune page ne correspond à cette requête.
      </p>
    </header>

    <article class="my-5">
      <p>
        Vous pouvez consulter le <a href="/plan-du-site">plan du site</a>, ou faire une recherche en utilisant ce formulaire :
      </p>

      <?php get_search_form() ?>
    </article>
  </div>
</div>

<?php get_footer();
