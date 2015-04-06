+function ($) {
	'use strict';

	// Define every tabgroup in DOM
	var $tabgroups	= $(".tabgroup");

	// For each tabgroup
	$tabgroups.each(function(){

		// Define collapse setting
		var $collapse	= false;
			 $collapse	= $(this).data('collapse');
		// Define hover setting
		var $hover		= false;
			 $hover		= $(this).data('hover');
		// Define every child tab
		var $tabs       = $(this).find('a[data-target]');
		// Define every child tabpanel
		var $tabpanels  = $(this).find(".tabpanel");

		// When a child tab is clicked
		// $tabs.mouseenter( function() {
		$tabs.on( "click", function(e) {

			// e.preventDefault();

			// Define clicked tab
			var $clicked = $(this);

			// Define clicked tab target
			var target = $clicked.data('target');

			function _s_tab_disactivate() {
	         $tabs.attr('aria-selected', false);
				$tabs.removeClass('active');				
			}

			function _s_tab_activate() {
	         $clicked.attr('aria-selected', true);
				$clicked.addClass('active');				
			}

			// If collapse enabled
			if ($collapse === true) {

				// If clicked tab is already active
				if ($clicked.hasClass("active")) {
					// Disactivate each tab
		         _s_tab_disactivate();
				} else {
					// Disactivate each tab
		         _s_tab_disactivate();
					// Activate clicked tab
		         _s_tab_activate();
				}

			} else {
				// Disactivate each tab
	         _s_tab_disactivate();
				// Activate clicked tab
	         _s_tab_activate();
			}

			$tabpanels.each(function(index, element){

				function _s_tabpanel_disactivate() {
	            $(element).attr('aria-hidden', true);
					$(element).removeClass('active');			
				}

				function _s_tabpanel_activate() {
               $(element).attr('aria-hidden', false);
					$(element).addClass('active');		
				}

				// Disactivate each tabpanel
				_s_tabpanel_disactivate();

				// If collapse enabled
				if ($collapse === true) {
					// If clicked tab is already active
					if ($clicked.hasClass("active")) {
						// If clicked tab target
						if($(element).attr('id') === target) {
							// Activate this tabpanel
		               _s_tabpanel_activate();
						}
					}
				} else {
					// If clicked tab target
					if($(element).attr('id') === target) {
						// Activate this tabpanel
	               _s_tabpanel_activate();
					}
				}
			});
		});
	});
}(jQuery);