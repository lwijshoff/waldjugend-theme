<?php
/*--------------------------------------------------------------
# Includes
--------------------------------------------------------------*/
require_once get_stylesheet_directory() . '/includes/class-tgm-plugin-activation.php';
require_once get_stylesheet_directory() . '/includes/tgm.php';
require_once get_stylesheet_directory() . '/includes/metadata.php';


/*--------------------------------------------------------------
# Parent Theme Styles
--------------------------------------------------------------*/
function waldjugend_enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'waldjugend_enqueue_parent_styles');


/*--------------------------------------------------------------
# Custom Login Page
--------------------------------------------------------------*/
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


/*--------------------------------------------------------------
# Plugin/Theme Update Checker
--------------------------------------------------------------*/
require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/lwijshoff/waldjugend-theme/',
	__FILE__,
	'waldjugend-theme'
);

// Set the branch that contains the stable release.
$UpdateChecker->setBranch('main');


/*--------------------------------------------------------------
# Custom Styles (Dynamic Background)
--------------------------------------------------------------*/
function waldjugend_enqueue_styles() {
    // Enqueue the main stylesheet
    wp_enqueue_style('waldjugend-style', get_stylesheet_directory_uri() . '/assets/css/styles.css');

    // Get the background image URL dynamically (child theme's assets)
    $background_url = get_stylesheet_directory_uri() . '/assets/design/background/background.jpg';

    // Inject the background image URL into the custom styles
    $custom_css = "
        body {
            background-image: url('$background_url');
            background-position: left top;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin-left: 0;
            margin-right: 0;
        }
    ";

    wp_add_inline_style('waldjugend-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'waldjugend_enqueue_styles');


/*--------------------------------------------------------------
# Widgets
--------------------------------------------------------------*/
// Remove Default Search Widget from Right Sidebar
function waldjugend_remove_default_search_widget() {
    $sidebars_widgets = get_option('sidebars_widgets');

    if (isset($sidebars_widgets['right-widget-area'])) {
        $sidebars_widgets['right-widget-area'] = array_filter(
            $sidebars_widgets['right-widget-area'],
            fn($widget_id) => $widget_id !== 'block-2'
        );
        update_option('sidebars_widgets', $sidebars_widgets);
    }
}
add_action('after_switch_theme', 'waldjugend_remove_default_search_widget');


/*--------------------------------------------------------------
# Shortcodes
--------------------------------------------------------------*/
function waldjugend_theme_icon_shortcode($atts) {
    $atts = shortcode_atts([
        'src' => '',
        'alt' => '',
        'class' => '',
        'style' => '',
    ], $atts);

    $url = get_stylesheet_directory_uri() . '/' . ltrim($atts['src'], '/');

    return '<img src="' . esc_url($url) . '" alt="' . esc_attr($atts['alt']) . '" class="' . esc_attr($atts['class']) . '" style="' . esc_attr($atts['style']) . '">';
}
add_shortcode('theme_icon', 'waldjugend_theme_icon_shortcode');