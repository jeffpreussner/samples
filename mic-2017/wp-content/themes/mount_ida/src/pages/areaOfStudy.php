<?php
// get page id and school name
$page_id 	= get_the_ID();
$school 	= getSchoolName($page_id);

// global fields
$tuition_paragraph = get_field('tuition_paragraph', 'options');

// get page details
$title 		= get_field('title');
$subhead 	= get_field('subhead');
$intro		= get_field('intro');

// get tabbed content
$curriculum_show_tab = get_field('curriculum_show_tab');
if ($curriculum_show_tab) :
	$curriculum_title 									= get_field('curriculum_title');
	$curriculum_description 						= get_field('curriculum_description');
	$curriculum_image 									= get_field('curriculum_image');
	$curriculum_required_courses_title 	= get_field('curriculum_required_courses_title');
	$curriculum_electives_courses_title = get_field('curriculum_electives_courses_title');
	$curriculum_title 									= get_field('curriculum_title');
	$curriculum_bottom_text_link				= get_field('curriculum_bottom_text_link');
endif ;

$faculty_show_tab = get_field('faculty_show_tab');
if ($faculty_show_tab) :
	$faculty_title 											= get_field('faculty_title');
	$faculty_description 								= get_field('faculty_description');
	$faculty_description_right 					= get_field('faculty_description_right');
	$faculty_highlight_title 						= get_field('faculty_highlight_title');
	$faculty_spotlight 									= get_field('faculty_spotlight');
	$faculty_fields 										= get_fields($faculty_spotlight->ID);
endif ;

$careers_show_tab = get_field('careers_show_tab');
if ($careers_show_tab) :
	$careers_title 											= get_field('careers_title');
	$careers_description 								= get_field('careers_description');
endif ;

$admissions_tuition_show_tab = get_field('admissions_tuition_show_tab');
if ($admissions_tuition_show_tab) :
	$admissions_tuition_title 					= get_field('admissions_tuition_title');
	$admissions_tuition_detail 					= get_field('admissions_tuition_detail');
	$admissions_tuition_tuition_fee 		= get_field('admissions_tuition_tuition_fee');
	$admissions_tuition_stat_number			= get_field('admissions_stat_number', 'options');
	$admissions_tuition_stat_text 			= get_field('admissions_stat_text', 'options');
endif ;


// get faculty quote
$faculty_quote_enable = get_field('faculty_quote_enable');
if ($faculty_quote_enable) :
	$faculty_quote_background_image = get_field('faculty_quote_background_image');
	$faculty_quote 									= get_field('faculty_quote');
	$faculty_quote_name 						= get_field('faculty_quote_name');
	$faculty_quote_school_name 			= get_field('faculty_quote_school_name');
	$faculty_quote_title 						= get_field('faculty_quote_title');
	$faculty_quote_title_2 					= get_field('faculty_quote_title_2');
endif ;

// curriculum full width promo
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

// other full width promo
$other_full_width_promo                   = get_field('other_tabs_full_width_promo');

if($other_full_width_promo):
	$other_full_width_promo_fields            = get_fields($other_full_width_promo);

	$other_full_width_promo_background_image  = $other_full_width_promo_fields['full_width_promo_background_image'];
	$other_full_width_promo_image             = $other_full_width_promo_fields['full_width_promo_image']; //no html yet
	$other_full_width_promo_text_position     = $other_full_width_promo_fields['full_width_promo_text_position']; //no html yet
	$other_full_width_promo_title             = $other_full_width_promo_fields['full_width_promo_title'];
	$other_full_width_promo_subtitle          = $other_full_width_promo_fields['full_width_promo_subtitle'];
	$other_full_width_promo_supporting_text   = $other_full_width_promo_fields['full_width_promo_supporting_text'];
	$text_pos = 'left-side-text';
	if ($other_full_width_promo_text_position == "center"){$text_pos="single";}
	if ($other_full_width_promo_text_position == "right"){$text_pos="right-side-text";}
	if ($other_full_width_promo_text_position == "left"){$text_pos="left-side-text";}
endif;

// important dates
$dates_enable_important_dates 			= get_field('dates_enable_important_dates');


