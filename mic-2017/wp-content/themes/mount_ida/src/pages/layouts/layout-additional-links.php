<?php
    $additional_links_supporting_text   = get_sub_field('additional_links_supporting_text');

    $mod_num = "11";
    if($additional_links_supporting_text){$mod_num = "12";}
?>

<div class="pb page-content">
    <section class="pb-section additional-links module<?php echo $mod_num; ?>">
        <div class="container">
            <?php linksHeader(); ?>
            <?php generateAddLinks('additional_links'); ?>
            <div class="btn-container">
                <?php mainLinkCTA(); ?>
            </div>
        </div>
    </section>
</div>
