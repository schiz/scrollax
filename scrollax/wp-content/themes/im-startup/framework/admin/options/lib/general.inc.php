<?php
/**
 * General
 * @since 1.5
 */
$option_tabs['miss_generalsettings_tab'] = array('class' => 'general', 'title' => __( 'General', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_generalsettings_tab' => $option_tabs ),
		'class'=> 'general',
		'icon' => 'icon-general.png',
		'type' => 'tab_start'
	),
		/*array(
			'name' => __('Responsive layout', MISS_ADMIN_TEXTDOMAIN),
			'desc' => __('This option making theme "responsive" or adaptive to be compatible with mobile devices such as iPhone, iPad, Android, Blackberry and respond to your users needs. By default this option enabled.',MISS_ADMIN_TEXTDOMAIN),
			'id' => 'responsive',
			'help' => '<img align="right" src="' . THEME_ADMIN_ASSETS_URI . '/images/icons/adaptive.png" alt="Adaptive Layout" />' . __('Responsive web design is an approach to web design in which a site is crafted to provide an optimal viewing experience easy reading and navigation with a minimum of resizing, panning, and scrolling across a wide range of devices.', MISS_ADMIN_TEXTDOMAIN ),
			'options' => array(
				'enabled' => __('Enable', MISS_ADMIN_TEXTDOMAIN),
				'disabled' => __('Disable', MISS_ADMIN_TEXTDOMAIN)
			),
			'default' => 'enabled',
			'type' => 'radio'
		),*/

		array(
			'name' => __('Retina', MISS_ADMIN_TEXTDOMAIN),
			'desc' => __('This option making sites compatible with retina-technology screens (high quality and high resolution screens) with one click. Users of latest Apple devices will appreciate the picture quality.',MISS_ADMIN_TEXTDOMAIN),
			'id' => 'hires',
			'options' => array(
				'enabled' => __('Enable', MISS_ADMIN_TEXTDOMAIN),
				'disabled' => __('Disable', MISS_ADMIN_TEXTDOMAIN)
			),
			'default' => 'disabled',
			'type' => 'radio'
		),
        
		array(
			'name' => __( 'Shortcode generator', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select post types for shortcode generator.', MISS_ADMIN_TEXTDOMAIN ),
			// 'default' => array('page','post','portfolio','news','vacancy','staff'),
			'id' => 'shortcode_generator_type',
			'options' => get_post_types(),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Analytics / Zopim', MISS_ADMIN_TEXTDOMAIN ),
			'desc' =>  __( 'Paste Analytics code or Zopim widget code here.', MISS_ADMIN_TEXTDOMAIN ),
			'help' => '<img align="left" hspace="10px" src="' . THEME_ADMIN_ASSETS_URI . '/images/icons/analytics.png" alt="Google Analytics" />' . __( 'The Google Analytics tracking code collects visitor data for your web property, and returns that data to Analytics where you can see it in reports. When you add a new web property to your Analytics account, Analytics generates the tracking code snippet that you need to add to the pages whose data you want to collect.<br /><br />Get your tracking code <a href="http://analytics.google.com/" target="_BLANK">here</a>', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'analytics_code',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom CSS', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Place for custom styles. This option may customise any style of the website. <br />Example:<br /><br /><code>.logo a { color: blue; }</code>', MISS_ADMIN_TEXTDOMAIN ),
			'help' => __( 'Requires some skills. Example:<br /><br /><code>.logo a { color: blue; }</code><br /><br />If you are having problems styling something then ask on the support forum and we will be with you shortly.', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'custom_css',
			'id' => 'custom_css',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom JavaScript', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Place for custom javascript. Required some skills.', MISS_ADMIN_TEXTDOMAIN ),
			'help' => __( 'Requires Javascript skills. Code Example:<br /><br /><code>alert ("Hello World!")</code><br />', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_js',
			'toggle_class' => 'custom_js',
			'type' => 'textarea'
		),
		
	array(
		'type' => 'tab_end'
	),

);