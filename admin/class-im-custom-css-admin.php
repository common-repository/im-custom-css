<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/admin
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Custom_Css_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * All options available in the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    All options available.
	 */
	private $plugin_options;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//assign options and their default values
		$this->plugin_options = array(
			'css_code' 	  	  => '/* Your code goes here */',
			'settings_status' => 1,
		);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-codemirror', plugin_dir_url( __FILE__ ) . 'lib/codemirror/lib/codemirror.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-codemirror-theme', plugin_dir_url( __FILE__ ) . 'lib/codemirror/theme/dracula.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/im-custom-css-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . '-codemirror', plugin_dir_url( __FILE__ ) . 'lib/codemirror/lib/codemirror.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-codemirror-mode', plugin_dir_url( __FILE__ ) . 'lib/codemirror/mode/css.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/im-custom-css-admin.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Create admin menu.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_menu() {

		add_submenu_page( 'options-general.php', 'IM Custom CSS', 'IM Custom CSS', 'manage_options', 'im-custom-css', array( $this, 'render_admin_page' ), 100 );

	}

	/**
	 * Render admin page.
	 *
	 * @since    1.0.0
	 */
	public function render_admin_page() {

		include_once 'partials/im-custom-css-admin-settings.php';

	}

	/**
	 * Register settings.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		register_setting( 'im_custom_css_settings', 'im_custom_css_options', array( $this, 'sanitize_options' ) );
		
		$this->convert_legacy_settings();
		$this->set_default_settings();

	}

	/**
	 * Convert legacy settings into the new settings structure.
	 *
	 * @since    1.0.0
	 */
	private function convert_legacy_settings() {
		return;
	}

	/**
	 * Set default values to all settings.
	 *
	 * @since    1.0.0
	 */
	private function set_default_settings() {

		if( is_array( get_option( 'im_custom_css_options' ) ) ) {

			$current_options = get_option( 'im_custom_css_options' );
			$plugins_options = $this->plugin_options;

			foreach ($this->plugin_options as $option => $value) {
				
				if(!isset($current_options[$option])) {

					$current_options[$option] = $value;

				}

			}

			update_option( 'im_custom_css_options', $current_options);

		} else {

			add_option( 'im_custom_css_options', $this->plugin_options);

		}

	}

	/**
	 * Method for sanitizing options.
	 *
	 * @since    1.0.0
	 */
	public function sanitize_options( $options ) {

		foreach ($options as $option => $value) {

			switch ($option) {

				case 'css_code':
					$options['css_code'] = $this->sanitize_css_code( $value );
					break;

				case 'settings_status':
					$options['settings_status'] = $this->sanitize_boolean( $value );
					break;

			}

		}

		return $options;

	}

	/**
	 * Sanitize method for css code.
	 *
	 * @since    1.0.0
	 */
	private function sanitize_css_code( $input ) {

	    $css = $input;

	    require_once( plugin_dir_path( __FILE__ ) . 'lib/csstidy/class.csstidy.php' );

	    $csstidy = new csstidy();

	    $warning = false;

	    $csstidy->set_cfg( 'remove_bslash', false );
	    $csstidy->set_cfg( 'compress_colors', false );
	    $csstidy->set_cfg( 'compress_font-weight', false );
	    $csstidy->set_cfg( 'optimise_shorthands', 0 );
	    $csstidy->set_cfg( 'remove_last_;', false );
	    $csstidy->set_cfg( 'case_properties', false );
	    $csstidy->set_cfg( 'discard_invalid_properties', true );
	    $csstidy->set_cfg( 'css_level', 'CSS3.0' );
	    $csstidy->set_cfg( 'preserve_css', true );
	    $csstidy->set_cfg( 'template', dirname( __FILE__ ) . '/lib/csstidy/wordpress-standard.tpl' );

	    $css = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $prev = $css );

	    if ( $css != $prev ) {
	        $warning = true;
	    }

	    $css = str_replace( '<=', '&lt;=', $css );
	    $css = wp_kses_split( $prev = $css, array(), array() );
	    $css = str_replace( '&gt;', '>', $css );
	    $css = strip_tags( $css );

	    if ( $css != $prev ) {
	        $warning = true;
	    }

	    $csstidy->parse( $css );
	    $this->value = $csstidy->print->plain();

	    if ( isset( $warning ) && $warning == true ) {
	        add_settings_error( 'css_code', 'css_code', __( "Unsafe code were found in your CSS and have been filtered out.", 'im-custom-css' ), 'error' );
	    	return $css;
	    } else {
	    	return $css;
	    }
	    
	}

	/**
	 * Sanitize method for integer based boolean.
	 *
	 * @since    1.0.0
	 */
	private function sanitize_boolean( $input ) {

		$input = intval($input);

		if( ($input == 0 || $input == 1) && is_int($input)) {

			return $input;

		} else {

			add_settings_error( 'settings_status', 'settings_status', __( "There seem to have been some problems saving your settings. Please try again.", 'im-custom-css' ), 'error' );
			return;

		}

	}

}
