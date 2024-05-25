<?php
function zp_dcpi_setup() {
    // Theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register menus
    register_nav_menus(array(
        'menu-1' => esc_html__('Primary', 'zp-dcpi'),
    ));
}
add_action('after_setup_theme', 'zp_dcpi_setup');

function zp_dcpi_scripts() {
    // Enqueue styles
    wp_enqueue_style('zp-dcpi-style', get_stylesheet_uri());
    wp_enqueue_style('zp-dcpi-fonts', get_template_directory_uri() . '/assets/fonts/Poppins-Regular.ttf');
    wp_enqueue_style('zp-dcpi-fonts-2', get_template_directory_uri() . '/assets/fonts/OpenSans-VariableFont_wdth,wght.ttf');
    
    // Enqueue scripts
    wp_enqueue_script('zp-dcpi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'zp_dcpi_scripts');
?>
