<?php

/*
|--------------------------------------------------------------------
| Assmble Template - Assembles a page with head, nav, body & footer
|--------------------------------------------------------------------
*/

$cp_base        = "src"; //change to 'dist' for production
$theme_dir      = get_template_directory() . "/" . $cp_base ;
$theme_dir_uri  = get_template_directory_uri() . "/" . $cp_base ;

function assemble_template($pagename) {
  global $theme_dir;
  global $theme_dir_uri;
  global $cp_base ;
  global $post;

  if (!file_exists("$theme_dir/pages/$pagename.php")) {
    echo "template file not found, was looking for: ".$pagename;
    $pagename = "the404";
  }

  include "$cp_base/pages/partials/head.php";
  include "$cp_base/pages/partials/nav.php";
  include "$cp_base/pages/$pagename.php";
  include "$cp_base/pages/partials/foot.php";
}

/*
|--------------------------------------------------------------------
| Modify jQuery - Overwrites WP default jQuery to latest version.
|--------------------------------------------------------------------
*/

function modify_jquery_version() {
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.1.1.min.js', false, '3.1.1');
    wp_register_script('jquery', get_template_directory_uri() . '/src/js/vendor/jquery/jquery-3.1.1.min.js');
    wp_enqueue_script('jquery');
  }
}
add_action('wp_enqueue_scripts', 'modify_jquery_version');


/*
|--------------------------------------------------------------------
| Move JS to footer
|--------------------------------------------------------------------
*/
function remove_head_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}

// END Custom Scripting to Move JavaScript

function move_jquery() {
  wp_deregister_script( 'jquery' );
  wp_register_script('jquery', 'https://code.jquery.com/jquery-3.1.1.min.js', false, '3.1.1', true);
  wp_enqueue_script('jquery');
}

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}

function mic_scripts() {
    global $cp_base, $theme_dir_uri;

    if ($cp_base === "src") { // enqueue scripts from mount_ida/src directory

        // retina-js
        wp_enqueue_script( 'retina-js', $theme_dir_uri . '/js/vendor/retinajs/retina.min.js' );


        // isotopes-js
        wp_enqueue_script( 'isotope-js', $theme_dir_uri . '/js/vendor/isotope/isotope.pkgd.js' );
        wp_enqueue_script( 'isotope-fit-columns', $theme_dir_uri . '/js/vendor/isotope/fit-columns.js' );

        // responsify-js
        wp_enqueue_script( 'responsify-js', $theme_dir_uri . '/js/vendor/responsify/responsify.js' );

        // slick-js
        wp_enqueue_script( 'slick-js', $theme_dir_uri . '/js/vendor/slick/slick.js' );

        //Modernizr
        wp_enqueue_script( 'modernizr', $theme_dir_uri . '/js/vendor/modernizr/modernizr.js' );

        //flexibility
        wp_enqueue_script( 'flexibility', $theme_dir_uri . '/js/vendor/flexibility/flexibility.js' );

        //scroll-magic
        wp_enqueue_script( 'scroll-magic', $theme_dir_uri . '/js/vendor/scrollmagic/scrollmagic/minified/ScrollMagic.min.js' );
        wp_enqueue_script( 'scroll-animation', $theme_dir_uri . '/js/vendor/scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js' );
        wp_enqueue_script( 'scroll-tween', $theme_dir_uri . '/js/vendor/scrollmagic/scrollmagic/minified/plugins/TweenMax.min.js' );
        wp_enqueue_script( 'scroll-magic-debug', $theme_dir_uri . '/js/vendor/scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js' );
        wp_enqueue_script( 'gsap-css', $theme_dir_uri . '/js/vendor/gsap/uncompressed/CSSPlugin.js' );
        wp_enqueue_script( 'gsap-scrollto', $theme_dir_uri . '/js/vendor/gsap/uncompressed/ScrollToPlugin.js' );
        wp_enqueue_script( 'lethargy', $theme_dir_uri . '/js/vendor/lethargy/lethargy.min.js' );

        //tabs
        wp_enqueue_script( 'tabs', $theme_dir_uri . '/js/vendor/tabs/jquery.responsiveTabs.min.js' );

        // mainjs
        wp_enqueue_script( 'main-js', $theme_dir_uri . '/js/main.js' );
        wp_enqueue_script( 'hover-intent', $theme_dir_uri . '/js/vendor/hoverintent/jquery.hoverIntent.js' );

        // src/js/nav.js
        wp_enqueue_script( 'nav-js', $theme_dir_uri . '/js/nav.js' );

    } else { // enqueue scripts from mount_ida/dist directory


        // datatables-js
        wp_enqueue_script( 'datatables-js', '//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js' );
        wp_enqueue_script( 'datatables-responsive-js', '//cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.min.js' );

        // dist/js/main.min.js
        wp_enqueue_script( 'main-js-dist', $theme_dir_uri . '/js/main.min.js' );

        // dist/js/vendor/vendor.min.js
        wp_enqueue_script( 'vendor-js-dist', $theme_dir_uri . '/js/vendor/vendor.min.js' );
    }
}
add_action( 'wp_enqueue_scripts', 'mic_scripts' );

