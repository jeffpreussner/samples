<?php

// define majors
$undergradMajors = '';
$undergradMajorsCount = 0;
$undergradMinorsCount = 0;

if (have_posts()) :
		while ( have_posts() ) :
			// setup_postdata( $post );
			the_post();
			$id = get_the_ID();
			$schools = wp_get_post_terms($id, 'schools', array("fields" => "names"));


					if ($post->post_type == 'areas_of_study'  ) :
							$undergradMajors .= '<li class="flexcol"><a href="' . get_permalink() . '" class="btn tertiary"><span>' . get_the_title() . '</span></a></li>';
							$undergradMajorsCount++;
					endif ;
		endwhile ;
endif ;


// get tax id
$taxonomy 								= get_queried_object();
$school_id 								= $taxonomy->term_id;



// get tax fields
$school_name 							= $taxonomy->name;
$school_description 			= $taxonomy->description;
$school_background 				= get_field('school_background_image', 'term_' . $school_id);
$school_subheadline 			= get_field('sub_headline', 'term_' . $school_id);

// alumni defult slide
$enable_alumn_slideshow			= get_field('enable_alumn_slideshow', 'term_' . $school_id);
if ($enable_alumn_slideshow) :
	$default_slide_hero_image = get_field('default_slide_hero_image', 'term_' . $school_id);
	$default_slide_blockquote = get_field('default_slide_blockquote', 'term_' . $school_id);
	$slide_alumn_name 				= get_field('slide_alumn_name', 'term_' . $school_id);
	$slide_alumn_grad_year 		= get_field('slide_alumn_grad_year', 'term_' . $school_id);
	$slide_alumn_job_title 		= get_field('slide_alumn_job_title', 'term_' . $school_id);
	$slide_alumn_caption 			= get_field('slide_alumn_caption', 'term_' . $school_id);
endif;

// faculty spotlight
$faculty_highlight_enable 				= get_field('faculty_highlight_enable', 'term_' . $school_id);
if ($faculty_highlight_enable) :
	$faculty_spotlight 							= get_field('faculty_spotlight', 'term_' . $school_id);
	$faculty_highlight_title				= get_field('faculty_highlight_title', 'term_' . $school_id);
	if ($faculty_spotlight) :
		$faculty_fields 								= get_fields($faculty_spotlight->ID);
	endif ;
endif;

// dean quote module
$quote_enable_dean_quote 				= get_field('quote_enable_dean_quote', 'term_' . $school_id);
if ($quote_enable_dean_quote) :
	$quote_dean_quote 						= get_field('quote_dean_quote', 'term_' . $school_id);
	$quote_dean_name 							= get_field('quote_dean_name', 'term_' . $school_id);
	$quote_dean_byline 						= get_field('quote_dean_byline', 'term_' . $school_id);
endif;

// featured student artwork gallery
$enable_gallery 			= get_field('enable_gallery', 'term_' . $school_id);
if ($enable_gallery) :
	$gallery_title 			= get_field('gallery_title', 'term_' . $school_id);
endif;

// important dates
$dates_enable_important_dates 				= get_field('dates_enable_important_dates', 'term_' . $school_id);

// full width promo
$full_width_promo                   = get_field('full_width_promo', 'term_' . $school_id);

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

// helper Functions

function getAlumnSlides($id) {

	if (have_rows('alumn_slide', 'term_' . $id)) :
			$counter = 1;
			while (have_rows('alumn_slide', 'term_' . $id)) :
					the_row();
					$slide_image = get_sub_field('slide_hero_image');
					?>
					<div class="alumni-slide" id="alumni<?php echo $counter?>" style="background-image: url(<?php echo $slide_image['url'] ?>);">
						<a href="#" class="close icon-close"></a>
						<div class="alumni-wrapper">
							<div class="alumni-aligner">
								<div class="column">
									<div class="alumni-content">
										<?php if(get_sub_field('slide_blockquote') != '') : ?>
											<blockquote><?php  echo wp_strip_all_tags(get_sub_field('slide_blockquote'), false); ?></blockquote>
										<?php endif ; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
					$counter++;
			endwhile ;
	endif ;

}




