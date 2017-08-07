


var $scrollTop = $(window).scrollTop(),
		mobileBreakPoint = 920;

mic.pages.areaOfStudy = {
	init: function () {
		//console.log('test');

		mic.pages.areaOfStudy.initTabs();
	},

	resizeEvent: function () {

	},

	bindEvents: function () {
		var resizeEvent = mic.util.debounce(function () {
			mic.pages.areaOfStudy.resizeEvent();
		}, 500);
		window.addEventListener('resize', resizeEvent);
	},

	initTabs: function(){
		// console.log('test');
		$('.tab-content ul').each(function(){
			$(this).addClass('split-col');
		});
		$('#aosTabs').responsiveTabs({
		    startCollapsed: 'accordion'
		});
	}
};
