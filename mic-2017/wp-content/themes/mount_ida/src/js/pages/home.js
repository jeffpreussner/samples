


var $scrollTop = $(window).scrollTop(),
		mobileBreakPoint = 920;

mic.pages.home = {
	init: function () {
		mic.pages.home.buildSlideshow();
		mic.pages.home.buildNews();
		mic.pages.home.initSchools();
		// mic.pages.home.initSlideshow();
	},


	resizeEvent: function () {
		// $('.hero-slider .slide').each(function(){
		// 	var $windowSize = $(window).width(),
		// 		newHeight = $windowSize/2;
		// 		$(this).height(newHeight);
		// });
	},

	bindEvents: function () {
		var resizeEvent = mic.util.debounce(function () {
			mic.pages.home.resizeEvent();
		}, 500);
		window.addEventListener('resize', resizeEvent);
	},

	buildNews: function () {
		// var $newsLength = $('.news-item').length * $('.news-item').outerWidth(),
		// 		$sliderNav = $('.slider-nav'),
		// 		$sliderNavBar = $('.slider-nav .scrollbar'),
		// 		$sliderNavWidth = $sliderNav.width(),
		// 		barwidth = ($sliderNavWidth / $newsLength) * 100;
		//
		// $sliderNavBar.width(Math.round(($sliderNavWidth / $newsLength) * 100) + "%");
		// $sliderNavBar.css('left', "0%");
		//
		// $('.news-slider-wrapper').on('scroll', function () {
		// 	var ScrollLeft = Math.round($('.news-slider-wrapper').scrollLeft() / $newsLength * 100);
		// 	$sliderNavBar.css('left', ScrollLeft + "%");
		// });
	},

	initSchools: function () {
		var $windowHeight = $(window).height() - 48;
		if(!mic.util.isIe9){
		$('.school-slide').each(function () {
			var newHeight = $windowHeight;
			// if(mic.isMobile){
			// 	newHeight = newHeight+50;
			// }
			if(newHeight < 580){
				newHeight = 580;
			}
			$(this).height(newHeight);
		});
	}

		$('.school-nav a').on('click', function (e) {
			$('.school-nav a.active').removeClass('active');
			$(this).addClass('active');
			$('.school-slide.active').removeClass('active');
			$thisTarget = $(this).attr('href');
			$($thisTarget).addClass('active');
			e.preventDefault();
		});

		$('.school-slide .close').on('click', function (e) {
			e.preventDefault();
			$(this).parents('.school-slide').removeClass('active');
			$('.school-nav a.active').removeClass('active');

		});
	},

	buildSlideshow: function () {
		this.resizeEvent();
		this.initSlideshow();
	},

	initSlideshow: function () {
		var $windowHeight = $(window).height() - $('.navigation').height();
		$('.hero-slider .slide').each(function () {
			var newHeight = $windowHeight;
			if(mic.isMobile){
				newHeight = newHeight+50;
			}
			if(newHeight < 580){
				newHeight = 630;
			}

			$(this).height(newHeight);
		});
		$('.hero-slider').slick({
			dots: true,
			appendArrows: false,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: false,
						nav: false
					}
				},
				{
					breakpoint: 920,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: true,
						nav: false
					}
				}
			]
		});
		if(mic.util.windowSize >= mic.util.mobileBreakPoint){
			$('.news-item').width($('.news-container').width()/2);
		}else{
			$('.news-item').width($('.news-container').width());
		}


		$('.news-slider-wrapper').slick({
			dots: true,
			appendArrows: $('.news .slider-nav'),
			infinite: true,
			speed: 300,
			nav: true,
			dots: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			variableWidth: false,
			responsive: [
				{
					breakpoint: 920,
					settings: {
						variableWidth: false,
						appendArrows: false,
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: true,
						nav: false
					}
				}
			]
		});
		//////////////////////////////////////////////
		//TODO:
		//LOOK INTO SLICK DESKTOP/MOBILE and resizing
		//////////////////////////////////////////////
		if ($(window).width() <= 920) {
			$('.mobile-slideshow').slick({
				dots: true,
				appendArrows: false,
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				slidesToScroll: 1
			});
		}
	}
};
