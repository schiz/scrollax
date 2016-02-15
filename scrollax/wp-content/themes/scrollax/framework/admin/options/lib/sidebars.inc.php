<?php
/**
 * Sidebars
 * @since 1.5
 */

$option_tabs['miss_sidebar_tab'] = array('class' => 'sidebar', 'title' => __( 'Sidebar', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_sidebar_tab' => $option_tabs ),
		'class'=> 'sidebar',
		'icon' => 'icon-sidebar.png',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Sticky sidebar', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Sticky sidebar make website sidebar visible for user on scroll. ', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'enable_fixed_sidebar',
			'options' => array( 'true' => __( 'Enable sticky sidebar', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Create new sidebar', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can create additional sidebars to use. To display your new sidebar then you will need to select it in the &quot;Custom Sidebar&quot; dropdown when editing a post or page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_sidebars',
			'type' => 'sidebar'
		),
	
	array(
		'type' => 'tab_end'
	),
);