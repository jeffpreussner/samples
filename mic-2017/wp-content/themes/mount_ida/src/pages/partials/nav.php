<?php

    /* ----------------------------------------------------
    | Output Menus
    |--------------------------------------------------- */

    // Include the modal menu
    get_template_part("$cp_base/pages/partials/modals");

    // Top Bar Menu
    function generateTopBarMenu() {

        wp_nav_menu( array(
              'theme_location'	  => 'top-bar-menu',
              'menu_class'		    => "",
              'menu_id'           => "",
              'container'			    => false,
              'items_wrap'        => topBarMenuWrap()
            )
        );
    }

    // Top Bar Menu Mobile - Used for mobile version
    function generateTopBarMenuMobile() {

        $menu_name  = 'top-bar-menu';
        $locations  = get_nav_menu_locations();
        $menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );

        // fetch all of the menu items
        $mobile_top_bar_menu_items  = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

        foreach ( $mobile_top_bar_menu_items as $item ) {

            // set up title, url and classes
            $title        = $item->title;
            $link         = $item->url;

            echo '<li class="collapsed-link"><a href="'.$link.'">'.$title.'</a></li>';
        }
    }

    // Prepend top bar menu with modal trigger
    function topBarMenuWrap() {

        $wrap  = '<ul id="%1$s" class="%2$s">';
        $wrap .= '<li><i>Information for:</i> <a class="trigger modal" href="#applicants">Applicants</a></li>';
        $wrap .= '%3$s';
        $wrap .= '</ul>';

        return $wrap;
    }

    // Main Nav Menu
    function generateHeaderMenu() {

        $menu_name  = 'header-menu';
        $locations  = get_nav_menu_locations();
        $menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );

        // fetch all of the menu items (WP menu objects)
        $header_menu_items  = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

        // initialize the total menu items count at 0
        $menu_items_count = 0;

        // initialize a counter at 0 (used to split up submenu items into columns)
        $counter = 0;

        // output the classes defined in the WP admin dash.
        // e.g. the CSS Classes (optional) field in the menu
        function outputMenuClasses($arr_of_classes) {
            $classes = '';

            for ($i=0; $i < count($arr_of_classes); $i++) {
                $classes .= $arr_of_classes[$i]." ";
            }

            return $classes;
        }

        // add wp default classes to nav menu - otherwise they are not included
        _wp_menu_item_classes_by_context($header_menu_items);

        // loop through all of the header menu items
        foreach ( $header_menu_items as $item ) {

            // set up title, url and classes
            $title        = $item->title;
            $link         = $item->url;
            $classes      = $item->classes;
            $class_list   = outputMenuClasses($classes);

            // item does not have a parent, this is a parent menu item
            if ( !$item->menu_item_parent ) {

                // save this id for later comparison with sub-menu items
                $parent_id = $item->ID;

                // get the page id of the parent menu item so we can access the custom fields
                $page_id = $item->object_id;

                // get the menu image & text from the parent page custom field
                $parent_page_menu_img   = get_field('parent_page_menu_img', $page_id);
                $parent_page_menu_text  = get_field('parent_page_menu_text', $page_id);

                // output parent items and associated wrapper markup
                if ( isset($header_menu_items[ $menu_items_count + 2]) ) {

                    if ( $header_menu_items[ $menu_items_count + 2]->menu_item_parent == $parent_id ) {  // parent has children - open up submenu
                        echo '<li class="'.$class_list.'"><a href="'.$link.'">'.$title.'</a>
                                  <ul class="dropdown-menu">
                                      <li class="dropdown-container">
                                          <ul>';
                    } else {  // parent menu item does not have children (no submenu)

                       echo '<li class="'.$class_list.'"><a href="'.$link.'">'.$title.'</a></li>';
                   }
                } else {  // parent menu item does not have children (no submenu)

                    echo '<li class="'.$class_list.'"><a href="'.$link.'">'.$title.'</a></li>';
                }

                if ( $parent_page_menu_img ) {  // output the image & text markup in the submenu

                    echo '<li class="nav-col span6">
                              <div class="promo-box">
                                  <div class="promo-img" style="background-image: url('.$parent_page_menu_img.');" data-rjs="3"></div>
                                  <div class="box-content">'.$parent_page_menu_text.'</div>
                              </div>
                          </li>';

                }
            }

            // ff item is a child, then output it
            if ( $parent_id == $item->menu_item_parent ) {

                // the li has a special class for use in the mobile menu
                // the class has been set in the CMS
                if ( preg_match("/mobile-nav-link/", $class_list) || preg_match("/mobile-overview/", $class_list)) {

                    echo '<li class="'.$class_list.'"><a href="'.$link.'">'.$title.'</a></li>';
                }

                else {  // submenu

                    if ( $counter === 0 ) {  // open a new submenu column

                        // submenu wrapper markup
                        echo '<li class="nav-col span3">
                                  <ul>';
                    }

                        // output submenu items
                        echo '<li><a href="'.$link.'">'.$title.'</a></li>';
                        $counter++;

                    // if we're at the last menu item in the menu items array
                    if ( end($header_menu_items)->ID === $header_menu_items[$menu_items_count]->ID  ) {

                        if ($header_menu_items[ $menu_items_count ]->menu_item_parent == 0) {
                            // if top level menu item, do nothing
                            return;
                        } else {
                            // close each submenu column
                            echo '</ul>
                            </li>';

                            // close parent containers
                            echo '</ul>
                                </li>
                              </ul>
                            </li>';

                            // reset the counter
                            $counter = 0;
                        }

                    } else {  // we're still looping through the cols, not at the end yet

                        if ( $counter === 4 || $header_menu_items[ $menu_items_count + 1 ]->menu_item_parent == 0 ) {

                            // close submenu column after every 4 menu items, or if its the last column (next menu item in array is a top level item)
                            echo '</ul>
                            </li>';

                            // reset the counter
                            $counter = 0;
                        }

                        // If this is the end of child items in a menu section, close parent containers
                        if ( $header_menu_items[ $menu_items_count + 1 ]->menu_item_parent == 0 ) {
                            echo '</ul>
                                </li>
                              </ul>
                            </li>';
                        }
                    }
                }
            }

        $menu_items_count++;

        }  // endforeach

    }

