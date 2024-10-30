<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://inmomentum.io/
 * @since             1.0.0
 * @package           Im_Custom_Css
 *
 * @wordpress-plugin
 * Plugin Name:       IM Custom CSS
 * Plugin URI:        http://inmomentum.io/wordpress/plugins/im-custom-css
 * Description:       Tremendously easy-to-use WordPress plugin for adding custom CSS to your website.
 * Version:           1.0.0
 * Author:            InMomentum
 * Author URI:        http://inmomentum.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       im-custom-css
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-im-custom-css-activator.php
 */
function activate_im_custom_css() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-im-custom-css-activator.php';
	Im_Custom_Css_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-im-custom-css-deactivator.php
 */
function deactivate_im_custom_css() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-im-custom-css-deactivator.php';
	Im_Custom_Css_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_im_custom_css' );
register_deactivation_hook( __FILE__, 'deactivate_im_custom_css' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-im-custom-css.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_im_custom_css() {
	$plugin = new Im_Custom_Css();
	$plugin->run();
}

run_im_custom_css();
