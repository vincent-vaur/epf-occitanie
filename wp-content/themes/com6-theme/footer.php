<?php
/**
 * Pied de page
 *
 * @package KLX_BS4
 */
?>
      </main><!-- #content -->

      <footer class="row border-top mt-4 px-2 px-sm-5 pt-4">
        <?php if (is_active_sidebar('sidebar-footer')) dynamic_sidebar('sidebar-footer'); ?>

        <?php wp_nav_menu(array(
          'theme_location'    => 'footer',
          'container'         => 'nav',
          'container_id'      => false,
          'container_class'   => 'col my-3 my-sm-5 my-xl-4 text-center',
          'menu_class'        => 'nav',
          'depth'            => 1
        )) ?>
      </footer>

    </div><!-- container -->

    <?php wp_footer(); ?>

    <!--noscript>Javascript n'est pas activé sur votre navigateur. Certaines parties du site peuvent ne pas fonctionner correctement.</noscript-->
  </body>
</html>