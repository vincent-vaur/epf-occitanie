/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
/*( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();*/


//https://github.com/selfthinker/dokuwiki_template_writr/blob/master/js/skip-link-focus-fix.js
(function($) {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function(el, index, selector){
      var $element = $(el);
      return $element.is(':input:enabled, a[href], area[href], object, [tabindex]') && !$element.is(':hidden');
    }
  });

  function focusOnElement($element) {
    if (!$element.length) {
      return;
    }
    if (!$element.is(':focusable')) {
      // add tabindex to make focusable and remove again
      $element.attr('tabindex', -1).on('blur focusout', function () {
        $(this).removeAttr('tabindex');
      });
    }
    $element.focus();
  }

  $(document).ready(function(){
    // if there is a '#' in the URL (someone linking directly to a page with an anchor)
    if (document.location.hash) {
      focusOnElement($(document.location.hash));
    }

    // if the hash has been changed (activation of an in-page link)
    $(window).bind('hashchange', function() {
      var hash = "#"+window.location.hash.replace(/^#/,'');
      focusOnElement($(hash));
    });
  });

})(jQuery);