/*
|--------------------------------------------------------------------
| Theme Styles
|--------------------------------------------------------------------
*/

function mic_styles() {
    global $cp_base, $theme_dir_uri;

    // Google Fonts
    wp_enqueue_style( 'font-montserrat', '//fonts.googleapis.com/css?family=Montserrat:300,400,700"', false );

    // Datatables CSS
    wp_enqueue_style( 'datatables-css', '//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css', false );
    wp_enqueue_style( 'datatables-responsive-css', '//cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css', false );

    if ($cp_base === "src") {  // enqueue stylesheets from mount_ida/src directory
        wp_enqueue_style( 'main-css', $theme_dir_uri . '/stylesheets/main.css' );
    } else { // enqueue stylesheets from mount_ida/dist directory
        wp_enqueue_style( 'main-css-dist', $theme_dir_uri . '/stylesheets/main.min.css' );
    }
}
add_action('wp_enqueue_scripts', 'mic_styles');

/*
|--------------------------------------------------------------------
| Register Theme Menus
|--------------------------------------------------------------------
*/

function register_mic_menus() {
    register_nav_menu('header-menu',__( 'Header Menu' ));

    register_nav_menu('top-bar-menu',__( 'Top Bar Menu' ));

    register_nav_menu('footer-menu-left',__( 'Footer Menu Left' ));
    register_nav_menu('footer-menu-center',__( 'Footer Menu Center' ));
    register_nav_menu('footer-menu-right',__( 'Footer Menu Right' ));

    register_nav_menu('bottom-bar-menu',__( 'Bottom Bar Menu' ));

    register_nav_menu('modal-menu',__( 'Modal Menu' ));
}
add_action( 'init', 'register_mic_menus' );

/*
|--------------------------------------------------------------------
| Theme Support
|--------------------------------------------------------------------
*/

// Theme Support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

// Add options page for AFC
if( function_exists('acf_add_options_page') ) {

  $option_page = acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title' 	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability' 	=> 'manage_options',
		'redirect' 	=> true
	));

  acf_add_options_sub_page(array(
    'page_title' 	=> 'Global Options',
    'menu_title'	=> 'Global Options',
    'parent_slug'	=> 'theme-options',
    'position' => 1,
    'menu_slug' 	=> 'acf-options'
  ));

}

// Add Read Only fields for ACF
add_action('acf/render_field_settings', 'add_readonly_to_acf_fields');
function add_readonly_to_acf_fields($field) {
  acf_render_field_setting( $field, array(
    'label'         => __('Read Only?','acf'),
    'type'          => 'radio',
    'name'          => 'readonly',
    'choices'       => array(
      0             => __("No",'acf'),
      1             => __("Yes",'acf'),
    ),
    'layout'        =>  'horizontal',
  ), true);
}

// Limit excerpt lengths
function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

// Modify excerpt helper text
add_filter( 'gettext', 'mic_excerpt_text', 10, 2 );

function mic_excerpt_text( $translation, $original )
{
    if ('Excerpt' == $original) {
        return 'Post Excerpt';
    } else {
        $pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your content that can be used in your theme.');
        if ($pos !== false) {
            return  'If this except is not filled in, WP will take the first 25 words from the news post directly. If filled in, only the first 25 words of this excerpt will appear on the homepage.';
        }
    }
    return $translation;
}

/*
|--------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------
*/

// List post categories without links
function list_post_categories() {
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    if ($categories) {
        foreach($categories as $category) {
            $output .= $category->cat_name.$separator;
        }
        echo trim($output, $separator);
    }
}

// Better debugging
function printr($var) {
    echo '<pre>'; print_r($var); echo '</pre>';
}

// Helper functions
get_template_part("src/pages/helpers/helperFunctions");

//thumbnail size for use on taxonomy pages - SW
add_image_size('category-thumbnails', 220, 220);
add_image_size('gallery-thumbnails', 180, 105);
add_image_size('student-gallery', 740, 490);
add_image_size('faculty-highlight', 492, 510);
add_image_size('image-grid', 250, 250);

add_filter('image_size_names_choose', 'custom_image_size');
function custom_image_size($sizes) {
  return array_merge($sizes,array(
    'category-thumbnails' => 'Category Thumbnails',
    'image-grid'       => 'Image Grid'
  ));
}

