<?php

$testimonials_box = array(
	'title' => 'Testimonials Options',
	'id' => 'miss_testimonials_meta_box',
	'pages' => array( 'testimonials' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	/**
	 * Deprecated
	 * @since 1.5
	 */
        array(
			'name'    => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Scrollax',
			'id'  => 'testimonial_caption',
			'toggle_class' => 'header_slider_featured_caption',
			'type' => 'text',
		),
	)
);
return array(
	'load' => true,
	'options' => $testimonials_box
);

?>
