<?php
/**
 * Theme Customizer
 *
 * @package mount_ida
 */

function theme_customize_register( $wp_customize ) {

    /*
    |-----------------------------------------------------------
    | Add Options Panels (WP Admin -> Appearance -> Customize)
    |-----------------------------------------------------------
    */

    // Header
    $wp_customize->add_panel('theme_header_options', array(
      'title' => __('Header Options', 'theme'),
      'description' => __('Change the Header Settings', 'theme'),
      'capabitity' => 'edit_theme_options',
      'priority' => 1
    ));

    // 404
    $wp_customize->add_panel('theme_404_options', array(
        'title' => __('404 Options', 'theme'),
        'description' => __('Change the 404 Content', 'theme'),
        'capabitity' => 'edit_theme_options',
        'priority' => 2
    ));

    /*
    |-----------------------------------------------------
    | Header Options
    |-----------------------------------------------------
    */

    $wp_customize->add_section('theme_header_logo', array(
      'priority' => 1,
      'title' => __('Header Logo', 'theme'),
      'panel' => 'theme_header_options'
    ));

    $wp_customize->add_setting('theme_logo', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'theme_logo', array(
      'label' => __('Upload logo for your header', 'theme'),
      'section' => 'theme_header_logo',
      'setting' => 'theme_logo'
    )));

    /*
    |-----------------------------------------------------
    | 404 Options
    |-----------------------------------------------------
    */

    $wp_customize->add_section('theme_404', array(
        'priority' => 1,
        'title' => __('404 Content', 'theme'),
        'panel' => 'theme_404_options'
    ));

    $wp_customize->add_setting('theme_404_content', array(
        'default' => '',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'theme_404_content', array(
        'label' => __('404 Content', 'theme'),
        'section' => 'theme_404',
        'setting' => 'theme_404_content',
        'type' => 'textarea'
    )));

}
add_action( 'customize_register', 'theme_customize_register' );
