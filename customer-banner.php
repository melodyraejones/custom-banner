<?php
/*
Plugin Name: Custom Banner
Description: Adds a customizable banner to the top of the site.
Version: 1.0
Author: Akshay Sharma
*/
function custom_banner_customize_register($wp_customize) {
    // Add a section for the banner
    $wp_customize->add_section('custom_banner_section', array(
        'title' => __('Custom Banner', 'custom-banner'),
        'priority' => 30,
    ));

    // Add setting for the banner text
    $wp_customize->add_setting('custom_banner_text', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for the banner text
    $wp_customize->add_control('custom_banner_text', array(
        'label' => __('Banner Text', 'custom-banner'),
        'section' => 'custom_banner_section',
        'settings' => 'custom_banner_text',
        'type' => 'text',
    ));

    // Add setting for the banner background color
    $wp_customize->add_setting('custom_banner_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add control for the banner background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_banner_bg_color', array(
        'label' => __('Banner Background Color', 'custom-banner'),
        'section' => 'custom_banner_section',
        'settings' => 'custom_banner_bg_color',
    )));

    // Add setting for banner text color
    $wp_customize->add_setting('custom_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add control for the banner text color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'custom_text_color', array(
        'label' => __('Text Color', 'custom-banner'),
        'section' => 'custom_banner_section',
        'settings' => 'custom_text_color',
    )));
}

add_action('customize_register', 'custom_banner_customize_register');


//to output the banner
function custom_banner_display() {
    $banner_text = get_theme_mod('custom_banner_text', '');
    $banner_bg_color = get_theme_mod('custom_banner_bg_color', '#000000');
    $custom_text_color = get_theme_mod('custom_text_color', '#ffffff'); 
    if ($banner_text) {
        echo '<div class="custom-banner-container" style="background-color:' . esc_attr($banner_bg_color) . '; color:' . esc_attr($custom_text_color) . ';">';
        echo '<div class="custom-banner">';
        echo esc_html($banner_text);
        echo '</div>';
        echo '</div>';
    }
}

add_action('wp_head', 'custom_banner_display');

//styles
function custom_banner_styles() {
    wp_enqueue_style('custom-banner-styles', plugins_url('/custom-banner.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'custom_banner_styles');
