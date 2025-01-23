<?php
// Enqueue parent theme styles
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

// Custom login for theme
function waldjugend_custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/css/waldjugendlogin.css" />';
}
add_action('login_head', 'waldjugend_custom_login');

// Define THEME_TAGLINE from database
function define_waldjugend_tagline() {
    define('THEME_TAGLINE', get_option('blogdescription', 'default'));
}
add_action('after_setup_theme', 'define_waldjugend_tagline');
?>