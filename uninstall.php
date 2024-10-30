<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Custom_Css
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

unregister_setting( 'im_custom_css_settings', 'im_custom_css_options' );
delete_option( 'im_custom_css_options' );
delete_site_option( 'im_custom_css_options' );

