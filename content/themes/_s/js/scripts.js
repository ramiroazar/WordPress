jQuery(document).ready(function($) {

/**
 * Lightbox
 *
 * @link http://dimsemenov.com/plugins/magnific-popup/documentation.html
 */

	// Toggle Inline Content Lightbox

	$('.toggle-lightbox').magnificPopup({
		type: 'inline',
		preloader: false,

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 768) {
					this.st.focus = false;
				} else {
					this.st.focus = "input[name=name]";
				}
			}
		}
	});

	// Toggle Gallery Lightbox

	$('.gallery').each(function() { // the containers for all your galleries
	   $(this).magnificPopup({
		   delegate: 'img', // child items selector, by clicking on it popup will open
		   type: 'image',
		   //title: false,
		   gallery: {
		     enabled: true,
		     navigateByImgClick: true,
		   },
			callbacks: {
				elementParse: function(item) {
					if (item.el.data('full')) {
						item.src = item.el.data('full');
					} else {
						item.src = item.el.attr('src');
					}
				}
			}
	   });
	});

/**
 * object-fit polyfill
 *
 * @link https://github.com/anselmh/object-fit/
 */

	objectFit.polyfill({
		selector: '.carousel img',
		fittype: 'cover',
		disableCrossDomain: 'true'
	});

});
