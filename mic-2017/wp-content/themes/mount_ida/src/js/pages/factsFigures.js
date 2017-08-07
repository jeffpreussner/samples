mic.pages.factsFigures = {
	init: function () {
		mic.pages.factsFigures.smoothScroll();
	},

	smoothScroll: function() {
		$(document).on('click', 'a', function(event){
		    event.preventDefault();

		    $('html, body').animate({
		        scrollTop: $( $.attr(this, 'href') ).offset().top
		    }, 400);
		});
	},
};
