<?php 

add_action( 'customize_register', 'add_scr_register_customizer_sections' );		

function add_scr_register_customizer_sections( $wp_customize ) {

	$add_scr_desc = '<p>';

	$add_scr_desc .= __( 'Help to make this plugin even better. Please follow the link to ' );

	$add_scr_desc .= sprintf( '<a href="%1$s" class="external-link" target="_blank">%2$s<span class="screen-reader-text"> %3$s</span></a>', esc_url( __( 'https://wordpress.org/support/plugin/additional-script' ) ), __( 'Contribute / Donate' ), __( '(opens in a new window)' ) );

	$add_scr_desc .= '</p>';

	$add_scr_desc .= '<p>';

	$add_scr_desc .= __( ' Give me a chance to appreciate your Rating and a nice little comment ' );

	$add_scr_desc .= sprintf( '<a href="%1$s" class="external-link" target="_blank">%2$s<span class="screen-reader-text"> %3$s</span></a>', esc_url( __( 'https://wordpress.org/support/plugin/additional-script/reviews/?rate=5#new-post' ) ), __( 'Rate 5 Stars' ), __( '(opens in a new window)' ) );

	$add_scr_desc .= '</p>';
	
	$wp_customize->add_section( 'add_scr_section', array(
		'title'    => __( 'Additional Script', 'twentyseventeen-child' ),
		'priority' => 255,
		'description' => $add_scr_desc
	) );
	
	add_scr_custom_sections( $wp_customize );
}

function add_scr_custom_sections( $wp_customize ) {

	$wp_customize->add_setting ( 'script-head-code', array () );

	$no_script_reqd = '<i>';

	$no_script_reqd .= __( 'No need to add script tags.' );

	$no_script_reqd .= '</i>';	

	$wp_customize->add_control (new WP_Customize_Control ( $wp_customize, 'script-head-code', 
			array (
	            'label' => 'Head JS Code',
	            'section' => 'add_scr_section',
	            'settings' => 'script-head-code',
	            'type' => 'textarea',
	            'priority' => 1,
	            'description' => $no_script_reqd
	        )
	    )
	);		

	$wp_customize->add_setting ( 'script-footer-code', array () );

	$wp_customize->add_control (new WP_Customize_Control ( $wp_customize, 'script-footer-code', 
			array (
	            'label' => 'Footer JS Code',
	            'section' => 'add_scr_section',
	            'settings' => 'script-footer-code',
	            'type' => 'textarea',
	            'priority' => 2,
	            'description' => $no_script_reqd
	        )
	    )
	);	
}

add_action( 'wp_head', 'add_scr_insert_head_js' );

function add_scr_insert_head_js() {
    ?>
        <script type="text/javascript">
         	<?php echo get_theme_mod( 'script-head-code' ); ?>
        </script> 
    <?php
}

add_action( 'wp_footer', 'add_scr_insert_footer_js' );

function add_scr_insert_footer_js() {
    ?>
        <script type="text/javascript">
         	<?php echo get_theme_mod( 'script-footer-code' ); ?>
        </script> 
    <?php
}