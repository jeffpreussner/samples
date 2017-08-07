(function(w, d, t) {
  if (!jQuery) {
    s = w.createElement(t);
    r = w.getElementsByTagName(i)[0];
    s.src = "js/vendor/jquery/jquery-3.1.1.min.js";
    r.parentNode.insertBefore(s, r);
  }
}(window, document, 'script'));

var mic = {

  body_id: null,

  init: function() {

    //set ie 
    // mic.util.isIe7 = $('html').hasClass('ie7');
    // mic.util.isIe8 = $('html').hasClass('ie8');
    // mic.util.isIe9 = $('html').hasClass('ie9');
    // mic.util.isIe10 = $('html').hasClass('ie10');

    //if ie add ie9 styles

    // if(mic.util.isIe7 || mic.util.isIe8 || mic.util.isIe10){
    //   $('html').addClass('ie9');
    // }
    mic.util.isIe = $('html').hasClass('ie9');

    mic.util.isMobile = mic.util.mobileCheck();
    if (Modernizr.flexbox) {
      //supports flexbox
    } else {
        flexibility(document.documentElement);
    }
    this.body_id = $("body").attr("id");
    if (mic.pages.hasOwnProperty(this.body_id)) {
      var page = mic.pages[this.body_id];
      if (page.hasOwnProperty("init") && typeof page.init === "function") {
        page.init(this);
      }
      if (page.hasOwnProperty("bindEvents") && typeof page.bindEvents === "function") {
        page.bindEvents();
      }
    }

    //site-wide event bindings
    mic.util.bindEvents();
    mic.util.addClassNameWhenInView();
    mic.util.micNotification();
    mic.navigation.init();
    mic.util.onLoadFn();
  }, // end init

  util: {
    mobileBreakPoint: 920,
    windowSize: $(window).width(),
    windowHeight: $(window).height(),
    body: $('body'),
    nav: $('.navigation'),
    mainNav: $(".nav-section.bottom"),
    mainNavItem: $(".nav-section.bottom .nav-link > a"),
    underlay: $('.underlay'),
    magicLine: $("#magic-line"),
    cookieName: 'mic__notification',
    isIe9: false,

    mobileCheck: function() {
      if (mic.util.windowSize > mic.util.mobileBreakPoint) {
        return false;
      }
      return true;
    },

    readCookie: function(name) {
      var dc = document.cookie;
      var dcArray = dc.split('; ');

      // set up the cookie as an object
      var cookieObj = {};

      // loop through cookies, structure them as objects
      dcArray.forEach(function(el) {
        var splits = el.split("=");
        cookieObj[splits[0]] = splits[1];
      });

      // return the specified cookie property
      if (cookieObj[name]) {
        return unescape(cookieObj[name]);
      } else {
        return null;
      }
    },

    createCookie: function(name, value, days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));

      var expires = "; expires=" + date.toGMTString();
      document.cookie = name + "=" + value + expires + "; path=/";
    },

    toggleBanner: function() {
      // append the notification to the header
      $("header .navigation-wrapper").after('<div class="mic__notification">' +
        '<span class="icon-caution"></span>' +
        '<div class="container">' +
        '<h3>' + mic.util.notification.header + '</h3>' + '<p>' + mic.util.notification.body + '<a href="' + mic.util.notification.link + '">' + mic.util.notification.linkText + '</a>' + '</p>' + '</div>' + '<span class="icon-close2"></span></div>');

      // close the notification, update the cookie visible property
      $(".mic__notification span").click(function() {
        $(".mic__notification").fadeOut(500);

        var newCookieProps = escape(JSON.stringify({visible: false, ID: mic.util.notification.ID}));

        // set the new cookie
        mic.util.createCookie(mic.util.cookieName, newCookieProps, 14);
      });
    },

    micNotification: function() {
      // get the properties of the cookie, structured as an object
      var notificationCookie = mic.util.readCookie(mic.util.cookieName);
      var notificationObj = JSON.parse(notificationCookie);

      // set the default cookie props
      var defaultCookieProps = escape(JSON.stringify({visible: true, ID: mic.util.notification.ID}));

      if (mic.util.notification.display) { // If the user has selected to show a notification

        if (!notificationCookie) { // Set the cookie if it doesn't already exist
          mic.util.createCookie(mic.util.cookieName, defaultCookieProps, 14);
        } else {
          var setCookie = mic.util.readCookie(mic.util.cookieName);
          var setCookieObj = JSON.parse(setCookie);

          var setCookieID = setCookieObj['ID'];

          if (mic.util.notification.ID !== setCookieID) { // Update the cookie if the unique id has changed
            mic.util.createCookie(mic.util.cookieName, defaultCookieProps, 14);
          }
        }

        notificationCookie = mic.util.readCookie(mic.util.cookieName);
        notificationObj = JSON.parse(notificationCookie);

        if (notificationObj && notificationObj['visible']) { // if visible prop === true, show the notification
          mic.util.toggleBanner();
        }

      }
    },

    getParameterByName: function(name, url) {
      if (!url)
        url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results)
        return null;
      if (!results[2])
        return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    },

    // isMobileSize: function(){
    //   if(windowSize > mobileBreakPoint){
    //       return false;
    //   }else{
    //       return true;
    //   }
    // },
    //
    bindEvents: function() {
      jQuery(window).on('load', function() {
        $('.js-focal-point-image').responsify();
      });

      var mainResizeEvent = mic.util.debounce(function() {
        $('.js-focal-point-image').responsify();
        mic.util.isMobile = mic.util.mobileCheck();
      }, 500);
      window.addEventListener('resize', mainResizeEvent);

      // remove 'mask-bottom' class if last section on page
      var lastSection = $('section').last();

      if (lastSection.hasClass('mask-bottom')) {
        lastSection.removeClass('mask-bottom');
      }

      // style select inputs on ie9
      $(".ie9 select").wrap("<div class='ie-styled-select'></div>");

    },

    debounce: function(func, wait, immediate) {
      var timeout;
      return function() {
        var context = this,
          args = arguments;
        var later = function() {
          timeout = null;
          if (!immediate)
            func.apply(context, args);
          };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow)
          func.apply(context, args);
        };
    },

    // isMobileSize: function(){
    //   return $("div#mobilecheck").is(":visible");
    // },

    addClassNameWhenInView: function() {
      var top = window.pageYOffset || document.documentElement.scrollTop,
        left = window.pageXOffset || document.documentElement.scrollLeft;

      var animateInMultiplier = 1;
      if (mic.pages.hasOwnProperty(mic.body_id) && mic.pages[mic.body_id].animateInMultiplier) {
        animateInMultiplier = mic.pages[mic.body_id].animateInMultiplier;
      }

      function addClassOnScroll() {
        $('.js-animate-in').each(function() {
          if (mic.util.isScrolledIntoView(this, animateInMultiplier) === true) {
            $(this).addClass('js-in-view');
          }
        });
      }
      //check to see that the user loaded the top of the page. If so attach scroll elements to the page.
      if (top < 200) {
        $(".js-animate-in").addClass('js-on');
        $(window).scroll(addClassOnScroll);
        addClassOnScroll();
      } else {
        $(".js-animate-in").removeClass('js-animate-in');
      }
    },

    isScrolledIntoView: function(elem, animateInMultiplier, topOnly) {
      if (!animateInMultiplier)
        animateInMultiplier = 1;

      var docViewTop = $(window).scrollTop();
      var docViewBottom = docViewTop + $(window).height();

      var elemTop = $(elem).offset().top;
      var elemBottom = elemTop + ($(elem).height() * animateInMultiplier);

      // if (!topOnly)
      //   return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
      // else
      return ((elemTop >= docViewTop) && (elemTop < docViewBottom));
    },

    onLoadFn: function() {

      if (! mic.util.isIe && !mic.util.isMobile) {
        if ($('.full-width-hero.has-bg').length > 0) {
          $('.full-width-hero.has-bg').each(function() {
            if (!$(this).hasClass('sl-section')) {
              $(this).css('min-height', (mic.util.windowHeight - $('.navigation').height() + 15) + 'px');
            }
          });
        }
      } else if (mic.util.isIe) {
        if ($('.pb,.hp-section,.pb-section,.wysiwyg-content,.as-section').length > 0) {
          $('.pb,.hp-section,.pb-section,.wysiwyg-content,.as-section').each(function() {
            $(this).addClass('ie9');
          });
        }
      }
    }
  }, // end util

  pages: {},

  navigation: {}
};

$(document).ready(function() {
  mic.init();
});
