<?php
global $wpdb;
$meta_boxes = array(
	'title' => sprintf( __( '%1$s Job Application Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_page_meta_box',
	'pages' => array( 'vacancy' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		array(
            'name'    => __( 'Application Form Visibility', MISS_ADMIN_TEXTDOMAIN ),
            'id'      => 'job_application_visibility',
            'default' => array('true'),
			'options' => array( 'true' => __( 'Enable job application form.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),

		array(
			'name'    => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Apply for this job',
			'id'  => 'job_application_caption',
			'toggle_class' => 'job_application_caption',
			'type' => 'text',
		),

		array(
			'name'    => __( 'Recipient Email', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter application recipient email address.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => get_bloginfo('admin_email'),
			'id'  => 'job_application_recipient',
			'toggle_class' => 'job_application_caption',
			'type' => 'text',
		),

		array(
			'name'    => __( 'Subject (optional)', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter application subject that will be shown as email subject.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'id'  => 'job_application_subject',
			'toggle_class' => 'job_application_caption',
			'type' => 'text',
		),

		array(
			'name' => __( 'Labels', MISS_ADMIN_TEXTDOMAIN ),
            'toggle_class' => 'labels',
			'type' => 'toggle_start'
		),
			array(
				'name'    => __( 'Name Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter main  name field label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Enter full name',
				'id'  => 'job_application_label_name',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
			),

			array(
				'name'    => __( 'Details Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter description field label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Details',
				'id'  => 'job_application_label_details',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
			),

			array(
				'name'    => __( 'Phone Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter phone field label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Phone',
				'id'  => 'job_application_label_phone',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
			),

			array(
				'name'    => __( 'Email Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter e-mail field label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Email',
				'id'  => 'job_application_label_email',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
			),

			array(
				'name'    => __( 'Attachment Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter attachment field label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Upload your CV',
				'id'  => 'job_application_label_attachment',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
			),

			array(
				'name'    => __( 'Button Label', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Enter submit buttio label.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => 'Apply',
				'id'  => 'job_application_label_button',
				'toggle_class' => 'job_application_caption',
				'type' => 'text',
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
