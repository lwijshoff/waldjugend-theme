<?php
// Load Parent Theme Styles
function waldjugend_enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'waldjugend_enqueue_parent_styles');

// Custom Login Styling
function waldjugend_custom_login_styles() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/assets/css/waldjugendlogin.css" />';
}
add_action('login_head', 'waldjugend_custom_login_styles');

// Custom Login Logo URL
function waldjugend_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'waldjugend_login_logo_url');

// Plugin/Theme Update Checker
require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/lwijshoff/waldjugend-theme/',
	__FILE__,
	'waldjugend-theme'
);

// Set the branch that contains the stable release.
$UpdateChecker->setBranch('main');

// Enqueue Custom Styles with Dynamic Background Image
function waldjugend_enqueue_styles() {
    // Enqueue the main stylesheet
    wp_enqueue_style('waldjugend-style', get_stylesheet_directory_uri() . '/assets/css/styles.css');

    // Get the background image URL dynamically (child theme's assets)
    $background_url = get_stylesheet_directory_uri() . '/assets/background-scaled.jpg';

    // Inject the background image URL into the custom styles
    $custom_css = "
        body {
            background-image: url('$background_url');
            background-position: left top;
            background-size: auto;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin-left: 0;
            margin-right: 0;
        }
    ";

    wp_add_inline_style('waldjugend-style', $custom_css);
}

add_action('wp_enqueue_scripts', 'waldjugend_enqueue_styles');

// Remove the default WordPress search widget
add_action('widgets_init', function() {
    unregister_widget('WP_Widget_Search');
}, 11);
