<?php // Important Dates Module //
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

		$event_title			= do_shortcode('[event]#_ATT{Event Location Name}[/event]');
		$event_URL				= do_shortcode('[event]#_EVENTURL[/event]');
		$event_location			= do_shortcode('[event]#_LOCATIONNAME[/event]');
		$event_date				= do_shortcode('[event]#_{F j, g:i}[/event]');

		?>

		<li>
			<div><a href="<?php echo $event_URL; ?>"><?php echo $event_title; ?></a></div>

			<?php if ($event_date) : ?>
				<div><?php echo $event_date; ?></div>
			<?php endif ; ?>

			<?php if($event_location) : ?>
				<div><?php echo $event_location; ?></div>
			<?php endif ; ?>
		</li>

		<?php
	}
}
?>
