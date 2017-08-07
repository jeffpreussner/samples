var videoWidth = ""
,	videoHeight = ""
;

function resizeVideo() {
	$(".videoIntro .jp-jplayer img").hide();
	if ($(window).height() > $(window).width() * 0.5425) { // Which dimension is bigger dependant on aspect ratio (16:9)
		$(".videoIntro .jp-jplayer video, .videoIntro .jp-jplayer img").removeAttr("height").removeAttr("width").width("auto").height("100%");
		videoHeight = "100%";
		videoWidth = "auto";
	} else {
		$(".videoIntro .jp-jplayer video, .videoIntro .jp-jplayer img").removeAttr("height").removeAttr("width").width("100%").height("auto");
		videoHeight = "auto";
		videoWidth = "100%";
	}
};

$(document).ready(function() {
	// set height of video container
	// $('.min-height').height($(window).height());

	$('.petition_form').on('submit', function(e){
		e.preventDefault();

		var $form = $(this)
		,	firstName = $form.find('.firstName').val()
		,	lastName = $form.find('.lastName').val()
		,	email = $form.find('.email').val()
		,	zip = $form.find('.zip').val()
		;

		if(firstName && lastName && email && zip){
			$.ajax({
				url: "https://secure2.oxfamamerica.org/page/sapi/almighty-testing",
				data: {
					"email": email,
					"first_name": firstName,
					"last_name": lastName,
					"zip": zip
				}
			}).success(function( data ) {
			  if(data.status == "success"){
					$('.error_status').hide();
					$('.form-success').show();
					$('.form-content').hide();
				}

			}).error(function( jqXHR, data ){
				if(data.field_errors){
					for(var i=0; i < data.field_errors.length; i++){
						var field = $form.find("."+data.field_errors[i].field+"_error"),
								error_message = data.field_errors[i].message;

						field.html(error_message).css('display', 'block').hide().fadeIn();
					}
				}else{
					$('.global_error').html("There was a problem submitting the form. Please try again.").css('display', 'block').hide().fadeIn();
				}
			});

		}else{
			$('.global_error').html("Please complete all fields and submit again.").css('display', 'block').hide().fadeIn();
		}
	});

	//module specific doc ready
	//chapter 2
	$('.info_graphic_change .see_change').on('click', function() {
		//$(this).fadeOut();

		var yearOpt = {
			useEasing: false,
			useGrouping: true,
			separator: '',
			decimal: '',
			prefix: '',
			suffix: ''
		}
		,	counterOpt = {
			useEasing: false,
			useGrouping: true,
			separator: '',
			decimal: '',
			prefix: '',
			suffix: '%'
		}
		;
		var yearCount = new CountUp("yearCount", 1962, 2015, 0, 3, yearOpt)
		,	wholeCount = new CountUp("whole_chicken", 83, 11, 0, 3, counterOpt)
		,	part1Count = new CountUp("chicken_part1", 3, 40, 0, 3, counterOpt)
		,	part2Count = new CountUp("chicken_part2", 1, 49, 0, 3, counterOpt)
		;

		yearCount.start();
		wholeCount.start();
		part1Count.start();
		part2Count.start();

		$('.info_graphic_change').addClass('animate');
		$(this).addClass('disabled');
		setTimeout(function() {
			$('.info_graphic_change .reset').fadeIn();
		}, 3000);
	});
});

$('.info_graphic_change .reset').on('click', function(e){
	e.preventDefault();
	$('.info_graphic_change').removeClass('animate');
	$('#yearCount').html('1962');
	$('#whole_chicken').html('83%');
	$('#chicken_part1').html('3%');
	$('#chicken_part2').html('1%');
	$('.info_graphic_change .see_change').removeClass('disabled');
	$(this).fadeOut();
});


$('.info_graphic_farms_to_factories .see_change').on('click', function(e) {
	// $(this).fadeOut();
	var yearOpt = {
		useEasing: false,
		useGrouping: true,
		separator: '',
		decimal: '',
		prefix: '',
		suffix: ''
	}
	,	counterOpt = {
		useEasing: false,
		useGrouping: true,
		separator: ',',
		decimal: '',
		prefix: '',
		suffix: ''
	}
	;
	e.preventDefault();
	var yearCount = new CountUp("farmYearCount", 1950, 2012, 0, 6, yearOpt)
	,	farmCount = new CountUp("farms", 1636705, 32935, 0, 6, counterOpt)
	,	chickenCount = new CountUp("chickens", 581038865, 8463194794, 0,6, counterOpt)
	,	perFarmCount = new CountUp("per_farm", 355, 256967, 0, 6, counterOpt)
	;
	yearCount.start();
	farmCount.start();
	chickenCount.start();
	perFarmCount.start();
	$('.sm-farm:eq(3)').fadeOut(1500, function(){
		$('.sm-farm:eq(2)').fadeOut(1500, function(){
			$('.sm-farm:eq(1)').fadeOut(1500, function(){
				$('.sm-farm:eq(0)').fadeOut(1500, function(){
					$('.lg-farm').fadeIn(1500, function(){
						$('.info_graphic_farms_to_factories .reset').fadeIn();
					});
				});
			});
		});
	});
	$(this).addClass('disabled');
});

