<?php

$service_box = array(
	'title' => 'Service Options',
	'id' => 'miss_service_meta_box',
	'pages' => array( 'service' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	/**
	 * Deprecated
	 * @since 1.5
	 */
array(
			'name' => __( 'Post Icon', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Please select post icon for some theme features such as Expose Slider.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_icon',
			'std' => 'im-icon-image-2',
			'default' => array_rand( miss_get_all_font_icons() ),
			'target' => 'all_icons',
			'type' => 'select'
		),
	)
);
return array(
	'load' => true,
	'options' => $service_box
);

?>
