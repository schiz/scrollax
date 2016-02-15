<?php
/**
 * Blog Layout
 * @since 1.5
 */

$option_tabs['miss_pages_tab'] = array('class' => 'pages', 'title' => __( 'Pages', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_pages_tab' => $option_tabs ),
		'class'=> 'pages',
		'icon' => 'icon-pages.png',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Default parent pages', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'pages_parent',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Archive caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter title for posts archive page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'post_page_caption',
			'default' => 'Archive: Posts',
			'type' => 'text'
		),

		array(
			'name' => __( 'News page caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter title for news archive page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'news_page_caption',
			'default' => 'Archive: News',
			'type' => 'text'
		),

		array(
			'name' => __( 'Testimonials page caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter title for testimonials archive page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'testimonials_page_caption',
			'default' => 'Archive: Testimonials',
			'type' => 'text'
		),

		array(
			'name' => __( 'Blog page', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose one of your pages to use as a blog page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_page',
			'target' => 'page',
			'type' => 'select'
		),

		array(
			'name' => __( 'Portfolio page', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose one of your pages to use as a portfolio page template.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_page',
			'target' => 'page',
			'type' => 'select'
		),

		array(
			'type' => 'toggle_end'
		),

		/**
		 * Login
		 */
		array(
			'name' => __( 'Sign In', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'pages_login',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Login page URL', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter login page URL.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_login_url',
			'type' => 'text'
		),

		array(
			'name' => __( 'Login menu title', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter login extra menu title.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_login_title',
			'type' => 'text'
		),

		array(
			'type' => 'toggle_end'
		),

		/**
		 * Store / Shop
		 */
		array(
			'name' => __( 'Store', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'pages_shop',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Store page caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter shop page title.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'product_page_caption',
			'type' => 'text'
		),

		array(
			'name' => __( 'Store extra header caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter title for shop extra menu.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_shop_title',
			'type' => 'text'
		),

		array(
			'type' => 'toggle_end'
		),

		/**
		 * Checkout
		 */
		array(
			'name' => __( 'Checkout', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'pages_checkout',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Checkout URL', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter checkout page URL.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_checkout_url',
			'type' => 'text'
		),

		array(
			'name' => __( 'Checkout menu title', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter title for checkout extra menu.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_checkout_title',
			'type' => 'text'
		),

		array(
			'type' => 'toggle_end'
		),


		/**
		 * Subscribe
		 */

		array(
			'name' => __( 'Subscribe', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'pages_subscribe',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Subscribe URL', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter subscribe page URL.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_subscribe_url',
			'type' => 'text'
		),

		array(
			'name' => __( 'Subscribe menu title', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter subscribe extra menu title.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_subscribe_title',
			'type' => 'text'
		),

		array(
			'type' => 'toggle_end'
		),

	array(
		'type' => 'tab_end'
	),

);