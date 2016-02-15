<?php
/**
 * Branding
 * @since 1.5
 */
$option_tabs['miss_branding_tab'] = array( 'class' => 'branding', 'title' => __( 'Branding', MISS_ADMIN_TEXTDOMAIN ) );
$option_store = Array(
	array(
		'name' => array( 'miss_branding_tab' => $option_tabs ),
		'class'=> 'branding',
		'icon' => 'icon-branding.png',
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Logo settings', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'menu_toggle',
			'type' => 'toggle_start'
		),

			array(
				'name' => __( 'Logo type', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'You can choose whether you wish to display a custom logo or your site title.', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'display_logo',
				'options' => array(
					'true' => __( 'Custom image logo', MISS_ADMIN_TEXTDOMAIN ),
					'' => sprintf( __( 'Display site title <small><a href="%1$s" target="_blank">(click here to edit site title)</a></small>', MISS_ADMIN_TEXTDOMAIN ), esc_url( get_option('siteurl') . '/wp-admin/options-general.php' ) )
				),
				'type' => 'radio'
			),
			array(
				'name' => __( 'Custom image logo', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Upload an image to use as your logo.', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'logo_url',
				'type' => 'upload'
			),

			array(
				'name' => __( 'Logo height', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter logo height in pixels.', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'logo_height',
				'default' => '48',
				'type' => 'numeral'
			),
            
			array(
				'name' => __( 'Login logo', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Upload image for WordPress login page.', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'login_logo_url',
				'type' => 'upload'
			),

		array(
			'type' => 'toggle_end'
		),

		array(
			'name' => __( 'Header order', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Specify header layout order.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'header_layout',
			'default' => 'logo_content_contacts',
			'options' => array( 
				'logo_content_contacts' => __( 'Logo / Custom content / Contacts', MISS_ADMIN_TEXTDOMAIN ),
				'logo_content' => __( 'Logo / Custom content', MISS_ADMIN_TEXTDOMAIN ),
				'logo' => __( 'Only centered logo', MISS_ADMIN_TEXTDOMAIN ),
			),
			'type' => 'select'
		),

		array(
			'name' => __( 'Custom favicon', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload your favicon.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'favicon_url',
			'type' => 'upload'
		),

	array(
		'type' => 'tab_end'
	),

);