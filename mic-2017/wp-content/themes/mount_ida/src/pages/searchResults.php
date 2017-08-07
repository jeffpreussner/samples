<?php // Search Results //

    global $post, $query, $page, $supplementalEngineName, $posts_per_page, $tab;

    $schools_count = 0;
    $total_results = 0;

    $posts_per_page = 10;

    // retrieve our search query if applicable

    $query = isset( $_GET['searchwpquery'] ) ? sanitize_text_field( $_GET['searchwpquery'] ) : '';
    $supplementalEngineName = 'custom_search_with_taxonomy';

    $tab = isset( $_GET['tab'] ) ? absint( $_GET['tab'] ) : 0;


    // retrieve our pagination if applicable

    $page = isset( $_GET['currentpage'] ) ? absint( $_GET['currentpage'] ) : 1;
    //$paged = $page;


    $highlighter = false;
    if( class_exists( 'SearchWP_Term_Highlight' ) ) {
        $highlighter = new SearchWP_Term_Highlight();
    }

    // the_post();

    function getQuery($type, $tabIndex) {

      global $post, $query, $page, $supplementalEngineName, $posts_per_page, $tab;

      rewind_posts();

      if (trim($tabIndex) !== trim($tab)) :
        $page = 1;
      else :
        $page = isset( $_GET['currentpage'] ) ? absint( $_GET['currentpage'] ) : 1;
      endif ;


      return $swp_query = new SWP_Query(
          array(
              's'               => $query,
              'engine'          => $supplementalEngineName,
              'page'            => $page,
              'posts_per_page'  => $posts_per_page,
              'post_type'       => $type
          )
      );

    }



    function getTaxonomyCount() {

      global $post, $query, $page, $supplementalEngineName, $posts_per_page, $tab;

      $count = 0;

      rewind_posts();

      $tax_query = new SWP_Query(
          array(
              's'               => $query,
              'engine'          => $supplementalEngineName,
              'posts_per_page'  => -1
          )
      );

      //printr($tax_query);

      if ( !empty( $tax_query->posts ) ) :
          foreach( $tax_query->posts as $post ) :
              if( $post instanceof SearchWPTermResult ) :
                if($post->term->taxonomy == 'schools' && $post->term->parent == 0) :
                  $count++;
                endif ;
              endif ;
          endforeach ;
      endif ;

      return $count;

    }

    function getPagination($currentQuery, $tabIndex) {
      global $page, $query, $tab;

      if (trim($tabIndex) !== trim($tab)) :
        $page = 1;
      else :
        $page = isset( $_GET['currentpage'] ) ? absint( $_GET['currentpage'] ) : 1;
      endif ;

      $pagination = paginate_links( array(
        'base' => @add_query_arg(array(
          'currentpage' => '%#%',
          'tab' => $tabIndex
        )),
        'format'  => '?currentpage=%#%' . '&tab='.$tabIndex,
        'current' => $page,
        'total'   => $currentQuery->max_num_pages,
        'show_all'           => false,
        'end_size'           => 1,
        'mid_size'           => 2,
        'prev_next'          => true,
        'type'               => 'list',
        'add_args'           => false
      ) );

?>

<nav class="pagination">
    <?php echo wp_kses_post( $pagination ); ?>
</nav>
<?php } ?>


<?php

      $pages_query = getQuery(array('areas_of_study', 'page'), 0);
      $news_query = getQuery('post', 1);
      $events_query = getQuery('event', 2);
      $faculty_query = getQuery('faculty_and_staff', 3);

      $schools_count = getTaxonomyCount();

      $pages_count = $pages_query->found_posts + $schools_count;
      $news_count = $news_query->found_posts;
      $events_count = $events_query->found_posts;
      $faculty_count = $faculty_query->found_posts;

      $total_results = $pages_count + $news_count + $events_count + $faculty_count;
?>
<section id="header">
    <?php if( !empty( $query ) ) : ?>
        <h1 class="centered">Search Results</h1>
    <?php else : ?>
        <h1 class="centered">Search</h1>
    <?php endif ; ?>

</section>

