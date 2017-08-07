<?php

    // $full_width_promo_image             = get_sub_field('full_width_promo_image');
    // $full_width_promo_text_position     = get_sub_field('full_width_promo_text_position');
    // $full_width_promo_title             = get_sub_field('full_width_promo_title');
    // $full_width_promo_subtitle          = get_sub_field('full_width_promo_subtitle');
    // $full_width_promo_supporting_text   = get_sub_field('full_width_promo_supporting_text');
    // $full_width_promo_styled_border     = get_sub_field('full_width_promo_styled_border');
    // $full_width_promo_background_image  = get_sub_field('full_width_promo_background_image');
    //
    // $text_pos = '';
    // if ($full_width_promo_text_position == "center"){$text_pos="single";}
    // if ($full_width_promo_text_position == "right"){$text_pos="right-side-text";}
    // if ($full_width_promo_text_position == "left"){$text_pos="left-side-text";}

    $full_width_promo                   = get_sub_field('full_width_promo');

    if($full_width_promo):
      $full_width_promo_fields            = get_fields($full_width_promo);

      $full_width_promo_background_image  = $full_width_promo_fields['full_width_promo_background_image'];
      $full_width_promo_image             = $full_width_promo_fields['full_width_promo_image']; //no html yet
      $full_width_promo_text_position     = $full_width_promo_fields['full_width_promo_text_position']; //no html yet
      $full_width_promo_title             = $full_width_promo_fields['full_width_promo_title'];
      $full_width_promo_subtitle          = $full_width_promo_fields['full_width_promo_subtitle'];
      $full_width_promo_supporting_text   = $full_width_promo_fields['full_width_promo_supporting_text'];
      $text_pos = 'left-side-text';
      if ($full_width_promo_text_position == "center"){$text_pos="single";}
      if ($full_width_promo_text_position == "right"){$text_pos="right-side-text";}
      if ($full_width_promo_text_position == "left"){$text_pos="left-side-text";}
    endif;

?>

<div class="pb page-content">
    <?php if ($full_width_promo_background_image) : ?>
        <section class="pb-section full-width-promo has-bg mask-top mask-bottom module9 <?php echo $text_pos; ?>" style="background-image: url('<?php echo $full_width_promo_background_image['url']; ?>');">
    <?php else : ?>
        <section class="pb-section full-width-promo module9 <?php echo $text_pos; ?>">
    <?php endif; ?>
        <?php generateFWPromo($full_width_promo_title, $full_width_promo_subtitle, $full_width_promo_supporting_text, $full_width_promo); ?>
    </section>
</div>
