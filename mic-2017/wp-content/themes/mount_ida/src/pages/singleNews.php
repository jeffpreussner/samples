<?php

    the_post();
    $post_ID        = get_the_ID();
    $post_title     = get_the_title();
    $image_ID  	    = get_post_thumbnail_id($post_ID);
    $image_alt 	    = get_post_meta($image_ID, '_wp_attachment_image_alt', true);
    $image_URL      = get_the_post_thumbnail_url();

?>

<section id="news">
    <div class="breadcrumb"><?php breadcrumb(); ?></div>
    
    <div class="container">
        <div class="news-header">
          <div class="news-category">
              <?php if (list_post_categories()) : ?>
                  <php list_post_categories(); ?>
              <?php endif; ?>
          </div>
          <div class="news-title">
              <h3><?php echo ($post_title ? $post_title : ''); ?></h3>
          </div>
          <div class="social-share">

                <a class="icon-fb"
                    href="https://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>"
                    rel="nofollow"
                    title="Share on Facebook"
                    target="_blank">
                </a>

                <a class="icon-tw"
                    href="https://twitter.com/share?url=<?php echo the_permalink(); ?>"
                    rel="nofollow"
                    title="Share on Twitter"
                    target="_blank">
                </a>

          </div>
        </div>
        <?php if ($image_URL) : ?>
            <div class="news-featured-image img-mask2">
                <img src="<?php echo $image_URL; ?>" alt="<?php echo ($image_alt ? $image_alt : ''); ?>">
            </div>
        <?php endif; ?>

        <div class="news-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<section id="featured-news">
    <?php get_template_part("$cp_base/pages/partials/featured_news_bottom"); ?>
</section>
