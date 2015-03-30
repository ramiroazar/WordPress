+function ($) {
	'use strict';

	var $tabgroups   = $(".tabgroup");

	$tabgroups.each(function(){

		var $tabpanels  = $(this).find(".tabpanel");
		var $tabs       = $(this).find('a[data-target]');

		$tabs.on( "click", function(e) {

			//e.preventDefault();

         $tabs.attr('aria-selected', false);
         $(this).attr('aria-selected', true);

			$tabs.removeClass('active');
			$(this).addClass('active');

			var id = $(this).data('target');

			$tabpanels.each(function(){

				$(this).removeClass('active');
            $(this).attr('aria-hidden', true);

				if($(this).attr('id') === id) {

					$(this).addClass('active');
               $(this).attr('aria-hidden', false);

				}
			});
		});
	});
}(jQuery);
