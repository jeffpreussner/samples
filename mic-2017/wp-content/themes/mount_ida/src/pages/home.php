<?php // Homepage //

    $page_id = get_the_ID();

?>

<div class="home page-content">

<section class="hp-section hero-slider module1">
    <?php
    if (have_rows('hero_slider')) :
        while (have_rows('hero_slider')) :
            the_row();
            $slide_title                = get_sub_field("slide_title");
            $slide_supporting_text      = get_sub_field("slide_supporting_text");
            $slide_background_image     = get_sub_field("slide_background_image");
            ?>

            <div class="slide" style="background-image: url('<?php echo ($slide_background_image ? $slide_background_image['url'] : ''); ?>');">
                <div class="slide-wrapper">
                    <div class="slide-aligner">
                        <div class="row">
                            <div class="slide-content">
                                <h2><?php echo ($slide_title ? $slide_title : ''); ?></h2>
                                <h5><?php echo ($slide_supporting_text ? $slide_supporting_text : ''); ?></h5>
                                <?php generateCTA('slide_link', $page_id); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    endif; ?>
</section>



<?php  // School Menu //

    /* ----------------------------------------------------
    | School Menu ACF + Functions
    |-----------------------------------------------------*/
    $school_menu_default_title              = get_field("school_menu_default_title");
    $school_menu_default_supporting_text    = get_field("school_menu_default_supporting_text");
    $school_menu_default_background_image   = get_field("school_menu_default_background_image");

    function generateSchoolNav(){
        $school_nav = array();
        while (have_rows('school_slide')) :
            the_row();
            array_push($school_nav, get_sub_field("school_title"));
        endwhile;
        $i = 1;
        for ($x = 0; $x < count($school_nav); $x++){
            echo '<a href="#school'.$i.'"><span>'.$school_nav[$x].'</span></a>';
            $i++;
        }
    }

?>

<img class="slider-img-overlay" src="/wp-content/themes/mount_ida/src/img/global/paint-1.svg"/>

