<?php

    $current_post_ID    = get_the_ID();
    $sticky_posts       = get_option( 'sticky_posts' ); //get stickies

    // Search
    $position = array_search($current_post_ID, $sticky_posts);

    // Remove from array
    if ($position) {
        unset($sticky_posts[$position]);
    }


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
        $featured_excerpt  = get_the_excerpt(); ?>

        <div class="featured-news">
            <div class="news-content">
                <p class="sub-title">FEATURED NEWS</p>
                <h3><?php echo $featured_title; ?></h3>
                <p class="news-detail"><?php echo $featured_excerpt; ?></p>
                <div class="btn-container">
                    <a href="<?php echo $featured_URL; ?>" class="btn primary">Read More</a>
                </div>
            </div>
        </div>
        
    <?php endforeach;
    wp_reset_postdata(); ?>
