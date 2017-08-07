<?php
/**
 * The template for displaying a single faculty or staff
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mount_ida
 */ 

		
		the_post();
		$post_ID        	= get_the_ID();

		$prefix				= get_field('prefix');
		$suffix				= get_field('suffix');
		$first_name 		= get_field('first_name');
		$last_name 			= get_field('last_name');
		$primary_title 		= get_field('primary_title');
		$secondary_title 	= get_field('secondary_title');
		$biography			= get_field('biography');
		$education 			= get_field('education');
		$phone_number 		= get_field('phone_number');
		$extension 			= get_field('extension');
		$email 				= get_field('email');
		$location_building 	= get_field('location_building');
		$location_room 		= get_field('location_room');

		$full_name 			= facultyName($first_name, $last_name, $prefix, $suffix);
?>


<section id="faculty-staff">
	<div class="breadcrumb"><?php breadcrumb(); ?></div>
    <div class="container">
        <div class="faculty-staff-content">
        	<div class="heading-info">
        		<?php if(has_post_thumbnail()) : ?>
		            <div class="img-mask2">
		            	<?php echo get_the_post_thumbnail($post_ID, 'faculty-highlight'); ?>
		            </div>
		        <?php endif; ?>
	            <h3 class="title"><?php echo $full_name; ?></h3>
	            <p class="supporting-text"><?php echo ($primary_title ? $primary_title : ''); ?><?php echo ($secondary_title ? ', ' . $secondary_title : ''); ?></p>
	        </div>
	        <div class="faculty-info">
	        	<?php if($education) : ?>
		            <div class="education">
		            	<h2>education</h2>
		            	<?php echo $education; ?>
		            </div>
		        <?php endif; ?>
		       	<?php if($phone_number || $email || $location_building) : ?>
		            <div class="contact<?php echo($education ? '' : ' single'); ?>">
		            	<h2>Contact</h2>
	            		<?php if ($phone_number) : ?>
	            			<p class="icon-phone"><a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?><?php echo ($extension ? ', Ext. ' . $extension : ''); ?></a></p>
	            		<?php endif; ?>
	            		<?php if ($email) : ?>
	            			<p class="icon-envelope"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
	            		<?php endif; ?>
	            		<?php if($location_building) : ?>
	            			<div class="icon-location"><p><?php echo $location_building; ?><?php echo($location_room ? ', ' . $location_room : ''); ?></p></div>
	            		<?php endif; ?>
		            </div>
		        <?php endif; ?>
	        </div>
	        <?php if($biography) : ?><hr/><?php endif; ?>
        </div>
        <?php if($biography) : ?>
	        <div class="bio">
	        	<?php echo $biography; ?>
	        </div>
	    <?php endif; ?>
    </div>
</section>