<?php
/**
 * Store
 * @since 1.7
 */
$option_tabs['miss_store_tab'] = array('class' => 'store', 'title' => __( 'Store / Woocommerce', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(

	array(
		'name' => array( 'miss_store_tab' => $option_tabs ),
		'class'=> 'store',
		'icon' => 'icon-store.png',
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Display share buttons', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Display share buttons.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'store_display_share_buttons',
			'options' => array(
				'yes' => __( 'Yes', MISS_ADMIN_TEXTDOMAIN ),
				'no' => __( 'No', MISS_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Display Featured products', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Display Featured products.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'store_display_featured_products',
			'options' => array(
				'yes' => __( 'Yes', MISS_ADMIN_TEXTDOMAIN ),
				'no' => __( 'No', MISS_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Featured products IDs', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'WooCommerce featured products is. Enter id1,id2', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'featured_products_ids',
			'type' => 'text'
		),

	array(
		'type' => 'tab_end'
	),

);
