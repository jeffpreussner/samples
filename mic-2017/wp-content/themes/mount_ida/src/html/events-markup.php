<?php  // Calendar Landing //


?>

<section id="hero">
		<h2 class="centered"><?php single_post_title(); ?></h2>
</section>

<?php get_template_part("$cp_base/pages/partials/featured-event") ?>

<section id="filter">
    <div class="container">
        <div class="filters-wrapper">
            <div class="row">
                <div class="filter category column">
                    <div class="dropdown-label">
                        Filter By Category
                    </div>
                    <select>
                        <option>ALL</option>
                        <option>Academic Calendar</option>
                        <option>Campus Events</option>
                        <option>Alumni</option>
                    </select>
                </div>
                <div class="search category column">
										<form>
										  	<label for="">Search Events & Calendars</label>
										  	<input type="search" name="search">
										</form>
                </div>
            </div>
        </div>
        <hr />
    </div>
</section>

<section id="events-listing">
    <div class="container">
				<div class="row">
						<div class="event-list">

								<?php echo do_shortcode('[events_list limit=5 pagination=1 tag="-featured-event"]

										<div class="post">
												<div class="post-wrapper">
														#_EVENTCATEGORIES
														<a href="#"><h3>#_EVENTNAME</h3></a>
														<p class="post-excerpt">
																#_EVENTEXCERPT{55,...} <a href="#_EVENTURL">Learn More</a>
														</p>
														<p class="event-details">#_{l F j} at #_{g}:#_{i A}, #_LOCATIONNAME</p>
												</div>
										</div>
										<hr />

								[/events_list]'); ?>

						</div>
						<div class="mic-calendar">
								<?php echo do_shortcode('[events_calendar long_events=1 full=0]'); ?>
						</div>
				</div>
    </div>
</section>

<section id="pagination">
		<div class="container">
				<?php // get_template_part("$cp_base/pages/partials/pagination") ?>
		</div>
</section>
