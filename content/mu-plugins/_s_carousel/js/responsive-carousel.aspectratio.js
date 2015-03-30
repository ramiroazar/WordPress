$(window).load(function() {  

		var $theWindow        = $(".carousel figure");  
		    			    		
		function resizeImg() {

			$theWindow.each(function() {

				windowAspectRatio = $(this).width() / $(this).height()

				$img = $(this).find("img");

				$img.each(function() {

					imageAspectRatio = $(this).width() / $(this).height();
				
					if ( windowAspectRatio < imageAspectRatio ) {
					    $(this)
					    	.removeClass('width height')
					    	.addClass('height');
					} else {
					    $(this)
					    	.removeClass('height width')
					    	.addClass('width');
					}
				});
			});
						
		}
		                   			
		$theWindow.resize(resizeImg).trigger("resize");

});