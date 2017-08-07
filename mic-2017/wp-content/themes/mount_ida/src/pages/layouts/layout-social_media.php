<?php // Campus Life Slide - Social Media //

    // ACF
    $cutout_image   = get_sub_field("cutout_image");
    $facebook_URL   = get_field('facebook_url', 'options');
    $twitter_URL    = get_field('twitter_url', 'options');
    $instagram_URL  = get_field('instagram_url', 'options');
    $youtube_URL    = get_field('youtube_url', 'options');

?>

<img src="<?php echo ($cutout_image ? $cutout_image['url'] : ''); ?>">
<div class="social-container">
    <a href="<?php echo ($facebook_URL ? $facebook_URL : ''); ?>" class="icon-fb" target="_blank"><span>Facebook</span></a>
    <a href="<?php echo ($twitter_URL ? $twitter_URL : ''); ?>" class="icon-tw" target="_blank"><span>Twitter</span></a>
    <a href="<?php echo ($instagram_URL ? $instagram_URL : ''); ?>" class="icon-ig" target="_blank"><span>Instagram</span></a>
    <a href="<?php echo ($youtube_URL ? $youtube_URL : ''); ?>" class="icon-yt" target="_blank"><span>YouTube</span></a>
</div>
