<?php
/**
 * The template for displaying a single event
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mount_ida
 */
	// WP Events Manager

	// Native Event Fields
	$event_id 				= do_shortcode('[event]#_EVENTID[/event]');
	$event_title 			= do_shortcode('[event]#_EVENTNAME[/event]');
	$event_description		= do_shortcode('[event]#_EVENTNOTES[/event]');
	$event_exerpt			= do_shortcode('[event]#_EVENTEXCERPT[/event]');
	$add_event_to_calendar 	= do_shortcode('[event]#_EVENTGCALURL[/event]');
	$recurr 				= do_shortcode('[events_list mode="weekly" limit="5" scope="future" recurrence ]#l[/events_list]');


	// Added Event Attributes
	$event_form				= do_shortcode('[event]#_ATT{Registration Form Id}[/event]');
	$event_contact_n		= do_shortcode('[event]#_ATT{Event Contact Name}[/event]');
	$event_contact_p		= do_shortcode('[event]#_ATT{Event Contact Phone Number}[/event]');
	$event_contact_e		= do_shortcode('[event]#_ATT{Event Contact Email Address}[/event]');

	$location_name			= do_shortcode('[event]#_ATT{Event Location Name}[/event]');
	$location_address		= do_shortcode('[event]#_ATT{Event Location Address}[/event]');
	$location_city			= do_shortcode('[event]#_ATT{Event Location City/Town}[/event]');

	// All possible date representations that are specified
	$event_date				= do_shortcode('[event]#_EVENTDATES[/event]'); // weekday, month day, year
	$event_startday 		= do_shortcode('[event]#l[/event]'); //Monday-Sunday
	$event_endday 			= do_shortcode('[event]#@l[/event]'); //Monday-Sunday
	$event_day				= do_shortcode('[event]#j[/event]'); //1-31
	$event_month			= do_shortcode('[event]#F[/event]'); //January - December

	//add event to calendar

?>

<section id="events">
	<div class="breadcrumb"><?php breadcrumb(); ?></div>
	<div class="container">
		<div class="event-wrapper">
			<div class="event-title">
			    <h3><?php echo ($event_title ? $event_title : ''); ?></h3>
			</div>
			<div class="social-share">
		      <a class="icon-fb"
		          href="https://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>"
		          rel="nofollow"
		          title="Share on Facebook"
		          target="_blank">
		      </a>
		      <a class="icon-tw"
		          href="https://twitter.com/share?url=<?php echo the_permalink(); ?>"
		          rel="nofollow"
		          title="Share on Twitter"
		          target="_blank">
		      </a>
			</div>
			<div class="event-content">
				<div class="event-info">
					<h6>when</h6>
					<p class="event-date"><?php echo format_event_info(); ?></p>
					<p class="icon-calendar"><a href="<?php echo $add_event_to_calendar; ?>">Add to Calendar</a></p>
					<?php if( $location_name || $location_address || $location_city ) : ?>
						<h6>where</h6>
						<p class="event-location"><?php format_location(); ?></p>
					<?php endif; ?>
				</div>

			    <?php echo ($event_description ? $event_description : ''); ?>
			    <?php if($event_form) : ?>
				    <div class="form">
				    	<?php echo do_shortcode('[formassembly formid='.$event_form.']'); ?>
				    </div>
				<?php endif; ?>
			</div>
			<?php if($event_contact_n != '' || $event_contact_p != '' || $event_contact_e != '' ) : ?>
				<div class="contact">
					<h2>contact</h2>
					<?php if($event_contact_n != '') : ?>
						<p><?php echo $event_contact_n; ?></p>
					<?php endif ; ?>

					<?php if($event_contact_n != '') : ?>
						<p class="icon-phone"><a href="tel:<?php echo $event_contact_p; ?>"><?php echo $event_contact_p; ?></a></p>
					<?php endif ; ?>

					<?php if($event_contact_e != '') : ?>
						<p class="icon-envelope"><a href="mailto:<?php echo $event_contact_e; ?>"><?php echo $event_contact_e; ?></a></p>
					<?php endif ; ?>
				</div>
			<?php endif ; ?>
			<div class="btn-container">
				<a href="<?php echo $add_event_to_calendar; ?>" class="btn solid-green"><span>Add to Calendar</span></a>
			</div>
		</div>
	</div>
</section>


<section id="dates">
	<div class="container">
	    <h3 class="section-title centered">Important Dates</h3>
	    <div class="col m-span12">
	        <ul class="dates-content">
				<?php
				echo do_shortcode('[events_list limit=5]

	            	<li>
	            		<div class=""><a href="#_EVENTURL">#_EVENTNAME</a></div>
	            		<div class="">#_{F j, g:i}</div>
	            		<div class="">#_ATT{Event Location Name}</div>
	            	</li>
    			[/events_list]'); ?>
	        </ul>
	        <div class="btn-container centered">
	            <a href="/events" class="btn solid-green"><span>View Full Calendar</span></a>
	        </div>
	    </div>
	</div>
</section>


<?php 

function format_event_info(){
	$event_date				= do_shortcode('[event]#_EVENTDATES[/event]'); // weekday, month day, year
	$event_day				= do_shortcode('[event]#j[/event]'); //1-31
	$event_month			= do_shortcode('[event]#F[/event]'); //January - December
	$event_start_day 		= do_shortcode('[event]#l[/event]'); //Monday-Sunday
	$event_end_day 			= do_shortcode('[event]#@l[/event]'); //Monday-Sunday
	$event_start_time		= do_shortcode('[event]#_12HSTARTTIME[/event]'); //start time of event in 12 hour format
	$event_time_meridiem	= do_shortcode('[event]#A[/event]');
	#_12HSTARTTIME

	//if event is recurring:
	// if($event_startday == "Monday" && $event_endday == "Friday"){
	// 	echo 'Weekdays';
	// }
	$dateFormat;
	//{not_recurrence}
		if($event_start_time){
			$dateFormat = $event_start_day . ', ' . $event_month . ' ' .  $event_day . ' at ' . $event_start_time;
		}
		else{
			$dateFormat = $event_date;
		}
	return $dateFormat;
	//{/not_recurrence}

}
 
function format_location(){
	$location_name			= do_shortcode('[event]#_ATT{Event Location Name}[/event]');
	$location_address		= do_shortcode('[event]#_ATT{Event Location Address}[/event]');
	$location_city			= do_shortcode('[event]#_ATT{Event Location City/Town}[/event]');
	$location_state			= do_shortcode('[event]#_ATT{Event Location State/County}[/event]');
	$location_postcode		= do_shortcode('[event]#_ATT{Event Location Postal Code}[/event]');
	$location_country		= do_shortcode('[event]#_ATT{Event Location Country}[/event]');


	if ( $location_name ) : echo $location_name; endif;
	if ( $location_name ) : 
		if ( $location_address || $location_city ) : echo ', ';
		endif;
	endif;
	if ( $location_address ) : echo $location_address; endif;
	if ( $location_city ) :
		if ( $location_address) : echo ', ' . $location_city;
		else : echo $location_city;
		endif;
		if ( $location_state ) : echo ', <span>' . $location_state . '</span>'; endif;
		if ( $location_postcode ) : echo ', ' . $location_postcode; endif;
		if ( $location_country ) : echo ', <span>' . $location_country . '</span>'; endif;
	endif;
}









