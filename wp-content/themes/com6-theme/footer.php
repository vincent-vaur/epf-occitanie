<?php

/**
 * Bas de page
 *
 * @package WordPress
 * @subpackage Epf_Occitanie
 * @since 1.0.0
 */
?>
    <footer class="row border-top px-2 pt-4">
      <div class="col-12 col-md-6 col-xl-5">
        <i class="d-block fas fa-map-marker-alt text-primary"></i>

        <p class="mt-2 mb-0 font-weight-bold">
          Etablissement Public Foncier d'Occitanie
        </p>

        <address>
          Parc club du Millénaire - Bât.19<br />
          1025 rue Henri Becquerel<br />
          34 000 Montpellier<br />
        </address>
      </div>

      <div class="col-12 col-md-6 col-xl-2">
        <i class="d-block fas fa-phone-alt text-primary"></i>

        <p class="mt-2 mb-0 font-weight-bold">
          Tél :
        </p>

        <p>01 02 03 04 05</p>
      </div>

      <div class="col-12 col-xl-5">
        <a class="btn btn-secondary mr-2 px-4 py-3" href="#">Espace sécurisé</a>
        <a class="btn btn-primary px-4 py-3" href="#">Marchés publics</a>
      </div>

      <?php if (has_nav_menu("footer")) : ?>
        <div class="col my-5 my-xl-4 text-center">
          <?php wp_nav_menu(array(
              'theme_location'  => "footer",
              'container'       => false,
              'items_wrap'      => '<nav class="%2$s">%3$s</nav>',
              'walker'          => new Walker_Menu_No_Ul("text-body"),
            )); ?>
        </div>
      <?php endif; ?>
    </footer>
  </div>

  <?php wp_footer(); ?>
</body>

</html>