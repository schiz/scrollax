<?php
/**
 * Skins
 * @since 1.5
 */

$option_tabs['miss_skins_tab'] = array('class' => 'skin', 'title' => __( 'Styles', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_skins_tab' => $option_tabs ),
		'class'=> 'skins',
		'icon' => 'icon-skins.png',
		'type' => 'tab_start'
	),

		// array(
		// 	'name' => __( 'Custom fonts integration', MISS_ADMIN_TEXTDOMAIN ),
		// 	'toggle_class' => 'web_fonts_integration_toggle',
		// 	'type' => 'toggle_start'
		// ),

		array(
			'name' => __( 'Google Web Fonts', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Google Web Fonts Generator adding custom Google Font to theme. Please read theme documentation first.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'google_web_fonts',
			'type' => 'google_web_fonts'
		),

		// array(
		// 	'type' => 'toggle_end'
		// ),

		array(
			'name' => __( 'Style options', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select predefined style or use advanced style manager to design your unique style.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'skin_generator',
			'options' => array( 
				'choose' => __( 'Choose style', MISS_ADMIN_TEXTDOMAIN ),
				'manage' => __( 'Manage style', MISS_ADMIN_TEXTDOMAIN )
				),
			'default' => 'choose',
			'toggle' => 'toggle_true',
			'type' => 'skin_generator'
		),
		array(
			'name' => __( 'Available styles', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select predefined style.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'style_variations',
			'default' => 'default',
			'target' => 'style_variations',
			'toggle_class' => 'skin_generator_choose',
			'type' => 'skin_select'
		),
	array(
		'type' => 'tab_end'
	),
);
