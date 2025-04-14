<?php
// Load Parent Theme Styles
function waldjugend_enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'waldjugend_enqueue_parent_styles');

// Load Block Patterns
function waldjugend_register_block_patterns() {
    $pattern_dir = get_template_directory() . '/patterns';

    foreach (glob($pattern_dir . '/*.php') as $file) {
        register_block_pattern_from_file($file);
    }
}
add_action('init', 'waldjugend_register_block_patterns');

register_block_pattern_category(
    'waldjugend-buttons',
    ['label' => __('Waldjugend Buttons', 'waldjugend-theme')]
);

// Custom Login Styling
function waldjugend_custom_login_styles() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/css/waldjugendlogin.css" />';
}
add_action('login_head', 'waldjugend_custom_login_styles');

function waldjugend_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'waldjugend_login_logo_url');

// Define Theme Constants
function waldjugend_define_constants() {
    if (!defined('THEME_TAGLINE')) {
        define('THEME_TAGLINE', get_option('blogdescription', 'default'));
    }
}
add_action('after_setup_theme', 'waldjugend_define_constants');

// Plugin/Theme Update Checker
require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/lwijshoff/waldjugend-theme/',
	__FILE__,
	'waldjugend-theme'
);

//Set the branch that contains the stable release.
$UpdateChecker->setBranch('main');
?>