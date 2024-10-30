<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Im_Custom_Css
 * @subpackage Im_Custom_Css/public
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Custom_Css_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if( isset(get_option( 'im_custom_css_options' )['settings_status']) && get_option( 'im_custom_css_options' )['settings_status'] ) {
			wp_enqueue_style( $this->plugin_name, $_SERVER['REQUEST_URI'] . '?im-custom-css=css', array(), $this->version, 'all' );
		}

	}
	
	/**
	 * Adding new variable to WordPress
	 *
	 * @since    1.0.0
	 */
	public function add_variable_to_wordpress( $public_query_vars ) {

	    $public_query_vars[] = 'im-custom-css';
	    return $public_query_vars;

	}
	
	/**
	 * Generates the CSS
	 *
	 * @since    1.0.0
	 */
	public function generate_css_display(){

	    $css = get_query_var('im-custom-css');

	    if ( $css == 'css' ){
	        include_once ( plugin_dir_path( __FILE__ ) . 'css/im-custom-css-public.php' );
	        exit;
	    }

	}

}
