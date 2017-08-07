


var $scrollTop = $(window).scrollTop(),
		mobileBreakPoint = 920;

mic.pages.schoolLanding = {
	init: function () {
		mic.pages.schoolLanding.convertSVG();
		mic.pages.schoolLanding.buildSlideshow();
		mic.pages.schoolLanding.buildNews();
		mic.pages.schoolLanding.initAlumni();
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
			mic.pages.schoolLanding.resizeEvent();
		}, 500);
		window.addEventListener('resize', resizeEvent);
	},
	convertSVG: function(){
		//Takes SVG image and converts it to svg element so we can change color based on School
		$(function(){
		    // $('img.svg').each(function(){
		    //     var $img = $(this),
			// 		imgID = $img.attr('id'),
			// 		imgClass = $img.attr('class'),
			// 		imgURL = $img.attr('src');
			//
		    //     $.get(imgURL, function(data) {
		    //         // Get the SVG tag, ignore the rest
		    //         var $svg = $(data).find('svg');
			//
		    //         // Add replaced image's ID to the new SVG
		    //         if(typeof imgID !== 'undefined') {
		    //             $svg = $svg.attr('id', imgID);
		    //         }
		    //         // Add replaced image's classes to the new SVG
		    //         if(typeof imgClass !== 'undefined') {
		    //             $svg = $svg.attr('class', imgClass+' replaced-svg');
		    //         }
			//
		    //         // Remove any invalid XML tags as per http://validator.w3.org
		    //         $svg = $svg.removeAttr('xmlns:a');
			//
		    //         // Check if the viewport is set, else we gonna set it if we can.
		    //         if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
		    //             $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
		    //         }
			//
		    //         // Replace image with new SVG
		    //         $img.replaceWith($svg);
			//
		    //     }, 'xml');
			// 	console.log($('.title span').width());
				// $('svg.svg.fist-line').attr('width', Math.ceil($('.title span').width())+'px');
// console.log($('svg.svg.fist-line').attr('width'));
				if($('.title').height() > 60){
					$('.title').addClass('two-lines');
					// $('.svg.second-line').width($('.title span').width()/2).show(0);
				}
		    // });
		});

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

	initAlumni: function () {
		var $windowHeight = $(window).height() - 48;
		$('.alumni-slide').each(function () {
			var newHeight = $windowHeight;
			$(this).height(newHeight);
		});

		$('.alumni-nav a').on('click', function (e) {
			$('.alumni-nav a.active, .alumni-slide.active').removeClass('active');
			$(this).addClass('active');
			$thisTarget = $(this).attr('href');
			$($thisTarget).addClass('active');
			$('.alumni-nav p').fadeOut();

			e.preventDefault();
		});

		$('.alumni-slide .close').on('click', function (e) {
			e.preventDefault();
			$(this).parents('.alumni-slide').removeClass('active');
			$('.alumni-nav a.active').removeClass('active');
			$('.alumni-slide.default').addClass('active');
			$('.alumni-nav p').fadeIn();
		});
	},

	buildSlideshow: function () {
		this.resizeEvent();
		this.initSlideshow();
	},

	initSlideshow: function () {

		if ($(window).width() <= 920) {
			//console.log("test");
			$('.mobile-slideshow').slick({
				dots: true,
				appendArrows: false,
				infinite: false,
				speed: 300,
				slidesToShow: 1,
				slidesToScroll: 1,
				adaptiveHeight: true
			});
		}
		$('.faculty-slider-wrapper').slick({
			dots: true,
			appendArrows: $('.faculty-spotlight .slider-nav'),
			infinite: false,
			speed: 300,
			nav: true,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			variableWidth: true,
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

		$('.slideshow-wrapper').slick({
			dots: true,
			appendArrows: $('.slideshow .slider-nav'),
			infinite: false,
			speed: 300,
			nav: true,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			variableWidth: true,
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
	}
};
