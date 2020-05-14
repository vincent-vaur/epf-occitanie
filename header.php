<?php

/**
 * Entête
 *
 * @package KLX_BS4
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <?php if ($items = wp_get_nav_menu_items("acces-rapide")) : ?>
    <aside class="rapid-access d-none d-lg-block">
      <?php foreach ($items as $post) : ?>
        <?php setup_postdata($post) ?>
        <?php $isDocutheque = $post->object === 'docutheque' ?>

        <a class="d-block my-4 text-center" <?= $isDocutheque ? 'download' : '' ?> href="<?= $isDocutheque ? get_field('document', $post->object_id)['url'] : $post->url ?>">
          <img class="d-block" src="<?= get_image_b64_src( get_field("icone-menu") ) ?>" alt="">
          <?= $post->title ?>
        </a>

        <?php wp_reset_postdata() ?>
      <?php endforeach; ?>
    </aside>
  <?php endif; ?>

  <div class="container-fluid overflow-hidden p-0">
    <?php locate_template("template-parts/menu.php", true) ?>
    <?php locate_template("template-parts/menu-mobile.php", true) ?>

    <main id="content">