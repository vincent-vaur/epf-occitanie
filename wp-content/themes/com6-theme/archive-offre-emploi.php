<?php

/**
 * Page des offres d'emploi
 *
 */

$title   = get_field('titre', 'cpt-offre-emploi');
$excerpt = get_field('chapo', 'cpt-offre-emploi');
$entete_id  = get_field('image_entete', 'cpt-offre-emploi'); // id

get_header(); ?>

<div class="row no-gutters">
  <div class="col-12 page-image-container">
    <?php if ( $entete_id ) : ?>
      <?= wp_get_attachment_image($entete_id, 'entete') ?>
    <?php else : ?>
      <img src="<?= get_template_directory_uri() . "/assets/post-default-thumbnail.png" ?>" alt="Image de l'article par défaut" />
    <?php endif; ?>
  </div>
</div>

<div class="row no-gutters page-content">
  <?php get_template_part("template-parts/sidebar") ?>

  <div class="col-xs-12 col-lg-8 px-2 px-sm-5">
    <header class="title-1-block shadow pb-2">
      <?php
      // fil d'ariane : la fonction est dans template-function.php
      if (function_exists('c6_nav_menu_breadcrumb')) {
        c6_nav_menu_breadcrumb();
      }
      ?>

      <h1 class="px-2 px-sm-5 py-2">
        <?php echo $title ? $title : post_type_archive_title( '', false ); ?>
      </h1>

      <p class="px-2 px-sm-5 mb-2">
        <?= $excerpt ?>
      </p>
    </header>

	<?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="job_add d-flex my-5 px-5 py-4 w-100 shadow">
            <div class="flex-grow-1">
            <h2 class="m-0 text-body"><?php the_title() ?></h2>
        
                <p class="my-4"><?= get_field('type_contrat') ?></p>
        
                <p class="my-4"><?= get_field('lieu') ?></p>
        
                <p class="m-0 font-weight-bold">
                <span class="text-uppercase">Date limite de candidature : </span>
                <?= get_field('date_candidature') ?>
                </p>
            </div>
        
            <a class="btn btn-secondary align-self-end" href="<?= get_post_permalink() ?>">Candidater</a>
        </article>
      <?php endwhile; ?>
	  
      <nav class="mt-5 post-pagination mx-auto">
      <?php the_posts_pagination(array(
        'mid_size' => 2,
        'before_page_number' => '<span class="sr-only">Page </span>',
        'prev_text' => '<i class="icon-angle-left" aria-hidden="true"></i><span class="sr-only">Page précédente</span>',
        'next_text' => '<span class="sr-only">Page suivante</span><i class="icon-angle-right" aria-hidden="true"></i>',
        'screen_reader_text' => 'Navigation des pages'
      )); ?>
      </nav>

    <?php else : ?>
      <p>Il n'y a actuellement aucune offre d'emploi.</p>
    <?php endif; ?>

  </div>
</div>

<?php get_footer();
