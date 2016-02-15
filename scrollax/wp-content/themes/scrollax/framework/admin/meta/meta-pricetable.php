<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s Custom Pricing Table Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_price_meta_box',
	'pages' => array( 'pricetable' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __( 'Display Style', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select stile for this price table.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_class',
			'default' => 'union',
			'options' => array( 
				'union' => __( 'Union', MISS_ADMIN_TEXTDOMAIN ),
				'separated' => __( 'Separated', MISS_ADMIN_TEXTDOMAIN ),
			),
			'type' => 'select'
		),
		array(
			'name' => __( 'Enable Custom Colors', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option can enable colour customisation capabilities.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_custom',
			'default' => '',
			'options' => array( 
				'true' => __( 'Check here for enable custom colors on site', MISS_ADMIN_TEXTDOMAIN ),
			),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Currency Sign', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter currency sign.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_currency',
			'default' => '£',
			'type' => 'text'
		),
		array(
			'name' => __( 'Heading Row Background', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom background for table header.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_header_bg',
			'default' => '#ffffff',
			'type' => 'color'
		),
		array(
			'name' => __( 'Heading Row Color', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom text color for table header.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_header_color',
			'default' => '#205685',
			'type' => 'color'
		),
		array(
			'name' => __( 'Price Row Background', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom background for table price row.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_price_bg',
			'default' => '#edf6f8',
			'type' => 'color'
		),
		array(
			'name' => __( 'Price Row Color', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom text color for table price row.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_price_color',
			'default' => '#205685',
			'type' => 'color'
		),
		array(
			'name' => __( 'Button Background First (top) Color', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom text color for table price row.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_button_bg_first',
			'default' => '#83bfe5',
			'type' => 'color'
		),
		array(
			'name' => __( 'Button Background Second (bottom) Color', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select custom text color for table price row.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_button_bg_second',
			'default' => '#5387bf',
			'type' => 'color'
		),
		array(
			'name' => __( 'Text After', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter text after price', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_price_after',
			'default' => ' / month',
			'type' => 'text'
		),
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
