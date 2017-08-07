<?php

    /* ----------------------------------------------------
    | Output Menus
    |--------------------------------------------------- */

    function generateFooterMenuLeft() {
      wp_nav_menu( array(
          'theme_location'	  => 'footer-menu-left',
          'menu_class'		    => 'footer-menu-left',
          'container'			    => false
        )
      );
    }

    function generateFooterMenuCenter() {
      wp_nav_menu( array(
          'theme_location'	  => 'footer-menu-center',
          'menu_class'		    => 'footer-menu-center',
          'container'			    => false
        )
      );
    }

    function generateFooterMenuRight() {
      wp_nav_menu( array(
          'theme_location'	  => 'footer-menu-right',
          'menu_class'		    => 'footer-menu-right m-flx-ord2',
          'container'			    => false
        )
      );
    }

    function generateBottomBarMenu() {
      wp_nav_menu( array(
          'theme_location'	  => 'bottom-bar-menu',
          'menu_class'		    => 'bottom-bar-menu',
          'container'			    => false
        )
      );
    }

    /* ----------------------------------------------------
    | ACF Custom Fields
    |--------------------------------------------------- */

    $facebook_URL   = get_field('facebook_url', 'options');
    $twitter_URL    = get_field('twitter_url', 'options');
    $instagram_URL  = get_field('instagram_url', 'options');
    $youtube_URL    = get_field('youtube_url', 'options');

?>

<footer role="contentinfo">
    <div class="upper-wrapper">
        <div class="container upper">
            <div class="row">
                <div class="col-one">
                    <div class="mic-logo"><img src="<?php echo $theme_dir_uri; ?>/img/global/mic-logo.svg" alt="Mount Ida College" width="153"/></div>
                </div>
                <div class="col-two">
                    <?php generateFooterMenuLeft(); ?>
                </div>
                <div class="col-three">
                    <?php generateFooterMenuCenter(); ?>
                </div>
                <div class="col-four">
                    <?php generateFooterMenuRight(); ?>
                    <ul class="m-flx-ord1">
                        <li class="social">
                            <a href="<?php echo ($facebook_URL ? $facebook_URL : ''); ?>" class="icon-fb"><span>Facebook</span></a>
                            <a href="<?php echo ($twitter_URL ? $twitter_URL : ''); ?>" class="icon-tw"><span>Twitter</span></a>
                            <a href="<?php echo ($instagram_URL ? $instagram_URL : ''); ?>" class="icon-ig"><span>Instagram</span></a>
                            <a href="<?php echo ($youtube_URL ? $youtube_URL : ''); ?>" class="icon-yt"><span>YouTube</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-wrapper">
        <div class="container lower">
            <div class="row">
                <div class="col-one">
                    <?php

                        generateBottomBarMenu();
                        $current_year = date('Y');

                    ?>
                    <p class="copyright">Copyright @<?php echo $current_year; ?> Mount Ida College. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <?php // Notification -- Send data from back end to front end //

        // Get the notification fields from the theme options
        $show_notification      = get_field('show_notification', 'options');
        $notification_header    = get_field('notification_header', 'options');
        $notification_body      = get_field('notification_body', 'options');
        $notification_link_url  = get_field('notification_link_url', 'options');
        $notification_link_text = get_field('notification_link_text', 'options');
        $notification_ID        = hash('md4', $notification_header.$notification_body); // Hash the values to create a unique identifier

        $mic_notification = '{
            "ID": "'.$notification_ID.'",
            "display": "'.$show_notification.'",
            "header": "'.$notification_header.'",
            "body": "'.$notification_body.'",
            "link": "'.$notification_link_url.'",
            "linkText": "'.$notification_link_text.'"
        }';

    ?>

    <script type="text/javascript">
        // bind notification to util object
        mic.util.notification = <?php echo $mic_notification; ?>;
    </script>

    <?php wp_footer(); ?>
</footer>
</main>

<!-- Page JS -->
<?php if (file_exists("$theme_dir/js/pages/$pagename.js")) : ?>
  <script src="<?php echo $theme_dir_uri;?>/js/pages/<?php echo $pagename;?>.js"></script>
<?php endif; ?>
<!-- End Page JS -->

</body>
</html>
