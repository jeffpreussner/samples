<?php
		// ACF Custom Fields
		$title 		= get_sub_field('form_title');
		$form_ID 	= get_sub_field('form_id');

?>
<div class="form pb page-content">
	<div class="formAssemblyContainer">
		<div class="container">
			<div class="row">
				<div class="column">
					<h2><?php echo ($title ? $title : ''); ?></h2>
					<?php echo do_shortcode('[formassembly formid="'.$form_ID.'"]'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