// Removing excerpt and custom field from event
add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type() {
    remove_post_type_support( 'event', 'excerpt' );
    remove_post_type_support( 'event', 'custom-fields' );
}


// Update key dates filter Options
function importantDatesFilter($input_object, $sfid)
{

	if($input_object['type']=='radio' && $input_object['name'] == '_sft_event-categories')
	{

    //now we know there are options we can loop through each one, and change what we need
    foreach($input_object['options'] as $option)
    {
      //unset($option->value);
      // unset($option->label);
      //$option = null;
      //update option name, style, title, or value
      // if($option->value=="athletic")
      // {//we want to change the label for the option "black" - we can feed back in the count number to the label for this field type
      //   $option->label = "Jet Black (".$option->count.")";
      //
      //   //yes you can even change the attributes on each option if necessary!
      //   $option->attributes['style'] = "color:#fff;background-color:#000";
      //   $option->attributes['title'] = "This is Jet Black";
      // }
    }

    $page_id = get_the_ID();
    $filter_categories = get_field('filter_categories', $page_id);
    //create a new option we want to add
    //options must have a value and label (this will need to be a loop)

    if($filter_categories):

      // Clear all options for the category dropdown and re-initiate the options array
      unset($input_object['options']);
      $input_object['options'] = array();
      $input_object['attributes']['class'] = 'dates-nav';

      $all_option = new StdClass();
      $all_option->value = '';
      $all_option->label = 'All';
      array_push($input_object['options'], $all_option);

      foreach ($filter_categories as $category) :

        if($category->count != 0) :
          $new_last_option = new StdClass();
          $new_last_option->value = $category->slug;
          $new_last_option->label = $category->name;
          array_push($input_object['options'], $new_last_option);
        endif ;

      endforeach;

    endif ;



  //if we want to filter the options generated, we need to make sure the options variable actually
  //exists before proceeding (its only available to certain field types)
  if(!isset($input_object['options']))
  {
    //return $input_object;
  }else{
    //var_dump($input_object);

    //unset($input_object['options']);



  }

}
  //echo "<br><br>";
  //var_dump($input_object);

	return $input_object;
}

add_filter('sf_input_object_pre', 'importantDatesFilter', 10, 2);


/*
|--------------------------------------------------------------------
| Leftover from Gortons?
| NOTE: Steve / Jeff - Do we need any of this?
|--------------------------------------------------------------------
*/

// Callback function to insert 'styleselect' into the $buttons array
// function my_mce_buttons_2( $buttons ) {
// 	array_unshift( $buttons, 'styleselect' );
// 	return $buttons;
// }
// Register our callback to the appropriate filter
// add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// function my_mce_before_init_insert_formats( $init_array ) {
// 	// Define the style_formats array
// 	$style_formats = array(
// 		// Each array child is a format with it's own settings
// 		array(
// 			'title' => 'small',
// 			'block' => 'small',
// 			'wrapper' => true,

// 		),
//     array(
// 			'title' => 'big',
// 			'block' => 'big',
// 			'wrapper' => true,

// 		),
// 	);
// 	// Insert the array, JSON ENCODED, into 'style_formats'
// 	$init_array['style_formats'] = json_encode( $style_formats );

// 	return $init_array;

// }
// // Attach callback to 'tiny_mce_before_init'
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );








// add_action( 'init', 'add_taxonomies_to_post' );
// function add_taxonomies_to_post() {
// 	register_taxonomy_for_object_type( 'event-categories', 'post' );
// }
//
// function unregister_default_category_tax() {
//     unregister_taxonomy_for_object_type( 'category', 'post' );
// }
// add_action( 'init', 'unregister_default_category_tax' );






// Function to get school name from post
function getSchoolName ($post_id) {
  $terms		= wp_get_post_terms($post_id, 'schools');

  foreach ($terms as $term) {
    if ($term->parent == 0) //check for parent terms only
        $school = $term->name;
 }

  return $school;

}



// Change deafult "post" to news
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );



