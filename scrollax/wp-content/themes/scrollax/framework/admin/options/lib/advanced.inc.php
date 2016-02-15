<?php
/**
 * Advanced
 * @since 1.5
 */

$option_tabs['miss_advanced_tab'] = array('class' => 'backup', 'title' => __( 'Backup', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_advanced_tab' => $option_tabs ),
		'class'=> 'backup',
		'type' => 'tab_start'
	),
		array(
			'name' => __( 'Import theme options', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Copy your export code here to import your theme settings.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'import_options',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Export theme options', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'When moving your site to a new WordPress installation you can export your theme settings here.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'export_options',
			'type' => 'export_options'
		),
		
	array(
		'type' => 'tab_end'
	),

);