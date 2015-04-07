
$(document).ready(function() {
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
});