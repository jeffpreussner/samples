
<?php
    $title      = get_the_title();
    $content    = apply_filters('the_content', $post->post_content);

    function alphaListing() {
        $letters = range('a', 'z');
        echo '<ul class="alpha-listing filters" id="alpha-one">';
        for ($i = 0; $i < count($letters); $i++) {
            echo "<li><a href='' class='button' data-filter='.".$letters[$i]."'>".strtoupper($letters[$i])."</a></li>";
        }
         echo '<li><a href="" class="selected button default" data-filter="*">see all</a></li></ul>';

    }

    function alphaListing2() {
        $letters = range('a', 'z');
        echo '<ul class="alpha-listing2 filters2">';
        for ($i = 0; $i < count($letters); $i++) {
            echo "<li><a href='' class='button' data-filter='.".$letters[$i]."'>".strtoupper($letters[$i])."</a></li>";
        }
         echo '<li><a href="" class="button default selected" data-filter="*">see all</a></li></ul>';

    }

    function outputFaculty() {
        global $post;
        $args = array(
            'post_type'         => 'faculty_and_staff',
            'posts_per_page'    => -1,
            'orderby'           => 'title',
            'order'             => 'DESC'
        );

        $faculty_posts = get_posts( $args );
        $refactored_name_array = array("key" => "value");
        foreach( $faculty_posts as $post ) :
            setup_postdata($post);
            $faculty_title    = get_the_title();
            $faculty_URL      = get_the_permalink();

            $faculty_name = formatName($faculty_title);
            $refactored_name_array[$faculty_name] = $faculty_URL;
        endforeach;
        wp_reset_postdata();

        ksort($refactored_name_array);
        foreach($refactored_name_array as $key => $value) :  
            $first_letter = strtolower(substr($key,0,1));
            if($key != "key") :
                echo '<li class=" faculty '.$first_letter.'">
                    <a href="'.$value.'">'.$key.'</a>
                </li>';
            endif;
        endforeach;
    }

    function formatName($title){
        $formatted_name = $title;
        if(str_word_count($title) == 2){
            $arr = explode(' ',trim($title));
            $formatted_name = $arr[1] . ', ' . $arr[0];
        }
        return $formatted_name;
    }

    function outputDepartments(){
        $terms = get_terms( 'department' );
        foreach ( $terms as $term ) {
            $term_link = get_term_link($term);
            $first_letter = strtolower(substr($term->name,0,1));
            echo '<li class="department '.$first_letter.'">
                    <a href="'.esc_url( $term_link ).'">'.$term->name.'</a>
                </li>';
        }
    }

?>
<section id="faculty-listing">
    <div class="header">
        <h3><?php the_title(); ?></h3>
        <?php echo $content; ?>
    </div>
    <div class="top-navigation-band">
        <ul class="tabBlock-tabs">
            <li class="tabBlock-tab is-active">index a - z</li>
            <li class="tabBlock-tab">offices &amp; departments</li>
        </ul>
    </div>

   <!--  <div class="nav-wrap">
         <ul class="group" id="example-one">
            <li class="current_page_item"><a href="#">Home</a></li>
            <li><a href="#">Buy Tickets</a></li>
            <li><a href="#">Group Sales</a></li>
            <li><a href="#">Reviews</a></li>
            <li><a href="#">The Show</a></li>
            <li><a href="#">Videos</a></li>
            <li><a href="#">Photos</a></li>
            <li><a href="#">Magic Shop</a></li>
         </ul>
    </div> -->


    <div class="tabBlock-content">
        <div class="tabBlock-pane">
            <h3>index a - z</h3>
            <?php alphaListing(); ?>
            <div class="mobile-tab-nav">
                <select id="faculty-selector">
                    <?php $letters = range('a', 'z'); ?>
                    <option class="default" value="*">see all</option>
                    <?php for ($i = 0; $i < count($letters); $i++) : ?>
                        <option value="<?php echo $letters[$i]; ?>"><?php echo $letters[$i]; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <ul class="faculty-listing">
                <?php outputFaculty(); ?>
            </ul>
        </div>
        <div class="tabBlock-pane">
            <h3>offices &amp; departments</h3>
            <?php alphaListing2(); ?>
            <div class="mobile-tab-nav">
                <select id="department-selector">
                    <?php $letters = range('a', 'z'); ?>
                    <option class="default" value="*">see all</option>
                    <?php for ($i = 0; $i < count($letters); $i++) : ?>
                        <option value="<?php echo $letters[$i]; ?>"><?php echo $letters[$i]; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <ul class="department-listing">
                <?php echo outputDepartments(); ?>
            </ul>
        </div>
    </div>
</section>