?>

<header class="navigation" role="banner">
    <div class="underlay"></div>
    <div class="navigation-wrapper">
        <div class="nav-header">
            <a class="logo-container" href="/">
                <img class="logo" src="<?php echo $theme_dir_uri; ?>/img/global/logo.svg" alt="Mount Ida College">
                <img class="collapsed-logo" src="<?php echo $theme_dir_uri; ?>/img/global/collapsedlogo.svg" alt="Mount Ida College">
            </a>
            <a href="#search" class="trigger modal icon-search" id="js-mobile-search"><span>Search</span></a>
            <a href="#" class="navigation-menu-button icon-menu" id="js-mobile-menu"><span>Menu</span></a>
        </div>
        <nav role="navigation">
            <ul id="js-navigation-menu" class="navigation-menu show">
                <li class="nav-section top">
                    <?php generateTopBarMenu(); ?>
                </li>
                <li class="nav-section bottom">
                    <ul><li id='magic-line'></li>
                        <?php generateHeaderMenu(); ?>
                        <li>
                            <div class="info-content mobile">
                            <i>Information for:</i>
                                <?php generateModalMenu(); ?>
                            </div>
                        </li>
                        <li class="collapsed-links">
                            <ul>
                                <?php generateTopBarMenuMobile(); ?>
                            </ul>
                        </li>
                        <li class="nav-section search">
                            <a class="icon-search opensearch"><span>Search</span></a>
                        </li>
                        <li class="searchform">
                              <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>/search/">
                                <input type="text" placeholder="Type your search here"  name="searchwpquery"/>
                                <button class="submit"><span class="icon-search"></span></button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
