<?php  // News & Events Index //

    // Featured News //

    function featuredNews() {
        $sticky_posts       = get_option( 'sticky_posts' ); //get stickies

        global $post;
        $args = array(
          'numberposts' => 2,
          'post__in'    => $sticky_posts
        );

        $featured_posts = get_posts( $args );

        foreach( $featured_posts as $post ) :
            setup_postdata($post);

            $featured_title    = get_the_title();
            $featured_URL      = get_the_permalink();
            $featured_image    = get_the_post_thumbnail_url();

            echo
            '<div class="promo-wrap has-bg" style="background-image: url('.$featured_image.'); background-position: center top, center top; background-size:cover;">
                <div class="promo-content">
                    <h6 class="sub-title">Featured News</h6>
                    <h3 class="title">'.$featured_title.'</h3>
                    <div class="btn-container">
                        <a href="'.$featured_URL.'" class="btn solid-green m-block"><span>Read More</span></a>
                    </div>
                </div>
            </div>';

        endforeach;
        wp_reset_postdata();
    }

?>

<section id="hero">
    <h2 class="centered"><?php single_post_title(); ?></h2>
    <div class="container">
        <div class="container mask-top mask-bottom has-bg">
            <?php featuredNews(); ?>
        </div>
    </div>
</section>

<?php // Filters // ?>
<section id="filter">
    <div class="container">

        <div class="filters-wrapper">
            <div class="row">
                <?php echo do_shortcode('[searchandfilter slug="480-2"]') ;?>
            </div>
        </div>
        <hr />
    </div>
</section>

<?php // News and Event Listing // ?>
<section id="news-and-events-listing">
    <div class="container">
        <?php echo do_shortcode('[searchandfilter slug="480-2" show="results"]'); ?>
    </div>
</section>

<?php get_template_part("$cp_base/pages/partials/featured-event") ?>
