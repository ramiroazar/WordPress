+function ($) {
	'use strict';

	var $tabgroups	= $(".tabgroup");
	var $collapse	= false;
		 $collapse	= $tabgroups.data('collapse');
	var $hover		= false;
		 $hover		= $tabgroups.data('hover');

	$tabgroups.each(function(){

		var $tabpanels  = $(this).find(".tabpanel");
		var $tabs       = $(this).find('a[data-target]');

		$tabs.on( "click", function(e) {

			//e.preventDefault();

			var $clicked = $(this);

			function _s_tab_disactivate() {
	         $tabs.attr('aria-selected', false);
				$tabs.removeClass('active');				
			}

			function _s_tab_activate() {
	         $clicked.attr('aria-selected', true);
				$clicked.addClass('active');				
			}

			// If collapse is enabled
			if ($collapse === true) {

				// If clicked tab is already active
				if ($clicked.hasClass("active")) {
		         _s_tab_disactivate();
				} else {
		         _s_tab_disactivate();
		         _s_tab_activate();
				}

			} else {
	         _s_tab_disactivate();
	         _s_tab_activate();
			}

			var id = $(this).data('target');

			$tabpanels.each(function(index, element){

				function _s_tabpanel_disactivate() {
	            $(element).attr('aria-hidden', true);
					$(element).removeClass('active');			
				}

				function _s_tabpanel_activate() {
               $(element).attr('aria-hidden', false);
					$(element).addClass('active');		
				}

				_s_tabpanel_disactivate();

				if ($collapse === true) {
					if ($clicked.hasClass("active")) {
						if($(element).attr('id') === id) {
		               _s_tabpanel_activate();
						}
					}
				} else {
					if($(element).attr('id') === id) {
	               _s_tabpanel_activate();
					}
				}
			});
		});
	});
}(jQuery);