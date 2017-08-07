<?php
    $page_id                            = get_the_ID();
    $full_width_hero_title              = get_sub_field('full_width_hero_title');
    $full_width_hero_subtitle           = get_sub_field('full_width_hero_subtitle');
    $full_width_hero_styled_title       = get_sub_field('full_width_hero_styled_title');
    $full_width_hero_supporting_text    = get_sub_field('full_width_hero_supporting_text');
    $full_width_hero_image              = get_sub_field('full_width_hero_image');
    $full_width_hero_background_image   = get_sub_field('full_width_hero_background_image');
    $full_width_hero_links              = get_sub_field('full_width_hero_links');


/*
    HTML NEEDS: styled title
*/

?>

<div class="pb page-content">
    <?php if ($full_width_hero_background_image) : ?>
        <section class="pb-section flex full-width-hero module1 mask-bottom has-bg" style="background-image: url('<?php echo $full_width_hero_background_image['url'] ; ?>');">
    <?php else: ?>
        <section class="pb-section flex full-width-hero module2">
    <?php endif; ?>
        <div class="hero-wrapper">
            <div class="slide-content">
                <h3 class="sub-title"><?php echo ($full_width_hero_subtitle ? $full_width_hero_subtitle : ''); ?></h3>
                <h1 class="title<?php echo ($full_width_hero_styled_title ? ' styled' : '' );  ?>"><?php echo ($full_width_hero_title ? $full_width_hero_title : ''); ?></h1>
                <p class="supporting-text"><?php echo ($full_width_hero_supporting_text ? $full_width_hero_supporting_text : ''); ?></p>

                <?php generateCTA('full_width_hero_links', $page_id); ?>

                <?php if ($full_width_hero_image) : ?>
                    <div class="img-mask2">
                        <img src="<?php echo $full_width_hero_image; ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