function getFeaturedWorkSlides($id, $title) {

	if (have_rows('gallery_slides', 'term_' . $id)) : ?>

		<section class="sl-section slideshow module4 mask-bottom mask-top">
			<div class="container">
				<div class="slideshow-wrapper">
				<?php while (have_rows('gallery_slides', 'term_' . $id)) : the_row(); ?>

							<div class="slideshow-slide slide">
								<div class="container">
									<div class="row">
										<div class="slide-text">

											<?php if($title != '') : ?>
												<h6><?php echo $title ?></h6>
											<?php endif ; ?>

											<?php
												$slide_image = get_sub_field('image');
											?>
											<h3><?php echo $slide_image['title'] ?></h3>
											<p><?php echo $slide_image['caption'] ?></p>
										</div>
										<div class="slide-image">
											<img alt="<?php echo $slide_image['alt'] ?>" src="<?php echo $slide_image['sizes']['student-gallery'] ?>">
										</div>
									</div>
								</div>
							</div>

				<?php endwhile ; ?>

				</div>
				<div class="slider-nav"></div>
			</div>
		</section>

	<?php endif ;

}


function getAlumnSliderNav($id) {
		if (have_rows('alumn_slide', 'term_' . $id)) : ?>
				<div class="nav-inner">
				<?php
				$counter = 1;
				while (have_rows('alumn_slide', 'term_' . $id)) :
						the_row();
						$slide_image = get_sub_field('slide_hero_image');
						?>

									<a href="#alumni<?php echo $counter; ?>"><img src="<?php echo $slide_image['sizes']['gallery-thumbnails']; ?>"></a>

						<?php
						$counter++;
				endwhile ; ?>
				</div>
		<?php
		endif ;
}



function getNews(){
		$sticky = get_option( 'sticky_posts' ); //get stickies
		rsort( $sticky ); //sort them by date

		$counter = 1;

		global $post;
		$args = array(
				'post_type' => 'post',
				'post__in'  => $sticky,
				'posts_per_page' => 2
		);

		$hp_posts = get_posts($args);

		foreach( $hp_posts as $post ) :
				setup_postdata($post);

				$single_title       = get_the_title();
				$single_url         = get_permalink();
				$single_exerpt      = get_the_excerpt();
				?>


				<div class="promo-wrap promo<?php echo $counter; ?>">
						<div class="promo-content">

								<h6 class="sub-title">News</h6>

								<?php if($single_title) : ?>
									<h3 class="title"><?php echo $single_title; ?></h3>
								<?php endif ; ?>

								<?php if($single_exerpt) : ?>
									<p class="supporting-text"><?php echo $single_exerpt ?></p>
								<?php endif ; ?>

								<?php if($single_url) : ?>
									<div class="btn-container"><a href="<?php echo $single_url ?>" class="btn solid-green m-block"><span>Read More</span></a></div>
								<?php endif ; ?>

						</div>
				</div>
		<?php
		$counter++;
		endforeach;
		wp_reset_postdata();
}


?>


<div class="sl page-content">

<section class="sl-section full-width-hero module1 has-bg mask-bottom" style="background-image: url(<?php echo $school_background; ?>);">
	<div class="hero-wrapper">
		<div class="slide-content">

			<h1 class="title"><span><?php echo $school_name; ?></span>
			</h1>
			<p class="supporting-text"><?php echo $school_description; ?></p>
		</div>
	</div>
</section>


<?php if ($undergradMajors != '') : ?>
	<section class="sl-section additional-links module2">
		<div class="container">
			<div class="links-text">
				<h2>Undergraduate Majors</h2>
			</div>
			<ul class="<?php echo ($undergradMajorsCount > 12 ? '' : 'col-limit-3'); ?>">
			<?php echo $undergradMajors; ?>
		</ul>
		</div>
	</section>
<?php endif ; ?>


<?php
	if( have_rows('minors', 'term_' . $school_id) ):
	$undergradMinorsCount = count(get_field('minors', 'term_' . $school_id));
?>
	<section class="sl-section additional-links module2">
	    <div class="container">
			<div class="links-text">
				<h2>Undergraduate Minors</h2>
			</div>
			<ul class="<?php echo ($undergradMinorsCount > 12 ? '' : 'col-limit-3'); ?>">
					<?php while ( have_rows('minors', 'term_' . $school_id) ) : the_row(); ?>
						<li class="flexcol"><a href="<?php echo get_sub_field('link_url') ?>" class="btn tertiary"><span><?php echo get_sub_field('link_cta'); ?></span></a></li>
					<?php endwhile; ?>
		    </ul>

	    </div>
	</section>
<?php endif ; ?>

