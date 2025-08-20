<?php
// Handles Waldjugend Plugin install/update via TGM (popup on theme activation)
// Constants are defined in metadata.php

// Disable nirvana TGMPA
function remove_nirvana_tgmpa() {
    remove_action( 'tgmpa_register', 'cryout_settings_plugin' );
}
add_action( 'after_setup_theme', 'remove_nirvana_tgmpa', 0 );

add_action( 'tgmpa_register', 'waldjugend_register_plugins' );

function waldjugend_get_latest_plugin_zip() {
    $transient_key = WJ_PLUGIN_ZIP_TRANSIENT_KEY;
    $cached_url = get_transient( $transient_key );
    if ( $cached_url !== false ) {
        return $cached_url;
    }

    $response = wp_remote_get( 'https://api.github.com/repos/' . WJ_GITHUB_USER . '/' . WJ_PLUGIN_GITHUB_REPO . '/releases/latest', array(
        'headers' => array(
            'User-Agent' => 'WordPress/' . get_bloginfo( 'version' )
        )
    ) );

    if ( is_wp_error( $response ) ) {
        return false;
    }

    $data = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( isset( $data['tag_name'] ) ) {
        $version = $data['tag_name'];
        $zip_url = WJ_PLUGIN_GITHUB_URL . "/archive/refs/tags/{$version}.zip";

        // cache for 1 hour
        set_transient( $transient_key, $zip_url, HOUR_IN_SECONDS );

        return $zip_url;
    }

    return false;
}

function waldjugend_register_plugins() {
    $plugin_zip = waldjugend_get_latest_plugin_zip();

    if ( ! $plugin_zip ) {
        return;
    }

    $plugins = array(
        array(
            'name'      => WJ_PLUGIN_NAME,
            'slug'      => WJ_PLUGIN_SLUG,
            'source'    => $plugin_zip,
            'required'  => true,
            'version'   => WJ_PLUGIN_VERSION, // Needs to be updated in metadata.php
            // 'force_activation' => true,
            // 'force_deactivation' => true,
            'external_url' => WJ_PLUGIN_GITHUB_URL,
        )
    );

    $config = array(
        'id'           => WJ_PLUGIN_SLUG . '-installer',
        'menu'         => WJ_PLUGIN_SLUG . 's',
        'dismissable'  => true,
        'has_notices'  => true,
        'is_automatic' => true,
        'strings'    => array(
            'page_title'                      => __( 'Recommended Plugins', WJ_PLUGIN_SLUG ),
            'menu_title'                      => sprintf( __('%s Plugins', WJ_PLUGIN_SLUG ), ucwords(WJ_THEME_NAME) ),
            'installing'                      => __( 'Installing Plugin: %s', WJ_PLUGIN_SLUG ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', WJ_PLUGIN_SLUG ),
            'notice_can_install_required'     => _n_noop( ucwords(WJ_THEME_NAME) . ' requires the following plugin: %1$s.', ucwords(WJ_THEME_NAME) . ' requires the following plugins: %1$s.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( ucwords(WJ_THEME_NAME) . ' recommends the following plugin: %1$s.', ucwords(WJ_THEME_NAME) . ' recommends the following plugins: %1$s.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', WJ_PLUGIN_SLUG ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', WJ_PLUGIN_SLUG ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', WJ_PLUGIN_SLUG ),
            'return'                          => __( 'Return to Required Plugins Installer', WJ_PLUGIN_SLUG ),
            'plugin_activated'                => __( 'Plugin activated successfully.', WJ_PLUGIN_SLUG ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', WJ_PLUGIN_SLUG ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}