$('.gallery').each(function() { // the containers for all your galleries
   $(this).magnificPopup({
	   delegate: '.gallery-icon a', // child items selector, by clicking on it popup will open
	   type: 'image',
	   title: false,
	   gallery: {
	     enabled:true,
	     navigateByImgClick: true,
	   }
   });
});