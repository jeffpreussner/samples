<?php // Helper Functions //

// NOTE: These functions were created to generate re-usable modules

// --------------------------------------------------------------------------

/*
|------------------------------------------------
| Additional Links Module Helper Functions
|------------------------------------------------
*/

// Header for Additional Links
function linksHeader(){
    $additional_links_title             = get_sub_field('additional_links_title');
    $additional_links_supporting_text   = get_sub_field('additional_links_supporting_text');

    echo '<div class="links-text">';
        if($additional_links_title)             : echo '<h2>'.$additional_links_title.'</h2>'; endif;
        if($additional_links_supporting_text)   : echo '<h5>'.$additional_links_supporting_text.'</h5>'; endif;
    echo '</div>';
}

// Helper function for echo'ing the appropriate CTA
function addhelper($cta, $target, $external, $internal_url, $external_url){
    $l;
    if($external){ $l = $external_url; }
    else { $l = $internal_url; }
    $t;
    if($target) { $t = "_blank"; }
    else { $t = "_self"; }


    echo '<li class="flexcol"><a href="'.$l.'" target="'.$t.'" class="btn text-link"><span>'.$cta.'</span></a></li>';

}

// Loop through links, grab variables for helper
function generateAddLinks($row){

    $row_count = count(get_sub_field($row));

    if ($row_count > 12) {
      echo '<ul>';
    } else {
      echo '<ul class="col-limit-3">';
    }

    if (have_rows($row)) :
        while (have_rows($row)) :
            the_row();
            $link_cta            = get_sub_field('link_cta');
            $link_target         = get_sub_field('link_target');
            $external_link       = get_sub_field('external_link');
            $link_url            = get_sub_field('link_url');
            $link_url_external   = get_sub_field('link_url_external');

            addHelper($link_cta, $link_target, $external_link, $link_url, $link_url_external);
        endwhile;
    endif;

    echo '</ul>';
}

// Main CTA underneath repeating links
function mainLinkCTA(){
    $additional_links_main_link_cta             = get_sub_field('additional_links_main_link_cta');
    $additional_links_main_link_external        = get_sub_field('additional_links_main_link_external'); //truefalse
    $additional_links_main_link_external_url    = get_sub_field('additional_links_main_link_external_url');
    $additional_links_main_link_url             = get_sub_field('additional_links_main_link_url');

    $link;
    if ($additional_links_main_link_external) { $link = $additional_links_main_link_external_url; }
    else { $link = $additional_links_main_link_url; }

    if ($additional_links_main_link_cta) :
        echo '<a href="'.$link.'" class="btn solid-green m-block"><span>'.$additional_links_main_link_cta.'</span></a>';
    endif;
}


/*
|------------------------------------------------
| Important Dates Module Functions
|------------------------------------------------
*/

