
mic.pages.graduate = {

  init: function() {
    console.log('grad js');
  },

  bindEvents: function() {

    $('.request-info-modal').click(function(e) {
      e.preventDefault();
      $("#request-info-modal").trigger('click');
    });

    $(function() {
      $("#request-info-modal").on("change", function(e) {
        if ($(this).is(":checked")) {
          $("body").addClass("modal-open");
        } else {
          $("body").removeClass("modal-open");
        }
      });

      $(".modal-fade-screen, .modal-close").on("click", function() {
        $(".modal-state:checked").prop("checked", false).change();
      });

      $(".modal-inner").on("click", function(e) {
        e.stopPropagation();
      });
    });

    var scrollEventAlt = mic.util.debounce(function() {
      mic.pages.graduate.navcollapse($(window).scrollTop());
    }, 25);

    document.addEventListener('scroll', scrollEventAlt);
  },

  navcollapse : function(scroll) {
    var buttonContainer = $('.btn-container');

    if (scroll > 808 && !buttonContainer.hasClass('stuck')) {
      buttonContainer.addClass('stuck');
    } else if (scroll < 808 && buttonContainer.hasClass('stuck')) {
      buttonContainer.removeClass('stuck');
    }
  }

}
