jQuery(document).ready(function($) {
  "use strict";

  /*------------------ BURGER MENU ------------------------------------------*/
  $(".burger-btn").click(function() {
    $(".menu-mobile").fadeToggle();

    // On désactive le scroll sur le body
    $("body").toggleClass("overflow-hidden");

    // On cache le logo du site pour une meilleure visibilité
    $("h1:eq(0)").toggle();
  });

  $(".menu-lvl-2-mobile i").click(function() {
    $(".menu-mobile .sub-menu").slideUp();
    $(".menu-lvl-2-mobile .icon-minus").removeClass("icon-minus");

    $(this)
      .toggleClass("icon-minus")
      .parent(".link-wrapper")
      .next(".sub-menu")
      .slideToggle();
  });



  /*-------------- ACCESSIBILITE ----------------------------------------------*/

  $("input,a,select,textarea,button").removeAttr("tabindex");

  // protection des liens target = _blank
  $("[target='_blank']").prop("rel", "noreferrer noopener");

  // ajoute (nouvelle fenêtre) au titre du lien
  $("[target='_blank']").each(function() {
    var title = $(this).attr("title");
    var alt = $(this)
      .find("img")
      .attr("alt");

    var $this = $(this).clone();

    $this.find("span.link-desc").empty();
    var text = $this.text(); // ''
    
    if (typeof title == "undefined") {
      if (text != "") {
        title = text + " (nouvelle fenêtre)";
      } else {
        title = "nouvelle fenêtre";
        
        if (alt != "" && alt !== "undefined") {
          title = alt + " (nouvelle fenêtre)";
        }
      }
    } else {
      title = title + " (nouvelle fenêtre)";
    }

    $(this).attr("title", title);
  });

  // Laisse le focus au champ de recherche si le champ est vide
  $(".search-form ").on("submit", function(event) {
    var s = $(this).find(".search-field");

    if (!s.val()) {
      event.preventDefault();
      s.focus(); // focus on the search input
    }
  });



  //---------------- SCROLL TO TOP ---------------------------------------------------------------

  if ($("#scroll-to-top").length) {
    var toppos = $(window).height() + 200;
    
    $(window).scroll(function() {
      if ($(this).scrollTop() > toppos) {
        $("#scroll-to-top").addClass("fixe");
      } else {
        $("#scroll-to-top").removeClass("fixe");
      }
    });

    // Clic
    $("#scroll-to-top").click(function() {
      $("html, body").animate({ scrollTop: 0 }, 1000, "swing");
      return false;
    });
  }
});
