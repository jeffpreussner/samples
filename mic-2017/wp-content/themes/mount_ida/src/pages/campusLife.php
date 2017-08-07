<?php // Campus Life Slides //

    $page_id = get_the_ID();

    // get number of slides
    $slider_rows       = get_field('slide');
    $slider_row_count  = count($slider_rows);

    function campusLifeSlides() {

        $counter    = 1;
        $slidIndex  = 0;
        global $cp_base;

        if (have_rows('slide')) { // campus life slides
            while (have_rows('slide')) {
                the_row();

                // vars
                $slide_background_image   = get_sub_field("slide_background_image");
                $section_bg_img           = '';
                $section_bg_class         = '';

                if ($slide_background_image) {
                    $section_bg_img    = 'style="background-image: url('.$slide_background_image.')"';
                    $section_bg_class  = 'has-bg';
                    // $data_style        = 'data-style="background-image: url('.$slide_background_image.'); background-size: 800px auto; background-attachment: scroll; background-position: center top;"';
                }

                if ($counter == 1) {
                    echo '<div id="slide-nav">
                             <a href="#" class="button template"></a>
                         </div>';
                }

                echo '<section id="module'.$counter.'" class="wysiwyg-content module'.$counter.' '.$section_bg_class.'" '.$section_bg_img.' data-slide-index="'.$slidIndex.'">
                          <div class="module-container"><div class="row">';

                if (have_rows('campus_life_slide_content')) {  // slide flexible layouts
                    while(have_rows('campus_life_slide_content')) {
                        the_row();
                        get_template_part("$cp_base/pages/layouts/layout-" . get_row_layout());
                    }
                }

                echo      '</div>
                        </div>
                    </section>';

                $counter++;
                
                if ($counter % 2 == 0) {
                    $slidIndex++;
                }
            }
        }

    }

?>


<div id="arrow"></div>
<div class="wysiwyg page-content">

<div id="scroll-container">
    <?php campusLifeSlides(); ?>
</div>

<?php // Full Width Module //

    // ACF
    $full_width_content_title             = get_field("full_width_content_title");
    $full_width_content_subtitle          = get_field("full_width_content_subtitle");
    $full_width_content_supporting_text   = get_field("full_width_content_supporting_text");
    $full_width_content_image             = get_field("full_width_content_image");  // ? ask about this
    $full_width_content_styled_image      = get_field("full_width_content_styled_image"); // ? ask about this
    $full_width_content_text_position     = get_field("full_width_content_text_position"); // ? ask about this

?>
<div class="extra">
<section class="wg-section full-width-content single module<?php echo $slider_row_count + 1; ?> ">
    <div class="container">
        <div class="row">
            <div class="column">
                <div class="text-content">
                    <h4><?php echo ($full_width_content_subtitle ? $full_width_content_subtitle : ''); ?></h4>

                    <h2 class="full-width-content-title"><?php echo ($full_width_content_title ? $full_width_content_title : ''); ?></h2>

                    <?php if ($full_width_content_supporting_text) : ?>
                        <p class="full-width-content-text"><?php echo $full_width_content_supporting_text; ?></p>
                    <?php endif; ?>

                    <?php generateCTA('full_width_content__links', $page_id); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (have_rows('stacked_promo')) : ?>
    <section class="wg-section stacked-promo module<?php echo $slider_row_count + 2; ?>">
        <?php $is_faculty = get_sub_field('stacked_promo_is_faculty_featured'); ?>
        <?php generatePromo('stacked_promo', $is_faculty); ?>
    </section>
<?php endif; ?>

<?php  // Additional Links //

    $additional_links_title = get_field('additional_links_title');

?>

<section class="wg-section additional-links module<?php echo $slider_row_count + 3; ?>">
    <div class="container">
        <div class="links-text">
            <h2><?php echo ($additional_links_title ? $additional_links_title : ''); ?></h2>
        </div>
        <?php generateAddLinks('additional_links_links'); ?>
    </div>
</section>
</div>
</div><!-- wysiwyg page-content -->
