<article <?php post_class("d-flex flex-column h-100 shadow position-relative") ?>>
  <?php if (has_post_thumbnail()) : ?>
    <a href="<?= get_permalink() ?>">
      <?= get_the_post_thumbnail(NULL, NULL, ['class' => 'w-100 h-auto']) ?>
    </a>
  <?php endif; ?>

  <h2 class="px-4 pt-4 pb-5 flex-grow-1">
    <a href="<?= get_permalink() ?>"><?php the_title() ?></a>
  </h2>

  <div class="link-btn">
    <a class="px-4 btn btn-secondary font-weight-normal shadow text-center" href="<?= get_permalink() ?>">
      Voir l'album
    </a>
  </div>

  <?php // photos_ids ?>
</article>