// stacked promo
$stacked_promo_title 					= get_field('stacked_promo_title');
$is_faculty 							= get_field('stacked_promo_is_faculty_featured');

?>

<div class="as page-content">

	<section class="as-section flex full-width-hero module1">
        <div class="hero-wrapper">
            <div class="slide-content">

				<?php if ($school) : ?>
					<div class="area-smudge-container">
						<i class="icon-smudge"></i>
						<h6 class="sub-title"><?php echo $school; ?></h6>
					</div>
				<?php endif ; ?>

								<?php if ($title != '') : ?>
                	<h2 class="title"><?php echo $title; ?></h2>
								<?php endif ; ?>

								<?php if ($subhead != '') : ?>
                	<p class="supporting-text"><?php echo $subhead; ?></p>
								<?php endif ; ?>

								<!-- <div class="btn-container"><a href="#" class="btn primary">Here is a CTA</a></div> -->
                <div class="img-mask2">
									<?php $feature_image_url = wp_get_attachment_image_src( get_post_thumbnail_id()); ?>
                    <?php echo get_the_post_thumbnail(); ?>

                </div>

				<?php if ($intro != '') :
					echo $intro;
				endif ; ?>

				<?php if (have_rows('links')) : ?>
						<div class="btn-container">
							<?php generateCTA('links', $page_id); ?>
					</div>
				<?php endif; ?>

            </div>
        </div>
    </section>

	<section class="as-section tabbed-menu module2">
		    <div id="aosTabs" class="tab-nav-wrapper">
			        <ul class="tab-nav">

								<?php if ($curriculum_show_tab) : ?>
			            	<li><a href="#curriculum">Curriculum</a></li>
								<?php endif ; ?>

								<?php if ($faculty_show_tab) : ?>
			            <li><a href="#faculty">Faculty</a></li>
								<?php endif ; ?>

								<?php if ($careers_show_tab) : ?>
			            <li><a href="#careers">Careers</a></li>
								<?php endif ; ?>

								<?php if ($admissions_tuition_show_tab) : ?>
			            <li><a href="#admissions-tuition">Admissions & Tuition</a></li>
								<?php endif ; ?>

			        </ul>



				<?php if ($curriculum_show_tab) : ?>
		     <div class="tab-content" id="curriculum">
					<div class="container">
						<div class="row row-one">

							<div class="column">
								<?php if ($curriculum_title != '') : ?>
									<h3><?php echo $curriculum_title; ?></h3>
								<?php endif ; ?>

								<?php if ($curriculum_description != '') : ?>
									<?php echo $curriculum_description; ?>
								<?php endif ; ?>

							</div>

							<div class="column mobile-hidden">
								<div class="img-mask2 circle">
									<img src="<?php echo $curriculum_image['sizes']['faculty-highlight']; ?>" alt="<?php echo $curriculum_image['alt']; ?>">
								</div>
							</div>
						</div>
					</div>
					<div class="container mobile-hidden">
						<div class="dashed-divider"></div>
						<div class="row row-two">
							<div class="column">
								<div class="row">

								<?php if(have_rows('curriculum_required_courses')) : ?>
									<div class="col">
										<p class="strong"><?php echo $curriculum_required_courses_title; ?></p>
										<ul>
											<?php while(have_rows('curriculum_required_courses')) : the_row(); ?>
												<li><strong><?php echo get_sub_field('course_number'); ?></strong> - <?php echo get_sub_field('course_title'); ?></li>
										<?php endwhile; ?>
										</ul>
									</div>
								<?php endif ; ?>

								<?php if(have_rows('curriculum_electives')) : ?>
									<div class="col">
										<p class="strong"><?php echo $curriculum_electives_courses_title; ?></p>
										<ul>
											<?php while(have_rows('curriculum_electives')) : the_row(); ?>
												<li><strong><?php echo get_sub_field('course_number'); ?></strong> - <?php echo get_sub_field('course_title'); ?></li>
										<?php endwhile; ?>
										</ul>
									</div>
								<?php endif ; ?>
								</div>
								<?php if($curriculum_bottom_text_link) : ?>
									<?php echo $curriculum_bottom_text_link; ?>
								<?php endif ;?>
							</div>
						</div>
					</div>
					<?php if ($full_width_promo) : ?>
						<section class="hp-section full-width-promo module8 <?php echo ($full_width_promo_background_image ? 'mask-top mask-bottom has-bg' : 'single'); ?>" style="background-image: url('<?php echo ($full_width_promo_background_image ? $full_width_promo_background_image['url'] : ''); ?>');">
								<?php generateFWPromo($full_width_promo_title, $full_width_promo_subtitle, $full_width_promo_supporting_text, $full_width_promo); ?>
						</section>
					<?php endif ;?>
		    </div>
					<!--end curriculum-->
				<?php endif ;?>

				<?php if ($faculty_show_tab) : ?>
		     <div class="tab-content" id="faculty">
					<div class="container">
						<div class="row row-one">
							<div class="column">

								<?php if($faculty_title != '') : ?>
									<h3><?php echo $faculty_title; ?></h3>
								<?php endif ; ?>

								<?php if($faculty_description != '') : ?>
									<?php echo $faculty_description; ?>
								<?php endif ; ?>

							</div>

							<?php if($faculty_description_right != '') : ?>
								<div class="column">
									<?php echo $faculty_description_right; ?>
								</div>
							<?php endif ; ?>


						</div>
					</div>
					<div class="container">
						<div class="dashed-divider"></div>
						<div class="row row-two">
							<div class="column">



								<div class="faculty-spotlight">
									<div class="faculty-image">
										<div class="img-mask2 circle">

											<?php $faculty_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $faculty_spotlight->ID ), 'faculty-highlight'); ?>
											<?php echo get_the_post_thumbnail($faculty_spotlight->ID, 'faculty-highlight'); ?>

										</div>
									</div>
									<div class="faculty-text">

										<?php if($faculty_highlight_title != '') : ?>
											<h6><?php echo $faculty_highlight_title; ?></h6>
										<?php endif ; ?>

										<h2><?php echo $faculty_fields['first_name'] . ' ' . $faculty_fields['last_name']; ?></h2>
										<h5><?php echo $faculty_fields['primary_title'] . ' ' . $faculty_fields['secondary_title']; ?></h5>
										<p><?php echo wp_strip_all_tags($faculty_fields['biography'], false); ?></p>

									</div>
								</div>


							</div>
						</div>
					</div>
					<?php if ($other_full_width_promo) : ?>
						<section class="hp-section full-width-promo module8 <?php echo ($other_full_width_promo_background_image ? 'mask-top mask-bottom has-bg' : 'single'); ?>" style="background-image: url('<?php echo ($other_full_width_promo_background_image ? $other_full_width_promo_background_image['url'] : ''); ?>');">
								<?php generateFWPromo($other_full_width_promo_title, $other_full_width_promo_subtitle, $other_full_width_promo_supporting_text, $other_full_width_promo); ?>
						</section>
					<?php endif ;?>
		    </div>
				<!--end faculty-->
				<?php endif ; ?>


			<?php if ($careers_show_tab) : ?>
		    <div class="tab-content" id="careers">
					<div class="container">
						<div class="row row-one">
							<div class="column">

								<?php if($careers_title != '') : ?>
									<h3><?php echo $careers_title; ?></h3>
								<?php endif ; ?>

								<?php if($careers_description != '') : ?>
									<?php echo $careers_description; ?>
								<?php endif ; ?>

							</div>

							<?php if(have_rows('careers_company_logos')) : ?>
								<div class="column mobile-hidden">
								<?php while(have_rows('careers_company_logos')) : the_row();?>
									<?php $logo_image =  get_sub_field('logo_image'); ?>
										<a target="_blank" href="<?php echo get_sub_field('image_link'); ?>">
											<img src="<?php echo $logo_image['sizes']['thumbnail']; ?>" alt="<?php echo $logo_image['alt']; ?>">
										</a>
								<?php endwhile ; ?>
								</div>
							<?php endif ; ?>

						</div>
					</div>
					<?php if ($other_full_width_promo) : ?>
						<section class="hp-section full-width-promo module8 <?php echo ($other_full_width_promo_background_image ? 'mask-top mask-bottom has-bg' : 'single'); ?>" style="background-image: url('<?php echo ($other_full_width_promo_background_image ? $other_full_width_promo_background_image['url'] : ''); ?>');">
								<?php generateFWPromo($other_full_width_promo_title, $other_full_width_promo_subtitle, $other_full_width_promo_supporting_text, $other_full_width_promo); ?>
						</section>
					<?php endif ;?>
				</div>
				<!--end careers-->
			<?php endif ; ?>

			<?php if ($admissions_tuition_show_tab) : ?>
		     <div class="tab-content" id="admissions-tuition">
					<div class="container">
						<div class="row row-one">
							<div class="column">

								<?php if ($admissions_tuition_title != '') : ?>
									<h3><?php echo $admissions_tuition_title; ?></h3>
								<?php endif ;?>

								<?php if ($admissions_tuition_detail != '') : ?>
									<?php echo $admissions_tuition_detail; ?>
								<?php endif ;?>

								<?php if($tuition_paragraph != '') : ?>
									<?php echo  $tuition_paragraph; ?>
								<?php endif ;?>

								<?php
									if ($admissions_tuition_tuition_fee->post_content != '') :
										setup_postdata($admissions_tuition_tuition_fee);
										the_content();
										wp_reset_postdata();
									endif ;
								?>

							</div>

							<?php if($admissions_tuition_stat_number != '') : ?>
							<div class="column">
								<div class="stat">
									<div class="content">
										<h3 class="number"><?php echo $admissions_tuition_stat_number; ?></h3>
										<p class="statdescription"><?php echo $admissions_tuition_stat_text; ?></p>
									</div>
								</div>
							</div>
							<?php endif ;?>

						</div>
					</div>
					<?php if ($other_full_width_promo) : ?>
						<section class="hp-section full-width-promo module8 <?php echo ($other_full_width_promo_background_image ? 'mask-top mask-bottom has-bg' : 'single'); ?>" style="background-image: url('<?php echo ($other_full_width_promo_background_image ? $other_full_width_promo_background_image['url'] : ''); ?>');">
								<?php generateFWPromo($other_full_width_promo_title, $other_full_width_promo_subtitle, $other_full_width_promo_supporting_text, $other_full_width_promo); ?>
						</section>
					<?php endif ;?>
		     </div>
				<!--end admissions-tuition-->
			<?php endif ; ?>

		    </div>
	</section>



