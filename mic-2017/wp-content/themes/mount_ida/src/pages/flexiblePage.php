<?php

// ACF
$background_image = get_field("background_image");
$responsive_bg_image = get_field("responsive_bg_imge");

?>

<?php

    if (have_rows('page_content_areas')){
        while(have_rows('page_content_areas')){ the_row();
          get_template_part("$cp_base/pages/layouts/layout-" . get_row_layout());
        } // while have page_content_areas
    } // if have page_content_areas

?>
