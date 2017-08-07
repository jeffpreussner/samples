<?php
    $hero_title                             = get_field('hero_title');
    $hero_headline                          = get_field('hero_headline');
    $hero_subhead                           = get_field('hero_subhead');
    $figures_module_one_background_image    = get_field('figures_module_one_background_image');
    $figures_module_two_title               = get_field('figures_module_two_title');
    $faculty_image                          = get_field('faculty_image');
    $faculty_stat_number                    = get_field('faculty_stat_number');
    $faculty_stat_description               = get_field('faculty_stat_description');
    $admissions_stat_number                 = get_field('admissions_stat_number');
    $admissions_stat_description            = get_field('admissions_stat_description');
    $institutional_stat_number              = get_field('institutional_stat_number');
    $institutional_stat_description         = get_field('institutional_stat_description');
    $institutional_image                    = get_field('institutional_image');
    $additional_links_title                 = get_field('additional_links_title');

    $enable_table                           = get_field('table_enable');
    if ($enable_table) :
        $table_title                        = get_field('table_title');
        $table_caption                      = get_field('table_caption');
    ?>
    <script>
      $(document).ready(function(){
          $('#table').DataTable({
              "searching": false,
              "ordering": false,
              "pagingType": "full_numbers",
              "info": false,
              "pageLength": 5,
              "responsive": true,
              "lengthMenu": [ 5, 25, 50, 75, 100 ],
              "columnDefs": [
                  { "responsivePriority": 1, "targets": 0 },
                  { "responsivePriority": 2, "targets": -1 }
              ],
              "dom": 't<"table-nav"lp>',
              "language": {
                "paginate": {
                  "previous": "Prev"
                },
                "lengthMenu": "Show _MENU_ "
              }
          });
      });
    </script>
    <?php
    endif ;
?>