<section id="search-input">
    <div class="container">

        <form role="search" method="get" class="search-form" action="/search/">
            <div class="search-bar">
                <label for="search-results">Search</label>
                <input
                        type="search"
                        class="search-field"
                        placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
                        value="<?php echo $query; ?>" name="searchwpquery"
                        title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"
                        id="search-results" />
            </div>
            <div id="search-submit">
                <input type="submit" class="submit-btn" value="<?php echo esc_attr_x( 'Search', 'Search' ) ?>" />
            </div>
        </form>

        <?php

            if ($query !== '') :
                if ($total_results == 1) :
                  echo '<p class="results-count">' . $total_results . ' Result for "' . $query . '"</p>';
                elseif ($total_results > 0) :
                  echo '<p class="results-count">' . $total_results . ' Results for "' . $query . '"</p>';
                else :
                  echo '<p class="results-count">No Results Found for "' . $query . '"</p>';
                endif ;
            else :
                echo '<p class="results-count"></p>';
            endif ;

        ?>
    </div>
</section>

<section id="search-results">
    <div class="container">

        <div id="search-tabs" class="tab-nav-wrapper">

            <ul class="tab-nav">
                <li><a
                        class="<?php echo ($pages_count > 0 ? '' : 'empty-result'); ?>"
                        href="#pages"
                        data-value="<?php echo $pages_count; ?>">Pages (<?php echo $pages_count; ?>)</a></li>
                <li><a
                        class="<?php echo ($news_count > 0 ? '' : 'empty-result'); ?>"
                        href="#news"
                        data-value="<?php echo $news_count; ?>">News (<?php echo $news_count; ?>)</a></li>
                <li><a
                        class="<?php echo ($events_count > 0 ? '' : 'empty-result'); ?>"
                        href="#events"
                        data-value="<?php echo $events_count; ?>">Events (<?php echo $events_count; ?>)</a></li>
                <li><a
                        class="<?php echo ($faculty_count > 0 ? '' : 'empty-result'); ?>"
                        href="#faculty-staff"
                        data-value="<?php echo $faculty_count; ?>">Faculty &amp; Staff (<?php echo $faculty_count; ?>)</a></li>
            </ul>

            <div class="mobile-tab-nav">
                <label>Filter by Type</label>
                <select>
                    <option <?php echo ($pages_count > 0 ? '' : 'disabled'); ?> value="#pages">Pages (<?php echo $pages_count; ?>)</option>
                    <option <?php echo ($news_count > 0 ? '' : 'disabled'); ?> value="#news">News (<?php echo $news_count; ?>)</option>
                    <option <?php echo ($events_count > 0 ? '' : 'disabled'); ?> value="#events">Events Events  (<?php echo $events_count; ?>)</option>
                    <option <?php echo ($faculty_count > 0 ? '' : 'disabled'); ?> value="#faculty-staff">Faculty &amp; Staff (<?php echo $faculty_count; ?>)</option>
                </select>
            </div>

            <div class="tab-content" id="pages">

                <?php

                    $wp_query = $pages_query; //to play nice with next/prev links;


                    if ( !empty( $pages_query->posts ) ) :
                        foreach( $pages_query->posts as $post ) : ?>

                        <?php if( $post instanceof SearchWPTermResult ) : ?>
                          <?php if($post->term->taxonomy == 'schools' && $post->term->parent == 0) :?>
                          <div class="search-result">
                            <?php //printr($post); ?>
                              <a class="result-title" href="<?php echo $post->link; ?>"><h3><?php echo $post->term->name; ?></h3></a>

                              <?php
                                // Insert term highlight function for taxonomy term description
                                $excerpt = html_entity_decode(strip_tags($post->description));

                                $excerpt = limit_text($excerpt, 20);
                                // if( $highlighter ) {
                                //   $excerpt = $highlighter->apply_highlight( $excerpt, $query );
                                // }
                                //
                                // $excerpt = preg_replace('/\s+/u', ' ', $excerpt);

                                echo '<p>';
                                echo $excerpt;
                                echo '<a class="read-more" href="'.$post->link.'"> Read More</a></p>';
                               ?>

                          </div>
                          <?php endif ; ?>
                        <?php else : setup_postdata( $post ); ?>

                          <div class="search-result">
                              <a class="result-title" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>

                              <?php
                                // Insert term highlight function for post excerpt
                                // printr($post);
                                if ($post->post_type == 'areas_of_study') :
                                  $excerpt = strip_tags(get_field('intro', $post->ID));
                                  $excerpt = html_entity_decode($excerpt);
                                else :
                                  $excerpt = html_entity_decode(strip_tags(get_the_excerpt()));
                                endif ;

                                if( $highlighter ) {
                                  $excerpt = $highlighter->apply_highlight( $excerpt, $query );
                                }

                                $excerpt = limit_text($excerpt, 20);

                                echo '<p>';
                                echo $excerpt;
                                echo '<a class="read-more" href="'.$post->link.'"> Read More</a></p>';
                               ?>

                               <?php
                                  //output highlighted content from a Custom Field
                                  // $custom_field = strip_tags(get_post_meta( get_the_ID(), '_intro', true ));
                                  // $custom_field = html_entity_decode($custom_field);
                                  //
                                  // if( $highlighter ) {
                                  //     $custom_field = $highlighter->apply_highlight( $custom_field, $query );
                                  // }
                                  // $custom_field = preg_replace('/\s+/u', ' ', $custom_field);
                                  // echo '<p>' . $excerpt . ' ... <a href="' . $post->link . '">Read More</a></p>';
                               ?>


                          </div>
                        <?php endif ; ?>


                        <?php endforeach;
                    endif;
                    getPagination($wp_query, 0);
                ?>
          </div>
          <!--end pages-->

          <div class="tab-content" id="news">

                  <?php

                    $wp_query = $news_query; //to play nice with next/prev links;
                    // printr($swp_query->posts);
                    if ( ! empty( $news_query->posts ) )  :
                      foreach( $news_query->posts as $post ) : ?>
                        <?php if( !$post instanceof SearchWPTermResult ) : setup_postdata( $post ); ?>
                          <?php //printr($post); ?>
                          <div class="search-result">
                              <a class="result-title" href="<?php the_permalink(); ?>"><h3><?php echo $post->post_title; ?></h3></a>
                            <?php
                              $excerpt = get_the_excerpt();
                              $excerpt = limit_text($excerpt, 20);
                              echo '<p>';
                              echo $excerpt;
                              echo '<a class="read-more" href="'. get_the_permalink() .'"> Read More</a></p>';

                              ?>
                            </div>
                              <?php endif ; ?>
                            <?php endforeach ; ?>
                          <?php endif ; ?>

                <?php  getPagination($wp_query, 1); ?>
          </div>
          <!--end news-->

          <div class="tab-content" id="events">

                  <?php
                    $wp_query = $events_query; //to play nice with next/prev links;
                    if ( ! empty( $events_query->posts ) )  :
                      foreach( $events_query->posts as $post ) : ?>
                        <?php if( !$post instanceof SearchWPTermResult ) : setup_postdata( $post );?>
                          <div class="search-result">
                              <a class="result-title" href="<?php the_permalink(); ?>"><h3><?php echo $post->post_title; ?></h3></a>
                            <?php

                              $excerpt = get_the_excerpt();
                              $excerpt = limit_text($excerpt, 20);
                              echo '<p>';
                              echo $excerpt;
                              echo '<a class="read-more" href="'. get_the_permalink() .'"> Read More</a></p>';
                              ?>
                            </div>
                              <?php endif ; ?>
                            <?php endforeach ; ?>
                          <?php endif ; ?>

                  <?php  getPagination($wp_query, 2); ?>
          </div>
          <!--end events-->

          <div class="tab-content" id="faculty-staff">

                  <?php

                    $wp_query = $faculty_query; //to play nice with next/prev links;

                    if ( ! empty( $faculty_query->posts ) )  :
                      foreach( $faculty_query->posts as $post ) : ?>
                        <?php if( !$post instanceof SearchWPTermResult ) : setup_postdata( $post ); ?>
                          <div class="search-result">
                              <a class="result-title" href="<?php the_permalink(); ?>"><h3><?php echo $post->post_title; ?></h3></a>
                              <?php
                                 //output highlighted content from a Custom Field
                                 $custom_field = strip_tags(get_field('biography', $post->ID));
                                 $custom_field = html_entity_decode($custom_field);

                                 if( $highlighter ) {
                                     $custom_field = $highlighter->apply_highlight( $custom_field, $query );
                                 }
                                 $excerpt = limit_text($custom_field, 20);
                                 echo '<p>';
                                 echo $excerpt;
                                 echo '<a class="read-more" href="'. get_the_permalink() .'"> Read More</a></p>';
                              ?>

                            </div>
                              <?php endif ; ?>
                            <?php endforeach ; ?>
                          <?php endif ; ?>

                <?php  getPagination($wp_query, 3); ?>
          </div>
          <!--end faculty-staff-->

        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
