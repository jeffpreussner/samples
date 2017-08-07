<?php

    $dates_title            = get_sub_field('dates_title');
    $dates_supporting_text  = get_sub_field('dates_supporting_text');
    $dates_link_cta         = get_sub_field('dates_link_cta');
    $dates_link_url         = get_sub_field('dates_link_url');
    $dates_show_sort        = get_sub_field('dates_show_sort');
    $dates_default_category = get_sub_field('dates_default_category');

    $events = do_shortcode('[events_list limit=5 tag="featured" category="athletic"][/events_list]');

?>

<div class="pb page-content">
    <section class="pb-section dates module14">
        <div class="container">
            <h3 class="section-title centered"><?php echo ($dates_title ? $dates_title : ''); ?></h3>
            <!-- <div class="col m-span12">
                <ul class="dates-content ">
                    <?php //echo $events; ?>
                </ul> -->
                <?php getImportantDates($page_id); ?>
                <?php if ($dates_link_cta) : ?>
                    <div class="btn-container centered">
                        <a href="<?php echo $dates_link_url; ?>" class="btn m-block solid-green"><span><?php echo ($dates_link_cta ? $dates_link_cta : ''); ?></span></a>
                    </div>
                <?php endif; ?>
            <!-- </div> -->
        </div>
    </section>
</div>
