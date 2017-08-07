<?php // Campus Life Slide - Blockquote //

    // ACF
    $blockquote     			= get_sub_field("blockquote");
    $quote_author   			= get_sub_field("quote_author");
    $quote_author_title			= get_sub_field("quote_author_title");
    $quote_author_department	= get_sub_field("quote_author_department");
    $post_object = get_field('post_object');
?>

<blockquote>
    <?php echo ($blockquote ? $blockquote : ''); ?>
</blockquote>
<cite> <?php echo ($quote_author ? $quote_author : ''); ?> </cite>
<cite>
	<?php if($quote_author_title && $quote_author_department) : ?>
		<?php echo $quote_author_title.', <a href="'.get_permalink($quote_author_department->ID).'" class="btn text-link">'.get_the_title($quote_author_department->ID).'</a>'; ?>
	<?php elseif ($quote_author_title) : ?>
		<?php echo $quote_author_title; ?>
	<?php elseif ($quote_author_department) : ?>
		<a href="<?php echo get_permalink($quote_author_department->ID); ?>" class="btn text-link"><?php echo get_the_title($quote_author_department->ID); ?></a>
	<?php endif; ?>
</cite>

