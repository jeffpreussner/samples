<?php

		function generateModalMenu() {
			wp_nav_menu( array(
					'theme_location'	  => 'modal-menu',
					'menu_class'		    => 'modal-menu',
					'container'			    => false
				)
			);
		};

		global $theme_dir_uri;

?>

<div id="search" class="modal-container">
	<div class="modal-header">
		<img class="logo" src="<?php echo $theme_dir_uri;?>/img/global/logo.svg" alt="Mount Ida College" data-rjs="2">
		<a href="#" class="icon-close close-modal"><span>close</span></a>
	</div>
	<form id="fakeform">
		<div class="input-group">
			<div class="inner">
				<input class="search-text" type="hidden" name="q" value=""/>
				<!--<p id="contenteditable" contenteditable="true">Type something here</p>-->
				<textarea class='autoExpand' rows='1' data-min-rows='1' placeholder='Search'></textarea>
				<button class="submit" type="submit" value=""><span>submit</span></button>
			</div>
		</div>
	</form>
</div>

<div id="applicants" class="modal-container">
	<div class="modal-header">
		<img class="logo" src="<?php echo $theme_dir_uri;?>/img/global/logo.svg" alt="Mount Ida College" data-rjs="2">
		<a href="#" class="icon-close close-modal"><span>close</span></a>
	</div>
	<div class="info-content desktop">
	<i>Information for:</i>
		<?php generateModalMenu(); ?>
	</div>
</div>
