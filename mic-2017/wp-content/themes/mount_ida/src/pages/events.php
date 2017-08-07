<?php  // Calendar Landing //

		the_post();

?>

<section id="hero">
	<h2 class="centered"><?php single_post_title(); ?></h2>
</section>

<?php get_template_part("$cp_base/pages/partials/featured-event") ?>

<section id="filter">
    <div class="container">
        <div class="filters-wrapper">
			<?php echo do_shortcode('[event_search_form]'); ?>
        </div>
        <hr />
    </div>
</section>

<section id="events-listing">
    <div class="container">
		<div class="row">
			<div class="event-list">
				<?php the_content(); ?>
			</div>
			<div class="mic-calendar">
				<?php echo do_shortcode('[events_calendar long_events=1 full=0]'); ?>
			</div>
		</div>
	</div>
</section>
