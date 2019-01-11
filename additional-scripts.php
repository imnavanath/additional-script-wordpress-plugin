<?php
/**
* Plugin Name: Additional Script
* Version: 2.0.0
* Author: Navanath Bhosale
* Description: The plugin gives you flexibility to <strong> add Script through Header / Footer on your site. </strong>
* License: GPL2
*/

add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'add_scr_add_settings_link' );

function add_scr_add_settings_link( $links ) {

	$links = array_merge( array( '<a href="customize.php">' . __( 'Insert Script' ) . '</a>' ), $links );
    return $links;
}

require_once 'includes/loader.php';