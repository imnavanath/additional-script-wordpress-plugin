<?php
/**
* Plugin Name: Additional Script 
* Plugin URI: #
* Version: 1.0.0
* Author: Navanath Bhosale
* Author URI: #
* Description: The plugin gives you flexibility for <strong> Additing Script in Header / Footer. </strong>
* License: GPL2
*/

define('ADD_SCRIPT_DIR',str_replace('\\','/',dirname(__FILE__)));

/**
* Initialize header and footer class
*/
class AddScript {

	/*
	* Constructor
	*/
	public function __construct() {

		$this->plugin = new stdClass;
		$this->plugin->name = 'additional-scripts';
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'wp_head', array( &$this, 'wp_head' ) );
		add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
	}

	/**
	* Register Settings
	*/
	function admin_init() {

		register_setting( 'additional-scripts', 'insert_in_header', 'trim' );
		register_setting( 'additional-scripts', 'insert_in_footer', 'trim' );
	}

	function admin_menu() {

		add_submenu_page( 'options-general.php', 'Additional Scripts', 'Additional Scripts', 'manage_options', 'additional-scripts', array( &$this, 'script_page' ) );

		// Get latest settings
        $this->settings = array(
			'insert_in_header' => esc_html( wp_unslash( get_option( 'insert_in_header' ) ) ),
			'insert_in_footer' => esc_html( wp_unslash( get_option( 'insert_in_footer' ) ) ),
        );
	}

	function script_page() {

		// only admin user can access this page
		if ( !current_user_can( 'administrator' ) ) {
			echo '<p>' . __( 'Sorry, you are not allowed to access this page.', $this->plugin->name ) . '</p>';
			return;
		}

    	// Save Settings
        if ( isset( $_REQUEST['submit'] ) ) {
        	// Check nonce
			if ( !isset( $_REQUEST[$this->plugin->name.'_nonce'] ) ) {
	        	// Missing nonce
	        	$this->errorMessage = __( 'nonce field is missing. Settings NOT saved.', $this->plugin->name );
        	} elseif ( !wp_verify_nonce( $_REQUEST[$this->plugin->name.'_nonce'], $this->plugin->name ) ) {
	        	// Invalid nonce
	        	$this->errorMessage = __( 'Invalid nonce specified. Settings NOT saved.', $this->plugin->name );
        	} else {
	        	// Save
				// $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
				// so do nothing before saving
	    		update_option( 'insert_in_header', $_REQUEST['insert_in_header'] );
	    		update_option( 'insert_in_footer', $_REQUEST['insert_in_footer'] );
				$this->message = __( 'Settings Saved.', $this->plugin->name );
			}
        }

		// Load options page
		require_once(ADD_SCRIPT_DIR . '/inc/options.php');
	}

	/**
	* Outputs script / CSS to the frontend header
	*/
	function wp_head() {
		$this->output( 'insert_in_header' );
	}

	/**
	* Outputs script / CSS to the frontend footer
	*/
	function wp_footer() {
		$this->output( 'insert_in_footer' );
	}

	/**
	* Outputs the given setting, if conditions are met
	*
	* @param string $setting Setting Name
	* @return output
	*/
	function output( $setting ) {
		// Ignore admin, feed, robots or trackbacks
		if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
			return;
		}

		// Get meta
		$meta = get_option( $setting );
		if ( empty( $meta ) ) {
			return;
		}
		if ( trim( $meta ) == '' ) {
			return;
		}

		// Output
		echo wp_unslash( $meta );
	}
}

$additional_scripts = new AddScript();