$('.info_graphic_farms_to_factories .reset').on('click', function(e){
e.preventDefault();
$('#farmYearCount').html('1950');
$('#farms').html('1,636,705');
$('#chickens').html('581,038,865');
$('#per_farm').html('355');

$('.lg-farm').fadeOut(function(){$('.sm-farm').fadeIn();});
$('.info_graphic_farms_to_factories .see_change').removeClass('disabled');
$(this).fadeOut();
});


$('.brands-info-graphic .brand').on('click', function(){
	var $this = $(this),
	brandImg = $this.attr('data-brand-img'),
	brandParent = $this.attr('data-parent'),
	brandTitle = $this.attr('data-title'),
	brandText = $this.attr('data-text'),
	parentImg,
	brandSub,
	text;
	if(brandParent == 'perdue'){
		//perdue
		text = "Perdue controls 8 percent. In 2014, revenue was $6 billion. Among the top four, they are the only company that is privately held so things like revenue and executive compensation are not publically available.";
		brandSub = "Owned by Perdue";
		parentImg = "images/parent_perdue.jpg";
	}else if(brandParent == 'pilgrims'){
		//pilgrims
		text = "Controls 19 percent. In 2014, Pilgrim’s brought in $8.6 billion in revenue, with profits of $711 million. Pilgrim’s President and CEO John Lovette has seen his compensation rise by 290 percent (to $9.3 million) since 2011.";
		brandSub = "Owned by Pilgrim’s";
		parentImg = "images/logos/parent_pilgrims.jpg";
	}else if(brandParent == 'tyson'){
		text = "Controls 23 percent. In 2014, Tyson brought in $37.8 billion in revenue, with profits of $856 million. Since 2011, compensation for Chairman John Tyson increased 260 percent, to $8.8 million.";
		brandSub = "Owned by Tyson";
		parentImg = "images/logos/parent_tyson.jpg";
	}else if(brandParent == "sanderson farms"){
		text = "Controls 23 percent. In 2014, Tyson brought in $37.8 billion in revenue, with profits of $856 million. Since 2011, compensation for Chairman John Tyson increased 260 percent, to $8.8 million.";
		brandSub = "Owned by Sanderson Farms";
		parentImg = "images/logos/parent_sanderson.jpg";

	}
	$('.brands_overlay .content .text').html(brandText);
	$('.brands_overlay .content .brandImg').attr('src', brandImg);
	$('.brands_overlay .content .brandTitle').html(brandTitle);
	$('.brands_overlay .content .brandSub').html(brandSub);
	$('.brands_overlay .content .parentImg').attr('src', parentImg);
	$('.brands_overlay').fadeIn();
});

$('.brands_overlay .close').on('click', function() {
	$('.brands_overlay').fadeOut();
});

$('.body-tooltip').on('click', function(e){
	e.preventDefault();
	this_target = $(this).attr('href');
	$this = $(this);
	if($(this).hasClass('active') == false){
		$('.overlay-window').fadeOut(function(){
			$('.overlay-window').attr('id',this_target.replace("#",""));
			$('.body-tooltip.active, .injury-content-box.active').removeClass('active');
			$this.addClass('active');
			$(".injury-content-box"+this_target+"-content").addClass('active').fadeIn();
			$(this).find(this_target+"-content").addClass('active');
			// console.log($(this).find(this_target+"-content").length);
		});
		$('.active_body').fadeIn();
		$('.text-block').animate({
			'opacity':'0.3'
		});
		// if ($(window).width()<=480) {
		// 	$('.overlay-window').css({"top": ($('.body-img').offset().top-$('body').scrollTop()+60)+"px"});
		// }
		$('.overlay-window').fadeIn();
	}
	if ($(window).width() <= 768) {
		$('html,body').animate({"scrollTop": ($('.injury-content-box.active').offset().top-60)+"px"},1000,function(){});
	}
	return false;
});

$('.overlay-window .close').on('click', function(e){
	e.preventDefault();
	$('.overlay-window, .active_body').fadeOut(function(){
		$('.body-tooltip.active, .injury-content-box.active').removeClass('active');
		$('.text-block').animate({
			'opacity':'1'
		});
	});
});



