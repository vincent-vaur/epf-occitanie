<article <?php post_class("d-flex flex-column h-100 shadow position-relative") ?>>
  <?php if (has_post_thumbnail()) : ?>
    <a href="<?= get_permalink() ?>">
      <?= get_the_post_thumbnail(NULL, NULL, ['class' => 'w-100 h-auto']) ?>
    </a>
  <?php endif; ?>

  <h2 class="px-4 pt-4 pb-2 flex-grow-1">
    <a href="<?= get_permalink() ?>"><?php the_title() ?></a>
  </h2>

  <p class="px-4 pb-4 text-uppercase"><?php the_field('date_pub'); ?></p>

  <?php
  $doc = get_field('document'); // array

  if (is_array($doc)) :
    $meta = wp_get_attachment_metadata($doc['id']);
    $type = $doc['subtype'];
    $size = size_format($doc['filesize'], $doc['filesize'] < 1000000 ? 0 : 2); ?>

    <div class="link-btn px-4">
      <a class="d-flex align-items-baseline btn btn-secondary font-weight-normal shadow" download href="<?= $doc['url'] ?>">
        <i class="icon icon-download"></i>
        <span class="flex-grow-1">Télécharger</span>
        <span class="size"><?= $size ?></span>
      </a>
    </div>
  <?php endif; ?>
</article>