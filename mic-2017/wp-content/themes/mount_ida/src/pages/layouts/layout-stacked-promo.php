
<!-- NO HTML FOR FACULTY, NO HTML FOR SCHOOL -->

<div class="pb page-content">
	<?php $is_faculty = get_sub_field('stacked_promo_is_faculty_featured'); ?>
    <?php if (have_rows('stacked_promo')) : ?>
    		<section class="pb-section <?php echo ($is_faculty ? 'stacked-faculty module8' : 'stacked-promo module3'); ?>">
            <?php generatePromo('stacked_promo', $is_faculty); ?>
        </section>
    <?php endif; ?>
</div>
