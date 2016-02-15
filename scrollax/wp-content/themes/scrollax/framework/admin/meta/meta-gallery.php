<?php
$meta_boxes = array(
	'title' => sprintf( __( '%1$s Gallery Page Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_page_meta_box',
	'pages' => array( 'miss_gallery' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(



			array(
                'name'    => 'Gallery Name',
                'id'      => '_gallery_customer',
				'options' => array( 'true' => __( 'Enter customer brand / company name', MISS_ADMIN_TEXTDOMAIN ) ),
				'type' => 'text'
			),
			array(
                'name'    => 'Experience',
                'id'      => '_gallery_exp',
				'options' => array( 'true' => __( 'Enter project experience or skills', MISS_ADMIN_TEXTDOMAIN ) ),
				'type' => 'text'
			),
			array(
                'name'    => 'Website',
                'id'      => '_gallery_uri',
				'options' => array( 'true' => __( 'Enter project link', MISS_ADMIN_TEXTDOMAIN ) ),
				'type' => 'text'
			),
			array(
                'name'    => 'Description',
                'id'      => '_gallery_descr',
				'options' => array( 'true' => __( 'Enter custom description', MISS_ADMIN_TEXTDOMAIN ) ),
				'type' => 'textarea'
			),
			array(
				'name'    => __( 'Placeholder Background', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_bg',
				'default' => '#f0f3f4',
				'type' => 'color'
			),
			array(
				'name'    => __( 'Placeholder Colour', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_color',
				'default' => '#dddddd',
				'type' => 'color'
			),

			array(
				'name'    => __( 'Placeholder Height', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_height',
				'default' => '6',
				'max' => 32,
				'min' => 1,
				'step' => 1,
				'unit' => ' px',
				'type' => 'range'
			),

			array(
				'name'    => __( 'Placeholder Border Radius', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_radius',
				'default' => '5',
				'max' => 16,
				'min' => 1,
				'step' => 1,
				'unit' => ' px',
				'type' => 'range'
			),
			array(
				'name'    => __( 'Placeholder Arrow Size', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_arrow',
				'default' => '6',
				'max' => 32,
				'min' => 1,
				'step' => 1,
				'unit' => ' px',
				'type' => 'range'

			),
			array(
				'name'    => __( 'Placeholder Arrow Position', MISS_ADMIN_TEXTDOMAIN ),
				'id'      => '_gallery_placeholder_position',
				'default' => 'left',
				'options' => array(
					'left' => __( 'Left', MISS_ADMIN_TEXTDOMAIN ),
					'center' => __( 'Center', MISS_ADMIN_TEXTDOMAIN ),
					'right' => __( 'Right', MISS_ADMIN_TEXTDOMAIN ),
				),
				'type' => 'select'
			),

            array(
                    'name' => __( 'Info Fields', MISS_ADMIN_TEXTDOMAIN ),
                    'type' => 'toggle_start'
            ),
						array(
							'name'    => __( 'Header Field', MISS_ADMIN_TEXTDOMAIN ),
							'id'      => '_gallery_field_header',
							'default' => __( 'Gallery Info', MISS_ADMIN_TEXTDOMAIN ),
							'desc' => __( 'Enter custom header text', MISS_ADMIN_TEXTDOMAIN ),
							'type' => 'text'
						),
						array(
							'name'    => __( 'Gallery Field', MISS_ADMIN_TEXTDOMAIN ),
							'id'      => '_gallery_field_project',
							'default' => __( 'Project', MISS_ADMIN_TEXTDOMAIN ),
							'desc' => __( 'Define gallery field name text', MISS_ADMIN_TEXTDOMAIN ),
							'type' => 'text'
						),
						array(
							'name'    => __( 'Experience Field', MISS_ADMIN_TEXTDOMAIN ),
							'id'      => '_gallery_field_exp',
							'default' => __( 'Experience', MISS_ADMIN_TEXTDOMAIN ),
							'desc' => __( 'Define experience field name text', MISS_ADMIN_TEXTDOMAIN ),
							'type' => 'text'
						),
						array(
							'name'    => __( 'Website Field', MISS_ADMIN_TEXTDOMAIN ),
							'id'      => '_gallery_field_web',
							'default' => __( 'Web', MISS_ADMIN_TEXTDOMAIN ),
							'desc' => __( 'Define website field name text', MISS_ADMIN_TEXTDOMAIN ),
							'type' => 'text'
						),
						array(
							'name'    => __( 'Description Field', MISS_ADMIN_TEXTDOMAIN ),
							'id'      => '_gallery_field_details',
							'default' => __( 'Details', MISS_ADMIN_TEXTDOMAIN ),
							'desc' => __( 'Define details field name text', MISS_ADMIN_TEXTDOMAIN ),
							'type' => 'text'
						),

	        array(
				'type' => 'toggle_end'
	        ),

	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
