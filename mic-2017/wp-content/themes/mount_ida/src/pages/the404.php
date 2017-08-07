<?php // 404 Template //

  $title_404    = get_field('title_404', 'options');
  $content_404  = get_field('content_404', 'options');

?>

<section id="the404content">
    <div class="container">
        <h2 class="centered"><?php echo ($title_404 ? $title_404 : ''); ?></h2>
        <div class="content-404">
            <?php echo ($content_404 ? $content_404 : ''); ?>
        </div>
        <div class="btn-container centered">
            <a
                href="/"
                class="btn solid-green block-centered m-block"><span>Back to Home</span></a>
        </div>
      </div>
</section>
