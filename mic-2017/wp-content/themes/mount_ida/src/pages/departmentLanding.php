<?php


$taxonomy 					= get_queried_object();
$dept_id 					= $taxonomy->term_id;
$department 				= $taxonomy->name;
$dept_slug 					= $taxonomy->slug;

// main contact fields
$main_contact 				= get_field('main_contact', 'term_' . $dept_id);
if ($main_contact) :
	$faculty_fields 		= get_fields($main_contact->ID);
	$prefix					= $faculty_fields['prefix'];
	$suffix					= $faculty_fields['suffix'];
	$first_name 			= $faculty_fields['first_name'];
	$last_name 				= $faculty_fields['last_name'];
	$title 					= $faculty_fields['primary_title'];
	$phone 					= $faculty_fields['phone_number'];
	$extension				= $faculty_fields['extension'];
	$email					= $faculty_fields['email'];
	$location_building 		= $faculty_fields['location_building'];
	$location_room 			= $faculty_fields['location_room'];

	$full_name 			= facultyName($first_name, $last_name, $prefix, $suffix);
endif;

// get all faculty from this taxonomy
$args = array(
	'post_type' 		=> 'faculty_and_staff',
	'posts_per_page' 	=> -1,
	'department' 		=> $dept_slug,	
	'orderby'			=> 'name',
	'order'				=> 'ASC',
);
$faculty = new WP_Query( $args );

?>


<section id="department-landing">
	<div class="breadcrumb"><?php breadcrumb(); ?></div>
    <div class="container">
        <div class="department-content">
        	<div class="heading-info">
        		<h3 class="department"><?php echo $department; ?></h3>
        		<?php if($main_contact) : ?>
		            <div class="img-mask2">
		            	<?php echo get_the_post_thumbnail($main_contact->ID); ?> <!-- , 'faculty-highlight' -->
		            </div>
		            <h3 class="title"><?php echo ($full_name ? $full_name : ''); ?></h3>
		            <p class="supporting-text"><?php echo ($title ? $title : ''); ?></p>
		        <?php endif; ?>
	        </div>
	        <?php if($main_contact) : ?>
		        <div class="main-contact-info">
			       	<?php if($phone || $email || $location_building) : ?>
			            <div class="contact">
			            	<h2>Contact</h2>
		            		<?php if ($phone) : ?>
		            			<p class="icon-phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?><?php echo ($extension ? ', Ext. ' . $extension : ''); ?></a></p>
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
			<?php endif; ?>
		    <hr/>
		    <?php if ( $faculty->have_posts() ) : ?>
			    <div class="department-faculty">
			    	<div class="container">
				    	<ul class="col-limit-3">
					    	<?php while ( $faculty->have_posts() ) : $faculty->the_post();
					    		$first_name 	= get_field('first_name');
					    		$last_name 		= get_field('last_name');
					    		$full_name 		= $first_name . ' ' . $last_name;
					    		$position 		= get_field('primary_title');
					    		?>

					    		<li class="flexcol">
					    			<ul class="single-container">
						    			<li><a class="name" href="<?php the_permalink(); ?>"><?php echo ($full_name ? $full_name : ''); ?></a></li>
						    			<li><p class="position"><?php echo ($position ? $position : ''); ?></p>
						    			</li>
						    		</ul>
						    	</li>
					    	<?php endwhile; ?>
					    </ul>
					</div>
			    </div>
			<?php endif; ?>
	    </div>
	</div>
</section>