<section id="facts-figures">
    <div class="container">
        <div class="facts-header">
        	<h2 class="sub-title"><?php echo ($hero_title ? $hero_title : ''); ?></h2>
        	<h3 class="title"><?php echo ($hero_headline ? $hero_headline : ''); ?></h3>
        	<p class="supporting-text"><?php echo ($hero_subhead ? $hero_subhead : ''); ?></p>
            <?php if(have_rows('hero_links')) : ?>
    		    <ul class="btn-container">
                    <?php while (have_rows('hero_links')) : the_row();
                        $link_cta               = get_sub_field('link_cta');
                        $link_target            = get_sub_field('link_target');
                        $external_link          = get_sub_field('external_link');
                        $data_anchor            = get_sub_field('data_anchor');
                        $link_url               = get_sub_field('link_url');
                        $link_url_external      = get_sub_field('link_url_external');
                        $link_data_anchor       = get_sub_field('link_data_anchor');

                        $link = 'hi';
                        if($external_link) : $link = $link_url_external;
                        elseif ($data_anchor) : $link = $link_data_anchor;
                        else : $link = $link_url; endif;

                        $target = "_self";
                        if($link_target) : $target == "_blank"; endif;
                        ?>
            			<li>
                            <span><a href="#<?php echo $link; ?>" target="<?php echo $target; ?>" class="btn primary solid-green"><span><?php echo $link_cta; ?></span></a></span>
                        </li>
                    <?php endwhile; ?>
        		</ul>
            <?php endif; ?>
        </div>
        <div class="facts has-bg mask-top mask-bottom" style="background-image: url(<?php echo ($figures_module_one_background_image ? $figures_module_one_background_image : ''); ?>); background-position: center center; background-size: cover;">
            <?php if(have_rows('figures_module_one_facts')) : ?>
                <div class="fact-container container flex">
                    <div class="fact-wrapper">
                        <?php while (have_rows('figures_module_one_facts')) : the_row();
                            $styled_text = get_sub_field('styled_text');
                            $detail_text = get_sub_field('detail_text');
                            ?>
                            <div class="fact">
                                <h4 class="styled-text"><?php echo($styled_text ? $styled_text : ''); ?></h4>
                                <p class="detail-text"><?php echo ($detail_text ? $detail_text : ''); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="facts" id="mustang-life">
            <?php if(have_rows('figures_module_two_facts')) : ?>
                <div class="fact-container container flex">
                    <h3 class="facts-title">Mustang Life</h3>
                    <div class="fact-wrapper">
                        <?php while (have_rows('figures_module_two_facts')) : the_row();
                            $text_or_image  = get_sub_field('text_or_image');
                            $styled_image   = get_sub_field('styled_image');
                            $styled_text    = get_sub_field('styled_text');
                            $detail_text    = get_sub_field('detail_text');
                            ?>
                            <div class="fact">
                                <?php if($text_or_image == "text") : ?>
                                    <h4 class="styled-text"><?php echo($styled_text ? $styled_text : ''); ?></h4>
                                <?php elseif ($text_or_image == "image") : ?>
                                    <h4 class="styled-text"><img src="<?php echo($styled_image ? $styled_image : ''); ?>"/></h4>
                                <?php endif; ?>
                                <p class="detail-text"><?php echo ($detail_text ? $detail_text : ''); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if(have_rows('figures_module_two_below_facts')) : ?>
            <div class="below-facts-list flex">
                <div class="container">
                    <ul>
                        <?php while (have_rows('figures_module_two_below_facts')) : the_row();
                            $stat_description   = get_sub_field('stat_description');
                            $stat_number        = get_sub_field('stat_number');
                            ?>
                            <li class="flexcol">
                                <p><?php echo ($stat_description ? $stat_description : ''); ?>:
                                    <span><?php echo ($stat_number ? $stat_number : ''); ?></span>
                                </p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="stat-with-image" id="faculty">
            <h3 class="image-stat-title">Faculty</h3>
            <div class="container">
                <div class="row">
                    <div class="column img-mask2">
                        <img src="/wp-content/themes/mount_ida/src/img/global/placeholder.png">
                    </div>
                    <div class="column">
                        <div class="stat">
                            <div class="content">
                                <h3 class="number"><?php echo($faculty_stat_number ? $faculty_stat_number : ''); ?></h3>
                                <p class="statdescription"><?php echo($faculty_stat_description ? $faculty_stat_description : ''); ?></p>
                            </div>
                        </div>
                        <?php if(have_rows('faculty_below_facts')) : ?>
                            <div class="extra-facts">
                                <ul>
                                    <?php while (have_rows('faculty_below_facts')) : the_row();
                                        $stat_description   = get_sub_field('stat_description');
                                        $stat_number        = get_sub_field('stat_number');
                                        ?>
                                        <li>
                                            <p><?php echo($stat_description ? $stat_description : ''); ?>:
                                                <span><?php echo($stat_number ? $stat_number : ''); ?></span>
                                            </p>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="facts-full-width" id="admissions">
            <div class="hero-wrapper">
                <div class="slide-content">
                    <h3 class="sub-title">admissions</h3>
                    <div class="content styled">
                        <h1 class="title"><?php echo($admissions_stat_number ? $admissions_stat_number : ''); ?></h1>
                        <p class="supporting-text"><?php echo($admissions_stat_description ? $admissions_stat_description : ''); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(have_rows('admissions_below_facts')) : ?>
            <div class="below-facts-list flex">
                <div class="container">
                    <ul>
                        <?php while (have_rows('admissions_below_facts')) : the_row();
                            $stat_description   = get_sub_field('stat_description');
                            $stat_number        = get_sub_field('stat_number');
                            ?>
                            <li class="flexcol">
                                <p><?php echo ($stat_description ? $stat_description : ''); ?>:
                                    <span><?php echo ($stat_number ? $stat_number : ''); ?></span>
                                </p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="stat-with-image" id="institutional">
            <h3 class="image-stat-title">Institutional Costs and aid</h3>
            <div class="container">
                <div class="row">
                    <div class="column">
                        <div class="stat">
                            <div class="content">
                                <h3 class="number"><?php echo($institutional_stat_number ? $institutional_stat_number : ''); ?></h3>
                                <p class="statdescription"><?php echo($institutional_stat_description ? $institutional_stat_description : ''); ?></p>
                            </div>
                        </div>
                        <?php if(have_rows('institutional_below_facts')) : ?>
                            <div class="extra-facts">
                                <ul>
                                    <?php while (have_rows('institutional_below_facts')) : the_row();
                                        $stat_description   = get_sub_field('stat_description');
                                        $stat_number        = get_sub_field('stat_number');
                                        ?>
                                        <li>
                                            <p><?php echo($stat_description ? $stat_description : ''); ?>:
                                                <span><?php echo($stat_number ? $stat_number : ''); ?></span>
                                            </p>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="column img-mask2">
                        <img src="/wp-content/themes/mount_ida/src/img/global/placeholder.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="facts-additional-links">
            <div class="container">
                <div class="links-text">
                    <h2><?php echo($additional_links_title ? $additional_links_title : ''); ?></h2>
                </div>
                <?php generateAddLinks('additional_links'); ?>
            </div>
        </div>

        <?php
        if ($enable_table) :

          $table = get_field( 'facts_table' );

        if ( $table ) {

          echo '<div class="facts-table">';
          echo '<div class="title">'. $table_title .'</div>';
          echo '<table id="table" class="table">';

          if ($table_caption) :
            echo '<caption>' . $table_caption . '</caption>';
          endif ;

              if ( $table['header'] ) {

                  echo '<thead>';

                      echo '<tr class="tableRow header">';

                          foreach ( $table['header'] as $th ) {

                              echo '<th class="tableCell">';
                                  echo $th['c'];
                              echo '</th>';
                          }

                      echo '</tr>';

                  echo '</thead>';
              }

              echo '<tbody>';

                  foreach ( $table['body'] as $tr ) {

                      echo '<tr class="tableRow">';

                          foreach ( $tr as $td ) {

                              echo '<td class="tableCell">';
                                  echo $td['c'];
                              echo '</td>';
                          }

                      echo '</tr>';
                  }

              echo '</tbody>';

          echo '</table>';
          echo '</div>';
        }

        endif ;
        ?>

    </div>
</section>
