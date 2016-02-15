<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s General Post Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_post_meta_box',
	'pages' => array( 'staff' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __( 'Position', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Please write a position to this employee.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'position',
			'type' => 'text'
		),
		array(
			'name' => __( 'Social pages', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Please select social pages to this employee.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sociable',
			'type' => 'sociable'
		)
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
