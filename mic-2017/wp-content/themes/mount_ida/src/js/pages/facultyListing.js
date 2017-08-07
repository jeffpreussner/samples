mic.pages.facultyListing = {

    // magicElem: '',
    // leftPosition: '',
    // newWidth: '',

    init: function () {
        //mic.pages.facultyListing.enableMagic = mic.pages.facultyListing.checkForActiveClass1();

        mic.pages.facultyListing.initTopTabs();

        if (mic.util.windowSize >= mic.util.mobileBreakPoint) {
            mic.pages.facultyListing.initFacultyJS();
            mic.pages.facultyListing.initDepartmentJS();
        }

        else{
            mic.pages.facultyListing.initFacultyMobileJS();
            mic.pages.facultyListing.initDepartmentMobileJS();
        }
    },

    /*** MAGIC LINE JS ***/



    /*** TOP NAVIGATION BAND JS ***/

    initTopTabs: function () {
        var TabBlock = {
            s: {
                animLen: 200
            },
            init: function() {
                TabBlock.bindUIActions();
                TabBlock.hideInactive();
            }, 
            bindUIActions: function() {
                $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
                    TabBlock.switchTab($(this));
                });
            },  
            hideInactive: function() {
                var $tabBlocks = $('#faculty-listing');
            
                $tabBlocks.each(function(i) {
                    var 
                        $tabBlock = $($tabBlocks[i]),
                        $panes = $tabBlock.find('.tabBlock-pane'),
                        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
              
                    $panes.hide();
                    $($panes[$activeTab.index()]).show();
                });
            },    
            switchTab: function($tab) {
                var $context = $tab.closest('#faculty-listing');
            
                if (!$tab.hasClass('is-active')) {
                    $tab.siblings().removeClass('is-active');
                    $tab.addClass('is-active');

                    TabBlock.showPane($tab.index(), $context);
                }
            },  
            showPane: function(i, $context) {
                var $panes = $context.find('.tabBlock-pane');
           
                // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
                $panes.slideUp(TabBlock.s.animLen);
                $($panes[i]).slideDown(TabBlock.s.animLen);
            }
        };

        $(function() {
            TabBlock.init();
        });
    },


    /*** FACULTY LISTING JS ***/

    initFacultyJS: function () {

        var iso_faculty = new Isotope( '.faculty-listing', {
            itemSelector: '.faculty',
            layoutMode: 'fitRows'
        });   
        // bind filter button click
        var filtersElem1 = document.querySelector('.alpha-listing');
        filtersElem1.addEventListener( 'click', function( event ) {
            // only work with buttons
            if ( !matchesSelector( event.target, 'a' ) ) {
                return;
            }
            var filterValue1 = event.target.getAttribute('data-filter');
            // use matching filter function
            //filterValue = filterFns[ filterValue ] || filterValue;
            iso_faculty.arrange({ filter: filterValue1 });
        });
        // change selected class on buttons
        var buttonGroups1 = document.querySelectorAll('.filters');
        for ( var i=0, len = buttonGroups1.length; i < len; i++ ) {
            var buttonGroup1 = buttonGroups1[i];
            radioButtonGroup( buttonGroup1 );
        }
        function radioButtonGroup( buttonGroup1 ) {
            buttonGroup1.addEventListener( 'click', function( event ) {
                // only work with buttons
                if ( !matchesSelector( event.target, 'a' ) ) {
                    return;
                }
                buttonGroup1.querySelector('.selected').classList.remove('selected');
                event.target.classList.add('selected');
            });
        }
    },


    /*** DEPARTMENT LISTING JS **/

    initDepartmentJS: function () {

        var iso_department = new Isotope( '.department-listing', {
            itemSelector: '.department',
            layoutMode: 'fitRows'
        });
        // bind filter button click
        var filtersElem2 = document.querySelector('.alpha-listing2');
        filtersElem2.addEventListener( 'click', function( event ) {
            // only work with buttons
            if ( !matchesSelector( event.target, 'a' ) ) {
                return;
            }
            var filterValue2 = event.target.getAttribute('data-filter');
            // use matching filter function
            //filterValue = filterFns[ filterValue ] || filterValue;
            iso_department.arrange({ filter: filterValue2 });
        });
        // change selected class on buttons
        var buttonGroups2 = document.querySelectorAll('.filters2');
        for ( var i=0, len = buttonGroups2.length; i < len; i++ ) {
            var buttonGroup2 = buttonGroups2[i];
            radioButtonGroup( buttonGroup2 );
        }
        function radioButtonGroup( buttonGroup2 ) {
            buttonGroup2.addEventListener( 'click', function( event ) {
                // only work with buttons
                if ( !matchesSelector( event.target, 'a' ) ) {
                    return;
                }
                buttonGroup2.querySelector('.selected').classList.remove('selected');
                event.target.classList.add('selected');
            });
        }
    },


    /*** FACULTY LISTING MOBILE JS **/

    initFacultyMobileJS: function () {
        $(function() {
            var $select = $('#faculty-selector'),
                $faculty =  $('.faculty');

            $select.on('change', function() {
                var value = '.' + $(this).val();
                $faculty.show().not(value).hide();
            });
        });
    },


    /*** DEPARTMENT LISTING MOBILE JS **/

    initDepartmentMobileJS: function () {
        $(function() {
            var $select = $('#department-selector'),
                $department =  $('.department');

            $select.on('change', function() {
                var value = '.' + $(this).val();
                $department.show().not(value).hide();
            });
        });
    },

}; 









