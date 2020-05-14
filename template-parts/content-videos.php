<article <?php post_class("d-flex flex-column h-100 shadow") ?>>
  <?php the_terms( get_the_ID(), 'cat-docutheque', '<div class="category-label">', '|', "</div>" ); ?>

  <?= get_field("video_oembed") ?>

  <h2 class="px-4 py-3 text-center">
    <a href="<?= get_permalink() ?>"><?php the_title() ?></a>
  </h2>
</article>