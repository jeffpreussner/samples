<?php
	$page_id = get_the_ID();
	$full_width_content_title               = get_sub_field('full_width_content_title');
	$full_width_content_subtitle            = get_sub_field('full_width_content_subtitle');
	$full_width_content_supporting_text     = get_sub_field('full_width_content_supporting_text');
	$full_width_content_text_position       = get_sub_field("full_width_content_text_position"); //no html yet
	$full_width_content_image_or_stat		= get_sub_field('full_width_content_image_or_stat');
	$full_width_content_image 				= get_sub_field('full_width_content_image');
	$full_width_content_stat_number			= get_sub_field('full_width_content_stat_number');
	$full_width_content_stat_description	= get_sub_field('full_width_content_stat_description');

	$module;
	if ($full_width_content_image_or_stat == "Image"){$module = "module4";}
	elseif ($full_width_content_image_or_stat == "Stat"){$module = "module5";}
	elseif ($full_width_content_image_or_stat == "Neither"){$module = "single module10";}
?>


<div class="pb page-content">
	<section class="pb-section full-width-content <?php echo $module; ?>">
	    <div class="container">
	    	<div class="row">
	    		<?php if ($module == "single module10") : ?> <!-- if single content -->
		    		<div class="column">
		    			<div class="text-content">
		    				<h6 class="sub-title"><?php echo ($full_width_content_subtitle ? $full_width_content_subtitle : ''); ?></h6>
		    			    <h3 class="full-width-content-title"><?php echo ($full_width_content_title ? $full_width_content_title : ''); ?></h3>
		    			    <p class="full-width-content-text">
		    			        <?php echo ($full_width_content_supporting_text ? $full_width_content_supporting_text : ''); ?>
		    			    </p>
		    			    <?php generateCTA('full_width_content_links', $page_id); ?>
		    			</div>
		    		</div>
		    	<?php elseif ($module == "module4"): ?> <!-- if image -->
		            <div class="column">
						<div class="img-mask2">
							<img src="<?php echo $full_width_content_image; ?>">
						</div>
			        </div>
		            <div class="column">
		                <div class="text-content">
	                    	<h6 class="sub-title"><?php echo ($full_width_content_subtitle ? $full_width_content_subtitle : ''); ?></h6>
	                        <h3 class="full-width-content-title"><?php echo ($full_width_content_title ? $full_width_content_title : ''); ?></h3>
	                        <p class="full-width-content-text">
	                            <?php echo ($full_width_content_supporting_text ? $full_width_content_supporting_text : ''); ?>
	                        </p>
	                        <?php generateCTA('full_width_content_links', $page_id); ?>
		                </div>
		            </div>
		        <?php elseif ($module == "module5"): ?>
		        	 <div class="column">
		                <div class="text-content">
							<h6 class="sub-title"><?php echo ($full_width_content_subtitle ? $full_width_content_subtitle : ''); ?></h6>
						    <h3 class="full-width-content-title"><?php echo ($full_width_content_title ? $full_width_content_title : ''); ?></h3>
						    <p class="full-width-content-text">
						        <?php echo ($full_width_content_supporting_text ? $full_width_content_supporting_text : ''); ?>
						    </p>
						    <?php generateCTA('full_width_content_links', $page_id); ?>
		                </div>
		            </div>
		            <div class="column stat">
		                <div class="content">
		                    <h3 class="number"><?php echo ($full_width_content_stat_number ? $full_width_content_stat_number : ''); ?></h3>
		                    <p class="statdescription"><?php echo ($full_width_content_stat_description ? $full_width_content_stat_description : ''); ?></p>
		                </div>
		            </div>
		    	<?php endif; ?>
		    </div>
	    </div>
	</section>
</div>
