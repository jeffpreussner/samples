mic.pages.taxonomy = {
  catName:'product',
  init:function() {
    if ($('section.taxonomy-section').attr('id').indexOf('recipe') >= 0) {
      this.catName = 'recipe';
    }
    this.totalPages = Math.ceil($("."+this.catName).length/9);
  },
  bindEvents:function() {
    var self = this;

    $("section#load-more").click(function(){
      var pageHeight = $("."+self.catName).outerHeight(true) * 3;
      var maxHeight = parseInt($("section#"+self.catName+"s").css("max-height"));
      $("section#"+self.catName+"s").css('max-height', maxHeight + pageHeight);
      if ($("section#"+self.catName+"s")[0].scrollHeight <= maxHeight + pageHeight) {
        $(this).css('opacity', 0);
      }
    });
  }
};
