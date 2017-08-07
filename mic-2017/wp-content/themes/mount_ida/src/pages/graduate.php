<?php // Graduate Landing Page //

    the_post();
    $page_title     = $post->post_title;
    $page_subtitle  = get_field('page_subtitle');

?>

<section id="hero">
    <div class="container centered">
        <div class="logo-wrapper">
            <a href="<?php echo get_site_url(); ?>">
                <img src="<?php echo $theme_dir_uri . "/img/global/mic-logo.svg"; ?>" alt="mic-logo">
            </a>
        </div>
        <h6><?php echo ($page_subtitle ? $page_subtitle : ''); ?></h6>
        <h1><?php echo $page_title; ?></h1>
    </div>
</section>

<?php // Full Width Promo //

    /* ----------------------------------------------------
    | Full Width Promo ACF
    |-----------------------------------------------------*/

    $full_width_promo                   = get_field('full_width_promo');

    if($full_width_promo):
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
    endif;

?>

<?php if ($full_width_promo) : ?>
        <?php if ($full_width_promo_background_image) : ?>
            <section
                      class="hp-section full-width-promo has-bg mask-top mask-bottom module8 <?php echo $text_pos; ?>"
                      style="background-image: url('<?php echo $full_width_promo_background_image['url']; ?>'); background-position: center center; background-size: cover;">
        <?php else : ?>
            <section class="hp-section full-width-promo module9 <?php echo $text_pos; ?>">
        <?php endif; ?>
            <?php generateFWPromo($full_width_promo_title, $full_width_promo_subtitle, $full_width_promo_supporting_text, $full_width_promo); ?>
        </section>
<?php endif; ?>

<?php // Program Details //

    $program_details      = get_field('program_details');
    $stat_top             = get_field('stat_top');
    $stat_top_caption     = get_field('stat_top_caption');
    $stat_bottom          = get_field('stat_bottom');
    $stat_bottom_caption  = get_field('stat_bottom_caption');
    $cta_type             = get_field('cta_type');

    if ($cta_type) {
        $program_cta = get_field('program_cta_url');
    } else {
        $program_cta = get_field('program_cta_link');
    }

?>

<section id="program-details">
    <div class="tab-content" id="admissions-tuition">
      	<div class="container">
        		<div class="row row-one">

                <div class="column">
                    <?php echo ($program_details ? $program_details : ''); ?>
                </div>

                <div class="column">
                    <?php if ($stat_top && $stat_top_caption) : ?>
                        <div class="stat circled">
                            <div class="content">
                                <h3 class="number"><?php echo $stat_top; ?></h3>
                                <p class="stat-description"><?php echo $stat_top_caption; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($stat_bottom && $stat_bottom_caption) : ?>
                    <div class="stat">
                        <div class="content">
                            <h3 class="number"><?php echo $stat_bottom; ?></h3>
                            <p class="stat-description"><?php echo $stat_bottom_caption; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

        		</div>
            <p class="centered">
                Want more info about this program?
                <a class="btn m-block text-link" target="_self" href="<?php echo ($program_cta ? $program_cta : ''); ?>"><span>Get more details here</span></a>
            </p>
      	</div>
    </div>
</section>

<?php // Faculty Spotlight //

    $faculty_spotlight  = get_field('faculty_spotlight');
    $faculty_ID         = $faculty_spotlight->ID;
    $first_name 		    = get_field('first_name', $faculty_ID);
    $last_name 		      = get_field('last_name', $faculty_ID);
    $primary_title 		  = get_field('primary_title', $faculty_ID);
    $secondary_title 	  = get_field('secondary_title', $faculty_ID);
    $biography			    = get_field('biography', $faculty_ID);
    $short_description  = get_field('short_description', $faculty_ID);
    $prefix             = get_field('prefix', $faculty_ID);
    $suffix             = get_field('suffix', $faculty_ID);

?>

<section class="sl-section faculty-spotlight">
    <div class="faculty-slider-wrapper">
        <div class="faculty-slide slide">
            <div class="slide-content">
                <?php if (get_the_post_thumbnail($faculty_ID)) : ?>
                <div class="faculty-image">
                    <div class="img-mask2 circle">
                        <img
                              width="492"
                              height="510"
                              src="<?php echo get_the_post_thumbnail_url($faculty_ID, 'faculty-highlight'); ?>"
                              alt="<?php echo facultyName($first_name, $last_name, $prefix, $suffix); ?>" />
                    </div>
                </div>
                <?php endif; ?>
                <div class="faculty-text">
                    <h6>Faculty Spotlight</h6>
                    <h2><?php echo facultyName($first_name, $last_name, $prefix, $suffix); ?></h2>
                    <h5><?php echo ($primary_title ? $primary_title : ''); ?><?php echo ($secondary_title ? ', ' . $secondary_title : ''); ?></h5>
                    <p><?php echo ($short_description ? $short_description : limit_text($biography, 60)); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php // Industry Experience //

    function industryExperience($id) {
        if ( have_rows('industry_experience', $id) ) {
            while ( have_rows('industry_experience', $id) ) {
                the_row();

                // vars
                $company  = get_sub_field('company');
                $title    = get_sub_field('title');

                echo
                '<li class="flexcol">
                    <div class="company">'
                        .$company.
                    '</div>
                    <div class="title">'
                        .$title.
                    '</div>
                </li>';
            }
        }
    }

?>

<section class="wg-section additional-links">
    <div class="container">
        <h5 class="industry-experience">Industry Experience</h5>
        <ul class="experience-list col-limit-2">
            <?php industryExperience($faculty_ID); ?>
        </ul>
    </div>
</section>

<?php // Image Grid //

?>

<section class="hp-section image-grid mask-top">
    <?php $grid_images = get_field('image_grid_images'); ?>
    <?php ImageGrid($grid_images); ?>
</section>

<?php // Request Info Modal //

    $info_modal_title       = get_field('info_modal_title');
    $info_modal_subtitle    = get_field('info_modal_subtitle');
    $form_ID 	              = get_field('form_id');

?>

<div class="request-information-modal">
    <input class="modal-state" id="request-info-modal" type="checkbox" />
    <div class="modal-fade-screen">
        <div class="modal-inner">
            <div class="close-wrapper">
                <div class="modal-close" for="request-info-modal"></div>
            </div>
            <div class="modal-content">
                <h2><?php echo ($info_modal_title ? $info_modal_title : ''); ?></h2>
                <p><?php echo ($info_modal_subtitle ? $info_modal_subtitle : ''); ?></p>
                <div class="form">
                    <?php echo ($form_ID ? do_shortcode('[formassembly formid="'.$form_ID.'"]') : ''); ?>
                </div>
            </div>
        </div>
    </div>
</div>
