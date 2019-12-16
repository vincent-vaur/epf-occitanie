jQuery( document ).ready( function( $ ) {

    'use strict';
	
/*------------------ COOKIES ----------------------------------------------*/
	
	// création/mise à jour d'un cookie
	var KLXcreateCookie = function(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	
	// lecture d'un cookie
	var KLXreadCookie = function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
		
/*-------------- ACCESSIBILITE ----------------------------------------------*/
	
	
	$('input,a,select,textarea,button').removeAttr('tabindex');

	// protection des liens target = _blank
	$("[target='_blank']").prop('rel','noreferrer noopener');
	
	// ajoute (nouvelle fenêtre) au titre du lien
	$("[target='_blank']").each( function( index ) {
		var title = $(this).attr('title'); //undefined
		var alt = $(this).find('img').attr('alt');
		var $this = $(this).clone();
		$this.find("span.link-desc").empty();
		var text = $this.text(); // ''
		if ( typeof(title) == 'undefined' ) {
			if ( text != '' ) { 
				title = text + ' (nouvelle fenêtre)';
			} else {
				title = 'nouvelle fenêtre';
				if ( alt != '' && alt !== 'undefined' ) title = alt + ' (nouvelle fenêtre)';
			}
		}
		else {
			title = title + ' (nouvelle fenêtre)';
		}
		$(this).attr( 'title', title );
	} );
	
	// Laisse le focus au champ de recherche si le champ est vide
	$('.search-form ').on('submit', function(event) {
		var s = $( this ).find(".search-field");
        if (!s.val()) {
            event.preventDefault();
            s.focus(); // focus on the search input
        }
	});
	

	// Contraste
	var contrast = KLXreadCookie('contrast');
	var contrast_stylesheet_path = template_url + "/style-contrast.css"; // template_url est déclaré via wp_add_inline_script
	
	if (contrast) {
		$('body').addClass('contrast');
		$('head').append($("<link href='" + contrast_stylesheet_path + "' id='highContrastStylesheet' rel='stylesheet' type='text/css' />"));
		$('#contraste').attr('aria-pressed', true);
	}

	$(document).on('click', '#contraste', function () {
		if ($('body').hasClass('contrast')) {
			$('#highContrastStylesheet').remove();
			$('body').removeClass('contrast');
			$(this).attr('aria-pressed', false);
			KLXcreateCookie('contrast', "");
			return false;
		} else {
			$('head').append($("<link href='" + contrast_stylesheet_path + "' id='highContrastStylesheet' rel='stylesheet' type='text/css' />"));
			$('body').addClass('contrast');
			$(this).attr('aria-pressed', true);
			KLXcreateCookie('contrast', '1', 7);
			return false;
		}
	});
	
	
//---------------- SLIDERS ---------------------------------------------------------------
	
	/* Slider actu page d'accueil */
	if ( $( "#actu-slider" ).length > 0 && typeof(jQuery.fn.slick) != 'undefined' ) {
		$("#actu-slider").slick({
			autoplay: false,
			infinite: false,
			arrows: true,
			dots: false,
			prevArrow: $(".slick-prev"),
			nextArrow: $(".slick-next"),
			slidesToShow: 1,
			slidesToScroll: 1,
		} );
	
		// play / pause
		/* ajouter aria-disabled="true" sur le bouton */
		$('.actu-nav .slick-pause').on('click', function() {
			$('.actu-nav .slick-pause').attr('aria-disabled', 'true');
			$('.actu-nav .slick-play').attr('aria-disabled', 'false');
			$('#actu-slider').slick('slickPause')
		});
		$('.actu-nav .slick-play').on('click', function() {
			$('.actu-nav .slick-play').attr('aria-disabled', 'true');
			$('.actu-nav .slick-pause').attr('aria-disabled', 'false');
			$('#actu-slider').slick('slickPlay')
		});
	}
				  
	
	

//---------------- SCROLL TO TOP ---------------------------------------------------------------		

	if ( $('#scroll-to-top').length ) {
		var toppos = $(window).height() + 200;
		console.log( toppos );
		$(window).scroll(function() {
			if ( $(this).scrollTop() > toppos ) { 
				$('#scroll-to-top').addClass('fixe');
			}
			else {
				$('#scroll-to-top').removeClass('fixe');
			}
		});
		// Clic
		$('#scroll-to-top').click(function(){
			$('html, body').animate({'scrollTop' : 0},1000, 'swing');
			return false;
		});	
	};

}); // end jquery
