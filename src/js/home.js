/**
 * Utilisation d'une fonction IIFE pour éviter les conflits :p
 * 
 * @see https://developer.mozilla.org/fr/docs/Glossaire/IIFE
 */
(function() {
  /**
   * Lancement des scripts
   */
  function init() {
    initNewsSlider();
    initMissionsSlider();
    initPublicationSlider();
  }

  /**
   * Initialise un slider SLICK avec les options passé
   *
   * Si les selecteurs des boutons "suivant" et "précédent" fournis,
   * attache ces derniers aux fonctions correspondantes du slider.
   *
   * @see https://kenwheeler.github.io/slick/
   *
   * @param {object} options Les options à passer à SLICK
   * @param {string} sliderSelector Le seleteur CSS du slider
   * @param {string} prevButtonSelector Le seleteur CSS du bouton "précédent"
   * @param {string} nextButtonSelector Le seleteur CSS du "suivant"
   */
  function initSlick(options, sliderSelector, prevButtonSelector, nextButtonSelector) {
    const slider = $(sliderSelector);

    slider.slick(options);

    prevButtonSelector &&
      $(prevButtonSelector).click(function(e) {
        e.preventDefault();
        slider.slick("slickPrev");
      });

    nextButtonSelector &&
      $(nextButtonSelector).click(function(e) {
        e.preventDefault();
        slider.slick("slickNext");
      });
  }

  /**
   * Met à jour la puce active du slider des actualités
   */
  function updateLastNewNavigation() {
    $(".home-last-news .navigation li")
      .removeClass("active")
      .eq($(".news .current").index() + 1)
      .addClass("active");
  }

  /**
   * Initialise le slider des actualités.
   * SLICK n'est pas utilisé ici car peu adapté.
   */
  function initNewsSlider() {
    const buttons = $(".home-last-news .navigation .nav-btn");

    // Bouton précédent
    buttons.eq(0).click(function(e) {
      e.preventDefault();

      if ($(".news .current").prev().length) {
        $(".news .current")
          .removeClass("current")
          .prev()
          .addClass("current");

        updateLastNewNavigation();
      }
    });

    // Bouton suivant
    buttons.eq(1).click(function(e) {
      e.preventDefault();

      if ($(".news .current").next().length) {
        $(".news .current")
          .removeClass("current")
          .next()
          .addClass("current");

        updateLastNewNavigation();
      }
    });
  }

  /**
   * Initialise le slider des missions
   */
  function initMissionsSlider() {
    initSlick(
      {
        slidesToShow: 1,
        centerMode: true,
        centerPadding: "0",
        arrows: false,
        variableWidth: true,
      },
      ".icon-list",
      ".missions .nav-btn:first-child",
      ".missions .nav-btn:last-child",
    );
  }

  /**
   * Initialise le slider des publications
   */
  function initPublicationSlider() {
    initSlick(
      {
        slidesToShow: 3,
        centerMode: true,
        centerPadding: "0",
        dots: true,
        arrows: false,
        variableWidth: true,
      },
      ".publication-list",
      ".navigation-buttons a:first-child",
      ".navigation-buttons a:last-child",
    );
  }

  init();
})();