<?php if ($faculty_quote_enable) : // START faculty quote ?>
	<section class="as-section blockquote-section module4 has-bg mask-bottom mask-top" style="background-image: url(<?php echo $faculty_quote_background_image['url']; ?> ), url(<?php echo $faculty_quote_background_image['url']; ?>);">
		<div class="container">
			<div class="row">
				<blockquote>
					<?php echo wp_strip_all_tags($faculty_quote, false); ?>
				</blockquote>
				<div class="attribution">

					<?php if($faculty_quote_name != '') : ?>
						<cite>
							<?php echo $faculty_quote_name; ?>
						</cite>
					<?php endif ; ?>

					<?php if($faculty_quote_title != '') : ?>
						<p><?php echo $faculty_quote_title; ?></p>
					<?php endif ; ?>

					<?php if($faculty_quote_title_2 != '') : ?>
						<p><?php echo $faculty_quote_title_2; ?></p>
					<?php endif ; ?>

				</div>
			</div>
		</div>
	</section>
<?php endif ; // END faculty quote ?>


<?php if (have_rows('stacked_promo')) : ?>
    <section class="as-section stacked-promo prerequisites">

		<?php if($stacked_promo_title != '') : ?>
			<h2 class="section-title centered"><?php echo $stacked_promo_title; ?></h2>
		<?php endif ; ?>

        <?php generatePromo('stacked_promo', $is_faculty); ?>

    </section>
<?php endif; ?>




	<?php if ($dates_enable_important_dates) : // START important dates ?>
		<section class="pb-section dates module7">
			<div class="container">
				<?php getImportantDates($page_id); ?>
			</div>
		</section>
	<?php endif ; // END important dates ?>


</div>
