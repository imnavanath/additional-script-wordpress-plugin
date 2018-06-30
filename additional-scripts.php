<?php
/**
* Plugin Name: Additional Script / Styles
* Version: 1.0.0
* Author: Navanath Bhosale
* Description: The plugin gives you flexibility for <strong> Additing Script or CSS styles through Header / Footer on your site. </strong>
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

		$this->AddScr_plugin = new stdClass;
		$this->AddScr_plugin->wpAddScript = 'additional-scripts';
		add_action( 'admin_init', array( &$this, 'AddScr_admin_init' ) );
		add_action( 'admin_menu', array( &$this, 'AddScr_admin_menu' ) );
		add_action( 'wp_head', array( &$this, 'AddScr_wp_head' ) );
		add_action( 'wp_footer', array( &$this, 'AddScr_wp_footer' ) );
	}

	/**
	* Register header & footer Settings
	*/
	function AddScr_admin_init() {

		register_setting( 'additional-scripts', 'AddScr_insert_in_header', 'trim' );
		register_setting( 'additional-scripts', 'AddScr_insert_in_footer', 'trim' );
	}

	function AddScr_admin_menu() {

		add_submenu_page( 'options-general.php', 'Additional Scripts', 'Additional Scripts', 'manage_options', 'additional-scripts', array( &$this, 'script_page' ) );

		// Update settings
        $this->settings = array(
			'AddScr_insert_in_header' => esc_html( wp_unslash( get_option( 'AddScr_insert_in_header' ) ) ),
			'AddScr_insert_in_footer' => esc_html( wp_unslash( get_option( 'AddScr_insert_in_footer' ) ) ),
        );
	}

	function script_page() {

		// Admin rights for the page
		if ( !current_user_can( 'administrator' ) ) {
			echo '<p>' . __( 'Sorry, you are not allowed to access this page.', $this->AddScr_plugin->wpAddScript ) . '</p>';
			return;
		}

    	// Save Settings
        if ( isset( $_REQUEST['submit'] ) ) {
        	// Checking nonce keys
			if ( !isset( $_REQUEST[$this->AddScr_plugin->wpAddScript.'_nonce'] ) ) {
	        	// Missing nonce keys
	        	$this->errorMessage = __( 'Nonce field is missing. Settings NOT saved.', $this->AddScr_plugin->wpAddScript );
        	} elseif ( !wp_verify_nonce( $_REQUEST[$this->AddScr_plugin->wpAddScript.'_nonce'], $this->AddScr_plugin->wpAddScript ) ) {
	        	// Invalid nonce keys
	        	$this->errorMessage = __( 'Invalid nonce specified. Settings NOT saved.', $this->AddScr_plugin->wpAddScript );
        	} else {
	        	// Save option
	    		update_option( 'AddScr_insert_in_header', esc_textarea ($_REQUEST['AddScr_insert_in_header'] ) );
	    		update_option( 'AddScr_insert_in_footer', esc_textarea ($_REQUEST['AddScr_insert_in_footer'] ) );
				$this->message = __( 'Code snippet added successfully.', $this->AddScr_plugin->wpAddScript );

			}
        }

		// Load required page
		require_once (ADD_SCRIPT_DIR . '/includes/options.php');
	}

	/**
	* Script for header
	*/
	function AddScr_wp_head() {
		$this->addScript( 'AddScr_insert_in_header' );
	}

	/**
	* Script for footer
	*/
	function AddScr_wp_footer() {
		$this->addScript( 'AddScr_insert_in_footer' );
	}

	/**
	* Reflect addScript $setting
	*/
	function addScript( $setting ) {
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