function updateContainer() {
	var viewport_height = $(window).height();
	var viewportWidth = $(window).width();

	/*===================================================================
			chapter module
	===================================================================*/
	$('.chapter').each(function() {
		var this_scroll = $(this).offset().top;
		//remove all attributes
		var attributes = $.map(this.attributes, function(item) {
			return item.name;
		});
		var img = $(this);
		$.each(attributes, function(i, item) {
			if (i > 0) {
		//img.removeAttr(item);
		}
		});

		//remove all attributes from module sections
		$(this).find('.module').each(function() {
			var attributes = $.map(this.attributes, function(item) {
				return item.name;
			});
			var img = $(this);
			$.each(attributes, function(i, item) {
				if (i > 0) {
			//img.removeAttr(item);
			}
			});
		});
		//remove all attributes from module sections
		$(this).find('.module_bg').each(function() {
			var attributes = $.map(this.attributes, function(item) {
				return item.name;
			});
			var img = $(this);
			$.each(attributes, function(i, item) {
				if (i > 1) {
			}
			});
		});

		if (viewportWidth > 768) {
			$('.module').each(function() {
			});
		}

	});
}

$(window).resize(function() {
	// Add the resize function to the window resize event but put it on a short timer as to not call it too often
	var resizeTimer;
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(resizeVideo, 150);
	});
}).trigger('resize');


