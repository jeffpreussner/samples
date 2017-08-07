<?php 
	$facts_title = get_sub_field("facts_title");
?>

<div class="pb page-content">
    <section class="pb-section facts module13">
        <div class="fact-container container flex">
        	<h3 class="facts-title"><?php echo ($facts_title ? $facts_title : ''); ?></h3>
        	<?php if(have_rows('facts')) : ?>
            	<div class="fact-wrapper">
            	    <?php while (have_rows('facts')) : 
            	    	the_row();
            	        $styled = get_sub_field("styled_text");
            	        $detail = get_sub_field("detail_text");
            	        ?>

            	        <div class="fact">
                            <h4 class="styled-text"><?php echo ($styled ? $styled : ''); ?></h4>
                            <p class="detail-text"><?php echo ($detail ? $detail : ''); ?></p>
                        </div>

                    <?php endwhile; ?>
            	</div>
            <?php endif; ?>
            <?php generateCTA('facts_links', $page_id); ?>
        </div>
    </section>
</div>