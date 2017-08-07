mic.pages.campusLife = {
	sm_controller: null,
	tm_wipe_anim: null,
	scene: null,
	scrollDelta: 0,
	_currentPage: 0,
	get currentPage() {
		return this._currentPage;
	},
	set currentPage(p) {
		this._currentPage = p;
		//console.log(this._currentPage);
		if (this._currentPage > 0) {
			$("#slide-nav").addClass('active');
		} else {
			$("#slide-nav").removeClass('active');
		}
		$('.wysiwyg-content').css("pointer-events", 'none');

		$('.wysiwyg-content#module' + (this._currentPage + 1)).css("pointer-events", 'auto');
		if ($("#slide-nav").hasClass("sm-slide-nav") && this._currentPage > 0) {
			var list = $("#slide-nav ul li").removeClass('active');
			console.log(this._currentPage);
			if (this._currentPage == 2 || this._currentPage == 4 || this._currentPage == 6 || this._currentPage == 8 || this._currentPage == 9) {
				$(list[this._currentPage - 2]).addClass('active');
			} else {
				$(list[this._currentPage - 1]).addClass('active');
			}
		}
	},
	disableStickyNav: true,
	init: function () {
		var self = this;

		var list = $("<ul>").appendTo("#slide-nav");
		$(".wysiwyg-content").each(function (i) {
			var li = $("<li>").appendTo(list);
			li.data('slide-index', i + 1);
			li.data('slide-name', $(this).data('slide-name'));
			$("#slide-nav .btn.template").clone().removeClass("template").appendTo(li);
		});

		//header slideshow
		// $("#header-slideshow .slider-container").responsiveSlides({
		//   auto:true
		// });

		//solution streams
		if (mic.util.isMobile || $(window).width() <= 920) {
			this.mobilePageInit();
			// } else if(mic.util.isIe9) {
			//   $('.row').each(function(){
			//       $(this).height($(this).parents('.wysiwyg-content').height());
			//   });
		} else {
			$("#slide-nav").addClass('sm-slide-nav');
			$("#slide-nav li").each(function () {
				$("<span>").html("").addClass("slide-nav-label").prependTo($(this));
			});
			$("#slide-nav li").click(function (e) {
				e.preventDefault();
				e.stopPropagation();
				//console.log("Current-Page",self.currentPage);
				//console.log("Current-Page",$(this).data('slide-index'));

				if (self.currentPage != $(this).data('slide-index')) {
					var dir = $(this).data('slide-index') - self.currentPage;
					dir = dir > 0 ? 1 : dir < 0 ? -1 : 0;
					self.currentPage = $(this).data('slide-index');
					var dest = self.currentPage * $(window).height();
					if (dir == 1) {
						window.scrollTo(0, dest - ($(window).height() / 2));
					} else {
						window.scrollTo(0, dest + ($(window).height() / 2));
					}
					TweenMax.to(window, 1.2,
							{
								scrollTo: {y: Math.round(dest)},
								ease: Quad.easeInOut
							}
					);
				}
			});
			this.initScrollMagic();
      // this.bindEvents();

		}
    mic.pages.campusLife.bindResize(self);

	},
	mobilePageInit: function () {
		$('.wysiwyg-content').each(function () {
			if ($(this).hasClass('has-bg')) {
				$(this).height($(window).height() - $('.nav-header').height() + 70);
			} else {
				$(this).attr('style', $(this).data('style'));
			}

		})
		// $(".campusLife-content").responsiveSlides({
		//   auto:true,
		//   pager:true,
		//   nav:true,
		//   timeout:8000,
		//   pause:true,
		//   pauseControls:true,
		//   manualControls:"#slide-nav ul"
		// });
		// $(".campusLife-content").swipe( {
		// swipeLeft: function(){
		//     $(".rslides_nav.next").click();
		// },
		// swipeRight: function(){
		//     $(".rslides_nav.prev").click();
		// }
// });

	},
	initScrollMagic: function () {
		var self = this;

		self.currentPage = Math.floor($(window).scrollTop() / $(window).height());
		this.sm_controller = new ScrollMagic.Controller();

		this.tm_wipe_anim = this.createTimelineMax(this.timeline, Power4.easeout);

		// var bg_anim_tween_out = TweenMax.to('body#campusLife', 1, {backgroundColor:"#2997d6"});
		// var bg_anim_tween_in = TweenMax.to("body#campusLife", 1, {backgroundColor:"#fede03"});

		//background tween
		// new ScrollMagic.Scene({
		//   triggerElement:".campusLife-content",
		//   triggerHook:"onEnter",
		//   duration:"100%"
		// }).setTween(bg_anim_tween_in)
		//   .addTo(this.sm_controller);
		//
		//bg tween 2
		// new ScrollMagic.Scene({
		//   triggerElement:"footer",
		//   triggerHook:"onEnter",
		//   duration:"280"
		// }).setTween(bg_anim_tween_out)
		//   .addTo(this.sm_controller);
		//
		//main slide pin
		new ScrollMagic.Scene({
			triggerElement: "#scroll-container",
			triggerHook: "onLeave",
			duration: "900%"
		}).setPin("#scroll-container")
				.addTo(this.sm_controller);
		//.addIndicators({name:"pin", indent:"100"})

		//slides animations
		this.scene = new ScrollMagic.Scene({
			triggerElement: "#scroll-container",
			triggerHook: "onEnter",
			duration: "900%"
		}).setTween(this.tm_wipe_anim)
				//.addIndicators({name:'gortons'})
				.addTo(this.sm_controller);
		//console.log(((this.tm_wipe_anim.duration())*100)+"%");
		this.bindSMEvents();

		setTimeout(function () {
			self.currentPage = Math.floor($(window).scrollTop() / $(window).height());
		}, 500);
	},
  bindResize: function(self){
    var destroyed = 0;
    $(window).on('resize',function(self){
      if( $(window).width() <= 920 ) {
        ////////////////////////////////////////
        //TODO: Fix this hack
        //hacky way to set desktop/mobile states
        ////////////////////////////////////////
        if (self.sm_controller) {
          // timelineMax.destroy();
          //  mic.pages.campusLife.timeline = null;
          // mic.pages.campusLife.sm_controller = mic.pages.campusLife.sm_controller.destroy(true);
          // $(window).reload();
        }
      } else if( $(window).width() > 920 ) {
            if( !mic.pages.campusLife.sm_controller ) {
              // $(window).reload();
              mic.pages.campusLife.initScrollMagic();
            }
        }
      // if($(window).width()<=920 && self.sm_controller != null){
      //   	 self.sm_controller.enabled(false).removePin(true);
      //       self.sm_controller = self.sm_controller.destroy(true);
      //       self.tm_wipe_anim = self.tm_wipe_anim.kill();
      //     self.mobilePageInit();
      //               destroyed = 1;

      //     $('#scroll-container,.scrollmagic-pin-spacer').attr('style','');
      // }else if($(window).width() >= 921 && destroyed == 1 ){
      //   	 self.sm_controller.enabled(true);
      //     destroyed = 0;
      //   }
    });
  },
	bindEvents: function () {
		var self = this;
    
    

		// $("#arrow").click(function(){
		//   if ($(window).width() > 1024 && (self.scrollDelta == -1 || self.currentPage !== 0)) return;
		//
		//   if ($(window).width() <= 1024) {
		//     self.currentPage = 1;
		//     self.scrollDelta = -1;
		//   }
		//   TweenMax.to(window, 1.2,
		//       {
		//         scrollTo:{y:Math.round($(window).height()), autoKill:false},
		//         ease:Quad.easeInOut,
		//         onComplete:function(){
		//           self.scrollDelta = 0;
		//         }
		//       }
		//     );
		//   });
	},
	bindSMEvents: function () {
		var self = this;
		// if (mic.util.isMobile || $(window).width() <= 1024) {
		//
		//     // configure iScroll
		//     var myScroll = new IScroll("#scroll-container",
		//                 {
		//                     scrollX: false,
		//                     scrollY: true,
		//                     scrollbars: true,
		//                     useTransform: false,
		//                     useTransition: false,
		//                     click: true
		//                 }
		//             );
		//             this.sm_controller.scrollPos(function () {
		//         return -myScroll.y;
		//     });
		//     myScroll.on("scroll", function () {
		//         this.sm_controller.update();
		//     });
		// }else{
		$(window).on('scroll', function (e) {
			// console.log('test');
      if($(window).width() > 920 && mic.pages.campusLife.sm_controller != null){
        self.sm_controller.update(true);
        clearTimeout(self.scrollTimeout);
        self.scrollTimeout = setTimeout(self.windowStopScroll, 200, self, e);
      }else if($(window).width() > 920 && mic.pages.campusLife.sm_controller == null ){
        alert('test');
        if($(window).width() > 920){
          mic.pages.campusLife.init();
        }
      }
		});
	},
	windowStopScroll: function (self, e) {
    if($(window).width() > 920){
		if (!self)
			self = mic.pages.campusLife;
		if (self.scrollDelta !== 0)
			return;

		clearTimeout(self.scrollTimeout);

		//override lethargy
		// direction = e.originalEvent.deltaY < 0 ? 1 : e.originalEvent.deltaY > 0 ? -1 : false;

		//hide slide nav buttons when footer is in view.
		var classFunc = mic.util.isScrolledIntoView($(".extra"), 1, true) ? 'removeClass' : 'addClass';
		$("#slide-nav.sm-slide-nav")[classFunc]('active');
		var viewSize = $(window).height();

		var roundFunc = self.sm_controller.info('scrollDirection') == "REVERSE" ? Math.floor : Math.ceil;

		if ($("#scroll-container").offset().top >= $('.scrollmagic-pin-spacer').height() * $('.wysiwyg-content').length)
			return;
		if (self.currentPage <= $('.wysiwyg-content').length) {
			var tn = TweenMax.to(
					window,
					0.5 + Math.abs($(window).scrollTop() / viewSize - roundFunc($(window).scrollTop() / viewSize)),
					{
						scrollTo: {
							x: 0,
							y: roundFunc($(window).scrollTop() / viewSize) * viewSize
						},
						ease: Quad.easeInOut,
						onUpdate: function () {
							////console.log('scroll progress:'+tn.progress());
							if (tn.progress() > 0.5)
								self.currentPage = Math.floor($(window).scrollTop() / $(window).height());
							////console.log('\tsetting currentpage: '+self.currentPage);
						}
					});
		}
}
	},
	createTimelineMax: function (timeline, defaultEase) {
		var timelineMax = new TimelineMax();

		for (var i = 0; i < timeline.length; i++) {
			var tl = timeline[i];
			if (!tl.hasOwnProperty("position"))
				tl.position = "+=0";
			if (tl.ease && tl.to)
				tl.to.ease = tl.ease;
			if (!defaultEase)
				defaultEase = Linear.easeNone;
			if (!tl.ease && tl.to)
				tl.to.ease = defaultEase;

			if (tl.events && tl.events.length && tl.events.length > 0 && tl.to) {
				for (var j = 0; j < tl.events.length; j++) {
					var ev = tl.events[j];
					tl.to[ev.event] = ev.func;
					if (ev.params)
						tl.to[ev.event + "Params"] = ev.params;
				}
			}

			if (tl.from) {
				timelineMax.fromTo(
						tl.selector,
						tl.duration,
						tl.from,
						tl.to,
						tl.position
						);
			} else {
				timelineMax.to(
						tl.selector,
						tl.duration,
						tl.to,
						tl.position
						);
			}
		}

		return timelineMax;
	},
	timeline: [
		//slide 1 in
		{
			selector: ".wysiwyg-content#module1",
			duration: 0.5,
			from: {y: "0%"},
			to: {y: "0%"},
			position: 0
		},
		//slide 2 in
		{
			selector: ".wysiwyg-content#module2",
			duration: 0.5,
			from: {y: "100%"},
			to: {y: "0%"},
			position: 1
		},
		{
			selector: ".wysiwyg-content#module2 .module-container",
			duration: 0.5,
			from: {opacity: "0"},
			to: {opacity: "1"},
			position: 1
		},
		//slide 2 out 3 in
		{
			selector: ".wysiwyg-content#module2 .module-container",
			duration: 0.5,
			to: {opacity: "0"},
			position: 2
		},
		{
			selector: ".wysiwyg-content#module3",
			duration: 0.5,
			from: {y: "0%"},
			to: {y: "0%"},
			position: 2
		},
		{
			selector: ".wysiwyg-content#module3",
			duration: 0.5,
			from: {y: "0%", opacity: "0"},
			to: {y: "0%", opacity: "1"},
			position: 2
		},
		//slide 3 out 4 in
		{
			selector: ".wysiwyg-content#module4",
			duration: 0.5,
			from: {y: "100%"},
			to: {y: "0%"},
			position: 3
		},
		{
			selector: ".wysiwyg-content#module4 .module-container",
			duration: 0.5,
			from: {opacity: "0"},
			to: {opacity: "1"},
			position: 3
		},
		//4 out 5 in
		{
			selector: ".wysiwyg-content#module4 .module-container",
			duration: 0.5,
			from: {opacity: "1"},
			to: {opacity: "0"},
			position: 4
		},
		{
			selector: ".wysiwyg-content#module5",
			duration: 0.5,
			from: {y: "0%"},
			to: {y: "0%"},
			position: 4
		},
		{
			selector: ".wysiwyg-content#module5",
			duration: 0.5,
			from: {y: "0%", opacity: "0"},
			to: {y: "0%", opacity: "1"},
			position: 4
		},
		//6 in
		{
			selector: ".wysiwyg-content#module6",
			duration: 0.5,
			from: {y: "100%"},
			to: {y: "0%"},
			position: 5
		},
		{
			selector: ".wysiwyg-content#module6 .module-container",
			duration: 0.5,
			from: {opacity: "0"},
			to: {opacity: "1"},
			position: 5
		},
		//6 out 7 in
		{
			selector: ".wysiwyg-content#module6 .module-container",
			duration: 0.5,
			from: {opacity: "1"},
			to: {opacity: "0"},
			position: 6
		},
		{
			selector: ".wysiwyg-content#module7",
			duration: 0.5,
			from: {y: "0%"},
			to: {y: "0%"},
			position: 6
		},
		{
			selector: ".wysiwyg-content#module7",
			duration: 0.5,
			from: {y: "0%", opacity: "0"},
			to: {y: "0%", opacity: "1"},
			position: 6
		},
		//8 in
		{
			selector: ".wysiwyg-content#module8",
			duration: 0.5,
			from: {y: "100%"},
			to: {y: "0%"},
			position: 7
		},
		{
			selector: ".wysiwyg-content#module8 .module-container",
			duration: 0.5,
			from: {opacity: "0"},
			to: {opacity: "1"},
			position: 7
		},
		//8 out 9 in
		{
			selector: ".wysiwyg-content#module8 .module-container",
			duration: 0.5,
			from: {opacity: "1"},
			to: {opacity: "0"},
			position: 8
		},
		{
			selector: ".wysiwyg-content#module9",
			duration: 0.5,
			from: {y: "0%"},
			to: {y: "0%"},
			position: 8
		},
		{
			selector: ".wysiwyg-content#module9",
			duration: 0.5,
			from: {y: "0%", opacity: "0"},
			to: {y: "0%", opacity: "1"},
			position: 8
		}
	]
};