$(document).ready(function() {

	$('.sign-co').on('click', function(e) {
		e.preventDefault();
		$('.navbar .petition_link').trigger('click');
	});
	$('.ch2_vid_co').on('click', function(e) {
		e.preventDefault();
	});
	$('.see_change').on('click', function(e) {
		e.preventDefault();
	});



	// $('.module_tooltips a').each(function() {
	// 	var $thisTip = $(this);
	// 	var $thisY = $thisTip.attr('data-y');
	// 	var $thisX = $thisTip.attr('data-x');
	// 	$thisTip.css({
	// 		"top": $thisY + "%",
	// 		"left": $thisX + "%"
	// 	});
	// });

	// $('.module_tooltips a').on('touchstart click', function(e) {
	// 	e.preventDefault();
	// 	$('.modal .modal_title').html($(this).attr('data-title'));
	// 	$('.modal .modal_content').html($(this).attr('data-text'));
	// 	$('.modal').fadeIn();
	// 	$('html,body').addClass('disable_scroll');
	// });

	$('.modal .close').on('touchstart click', function(e) {
		e.preventDefault();
		$('.modal').fadeOut(function(){
			if($(this).hasClass('bio')){
				$("#bio .bio_image").attr('src','');
				$("#bio .bio_name,#bio .bio_cap,#bio .bio_text,#bio .bio_quote,#bio .bio_title").html('');
			}else if($(this).hasClass('video_modal')) {
					$(this).parents().find('.pause_btn').trigger('click');
					// $("#"+$(this).parents('modal').find('.jp-jplayer').attr('id')).jplayer("stop");
					This_video_id = "#"+$(this).find('.jp-jplayer').attr('id');
					$(This_video_id).jPlayer("destroy");
				}
				$('html,body').removeClass('disable_scroll');
		}).removeClass('active');
		$('html,body').removeClass('disable_scroll');
		if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
			$('html,body').height('auto');
		}
	});

	var petition_expanded = false
	,	current_scroll_top = 0
	;
	$('.petition_link').on('click', function(e) {
		e.preventDefault();
			//MOBILE

		if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
			$('.petition').height($(window).height());
			if($(window).width()>767){
			$('.petition_text,.petition .form_container').height(($(window).height()) + "px");
			}
			if ($('#navigation').hasClass('active') && $('.petition').hasClass('expanded')){
				//nav open and petition expanded
				$('html,body').height('auto');
				$('html,body').scrollTop(current_scroll_top);
				$('.petition').removeClass('expanded');
			} else if($('#navigation').hasClass('active')==false && $('.petition').hasClass('expanded')) {
				//nav closed and petition expanded
				$('.navigation-bg').fadeOut();
				$('html,body').height('auto');
				$('html,body').scrollTop(current_scroll_top);
				$('.petition').removeClass('expanded');
				$('html,body').removeClass('disable_scroll');
			}else if($('#navigation').hasClass('active') && $('.petition').hasClass('expanded') == false){
				//nav open and petition closed
				current_scroll_top = $(document).scrollTop();

				$('.petition').addClass('expanded');
				$('.navigation-bg').fadeIn();
				$('html,body').height($(window).height());
			}else if($('#navigation').hasClass('active') == false && $('.petition').hasClass('expanded') == false){
				current_scroll_top = $(document).scrollTop();
				$('html,body').addClass('disable_scroll');
				$('.navigation-bg').fadeOut();
				$('.petition').addClass('expanded');
				$('.navigation-bg').fadeIn();
				$('html,body').height($(window).height());
			}
		}else{
			//DESKTOP
			$('.petition_text,.petition .form_container').height(($(window).height() - $("#navigation").outerHeight()) + "px");

			if ($('#navigation').hasClass('active') && $('.petition').hasClass('expanded')){
				//nav open and petition expanded
				$('.petition').removeClass('expanded');

			} else if($('#navigation').hasClass('active') == false && $('.petition').hasClass('expanded')) {
				//nav closed and petition expanded
				$('.navigation-bg').fadeOut();
				$('.petition').removeClass('expanded');
				$('html,body').removeClass('disable_scroll');

			}else if($('#navigation').hasClass('active') && $('.petition').hasClass('expanded') == false){
				//nav open and petition closed
				$('.petition').addClass('expanded');
				$('.navigation-bg').fadeIn();

			}else if($('#navigation').hasClass('active') == false && $('.petition').hasClass('expanded') == false){
				$('html,body').addClass('disable_scroll');
				$('.petition').addClass('expanded');
				$('.navigation-bg').fadeIn();

			}
		}
	});
	$('body').on('click',"#nav-toggle", function(e) {
		e.preventDefault();
		if ($('#navigation').hasClass('active')) {

			$('#navigation,#progress,.petition,.navbar').removeClass('active');
			$(this).removeClass('active');
			if($('.petition').hasClass('expanded')==false){
				$('html,body').removeClass('disable_scroll');
				if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
					$('html,body').height('auto');
				}
				$('.navigation-bg').fadeOut();
			}else{
				$('html,body').addClass('disable_scroll');
				if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
					$('html,body').height($(window).height());
				}
			}
			if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
				$('.petition').height($(window).height());
			}else{
				$('.petition_text,.petition .form_container').height(($(window).height()) + "px");
			}
		} else {
			$(this).addClass('active');
			$('#navigation,#progress,.petition,.navbar').addClass('active');
			$('html,body').addClass('disable_scroll');
			$('.navigation-bg').fadeIn();
			setTimeout(function(e) {
				if($(window).width()<=480){
					$('.petition').height($(window).height());
				}else{
					$('.petition_text,.petition .form_container').height(($(window).height() - $("#navigation").outerHeight()) + "px");
				}

			}, 300);
			
		}
	});

	//custom accordion code
	$('#accordion .panel-title a').on('click', function(e) {
		var accordion_target = $(this).attr('data-href')
		if ($(accordion_target).hasClass('collapse') == false) {
			$(accordion_target).addClass('collapse');
			$(this).removeClass('active');
		} else {
			$.each($('#accordion .panel-title a'), function() {
				$(this).removeClass('active');
			});
			$.each($('.panel-collapse'), function(e) {
				if ($(this).hasClass('collapse') == false) {
					$(this).addClass('collapse');
				}
			});
			$(accordion_target).removeClass('collapse');
			$(this).addClass('active');

		}
	});

	//on window resize call initializer
	//TODO: This might be a big issue.
	// 1. Not debouncing so likely firing erratically
	// 2. On  window resize adds event listener for resize that then triggers a resize event. Infininite loop?
	$(window).resize(function() {
		$(window).bind('resize', function(e) {
			window.resizeEvt;
			$(window).resize(function() {
				clearTimeout(window.resizeEvt);
				window.resizeEvt = setTimeout(function() {
					updateContainer();
					if (!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
						s.refresh();
					}
				}, 250);
			});
		});
	});

	//SOCIAL BUTTONS
	$('.socbtn').on('click', function(e){
		e.preventDefault();
		var msg = encodeURIComponent($(this).attr('data-msg'));
		var link = $(this).attr('data-link');
		if(typeof link == 'undefined'){
			link = window.location;
			// alert(link);
		}
		if(typeof msg == 'undefined' || msg == ''){
			msg = $('meta[property="og:description"]').attr("content");
		}
		if($(this).hasClass('tw')){
			url = 'http://twitter.com/?status='+msg+'+'+link;
		}else if($(this).hasClass('fb')){
			url = 'https://www.facebook.com/dialog/feed?app_id=763894097072173&display=popup&caption='+msg+'&link='+link+'&redirect_uri='+SERVER_URL;
		}
		var pop = window.open(url,'name','height=500,width=500');
		if (window.focus){
			pop.focus();
		}
		return false;
	});

	/**MODALS**/
	//console.log(bios[0]);
	$('.launch_modal').on('click', function(e){
		e.preventDefault();
		var $this_modal = $(this);
		if ($this_modal.hasClass('video')) {
			var this_target = $this_modal.attr('href');
			var vid_src = $(this_target).find('.video_player').attr("data-src");
			var vid_id =$(this_target).find('.video_player').attr("data-id");
			var poster_src = $(this_target).find('.video_player').attr('data-poster');
			var isLoop = false;
				videoWidth = '100%';
				videoHeight = "auto"
			$("#video_" + vid_id).jPlayer({
				ready: function() {
					$(this).jPlayer("setMedia", {
						// title: "Big Buck Bunny",
						m4v: vid_src + ".mp4",
						ogv: vid_src + ".ogv",
						poster: poster_src
					});
					$(this).jPlayer("play",0);
					$('.fake_play[data-id="'+vid_id+'"]').hide();
					$('.fake_pause[data-id="'+vid_id+'"]').show();

				},
				ended: function(){
					if($(window).width()<=767){
						$(this_target).find('.close').trigger('click');
					}
				},
				supplied: "m4v, ogv",
				cssSelectorAncestor: "#video_player_" + vid_id,
				cssSelector: {
					title: "#vid_" + vid_id + "_title",
					play: "#vid_" + vid_id + "_play",
					pause: "#vid_" + vid_id + "_pause",
					stop: "#vid_" + vid_id + "_stop",
					mute: "#vid_" + vid_id + "_mute",
					unmute: "#vid_" + vid_id + "_unmute",
					currentTime: "#vid_" + vid_id + "_currentTime",
					duration: "#vid_" + vid_id + "_duration",
					playbackRateBarValue: ".playback-rate-bar-value",
					playbackRateBar: ".playback-rate-bar",
					seekBar: "#vid_" + vid_id + "_seek_bar",
					playBar: "#vid_" + vid_id + "_play_bar"

				},
				size: {
					width: videoWidth,
					height: videoHeight
				}
			});


			$(this_target).fadeIn().addClass('active');
			$('html,body').addClass('disable_scroll');
		} else if ($this_modal.hasClass('bio')) {
			if(bios[$this_modal.attr('data-bio-id')].name != undefined){
				$("#bio .bio_name").html(bios[$this_modal.attr('data-bio-id')].name);
			}
			if(bios[$this_modal.attr('data-bio-id')].img != undefined){
				$("#bio .bio_image").attr('src',bios[$this_modal.attr('data-bio-id')].img);
			}
			if(bios[$this_modal.attr('data-bio-id')].title != undefined){
				$("#bio .bio_title").html(bios[$this_modal.attr('data-bio-id')].title);
			}
			if(bios[$this_modal.attr('data-bio-id')].quote != undefined){
				$("#bio .bio_quote").html(bios[$this_modal.attr('data-bio-id')].quote);
			}
			if(bios[$this_modal.attr('data-bio-id')].text != undefined){
				$("#bio .bio_text").html(bios[$this_modal.attr('data-bio-id')].text);
			}
			if(bios[$this_modal.attr('data-bio-id')].caption != undefined){
				$("#bio .bio_cap").html('<div class="caption">'+bios[$this_modal.attr('data-bio-id')].caption+'</div>');
			}
			this_target = $this_modal.attr('href');
			$(this_target).fadeIn();
			$('html,body').addClass('disable_scroll');
		} else if ($this_modal.hasClass('about')) {
			$('#nav-toggle').trigger('click');
			this_target = $this_modal.attr('href');
			$(this_target).fadeIn();
			$('html,body').addClass('disable_scroll');
		}
	});

	function initParallax(){
			$.each($('.intro-module'), function() {
				var cardverticalPos = (($(window).height() / 2) - $(this).find('.title_card').outerHeight() / 2) + "px";
				var textverticalPos = (($(window).height() / 2) - $(this).find('.intro_text').outerHeight() / 2) + "px";
				// console.log($(this).offset().top);
				//keyframes for chapter intros
				var kf_0 = $(this).offset().top;
				var kf_1 = $(this).offset().top - 3;
				var kf_2 = $(this).offset().top - 2;
				var kf_3 = $(this).offset().top - 2 + 715;
				var kf_4 = $(this).offset().top + 2 + 1430;
				var kf_5 = $(this).offset().top + 2145;
				var kf_6 = $(this).offset().top + 2146;
				var kf_7 = $(this).offset().top + 2860;
				var kf_8 = $(this).offset().top + 3575;
				var kf_9 = $(this).offset().top + 4290;
				var kf_10 = $(this).offset().top + 4291;
				var kf_11 = $(this).offset().top + 5000;
				var kf_12 = $(this).offset().top + 5001;

				$(this).find('.videoContainer.intro').attr('data-' + kf_0, "position: relative;");
				$(this).find('.videoContainer.intro').attr('data-' + kf_1, "position: relative;");
				$(this).find('.title_card').attr('data-' + kf_1, "top: -500000px;opacity:1; margin-top: 0px;");
				$(this).find('.title_card').attr('data-' + kf_2, "top: 100px;opacity:1; margin-top: 0px");

				//fade In
				$(this).find('.title_card').attr('data-' + kf_3, "top: 100px;opacity:1; margin-top: 0px");
				$(this).find('.title_card').attr('data-' + kf_4, "top: 100px;opacity:1; margin-top: 0px");

				//fade OUT
				$(this).find('.title_card').attr('data-' + kf_5, "top: 100px;opacity:0; margin-top: -40px");
				$(this).find('.title_card').attr('data-' + kf_6, "top: -500000px;opacity:0; margin-top: 0px;");

				$(this).find('.intro_text').attr('data-' + kf_5, "top: -500000px;opacity:0; margin-top: 0px;");
				$(this).find('.intro_text').attr('data-' + kf_6, "top: 100px;opacity:0; margin-top: 0px");

				//fade In
				$(this).find('.intro_text').attr('data-' + kf_7, "top: 100px;opacity:1; margin-top: 0px");
				$(this).find('.intro_text').attr('data-' + kf_8, "top: 100px;opacity:1; margin-top: 0px");

				//fade OUT
				$(this).find('.intro_text').attr('data-' + kf_9, "top: 100px;opacity:0; margin-top: -40px");
				$(this).find('.intro_text').attr('data-' + kf_10, "top: -500000px;opacity:0; margin-top: 0px;");

				$(this).find('.videoIntro').attr('data-' + kf_0, "top: 100px;opacity:1; margin-top: 0px");
				$(this).find('.videoIntro').attr('data-' + kf_10, "top: 100px;opacity:1;");

				$(this).find('.videoIntro').attr('data-' + kf_11, "top:100px;opacity:0;");
				$(this).find('.videoIntro').attr('data-' + kf_12, "top: -500000px;opacity:0; margin-top: 0px;");
				$(this).find('.videoContainer.intro').attr('data-' + kf_11, "position: relative;");
				$(this).find('.videoContainer.intro').attr('data-' + kf_12, "position: relative;");

			});


			var preChapter1 = $('#chapter_1_top').offset().top;
			var chapter1end = $('#chapter_1_top').offset().top + $('.chapter1').outerHeight()-1;
			var preChapter2 = $('#chapter_2_top').offset().top;
			var chapter2end = $('#chapter_2_top').offset().top + $('.chapter2').outerHeight() - 1;
			var preChapter3 = $('#chapter_3_top').offset().top;
			var chapter3end = $('#chapter_3_top').offset().top+$('.chapter3').outerHeight()-1;
			var preChapter4 = $('#chapter_4_top').offset().top;
			var chapter4end = $('#chapter_4_top').offset().top+$('.chapter4').outerHeight()-1;
			var preChapter5 = $('#chapter_5_top').offset().top;
			var chapter5end = $('#chapter_5_top').offset().top+$('.chapter4').outerHeight()-1;
			var $progress = $("#progress");
			$("#progress").attr('data-start',"width: 0%; background-color: rgb(255,162,0);")
				.attr('data-'+chapter1end,"width: 14.1%; background-color: rgb(255,162,0);")
				.attr('data-'+preChapter2, "width: 14.12%; background-color: rgb(10,155,217);")
				.attr('data-'+chapter2end, "width: 33.9%; background-color: rgb(10,155,217);")
				.attr('data-'+preChapter3,"width: 33.91%; background-color: rgb(231,0,82);")
				.attr('data-'+chapter3end,"width: 48.2%; background-color: rgb(231,0,82);")
				.attr('data-'+preChapter4,"width: 48.23%; background-color: rgb(139, 60, 217);")
				.attr('data-'+chapter4end,"width: 89.1%; background-color: rgb(139, 60, 217);")
				.attr('data-'+preChapter5,"width: 89.12%; background-color: rgb(97, 165, 52);")
				.attr('data-end',"width: 100%; background-color: rgb(97, 165, 52);");

			var active_chapter = 1;
			var video_load_array = [0,0,0,0,0];


			var s = skrollr.init({
				smoothScrolling: false,
				forceHeight: false,
				render: function(data) {
					//get each video top
					$.each($('.video_player'), function() {
						var $this_id = $("#" + $(this).find('.jp-jplayer').attr('id'));
						var fake_id = $this_id.attr('data-id');
						var this_module_height = $(this).parents('.section_background').outerHeight();
						if ($(this).parents().hasClass('intro')) {
							this_module_height = $(this).parents('.intro').outerHeight();
						}
						var this_video_top = $(this).offset().top - 300;
						var this_video_bottom = this_module_height + this_video_top - 300;
						if (data.curTop >= this_video_top && data.curTop <= this_video_bottom) {
							var play_this_video = true;
							$this_id.jPlayer("play");
							$('.fake_play[data-id="'+fake_id+'"]').hide();
							$('.fake_pause[data-id="'+fake_id+'"]').show();

						} else {
							var play_this_video = false;
							$this_id.jPlayer("pause");
							$('.fake_play[data-id="'+fake_id+'"]').show();
							$('.fake_pause[data-id="'+fake_id+'"]').hide();
						}
					});
					if (data.curTop) {
						//console.log((data.curTop/$('html').outerHeight())*100);
						var active_chapter = 1;
						var video_load_array = [0,0,0,0,0,0];
						if(data.curTop < $('#chapter_2').offset().top){
							active_chapter = 1;
							$('.modal .current_time, .modal .bio_quote').css({'color':'rgb(255, 162, 0)'});
						}else if(data.curTop < $('#chapter_3').offset().top){
							active_chapter = 2;
							$('.modal .current_time, .modal .bio_quote').css({'color':'#0a9bd9'});
						}else if(data.curTop < $('#chapter_4').offset().top){
							active_chapter = 3;
							$('.modal .current_time, .modal .bio_quote').css({'color':'rgb(231, 0, 82)'});
						}else if(data.curTop < $('#chapter_5').offset().top){
							active_chapter = 4;
							$('.modal .current_time, .modal .bio_quote').css({'color':'rgb(139, 60, 217)'});
						}else{
							active_chapter = 5;
							$('.modal .current_time, .modal .bio_quote').css({'color':'rgb(119, 203, 64)'});
						}
						previous_chapter = active_chapter-1;
						next_chapter = active_chapter+1;
						if(video_load_array[active_chapter]==0){
							$.each($('#chapter_'+active_chapter+' .video_player'), function(e) {
								var vid_src = $(this).attr("data-src");
								var vid_id = $(this).attr("data-id");
								var poster_src = $(this).attr('data-poster');
								var isLoop = false;
								if ($(this).parents('.intro').length > 0) {
									resizeVideo();
									isloop = true;
								} else {
									videoWidth = '100%';
									videoHeight = "auto"
								}
								$("#video_" + vid_id).jPlayer({
									ready: function() {
										$(this).jPlayer("setMedia", {
											// title: "Big Buck Bunny",
											m4v: vid_src + ".mp4",
											ogv: vid_src + ".ogv",
											poster: poster_src
										});
									},
									supplied: "m4v, ogv",
									cssSelectorAncestor: "#video_player_" + vid_id,
									cssSelector: {
										title: "#vid_" + vid_id + "_title",
										play: "#vid_" + vid_id + "_play",
										pause: "#vid_" + vid_id + "_pause",
										stop: "#vid_" + vid_id + "_stop",
										mute: "#vid_" + vid_id + "_mute",
										unmute: "#vid_" + vid_id + "_unmute",
										currentTime: "#vid_" + vid_id + "_currentTime",
										duration: "#vid_" + vid_id + "_duration",
										playbackRateBarValue: ".playback-rate-bar-value",
										playbackRateBar: ".playback-rate-bar",
										seekBar: "#vid_" + vid_id + "_seek_bar",
										playBar: "#vid_" + vid_id + "_play_bar"

									},
									size: {
										width: videoWidth,
										height: videoHeight
									}
								});
							});
							video_load_array[active_chapter] = 1;
						}
						if(video_load_array[next_chapter] == 1){
						$.each($('#chapter_'+next_chapter+' .video_player'), function(e) {
							var vid_id = $(this).attr("data-id");
							$("#video_" + vid_id).jPlayer("destroy");
							video_load_array[next_chapter] = 0;
							console.log('unloading #chapter_'+next_chapter);
						});
						}
						if(video_load_array[previous_chapter] == 1){
						$.each($('#chapter_'+previous_chapter+' .video_player'), function(e) {
							var vid_id = $(this).attr("data-id");
							$("#video_" + vid_id).jPlayer("destroy");
							video_load_array[previous_chapter] = 0;
							console.log( 'unloading #chapter_'+previous_chapter);
						});
						}
					}
				}
			});
			skrollr.menu.init(s, {
				change: function(hash, top) {
				//console.log(hash, top);
				}
			});

			$('#navigation a.navLink').on('touchstart click', function(e) {
				e.preventDefault();
				// e.stopPropagation();
				$('#nav-toggle').trigger('click');
				$('.modal .close').trigger('click');
			});


			$.each($('.intro .video_player'), function(e) {
				var vid_src = $(this).attr("data-src");
				var vid_id = $(this).attr("data-id");
				var poster_src = $(this).attr('data-poster');
				var isLoop = false;
				if ($(this).parents('.intro').length > 0) {
					resizeVideo();
					isloop = true;
				} else {
					videoWidth = '100%';
					videoHeight = "auto"
				}
				$("#video_" + vid_id).jPlayer({
					ready: function() {
						$(this).jPlayer("setMedia", {
							// title: "Big Buck Bunny",
							m4v: vid_src + ".mp4"
							// ogv: vid_src + ".ogv",
							// poster: "transparent.png"
						});
					},
					loop: true,
					supplied: "m4v, ogv",
					cssSelectorAncestor: "#video_player_" + vid_id,
					cssSelector: {
						title: "#vid_" + vid_id + "_title",
						play: "#vid_" + vid_id + "_play",
						pause: "#vid_" + vid_id + "_pause",
						stop: "#vid_" + vid_id + "_stop",
						mute: "#vid_" + vid_id + "_mute",
						unmute: "#vid_" + vid_id + "_unmute",
						currentTime: "#vid_" + vid_id + "_currentTime",
						duration: "#vid_" + vid_id + "_duration",
						playbackRateBarValue: ".playback-rate-bar-value",
						playbackRateBar: ".playback-rate-bar",
						seekBar: "#vid_" + vid_id + "_seek_bar",
						playBar: "#vid_" + vid_id + "_play_bar"

					},
					size: {
						width: videoWidth,
						height: videoHeight
					}
				});
			});
			video_load_array[active_chapter] = 1;

			setTimeout(resizeVideo, 500);
			setTimeout(function() {
				$('.loading').fadeOut();
			}, 600);

		}

		$('body').on('click', '.fake_play', function(e){
			e.preventDefault();
			var this_video_id = $(this).attr('data-id');
			$('#vid_'+this_video_id+'_play').trigger('click');
		});
		$('body').on('click', '.fake_pause', function(e){
			e.preventDefault();
			var this_video_id = $(this).attr('data-id');
			$('#vid_'+this_video_id+'_pause').trigger('click');
		});
		$('.play_btn').on('click', function() {
			$(this).siblings('.videoContainer').find('.fake_play').hide();
			$(this).siblings('.videoContainer').find('.fake_pause').show();

		});
		$('.pause_btn').on('click', function() {
			$(this).siblings('.videoContainer').find('.fake_pause').hide();
			$(this).siblings('.videoContainer').find('.fake_play').show();

		});


	//call initializer
	updateContainer();
	if (!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
		setTimeout(initParallax, 5000);
	}else{
		$('body').on('click touchstart','.menu a.navLink', function (e) {
			e.preventDefault();
			// e.stopPropagation();
			this_link_target = $(this).attr('href');
			setTimeout(function(){
				$('body, html').scrollTop($(this_link_target).offset().top);
				$("#nav-toggle").trigger('click');
				$('.modal .close').trigger('click');
			}, 0);
		});

		$('.loading').fadeOut();
		$('.videoIntro').each(function(){
			var bg_image = $(this).find('.video_player').attr('data-poster');
			$('<div style="opacity:0.3; position:absolute; height:100%; width: 100%; background-image: url('+bg_image+');"></div>').insertAfter(this);
			$(this).remove();
		});
		$(document).on('scroll',function(){
			var mobilescroll = $(document).scrollTop()
			,	active_chapter = 1
			,	video_load_array = [0,0,0,0,0,0]
			;
		if(mobilescroll < $('#chapter_2').offset().top){
			active_chapter = 1;
		}else if(mobilescroll < $('#chapter_3').offset().top){
			active_chapter = 2;
		}else if(mobilescroll < $('#chapter_4').offset().top){
			active_chapter = 3;
		}else if(mobilescroll < $('#chapter_5').offset().top){
			active_chapter = 4;
		}else{
			active_chapter = 5;
		}
		previous_chapter = active_chapter-1;
		next_chapter = active_chapter+1;
		if(video_load_array[active_chapter]==0){
			$.each($('#chapter_'+active_chapter+' .video_player'), function(e) {
				var vid_src = $(this).attr("data-src");
				var vid_id = $(this).attr("data-id");
				var poster_src = $(this).attr('data-poster');
				var isLoop = false;
				if ($(this).parents('.intro').length > 0) {
					resizeVideo();
					isloop = true;
				} else {
					videoWidth = '100%';
					videoHeight = "auto"
				}
				$("#video_" + vid_id).jPlayer({
					ready: function() {
						$(this).jPlayer("setMedia", {
							// title: "Big Buck Bunny",
							m4v: vid_src + ".mp4",
							// ogv: vid_src + ".ogv",
							poster: poster_src
						});
					},
					supplied: "m4v, ogv",
					cssSelectorAncestor: "#video_player_" + vid_id,
					cssSelector: {
						title: "#vid_" + vid_id + "_title",
						play: "#vid_" + vid_id + "_play",
						pause: "#vid_" + vid_id + "_pause",
						stop: "#vid_" + vid_id + "_stop",
						mute: "#vid_" + vid_id + "_mute",
						unmute: "#vid_" + vid_id + "_unmute",
						currentTime: "#vid_" + vid_id + "_currentTime",
						duration: "#vid_" + vid_id + "_duration",
						playbackRateBarValue: ".playback-rate-bar-value",
						playbackRateBar: ".playback-rate-bar",
						seekBar: "#vid_" + vid_id + "_seek_bar",
						playBar: "#vid_" + vid_id + "_play_bar"

					},
					size: {
						width: videoWidth,
						height: videoHeight
					}
				});
			});
			video_load_array[active_chapter] = 1;
		}


		if(video_load_array[next_chapter] == 1){
		$.each($('#chapter_'+next_chapter+' .video_player'), function(e) {
			var vid_id = $(this).attr("data-id");
			$("#video_" + vid_id).jPlayer("destroy");
			video_load_array[next_chapter] = 0;
			console.log('unloading #chapter_'+next_chapter);
		});
		}
		if(video_load_array[previous_chapter] == 1){
		$.each($('#chapter_'+previous_chapter+' .video_player'), function(e) {
			var vid_id = $(this).attr("data-id");
			$("#video_" + vid_id).jPlayer("destroy");
			video_load_array[previous_chapter] = 0;
			console.log( 'unloading #chapter_'+previous_chapter);
		});
		}
		});
	}
});
