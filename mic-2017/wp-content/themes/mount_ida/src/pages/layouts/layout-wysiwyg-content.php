<?php
		// ACF Custom Fields
		$wysiwyg_content_background_color 	= get_sub_field('wysiwyg_content_background_color');
		$wysiwyg_content_alignment 			= get_sub_field('wysiwyg_content_alignment');
		$wysiwyg_content 					= get_sub_field('content');
?>

<div class="pb page-content">
    <section class="pb-section wysiwyg-content">
    	<div class="container">
    		<?php echo $wysiwyg_content; ?>
    	</div>
    </section>
</div>