function getImportantDates($id) {

    $dates_title                    = get_field('dates_title', $id);
    $dates_link_cta                 = get_field('dates_link_cta', $id);
    $dates_link_url                 = get_field('dates_link_url', $id);
    $dates_show_filter              = get_field('dates_show_filter', $id); // bool

		if ($dates_title) : ?>
			 <h3 class="section-title centered"><?php echo $dates_title; ?></h3>
		<?php endif; ?>

    <div class="col m-span12">
        <ul class="dates-content">
            <?php

                if ($dates_show_filter) :
                    echo do_shortcode( '[searchandfilter slug="important-dates-filter"]' );
                    echo do_shortcode( '[searchandfilter slug="important-dates-filter" show="results"]' );
                else :
                    echo do_shortcode('[events_list limit=5]
                        <li>
                            <div><a href="#_EVENTURL">#_EVENTNAME</a></div>
                            <div>#_{F j, g:i}</div>
                            <div>#_ATT{Event Location Name}</div>
                        </li>
                    [/events_list]');

                endif;

            ?>
        </ul>

        <?php if ($dates_link_cta) : ?>
            <div class="btn-container centered">
                <a
                    href="<?php echo ($dates_link_url ? $dates_link_url : ''); ?>"
                    class="btn solid-green block-centered m-block"><span><?php echo ($dates_link_cta ? $dates_link_cta : ''); ?></span>
                </a>
            </div>
  			<?php endif ; ?>
    </div>

<?php }


/*
|-------------------------------------------------------
| Generate CTA Functions
|-------------------------------------------------------
*/


function generateCTA_helper($arrow, $add_style, $cta, $target, $external, $internal_url, $external_url, $tertiary_text)
{

    // Determine if link is internal or external
    $i;
    if($external){ $i = $external_url; }
    else { $i = $internal_url; }

    // Determine if link should open in new tab or same tab
    $t;
    if($target) { $t = "_blank"; }
    else { $t = "_self"; }

    // Determine if there is any additional style selection
    $additional_style = "";
    if($add_style){$additional_style = "$add_style"; }

    // Determine which style button are we dealing with and
    // set classes based on that style selection
    $classes;
    if ($arrow){ $classes = "btn m-block styled $additional_style"; }
    else { $classes = "btn m-block $additional_style"; }

    //Echo appropriate CTA based on all the above
    if ($add_style == "text-link" && $tertiary_text){
        echo '<p>'.$tertiary_text.' <a class="'.$classes.'" target="'. $t .'" href="'.$i.'"><span>' .$cta. '</span></a></p>';
    }
    else {
        echo '<a class="'.$classes.'" target="'. $t .'" href="'.$i.'"><span>' .$cta. '</span></a>';
    }
}

// Generate loop for CTA's
function generateCTA($row, $id){

    if (have_rows($row, $id)) :

        $count = -1;
        while (have_rows($row, $id)) : the_row(); $count++; endwhile;
        while( have_rows($row, $id) ): the_row(); $my_data[] = get_row(); endwhile;
        $runner = 0;

        $rows = get_field($row, $id);

        while (have_rows($row, $id)) : the_row();
            $arrow_style                = get_sub_field('arrow_style');
            $additional_link_style      = get_sub_field('additional_link_style'); // arr
            $link_cta                   = get_sub_field("link_cta");
            $link_target                = get_sub_field("link_target");
            $external_link              = get_sub_field("external_link");
            $link_url                   = get_sub_field("link_url");
            $link_url_external          = get_sub_field("link_url_external");
            $tertiary_supporting_text   = get_sub_field('tertiary_supporting_text');

            if (is_array($additional_link_style)) {
              $additional_link_style = implode(" ", $additional_link_style);
            }

            if($runner == 0 && $additional_link_style != "text-link"){
                echo '<div class="btn-container">';
            }

            generateCTA_helper($arrow_style, $additional_link_style, $link_cta, $link_target, $external_link, $link_url, $link_url_external, $tertiary_supporting_text);


            if($count == $runner && $additional_link_style != "text-link") {
                echo '</div>';
            }
            elseif($row == 'stacked_promo_links' && $count != $runner && strcmp($rows[$runner+1]['additional_link_style'],"text-link")){
                echo '</div>';
            }
            //strcmp($rows[$runner+1]['additional_link_style'],"text-link")
            elseif($count != $runner && $additional_link_style == "text-link"){
                echo '</div>';
            }

            $runner++;
        endwhile;
    endif;
}


/*
|------------------------------------------------
| Full Width Promo Module Functions
|------------------------------------------------
*/

// Generate Full Width Promo
function generateFWPromo($title, $subtitle, $supporting, $id = ''){
	echo '<div class="promo-content">
        <div class="container">
			<div class="row">
            	<div class="column">';
                    promoHeader($title, $subtitle, $supporting);
                    generateCTA('full_width_promo_links', $id);
            echo '</div>
            </div>
        </div>
	</div>';
}

// Generate Full Width Promo Header
function promoHeader($title, $subtitle, $supporting){
    if($title) 		: echo '<h6>'.$title.'</h6>'; endif;
    if($subtitle) 	: echo '<h2>'.$subtitle.'</h2>'; endif;
    if($supporting) : echo '<p class="supporting-text">'.$supporting.'</p>'; endif;
}


/*
|------------------------------------------------
| Image Grid Module Functions
|------------------------------------------------
*/

// Generate Image Grid Header
function gridHeader(){
    $image_grid_title                = get_sub_field('image_grid_title');
    $image_grid_supporting_text      = get_sub_field('image_grid_supporting_text');

    if($image_grid_title)           : echo '<h6>'.$image_grid_title.'</h6>'; endif;
    if($image_grid_supporting_text) : echo '<h5>'.$image_grid_supporting_text.'</h5>'; endif;
}

// Generate Image Grid
function ImageGrid($grid_images){
    //$grid_images = get_field('image_grid_images');
    if ($grid_images): ?>
        <?php foreach ($grid_images as $image): ?>
            <!-- take out height and width when actual images are imported -->
            <img src="<?php echo $image['sizes']['image-grid']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endforeach; ?>
    <?php endif;
}


/*
|------------------------------------------------
| Stacked Promo Module Functions
|------------------------------------------------
*/

// Loops through each Stacked Promo available
function generatePromo($promo_field, $is_faculty){

    $i = 1;
    //$count = count($promo_field);
    $count = 0;
    while (have_rows($promo_field)) : the_row(); $count++; endwhile;

    while (have_rows($promo_field)) : the_row();
        $title                  = get_sub_field('title');
        $styled_title           = get_sub_field('styled_title');
        $subtitle               = get_sub_field('subtitle');
        $supporting_text        = get_sub_field('supporting_text');
        $background_image       = get_sub_field('background_image');
        $has_featured_majors    = get_sub_field('has_featured_majors');
        $featured_majors        = get_sub_field('featured_majors');
        $faculty_image          = get_sub_field('faculty_image');
        if ($i % 2 != 0) :
            echo '<div class="container">';
        endif;


        if ($is_faculty) :
            echo '<div class="faculty-wrap faculty'.$i.'">';

        else :
            if($background_image):
                echo '<div class="promo-wrap promo'.$i.' has-bg mask-top mask-bottom" style="background-image: url('.$background_image["url"].');">';
            else:
                echo '<div class="promo-wrap promo'.$i.'">';
            endif;
        endif;

        generatePromoContent($title, $styled_title, $subtitle, $supporting_text, $has_featured_majors, $featured_majors, $is_faculty, $faculty_image, 'stacked_promo_links');

        if ($i % 2 == 0 || $i == $count) : echo '</div>'; endif;

        echo '</div>';

        $i++;

    endwhile;
}

// Helper function to generate Stacked Promo Content
function generatePromoContent($title, $styled_title, $subtitle, $supporting_text, $has_featured_majors, $featured_majors, $is_faculty, $faculty_image, $links){

    $page_id = get_the_ID();
    $style = '';
    if($styled_title) { $style="styled"; }

    if ($is_faculty) {
        echo '<div class="faculty-content">';
            echo '<div class="img-mask2">
                    <img src="'.$faculty_image.'">
                </div>';
    }
    else {
        echo '<div class="promo-content">';
    }

        if ($subtitle)              : echo '<h6 class="sub-title">'.$subtitle.'</h6>'; endif;
        if ($title)                 : echo '<h3 class="title '.$style.'">'.$title.'</h3>'; endif;
        if ($supporting_text)       : echo '<p class="supporting-text">'.$supporting_text.'</p>'; endif;
        if ($has_featured_majors)   : generateFeaturedMajors($featured_majors); endif;
        generateCTA($links, $page_id);

        echo '</div>';
}

// Genrate Featured Major option
function generateFeaturedMajors($post_objects){
    echo '<div class="featured-major">
            <h6>Featured Majors</h6>';

        if( $post_objects ) :
            foreach( $post_objects as $post_object):
                echo '<a href=" '. get_permalink($post_object->ID) .' " class="btn text-link">
                        '. get_the_title($post_object->ID) . '
                    </a>';
            endforeach;
        endif;
    echo '</div>';
}


/*
|------------------------------------------------
| Breadcrumbs for Single Events and Single News
|------------------------------------------------
*/

function breadcrumb(){
    $post_ID    = get_the_ID();
    $object     = get_queried_object();

    // link back to home page
    $home       = "home";
    $home       = strtoupper ($home);
    $homeLink   = "<a href=".get_site_url().">".$home."</a>";


    // determines what the post type is for middle part of crumb
    $crumbLink;
    if (get_post_type($post_ID)  == "post") :
        $crumb = "news";
        $crumbLink = 475;
    elseif (get_post_type($post_ID) == "event") :
        $crumb = "events";
        $crumbLink = 475;
    elseif (get_post_type($post_ID) == "areas_of_study") :
        $crumb = "Academics";
        $crumbLink = 3383;
    elseif (get_post_type($post_ID) == "tuition_fee") :
        $crumb = "Academics";
        $crumbLink = 3383;
    elseif (get_post_type($post_ID) == "faculty_and_staff") :
        $crumb = "directory";
        $crumbLink = 3970;
    endif;

    $crumb      = strtoupper ($crumb);
    $crumbLink  = "<a href=".get_page_link($crumbLink).">".$crumb."</a>";

    if ($object->name != '') : $title = strtoupper ($object->name);
    else : $title = strtoupper (get_the_title());
    endif;

    if(strlen($title) > 14) :
        $title = substr($title, 0, 15) . '...';
    endif;

    $titleLink  = "<span>".$title."</span>";
    //$titleLink = $object->name;
    $forwardArrow = "<span class='arrow'>></span>";

    echo $homeLink . $forwardArrow . $crumbLink . $forwardArrow . $titleLink;
}

/*
|------------------------------------------------
| Generate News function for home page
|------------------------------------------------
*/

function generateNews(){
    $sticky = get_option( 'sticky_posts' ); //get stickies
    rsort( $sticky ); //sort them by date

    global $post;
    $args = array(
        'post_type' => 'post',
        'post__in'  => $sticky
    );

    $hp_posts = get_posts($args);

    foreach( $hp_posts as $post ) :
        setup_postdata($post);

        $single_title       = get_the_title();
        $single_url         = get_permalink();
        $single_date        = get_the_date('F j, Y');
        $single_exerpt      = limit_text(get_the_excerpt(), 25);

        echo '<div class="news-item">';
            if($single_date)    : echo '<div class="date">'.$single_date.'</div>'; endif;
            if($single_title)   : echo '<div class="news-title">'.$single_title.'</div>'; endif;
            if($single_exerpt)  : echo '<p class="news-detail">'.$single_exerpt.'</p>'; endif;
            if($single_url)     : echo '<a href="'.$single_url.'" class="btn text-link"><span>Read More</span></a>'; endif;
        echo '</div>';

    endforeach;
    wp_reset_postdata();
}

/*
|------------------------------------------------
| Faculty Name
|------------------------------------------------
*/

function facultyName($fname, $lname, $prefx, $sufx) {

    $faculty_name = $fname . ' ' . $lname;

    if ($prefx) {
        $faculty_name = $prefx . ' ' . $faculty_name;
    }
    if ($sufx) {
        $faculty_name .= ', ' . $sufx;
    }
    return $faculty_name;
}

?>
