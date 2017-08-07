
var $scrollTop = $(window).scrollTop(),
		mobileBreakPoint = 920,
		$windowHeight = $(window).height() - $('.navigation').height();
		$windowWidth = $(window).height() - $('.navigation').height();

mic.pages.pagebuilder = {
	init: function () {
		mic.pages.pagebuilder.loadPage();

		//for testing
		$(window).on('resize', function() {
			mic.pages.pagebuilder.loadPage();
		});
	},

	loadPage: function () {
		// $windowHeight = $(window).height() - $('.navigation').height()+15;
		// // if($windowWidth >= mobileBreakPoint){
		// 	$('.full-width-hero.has-bg').each(function () {
		// 		$(this).css('min-height',$windowHeight+'px');
		// 	});
		// // }
	},
	resizeEvent: function(){

	}

};
