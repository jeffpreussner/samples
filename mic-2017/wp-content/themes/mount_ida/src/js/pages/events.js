
mic.pages.events = {

  init: function() {

  },

  bindEvents: function() {

      var currentURL = window.location.href;

      // parse url and check if user preforms search via calendar date picker
      var isDateInURL = currentURL.match(/\/[\d]{4}\-[\d]{2}\-[\d]{2}/);

      if (isDateInURL) {
          var activeDate = $('a[href$="' + currentURL + '"]');

          // add active class to date being queried
          activeDate.parent('td').toggleClass('active-date');
      }

      $('.em-date-start').attr('placeholder', 'Start Date');
      $('.em-date-end').attr('placeholder', 'End Date');

  }

}
