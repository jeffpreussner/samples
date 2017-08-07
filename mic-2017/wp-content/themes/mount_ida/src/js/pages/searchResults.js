
mic.pages.searchResults = {

		init: function () {

				var mobileSelectFilter = {

					  init: function() {
					    	this.bindUIfunctions();
					  },

					  bindUIfunctions: function() {
					      $('.mobile-tab-nav select').on("change", function(event) {
					        	mobileSelectFilter.changeSelect($(this).val());
					        	event.preventDefault();
					      });
					  },

					  changeSelect: function(hash) {
						    var div = $(hash);

						    div.addClass("r-tabs-state-active").siblings().removeClass("r-tabs-state-active");

								$('.tab-content').hide();
								div.show()
					  },
				}

				mobileSelectFilter.init();
		},
		// init

		bindEvents: function () {
				var currentPage = mic.util.getParameterByName('currentpage', window.location.href);
				var activeTab = 0;

				// If paginated
				if (currentPage) { // click on pagination link
						activeTab = mic.util.getParameterByName('tab', window.location.href);
				} else { // first land on page
						// check data-attributes to set active tab
						if ( $('a[href="#pages"]').data('value') > 0 ) {
								activeTab = 0;
						} else if ( $('a[href="#news"]').data('value') > 0 ) {
								activeTab = 1;
						} else if ( $('a[href="#events"]').data('value') > 0 ) {
								activeTab = 2;
						} else if ( $('a[href="#faculty-staff"]').data('value') > 0 ) {
								activeTab = 3;
						}
				}

				// https://github.com/jellekralt/Responsive-Tabs
				$('#search-tabs').responsiveTabs({
						active: activeTab
				});

		}
		// bind events

}
