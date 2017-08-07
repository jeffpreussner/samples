<?php
/**
 * Search & Filter Pro
 *
 * Results Template
 *
 */

if ( $query->have_posts() )
{

	while ($query->have_posts())
	{
		$query->the_post();

    $post_type = get_post_type();

		$post_id = $query->posts[0]->ID;



    if($post_type == 'post') :
      $post_name = 'News';
			$tax_name = 'category';
    else :

      $post_name = $post_type;
			$tax_name = 'event-categories';

			$event_location			= do_shortcode('[event]#_ATT{Event Location Name}[/event]');
			$event_date				= do_shortcode('[event]#_EVENTDATES[/event]'); // weekday, month day, year

			// check if event has past current date
			$date = strtotime($event_date);
			$current = strtotime(date("Y/m/d"));

			if($date > $current) :

				$event_day				= do_shortcode('[event]#j[/event]'); //1-31
				$event_month			= do_shortcode('[event]#F[/event]'); //January - December
				$event_start_day 		= do_shortcode('[event]#l[/event]'); //Monday-Sunday
				$event_end_day 			= do_shortcode('[event]#@l[/event]'); //Monday-Sunday
				$event_start_time		= do_shortcode('[event]#_12HSTARTTIME[/event]'); //start time of event in 12 hour format
				$event_time_meridiem	= do_shortcode('[event]#A[/event]');

				$dateFormat;

					if($event_start_time){
						$dateFormat = $event_start_day . ', ' . $event_month . ' ' .  $event_day . ' at ' . $event_start_time;
					}
					else{
						$dateFormat = $event_date;
					}

			endif ;

    endif ;

    	$permalink_cta;
    	if($post_type == 'post') { $permalink_cta = "Read More"; }
    	else { $permalink_cta = "Learn More"; }

		$tax = get_the_terms($post_id, $tax_name);

		?>


		<?php if($post_type == 'post' || $date > $current) : //only show posts or future events?>

			<div class="post">
	      <div class="post-wrapper">
	          <div class="post-categories">
	              <ul>
	                  <li><?php echo $post_name; ?></li>
										<?php if($tax) : ?>
	                  	<li><?php echo $tax[0]->name; ?></li>
									<?php endif ;?>
	              </ul>
	          </div>
	          <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>

	          <p class="post-excerpt">
	              <?php echo get_the_excerpt(); ?>
	              <a href="<?php the_permalink(); ?>"><?php echo $permalink_cta; ?></a>
	          </p>
						<?php if($post_type == 'event') : ?>
	          	<p class="event-details"><?php echo $dateFormat . ', ' . $event_location; ?></p>
						<?php endif ; ?>
	        </div>
	    </div>
			<hr />

	<?php endif ; ?>

		<?php
	}
	?>

	<nav class="pagination">


		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</nav>
	<?php
}
else
{
	echo "No Results Found";
}
?>

<?php

?>
