(function($) {

	/*var pluginName = "carousel",
		initSelector = "." + pluginName,
		//img = initSelector.find("img"),
		aspectRatioMethods = {
			_aspectRatio: function(){
				var $self = $( this );
				$self.addClass("yayyyyy");
			},
		};

	// add methods
	$.extend( $.fn[ pluginName ].prototype, aspectRatioMethods );*/

	$( function(){

		var $canvas 		= $(".carousel"),
	       $img 			= $(".carousel img");

		$img.each(function(){
			// Create new offscreen image to test
			var theImage = new Image();
			theImage.src = $(this).attr("src");
			// Add a reference to the original.
			$(theImage).data("original",this);

			// Get accurate measurements from that.
			$(theImage).load(function(){
				var imageWidth = this.width;
				var imageHeight = this.height;
				$($(this).data("original")).attr({"data-width":imageWidth,"data-height":imageHeight});
			});
		});
	                      
	   function resizeBg() {

	   	var canvasWidth = $canvas.width();
	   	var canvasHeight = $canvas.height();
	   	var canvasAspectRatio = canvasWidth / canvasHeight;

	   	$canvas.attr("data-aspect-ratio",canvasAspectRatio);

	   	$img.each(function(){

	   		var imageWidth = $(this).data("width");
	   		var imageHeight = $(this).data("height");
	   		var imageAspectRatio = imageWidth / imageHeight;

		   	$(this).attr("data-aspect-ratio",canvasAspectRatio);

	   		if (canvasAspectRatio > 1 ) {
	   			if (imageWidth > 1) {
	   				$removeClass();
	   				$(this).addClass("landscape");
	   			} else {
	   				$removeClass();
	   				$(this).addClass("portrait");	   				
	   			}
	   		} else {
	   			if (imageWidth > 1) {
	   				$removeClass();
	   				$(this).addClass("landscape");
	   			} else {
	   				$removeClass();
	   				$(this).addClass("portrait");	   				
	   			}  			
	   		}

         });
	            
	   }
	    
	   $(window).resize(resizeBg).trigger("resize");

	} );

}(jQuery));