// News & events page filter options
// Update key dates filter Options
function newsEventsFilters($input_object, $sfid)
{

  if(($sfid==3895 || $sfid==480) && $input_object['name'] == '_sf_submit')
	{
      $input_object['attributes']['style'] = 'position: absolute;';

  }

	if(($sfid==3895 || $sfid==480) && $input_object['name'] != '_sf_post_type')
	{

    global $searchandfilter;
	  $sf_current_query = $searchandfilter->get(3895)->current_query();
    $post_name = $sf_current_query->get_fields_html(array("_sf_post_type"));

    // printr($input_object);
    // printr($post_name);
    // Clear all options for the category dropdown and re-initiate the options array
    unset($input_object['options']);
    $input_object['options'] = array();

    if (isset($sf_current_query->get_array()['post_types']['active_terms'][0]['value'])) {
      $post_type = $sf_current_query->get_array()['post_types']['active_terms'][0]['value'];



      //printr($post_type);

      // printr($sf_current_query->get_array()['post_types']['active_terms'][0]['value']);



      if ($post_type == 'event') :

        if ($input_object['name'] == '_sft_category') :
          $input_object['attributes']['style'] = 'display: none;';
          unset($input_object['options']);
          $input_object['options'] = array();
        endif ;
        $terms = get_terms( array(
            'taxonomy' => 'event-categories',
            'hide_empty' => true,
        ) );
        $input_object['name'] = '_sft_event-categories';
        $input_object['attributes']['name'] = '_sft_event-categories[]';



      elseif ($post_type == 'post') :

        if ($input_object['name'] == '_sft_event-categories') :
          $input_object['attributes']['style'] = 'display: none;';
          unset($input_object['options']);
          $input_object['options'] = array();
        endif ;

        $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ) );
        $input_object['name'] = '_sft_category';
        $input_object['attributes']['name'] = '_sft_category[]';



      else :


        return $input_object;

      endif;

      $new_option = new StdClass();
      $new_option->value = '';
      $new_option->label = 'All';

      array_push($input_object['options'], $new_option);

      foreach ( $terms as $term ) :
        $new_option = new StdClass();
        $new_option->value = $term->slug;
        $new_option->label = $term->name;
        // $input_object['options'] = array($new_option);
        array_push($input_object['options'], $new_option);
      endforeach;


  	} else { // Filter by post is 'all post types'

      // add a default 'all categories' option to the category dropdown and disable it
      $new_option = new StdClass();
      $new_option->value = '';
      $new_option->label = 'All';
      array_push($input_object['options'], $new_option);

      if ($input_object['name'] == '_sft_event-categories') :
        $input_object['attributes']['style'] = 'display: none;';
      endif ;

      if ($input_object['name'] == '_sft_category') :
        $input_object['attributes']['style'] = 'pointer-events: none;-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;';
      endif ;    }



  }

  //printr($input_object);
  return $input_object;
}
add_filter('sf_input_object_pre', 'newsEventsFilters', 10, 2);


function new_excerpt_more($more) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');



// Adding Tuition Fee Custom Type Under Areas of Study in WP admin
add_submenu_page( 'edit.php?post_type=areas_of_study', 'Tuition Fees', 'Tuition Fees',
'manage_options', 'edit.php?post_type=tuition_fee', NULL );


function areas_of_study_submenu_order( $menu_ord )
{
    global $submenu;

    $arr = array();
    $arr[] = $submenu['edit.php?post_type=tuition_fee'][5];
    $arr[] = $submenu['edit.php?post_type=tuition_fee'][10];
    $arr[] = $submenu['edit.php?post_type=tuition_fee'][15];
    $arr[] = $submenu['edit.php?post_type=tuition_fee'][16];
    $arr[] = $submenu['edit.php?post_type=tuition_fee'][0];
    $submenu['edit.php?post_type=tuition_fee'] = $arr;

    return $menu_ord;
}

add_filter( 'custom_menu_order', 'areas_of_study_submenu_order' );


// Removing Comments from WP Admin
function custom_menu_page_removing() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );



/*
*
* searchWP plugin setup
*
*/

function searchwp_term_highlight_auto_excerpt( $excerpt ) {
	global $post;
	if ( ! is_search() ) {
		return $excerpt;
	}
	// prevent recursion
	remove_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );
	$global_excerpt = searchwp_term_highlight_get_the_excerpt_global( $post->ID, null, get_search_query() );
	add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );

  if ($global_excerpt)
  	return '"...' . $global_excerpt . '..."';
}
// add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );


function my_searchwp_th_num_words() {
    // use 75 words instead of the default 55
    return 5;
}
add_filter( 'searchwp_th_num_words', 'my_searchwp_th_num_words' );

add_filter( 'searchwp_tax_term_or_logic', '__return_true' );

// add_filter( 'searchwp_debug', '__return_true' );

function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/*
|--------------------------------------------------------------------
| Theme Scripts
|--------------------------------------------------------------------
*/

// if ($cp_base === "dist" ) {
//   add_action( 'wp_footer', 'my_deregister_scripts' );
//   // add_action( 'wp_enqueue_scripts', 'move_jquery');
//   remove_action('wp_head', 'print_emoji_detection_script', 7);
//   remove_action('wp_print_styles', 'print_emoji_styles');
//   add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );
// }
