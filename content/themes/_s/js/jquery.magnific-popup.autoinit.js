/*! Magnific Popup - v1.0.0 - 2015-01-03
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2015 Dmitry Semenov; */

$('.gallery').each(function() { // the containers for all your galleries
	$(this).magnificPopup({
		delegate: 'a', // child items selector, by clicking on it popup will open
		type: 'image',
		title: false,
		gallery: {
		  enabled:true,
		  navigateByImgClick: true,
		}
	});
});