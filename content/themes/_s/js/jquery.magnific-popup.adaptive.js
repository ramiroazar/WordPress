/*! Magnific Popup - v1.0.0 - 2015-01-03
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2015 Dmitry Semenov; */
$(document).ready(function() {

	function resizeImage(instance) {
		var item = instance.currItem;
		var img = $('img.mfp-img');
		if(!item || !img) return;

		if(instance.st.image.verticalFit) {
			var decr = 0;
			// fix box-sizing in ie7/8
			if(instance.isLowIE) {
				decr = parseInt(img.css('padding-top'), 10) + parseInt(img.css('padding-bottom'),10);
			}
			img.css('max-height', instance.wH-decr);
		}
	}

	$('.gallery').each(function() { // the containers for all your galleries
		$(this).magnificPopup({
			type: 'ajax', 
			delegate: '.gallery-icon a', // the selector for gallery item
			ajax: {
				settings: { 
					type: "post", 
					// Reference to wp_localize_script() in functions.php
					url: lightbox_adaptive_ajax.ajax_url,
				},
			},
			gallery: {
				enabled: true,
			},
			callbacks: {
				// Before change
				beforeChange: function() {
					// Get context
				   var $items = this.items;
			   	var items_index_current = this.index;
			   	var $items_current = $items[items_index_current].el;

			   	// Get metadata
			   	var img_src = $($items_current).attr("href");

					// Set ajax data
					this.st.ajax.settings.data = {
						// Reference to lightbox_adaptive_ajax() in functions.php
						action: "lightbox_adaptive_ajax",
						img_src: img_src,
					}

				},
				// On ajax response
				parseAjax: function (mfpResponse) {
					// Get context
					var $index = this.index + 1,
					$total = this.items.length;
					// Populate counter
					mfpResponse.data = mfpResponse.data.replace(
						"<div class='mfp-counter'></div>", 
						"<div class='mfp-counter'>" + $index + " of " + $total + "</div>"
					);
				},
				// Mimic image type styles
				ajaxContentAdded: function() {
					resizeImage(this);
					this.container.removeClass("mfp-ajax-holder").addClass("mfp-image-holder");
				},
				// Mimic image type vertical resize
				resize: function() {
					/*
					Note: Ideally, the img should be retrieved from the $.magnificPopup.instance.
					Problem: Object is retrieved successfully but javascript manipulation of object is unsuccessfull
					Example:
					var output = this.container[0].innerHTML;
					var elements = $(output);
					var img = $('img.mfp-img', elements);
					img.css("", "");
					*/
					resizeImage(this);
				},
			},
		});
	});

});