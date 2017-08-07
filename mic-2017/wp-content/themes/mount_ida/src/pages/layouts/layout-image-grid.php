<?php
    $page_id                         = get_the_ID();
    $styled_border                   = get_sub_field('image_grid_styled_border');
    $image_grid_title                = get_sub_field('image_grid_title');
    $image_grid_supporting_text      = get_sub_field('image_grid_supporting_text');
    $grid_images                     = get_sub_field('image_grid_images');
?>

<div class="pb page-content">
    <section class="pb-section image-grid <?php echo ($styled_border)? 'mask-top mask-bottom module7' : 'module6'; ?>">
        <?php if($image_grid_title || $image_grid_supporting_text ) :?>
            <div class="grid-text-container">
                <div class="grid-text">
                    <div class="inner">
                        <h6><?php echo ($image_grid_title ? $image_grid_title : ''); ?></h6>
                        <h5><?php echo ($image_grid_supporting_text ? $image_grid_supporting_text : ''); ?></h5>
                        <?php generateCTA('image_grid_links', $page_id); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- replace following hardcode with imageGrid() when images are in wordpress -->
        <?php imageGrid($grid_images); ?>
    </section>
</div>
