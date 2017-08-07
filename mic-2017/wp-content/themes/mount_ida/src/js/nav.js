
mic.navigation = {
  leftPos: '',
  newWidth: '',
  scrollTop: '',
  magicEl: '',
  closeClicked: false,
  init: function() {
    // console.log(mic.util.windowSize <= mic.util.mobileBreakPoint);
    mic.navigation.enableMagic = mic.navigation.checkForActiveClass();
    if (mic.util.windowSize >= mic.util.mobileBreakPoint) {
      mic.navigation.startTheMagic();
    }
    mic.navigation.bindEvents();

$(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
        console.log('1');
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 54);
        this.rows = minRows + rows;
        console.log('2');
    });
  },

  bindEvents: function() {

    var scrollEvent = mic.util.debounce(function() {
      mic.navigation.scrolltop = $(window).scrollTop();
      mic.navigation.navcollapse(mic.navigation.scrolltop);
    }, 25);

    var navResizeEvent = mic.util.debounce(function() {
      //console.log('resized');
      mic.navigation.resetTheMagic();
    }, 25);

    document.addEventListener('scroll', scrollEvent);
    window.addEventListener('resize', navResizeEvent);

    //////////////////////////////////////////
    // TODO:
    // clean up
    // use classes to animate.
    // below is just for proof of concept
    //////////////////////////////////////////

    $('.opensearch').on('click', function(e) {
      if ($(this).hasClass('active')) {
        $(this).add('.searchform').removeClass('active');
      } else {
        $(this).add('.searchform').addClass('active');
        $('.searchform').find('input[type="text"]').focus();
      }
    });
    $('#fakeform textarea').focus(function(){
      $(this).html('');
    });
    // $('.search-form .submit').on('click', function(e){e.preventDefault();});

    // $('.navigation-menu-button').on('click', function(e) {
    //   e.preventDefault();
    //   if (!$(this).hasClass('active')) {
    //     $(this).addClass('active');
    //     mic.util.body.addClass('overflow-hidden');
    //     $('.nav-section,nav').addClass('active');
    //   } else {
    //     $(this).removeClass('active');
    //     $('.nav-section,nav').removeClass('active');
    //     mic.util.body.removeClass('overflow-hidden');
    //   }
    // });
    // $('.close-modal').on('click', function(e) {
    //   e.preventDefault();
    //   // e.stopPropagation();
    //   $('.modal-container.active').removeClass('active');
    //   $('html').removeClass('disableScroll');
    //   mic.navigation.closeClicked = true;
    //   // return false;
    // });
    // $('#contenteditable').on('focus', function() {
    //   if ($(this).html() == 'Type something here') {
    //     $(this).empty();
    //     // $(this).trigger('focus');
    //   }
    // }).on('keyup paste input', function() {
    //   var $this = $(this);
    //   if ($this.data('before') !== $this.html()) {
    //     $this.data('before', $this.html());
    //     $this.trigger('change');
    //     $('.search-text').val($this.html().replace("<br>", " "));
    //   }
    // }).on('keydown', function(e) {
    //   // trap the return key being pressed
    //   $('.search-text').val();
    //   if (e.keyCode === 13) {
    //     // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
    //     if(mic.util.isMobile && $('.search-text').val() != 'Type something here' &&  $('.search-text').val() != '' ){
    //       $('.search-form input[name="searchwpquery"]').val($('.search-text').val());
    //       $('.search-form').submit();
    //     }
    //     // document.execCommand('insertHTML', false, '<br><br>');
    //     // prevent the default behaviour of return key pressed
    //     return false;
    //   }
    // })
    // .on('blur', function(e){
    //   setTimeout(function(){
    //     //wait for all events handlers then check if close was clicked
    //     if(mic.util.isMobile && !mic.navigation.closeClicked){
    //       $('.search-form input[name="searchwpquery"]').val($('.search-text').val());
    //       $('.search-form').submit();
    //     }else{
    //       mic.navigation.closeClicked = false;
    //     }
    //     },250);
    // });

    $('#fakeform').on('submit', function(e){
       e.preventDefault();
      $('.search-form input[name="searchwpquery"]').val($('#fakeform .autoExpand').val());
      $('.search-form').submit();
    });
    $('.trigger.modal').on('click', function(e) {
      e.preventDefault();
      var $target = $(this).attr('href');
      $($target).addClass('active');
      $('html').addClass('disableScroll');
      if($(this).hasClass('icon-search') && mic.util.isMobile){
        // $('#contenteditable').focus();
      }
    });



    ///////////////////////////////
    //TODO:
    //Clean up and organize
    ///////////////////////////////
    if (mic.util.windowSize <= mic.util.mobileBreakPoint) {
      $('.mobile-nav-link > a').on('click', function(e) {
        $('.nav-link.active').trigger('click');
        var $thisNavLink = $(this).parents('.nav-link'),
          $thisMenu = $(this).parents('.nav-link').find('.dropdown-menu');
        $thisNavLink.removeClass('active');
        $thisMenu.removeClass('active');
        //   console.log('test');
        e.preventDefault();
        e.stopPropagation();

      });
      $('.nav-link > a').on('click', function(e) {
        // console.log($(this).siblings('.dropdown-menu').length);
        if ($(this).siblings('.dropdown-menu').length > 0) {
          //if <a> doesnt have url it is a dropdown
          e.preventDefault();
          var $thisNavLink = $(this).parents('.nav-link'),
            $thisMenu = $(this).parents('.nav-link').find('.dropdown-menu');
          if (!$thisMenu.hasClass('active')) {
            $('.nav-link').each(function() {
              if ($(this).hasClass('active')) {
                $(this).find('a').trigger('click');
                return false;
              }
            });
            $('.dropdown-menu,.nav-link').removeClass('active');
            $thisNavLink.addClass('active');
            $thisMenu.addClass('active');
          } else {
            $thisNavLink.removeClass('active');
            $thisMenu.removeClass('active');
          }
        }
      });
    }
  },

  checkForActiveClass: function() {
    if ($('.current-menu-item').length > 0) {
      mic.navigation.magicEl = '.current-menu-item';
      return true;
    }
    if ($('.current-menu-parent').length > 0) {
      mic.navigation.magicEl = '.current-menu-parent';
      return true;
    }
    return false;

  },
	
  resetTheMagic: function() {
    if (mic.navigation.enableMagic) {
      //console.log('magic-reset');
      $("#magic-line").width($(mic.navigation.magicEl).width()).css("left", $(mic.navigation.magicEl + " > a").position().left).data("origLeft", $(mic.navigation.magicEl + " > a").position().left).data("origWidth", $(mic.navigation.magicEl).width());

      mic.navigation.newWidth = $(mic.navigation.magicEl).width();
      mic.navigation.leftPos = $(mic.navigation.magicEl + " > a").position().left;
      // console.log('triggered magic');
    }
  },

  startTheMagic: function() {
    // console.log(mic.navigation.magicEl);
    if (mic.navigation.enableMagic) {
      mic.navigation.resetTheMagic();
    }
    var $navElement = $(".nav-section.bottom .nav-link > a, .nav-section.bottom .nav-link > .dropdown-menu");
    $navElement.hoverIntent({
      over:
      function() {
        $(this).parents('.nav-link').addClass('hover');
          if (mic.navigation.enableMagic) {
            mic.navigation.leftPos = $(this).position().left;
            mic.navigation.newWidth = $(this).parent().width();
            $("#magic-line").stop().animate({left: mic.navigation.leftPos, width: mic.navigation.newWidth});
          }
          if($(this).siblings('.dropdown-menu').length >0){
            $('.underlay').addClass('active');
          }
      },
      out: function() {
       
          $(this).parents('.nav-link').removeClass('hover');
           var magicInterval = setInterval(function() {
          if(!$('.dropdown-menu').is(':visible')) {
            $('.underlay').removeClass('active');
            clearInterval(magicInterval);
          }
           }, 50); 
            if (mic.navigation.enableMagic) {
              $("#magic-line").stop().animate({
                left: $(mic.navigation.magicEl + " > a").position().left,
                width: $(mic.navigation.magicEl).width()
              });
            }
            // 
          // }
        // }, 50); 

      },
      timeout: 200,
      sensitivity: 1
      });
  },
  navcollapse: function(scroll) {
    if (!mic.util.isMobile) {
      if (scroll > 108 && !$('.navigation').hasClass('collapsed')) {
        //	console.log('collapsed');
        $('.navigation').addClass('collapsed');
        $('body').addClass('collapsed');
        setTimeout(function() {
          mic.navigation.resetTheMagic();
        }, 250);
      } else if (scroll < 108 && $('.navigation').hasClass('collapsed')) {
        //console.log('expand');
        $('.navigation').removeClass('collapsed');
        $('body').removeClass('collapsed');
        setTimeout(function() {
          mic.navigation.resetTheMagic();
        }, 250);
      }
    }
  }
}
