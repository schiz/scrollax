<?php
/**
 * Scores
 * @since 1.5
 */
$option_tabs['miss_review_tab'] = Array('class' => 'rank', 'title' => __( 'Ranks', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_review_tab' => $option_tabs ),
		'class'=> 'rank',
		'icon' => 'icon-rank.png',
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Enable reviews', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose this option to enable or disable the post ranking.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'review',
			'options' => array( 
				'enable' => __( 'Enable', MISS_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Disable', MISS_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),

		array(
			'name' => __( 'Active colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Specify active icon colour.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'star_color',
			'default' => '#202020',
			'type' => 'color'
		),

		array(
			'name' => __( 'Inactive colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Specify inactive icon colour.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'star_color2',
			'default' => '#aaaaaa',
			'type' => 'color'
		),

		array(
			'name' => __( 'Icon size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Specify icon size.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'star_size',
			'default' => '18',
			'step2' => '18',
			'type' => 'numeral'
		),

		array(
			'name' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Specify default icon.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'star_image',
			'default' => 'im-icon-star-4',
			'target' => 'all_icons',
			'type' => 'icons'
		),

		array (
			'name' => __( 'Display reviews on: ', MISS_ADMIN_TEXTDOMAIN),
			'desc' => __( 'Please choose where you would like to display the reviews. ', MISS_ADMIN_TEXTDOMAIN),
			'id' => 'review_area',
			'options' => array(
				'single_post_page' => __('Single Posts', MISS_ADMIN_TEXTDOMAIN),
				'widgets' => __('Widgets', MISS_ADMIN_TEXTDOMAIN)
			),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Review criterias', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Create your criterias to be used on review content', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'criteria',
			'type' => 'criteria'
		),
	array(
		'type' => 'tab_end'
	),
);