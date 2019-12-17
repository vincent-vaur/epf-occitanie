<?php
/**
 * Page d'un lément de la docuthèque : publication, album photo, vidéo
 *
 * @package KLX_BS4
 */

// on récupère l'image d'entête du type de média
$type_media = get_field('type-media', $post->ID ); // object WP_Term

if (!$type_media){
  wp_die('Type de média inconnu');
}

$entete_id  = get_field('image_entete', $type_media); // id

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <div class="row no-gutters">
    <div class="col-12 page-image-container">
      <?php if ($entete_id) : ?>
        <?= wp_get_attachment_image($entete_id, 'entete') ?>
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
          if (function_exists('c6_nav_menu_breadcrumb')) {
            c6_nav_menu_breadcrumb();
          }
          ?>

        <h1 class="px-5 py-2">
          <?php the_title() ?>
        </h1>
        <p class="px-5 mb-2"><?php the_field('date_pub'); ?></p>
      </header>

      <article class="mt-5">
        <?php if ($type_media->slug == 'publications') : // Publications
          // lien télécharger
          $doc = get_field('document'); // array

          if (is_array($doc)) :
            $meta = wp_get_attachment_metadata($doc['id']);
            $type = $doc['subtype'];
            $size = size_format($doc['filesize'], $doc['filesize'] < 1000000 ? 0 : 2);
          ?>
            <a download href="<?= $doc['url'] ?>" class="btn btn-secondary font-weight-normal shadow">Télécharger <?= $size ?></a>
          <?php endif;

        // video
        elseif ($type_media->slug == 'videos') : ?>

          <div class="embed-responsive embed-responsive-16by9">
            <?php the_field('video_oembed'); ?>
          </div>

        <?php elseif ($type_media->slug == 'photos') : // galerie
          $photos = get_post_meta($post->ID, 'photos_ids', true);

          if (is_array($photos)) {
            echo do_shortcode('[gallery size="album-photo" link="file" ids="' . implode(',', $photos) . '" ]');
          }
        endif; ?>

        <?php the_content() ?>
      </article>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer();
