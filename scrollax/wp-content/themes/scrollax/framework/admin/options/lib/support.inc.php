<?php
/**
 * Support
 * @since 1.5
 */

$option_tabs['miss_support_tab'] = array('class' => 'support', 'title' => __( 'Support', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_support_tab' => $option_tabs ),
		'class'=> 'support',
		'icon' => 'icon-support.png',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Theme documentation', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'admin_logo_url',
			'std' => __( 'Documentation been included with theme bundle (bundle.zip). Please download theme files and open "documentation" folder from downloaded directory. Also you may use online-documentation <a href="http://cdn.irishmiss.com/d/startup/" target="_BLANK">here</a>.', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'links'
		),
 		array(
			'name' => __( 'Purchase code', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'purchase_code',
			'std' => __( 'Please enter purchase code for theme updates.', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'text'
		),
		array(
			'name' => __( 'Theme support', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'import_options',
			'std' => __( 'We truly appreciate your purchase and your issues is also important for us! To improve any support aspect we launched helpdesk system which may help to you work with our team, solve important issues and accept all additional theme features and improvements. When you\'ll create your ticket, we\'ll registered your ticket inside our CRM, then we\'ll review it and assign appropriated person from our team which may help you as soon as possible.<br />Click to <a href="http://helpdesk.irishmiss.com/">add your issue &rarr;</a>.', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'links'
		),
	array(
		'type' => 'tab_end'
	),
);