<?php if ($enable_alumn_slideshow) :  // START Alumn Slidshow?>
	<section class="sl-section alumni-menu module3 mask-bottom mask-top">
		<div class="mobile-slideshow">
		<div class="alumni-slide default active" style="background-image: url(<?php echo $default_slide_hero_image; ?>);">
			<div class="alumni-wrapper">
				<div class="alumni-aligner">
					<div class="column">
						<div class="alumni-content">

							<?php if($default_slide_blockquote != '') : ?>
								<blockquote><?php echo wp_strip_all_tags($default_slide_blockquote, false); ?></blockquote>
							<?php endif ; ?>

							<?php if($slide_alumn_name != '') : ?>
								<cite><?php echo $slide_alumn_name; ?></cite>
							<?php endif ; ?>

							<?php if($slide_alumn_grad_year != '') : ?>
								<p class="small"><?php echo $slide_alumn_grad_year; ?><br><?php echo $slide_alumn_job_title; ?></p>
							<?php endif ; ?>

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php getAlumnSlides($school_id); ?>

	</div>

		<div class="alumni-nav">
			<?php if($slide_alumn_caption != '') : ?>
				<p><?php echo $slide_alumn_caption; ?></p>
			<?php endif ; ?>

			<?php getAlumnSliderNav($school_id); ?>

		</div>

	</section>
<?php endif ; // END Alumn Slidshow ?>

<?php if ($quote_enable_dean_quote) : ?>
	<section class="sl-section blockquote-section module4 mask-bottom mask-top">
		<div class="container">
			<div class="row">
				<blockquote><?php echo wp_strip_all_tags($quote_dean_quote, false); ?></blockquote>
				<div class="attribution">

					<?php if($quote_dean_name != '') : ?>
						<cite><?php echo $quote_dean_name;?></cite>
					<?php endif ; ?>

					<?php if($quote_dean_byline != '') : ?>
						<p><?php echo $quote_dean_byline;?></p>
					<?php endif ; ?>

				</div>
			</div>
		</div>
	</section>
<?php endif ; // END Alumn Slidshow ?>

<?php
if ($enable_gallery) : // START student work gallery

	getFeaturedWorkSlides($school_id, $gallery_title);

endif ; // END student work gallery  ?>

<?php if($faculty_highlight_enable && $faculty_spotlight) : // START Faculty Spotlight ?>
		<section class="sl-section faculty-spotlight module5">
			<div class="faculty-slider-wrapper">
				<div class="faculty-slide slide">
					<div class="slide-content">
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

				<?php if ($faculty_fields['quote']) : ?>
					<div class="faculty-slide slide">
						<div class="slide-content">
							<div class="faculty-image">
								<div class="img-mask2 circle">

									<?php echo get_the_post_thumbnail($faculty_spotlight->ID, 'faculty-highlight'); ?>

								</div>
							</div>
							<div class="faculty-text">

								<?php if($faculty_highlight_title != '') : ?>
									<h6><?php echo $faculty_highlight_title; ?></h6>
								<?php endif ; ?>


								<blockquote><?php echo wp_strip_all_tags($faculty_fields['quote'], false); ?></blockquote>

							</div>
						</div>
					</div>
				<?php endif ; ?>

			</div>

			<?php if ($faculty_fields['quote'] != '') : ?>
				<div class="container">
					<div class="slider-nav"></div>
				</div>
			<?php endif ; ?>

	</section>
<?php endif ; // END Faculty Spotlight ?>

	<section class="sl-section stacked-promo module6">
    <div class="container">
        <?php getNews(); ?>
    </div>
  </section>

	<?php if ($dates_enable_important_dates) : // START important dates ?>
		<section class="pb-section dates module7">
			<div class="container">
				<?php getImportantDates('term_'.$school_id); ?>
			</div>
		</section>
	<?php endif ; // END important dates ?>

	<?php if ($full_width_promo) : // START full width promo ?>
		<section class="hp-section full-width-promo module8 <?php echo ($full_width_promo_background_image ? 'mask-top has-bg' : 'single'); ?>" style="background-image: url('<?php echo ($full_width_promo_background_image ? $full_width_promo_background_image['url'] : ''); ?>');">
		    <?php generateFWPromo($full_width_promo_title, $full_width_promo_subtitle, $full_width_promo_supporting_text, 'term_'.$school_id); ?>
		</section>
	<?php endif ; // END full width promo ?>

</div>
