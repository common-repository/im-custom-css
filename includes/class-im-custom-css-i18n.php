<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/includes
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Custom_Css_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'im-custom-css',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
