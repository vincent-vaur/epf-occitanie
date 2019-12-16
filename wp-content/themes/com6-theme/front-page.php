<?php

/**
 * Template de la page d'accueil
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
  <?php if ($news = get_field('actualites')) : ?>
    <section class="row no-gutters mt-0 justify-content-center position-relative home-last-news">
      <h2 class="mt-1 ml-4 position-absolute display-4 text-secondary font-weight-bold text-uppercase">
        à la une
      </h2>

      <div class="col-xs-12 col-lg-10 col-xl-8">
        <div class="news">
          <?php foreach ($news as $index => $post) : ?>
            <?php setup_postdata($post) ?>

            <div class="row news-wrapper <?= $index === 0 ? 'current' : '' ?>">
              <?php the_post_thumbnail() ?>

              <div class="col-12 offset-md-6 col-md-7 offset-lg-5 col-lg-7 content-wrapper">
                <div class="py-4 px-5 content shadow">
                  <h3>
                    <a class="text-body" href="<?php the_permalink() ?>">
                      <?php the_title() ?>
                    </a>
                  </h3>
                </div>
              </div>
            </div>

            <?php wp_reset_postdata() ?>
          <?php endforeach; ?>

          <div class="row nav-container">
            <nav class="col-12 col-md-5 navigation">
              <ul class="list-unstyled">
                <li>
                  <a class="nav-btn" href="#"><span class="sr-only">Actualité précédente</span></a>
                </li>

                <?php foreach ($news as $index => $post) : ?>
                  <?php setup_postdata($post) ?>

                  <li class="<?= $index === 0 ? 'active' : '' ?>">
                    <a href="<?= get_permalink($post->ID) ?>"><span class="sr-only">Actualité <?= $index + 1 ?></span></a>
                  </li>

                  <?php wp_reset_postdata() ?>
                <?php endforeach; ?>

                <li>
                  <a class="nav-btn" href="#"><span class="sr-only">Actualité suivante</span></a>
                </li>
              </ul>
            </nav>

            <div class="w-100"></div>

            <div class="col-12 col-md-5 text-center">
              <a class="mb-3 mx-5 shadow btn btn-secondary text-uppercase" href="/actualites">
                Toute l'actu
                <i class="icon icon-left"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($expertises = wp_get_nav_menu_items("expertises")) : ?>
    <section class="missions row justify-content-center">
      <div class="col-xs-12 col-lg-8">
        <h2 class="ml-2 mt-1 text-center text-body">
          Expertise <span class="text-secondary">&</span> <strong>missions</strong>
        </h2>

        <div class="position-relative">
          <a class="nav-btn" href="#">
            <i class="icon-left-open text-body"></i>
          </a>

          <div class="icon-list mx-5">
            <?php foreach ($expertises as $index => $post) : ?>
              <?php setup_postdata($post) ?>

              <div>
                <a href="<?= $post->url ?>">
                  <img src="<?= get_field("icone-menu") ?>">
                  <?php the_title() ?>
                </a>
              </div>

              <?php wp_reset_postdata() ?>
            <?php endforeach; ?>
          </div>

          <a class="nav-btn" href="#">
            <i class="icon-right-open text-body"></i>
          </a>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="row no-gutters justify-content-center" role="presentation">
    <div class="col-xs-12 col-lg-8">
      <div class="row justify-content-center">
        <div class="divider col-5 bg-primary">&nbsp;</div>
        <div class="divider col-2"></div>
        <div class="divider col-5 bg-primary">&nbsp;</div>
      </div>
    </div>
  </section>

  <?php if ($publications = get_field('publications')) : ?>
    <section class="publications">
      <div class="navigation-buttons d-flex justify-content-around">
        <a href="#"><span class="sr-only">Publication précédente</span></a>
        <a href="#"><span class="sr-only">Publication suivante</span></a>
      </div>

      <div class="col-11 col-lg-8 col-xl-7 ovale text-center">
        <h2 class="my-2 pt-3 text-body">
          Nos<br />
          <strong>Publications</strong>
        </h2>

        <p class="font-italic">Retrouvez l'ensemble de nos documents à télécharger</p>
      </div>

      <nav class="publication-list">
        <?php foreach ($publications as $post) : ?>
          <?php setup_postdata($post) ?>
          <?php $document = get_field('document') ?>

          <div class="publication">
            <h3 class="mb-5 h5 font-weight-bold"><?php the_title() ?></h3>

            <footer>
              <small class="flex-grow-1 text-muted">
                <span class="text-uppercase"><?= $document['subtype'] ?></span> |
                <?= size_format($document['filesize'], $document['filesize'] < 1000000 ? 0 : 2) ?>
              </small>

              <a href="<?= $document['url'] ?>" download>Télécharger</a>
            </footer>
          </div>

          <?php wp_reset_postdata() ?>
        <?php endforeach; ?>
      </nav>

      <a class="all position-absolute btn btn-primary" href="<?php echo get_term_link('publications', 'type-media'); ?>">Toutes les publications</a>
    </section>
  <?php endif; ?>

  <?php if ($numbers = [get_field('bloc_1'), get_field('bloc_2'), get_field('bloc_3')]) : ?>
    <section class="number-list row align-items-baseline no-gutters text-center text-white">
      <?php foreach ($numbers as $number) : ?>
        <div class="number-container col-4 d-flex flex-column align-items-center">
          <p class="figure font-weight-bold"><?= $number['chiffre'] ?></p>
          <img src="<?= $number['logo'] ?>" />
          <p class="label mt-4 font-weight-bold"><?= $number['texte'] ?></p>
        </div>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>

  <section class="map row no-gutters align-items-center">
    <div class="col-xs-12 col-lg-10 left">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-xl-7">
          <h2 class="display-4 text-body">
            Cartographie<br />
            des <strong class="font-weight-bold">sites</strong>
          </h2>

          <p class="my-4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>

          <form>
            <div class="input-group">
              <input class="form-control form-control-lg" type="text" placeholder="Rechercher une commune" aria-label="Rechercher une commune">
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button">OK</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <p class="watermark font-weight-bold">Carte</p>
    </div>

    <div class="col-xs-12 col-sm-5 right">
      <img src="<?= get_bloginfo('template_url') ?>/assets/carte-occitanie.svg" />
    </div>
  </section>
<?php endwhile; ?>

<?php get_footer();
