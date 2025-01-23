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

// Change login logo URL to homepage URL
function waldjugend_custom_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'waldjugend_custom_login_logo_url');

// Fetch and set tagline dynamically, but only for config.php
function waldjugend_set_config() {
    // Only define the constant in config.php
    if (basename(__FILE__) === 'config.php') {
        // Get the tagline (blogdescription) from the database
        $tagline = get_option('blogdescription', 'default');
        
        // Define the tagline as a constant, so it's globally available in config.php
        define('THEME_TAGLINE', $tagline);
    }
}
add_action('after_setup_theme', 'waldjugend_set_config');
?>