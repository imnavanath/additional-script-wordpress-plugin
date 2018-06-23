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
* Initialize main script class
*/
class AddScript {

	/*
	* Constructor
	*/
	public function __construct() {

		$this->plugin = new stdClass;
		$this->plugin->wp_script = 'additional-scripts';
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'wp_head', array( &$this, 'wp_head' ) );
		add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
	}

	/**
	* Register header & footer Settings
	*/
	function admin_init() {

		register_setting( 'additional-scripts', 'insert_in_header', 'trim' );
		register_setting( 'additional-scripts', 'insert_in_footer', 'trim' );
	}

	function admin_menu() {

		add_submenu_page( 'options-general.php', 'Additional Scripts', 'Additional Scripts', 'manage_options', 'additional-scripts', array( &$this, 'script_page' ) );

		// Update settings
        $this->settings = array(
			'insert_in_header' => esc_html( wp_unslash( get_option( 'insert_in_header' ) ) ),
			'insert_in_footer' => esc_html( wp_unslash( get_option( 'insert_in_footer' ) ) ),
        );
	}

	function script_page() {

		// Admin rights for the page
		if ( !current_user_can( 'administrator' ) ) {
			echo '<p>' . __( 'Sorry, you are not allowed to access this page.', $this->plugin->wp_script ) . '</p>';
			return;
		}

    	// Save Settings
        if ( isset( $_REQUEST['submit'] ) ) {
        	// Checking nonce keys
			if ( !isset( $_REQUEST[$this->plugin->wp_script.'_nonce'] ) ) {
	        	// Missing nonce keys
	        	$this->errorMessage = __( 'nonce field is missing. Settings NOT saved.', $this->plugin->wp_script );
        	} elseif ( !wp_verify_nonce( $_REQUEST[$this->plugin->wp_script.'_nonce'], $this->plugin->wp_script ) ) {
	        	// Invalid nonce keys
	        	$this->errorMessage = __( 'Invalid nonce specified. Settings NOT saved.', $this->plugin->wp_script );
        	} else {
	        	// Save option
	    		update_option( 'insert_in_header', $_REQUEST['insert_in_header'] );
	    		update_option( 'insert_in_footer', $_REQUEST['insert_in_footer'] );
				$this->message = __( 'Settings Saved.', $this->plugin->wp_script );
			}
        }

		// Load required page
		require_once(ADD_SCRIPT_DIR . '/includes/options.php');
	}

	/**
	* Script for header
	*/
	function wp_head() {
		$this->output( 'insert_in_header' );
	}

	/**
	* Script for footer
	*/
	function wp_footer() {
		$this->output( 'insert_in_footer' );
	}

	/**
	* Reflect output $setting
	*/
	function output( $setting ) {
		if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
			return;
		}

		// Meta options
		$meta = get_option( $setting );
		if ( empty( $meta ) ) {
			return;
		}
		if ( trim( $meta ) == '' ) {
			return;
		}

		// Unslash meta
		echo wp_unslash( $meta );
	}
}

$additional_scripts = new AddScript();