<?php if (have_rows('school_slide')) : ?>
    <section class="hp-section school-menu module2">
        <div class="mobile-slideshow">
            <!-- START OF SCHOOL DEFAULT SLIDE -->
            <div class="school-slide default" style="background-image: url('<?php echo ($school_menu_default_background_image ? $school_menu_default_background_image['url'] : ''); ?>');">
               <div class="school-wrapper">
                   <div class="school-aligner">
                       <div class="col span12">
                           <div class="school-content">
                               <h2 class="school-title"><?php echo ($school_menu_default_title ? $school_menu_default_title : ''); ?></h2>
                               <p class="school-supporting-text"><?php echo ($school_menu_default_supporting_text ? $school_menu_default_supporting_text : ''); ?></p>
                               <?php generateCTA('school_menu_default_links', $page_id); ?>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            <!-- END OF SCHOOL DEFAULT SLIDE -->
            <!-- START OF SCHOOL NAV SLIDES/LOOP -->
            <?php
            $i=1;
            while (have_rows('school_slide')) :
                the_row();
                $school_background_image        = get_sub_field("school_background_image");
                $school_title                   = get_sub_field("school_title");
                $school_supporting_text         = get_sub_field("school_supporting_text");
                ?>
                <div class="school-slide" id="school<?php echo $i; ?>" style="background-image: url('<?php echo ($school_background_image ? $school_background_image['url'] : ''); ?>');">
                    <a href="#" class="close icon-close"></a>
                    <div class="school-wrapper">
                        <div class="school-aligner">
                            <div class="col span12">
                                <div class="school-content">
                                    <h3 class="school-title"><?php echo ($school_title ? $school_title : ''); ?></h3>
                                    <p class="school-supporting-text"><?php echo ($school_supporting_text ? $school_supporting_text : ''); ?></p>
                                    <?php generateCTA('school_links', $page_id); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
            endwhile; ?>
            <!-- END OF SCHOOL NAV SLIDES/LOOP -->
        </div>
        <div class="school-nav">
            <div class="container">
                <div class="nav-inner" >
                    <?php generateSchoolNav(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php // Full Width Content //

    /* ----------------------------------------------------
    | Full Width Content ACF + Functions
    |-----------------------------------------------------*/

    $full_width_content_text_position       = get_field("full_width_content_text_position"); //no html yet
    $full_width_content_title               = get_field('full_width_content_title');
    $full_width_content_subtitle            = get_field('full_width_content_subtitle');
    $full_width_content_supporting_text     = get_field('full_width_content_supporting_text');
    $full_width_content_image               = get_field("full_width_content_image");

?>

<section class="hp-section full-width-content module3">
    <div class="container">
        <div class="row">
            <div class="column">
                <div class="img-mask2">
                    <img src="http://placehold.it/543x329">
                </div>
            </div>
            <div class="column">
                <div class="text-content">
                    <h6 class="sub-title"><?php echo ($full_width_content_subtitle ? $full_width_content_subtitle : ''); ?></h6>
                    <h3 class="full-width-content-title"><?php echo ($full_width_content_title ? $full_width_content_title : ''); ?></h3>
                    <p class="full-width-content-text">
                        <?php echo ($full_width_content_supporting_text ? $full_width_content_supporting_text : ''); ?>
                    </p>
                    <?php generateCTA('full_width_content__links', $page_id); ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php // Facts //

    /* ----------------------------------------------------
    | FACTS ACF + Functions
    |-----------------------------------------------------*/

    $facts_title = get_field("facts_title");

?>

<section class="hp-section facts module4">
    <div class="fact-container container flex">
        <h3 class="facts-title"><?php echo ($facts_title ? $facts_title : ''); ?></h3>
        <?php if(have_rows('facts')) : ?>
            <div class="fact-wrapper">
                <?php while (have_rows('facts')) :
                    the_row();
                    $styled = get_sub_field("styled_text");
                    $detail = get_sub_field("detail_text");
                    ?>

                    <div class="fact">
                        <h4 class="styled-text"><?php echo ($styled ? $styled : ''); ?></h4>
                        <p class="detail-text"><?php echo ($detail ? $detail : ''); ?></p>
                    </div>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php generateCTA('facts_links', $page_id); ?>
    </div>
</section>



<?php // Image Grid

    /* ----------------------------------------------------
    | Img Grid ACF
    |-----------------------------------------------------*/

    $image_grid_title                = get_field('image_grid_title');
    $image_grid_supporting_text      = get_field('image_grid_supporting_text');
    $grid_images                     = get_field('image_grid_images');

?>

<section class="hp-section image-grid module5 mask-top mask-bottom">
    <?php if($image_grid_title || $image_grid_supporting_text ) :?>
        <div class="grid-text-container">
            <div class="grid-text">
                <div class="inner">
                    <h4><?php echo ($image_grid_title ? $image_grid_title : ''); ?></h4>
                    <p><?php echo ($image_grid_supporting_text ? $image_grid_supporting_text : ''); ?></p>
                    <!-- class below is only btn secondary, ask if theres going to be a third option for outline -->
                    <?php generateCTA('image_grid_links', $page_id); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php ImageGrid($grid_images); ?>
</section>



<?php // News //

    /* ----------------------------------------------------
    | News ACF + Functions
    |-----------------------------------------------------*/

    $news_feed_title                = get_field("news_feed_title");
    $news_feed_link_cta             = get_field("news_feed_link_cta");
    $news_feed_external_link        = get_field("news_feed_external_link"); //truefalse
    $news_feed_link_url_external    = get_field("news_feed_link_url_external");

    $news_link = '';
    if ($news_feed_external_link) { $news_link = $news_feed_link_url_external; }
    $news_ID = get_option('page_for_posts');
?>

<section class="hp-section news">
        <div class="container">
            <div class="row">
            <h3 class="section-title"><?php echo ($news_feed_title ? $news_feed_title : ''); ?></h3>
            <div class="news-container">
                <div class="news-slider-wrapper">
                    <?php generateNews(); ?>
                </div>
            </div>
            <!-- <div class="slider-nav"><div class="scrollbar"></div></div> -->
            <div class="btn-container centered">
                <a href="<?php echo get_permalink($news_ID); ?>" class="btn outlined-green block-centered m-block"><span><?php echo ($news_feed_link_cta ? $news_feed_link_cta : ''); ?></span></a>
            </div>
        </div>
    </div>
    <div class="slider-nav"></div>
</section>



<?php // Dates //

    // ACF
    $dates_enable_important_dates   = get_field('dates_enable_important_dates'); // bool

?>

<?php if ($dates_enable_important_dates) : ?>
<section class="hp-section dates module7">
    <div class="container">
        <?php getImportantDates($page_id); ?>
    </div>
</section>
<?php endif; ?>



<?php // Full Width Promo

    /* ----------------------------------------------------
    | Full Width Promo ACF
    |-----------------------------------------------------*/

    $full_width_promo                   = get_field('full_width_promo');

    $full_width_promo_fields            = get_fields($full_width_promo);

    $full_width_promo_background_image  = $full_width_promo_fields['full_width_promo_background_image'];
    $full_width_promo_image             = $full_width_promo_fields['full_width_promo_image']; //no html yet
    $full_width_promo_text_position     = $full_width_promo_fields['full_width_promo_text_position']; //no html yet
    $full_width_promo_title             = $full_width_promo_fields['full_width_promo_title'];
    $full_width_promo_subtitle          = $full_width_promo_fields['full_width_promo_subtitle'];
    $full_width_promo_supporting_text   = $full_width_promo_fields['full_width_promo_supporting_text'];
    $text_pos = 'left-side-text';
    if ($full_width_promo_text_position == "center"){$text_pos="single";}
    if ($full_width_promo_text_position == "right"){$text_pos="right-side-text";}
    if ($full_width_promo_text_position == "left"){$text_pos="left-side-text";}

?>

<?php if ($full_width_promo) : ?>
        <?php if ($full_width_promo_background_image) : ?>
            <section class="hp-section full-width-promo has-bg mask-top module8 <?php echo $text_pos; ?>" style="background-image: url('<?php echo $full_width_promo_background_image['url']; ?>'); background-position: center center; background-size: cover;">
        <?php else : ?>
            <section class="hp-section full-width-promo module9 <?php echo $text_pos; ?>">
        <?php endif; ?>
            <?php generateFWPromo($full_width_promo_title, $full_width_promo_subtitle, $full_width_promo_supporting_text, $full_width_promo); ?>
        </section>
<?php endif; ?>


</div>
