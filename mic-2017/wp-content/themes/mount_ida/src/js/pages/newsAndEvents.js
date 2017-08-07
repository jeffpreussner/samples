mic.pages.newsAndEvents = {


  bindEvents: function () {
    //detects the start of an ajax request being made
    $(document).on("sf:ajaxstart", ".searchandfilter", function(){
      //console.log("ajax start");
    });

    //detects when the ajax request has finished and the content has been updated
    // - add scripts that apply to your results here
    $(document).on("sf:ajaxfinish", ".searchandfilter", function(){
    	//console.log("ajax complete");
    	//so load your lightbox or JS scripts here again
    });
	}


}
