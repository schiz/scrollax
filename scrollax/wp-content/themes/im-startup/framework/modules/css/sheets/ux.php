<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}


$local = Array(
	'html' => array(
		'color' => 'body_color',
	),	
	'body' => array(
		'background-color' => 'body_bg_color',
		'background-image' => 'body_bg_image',
		'background-repeat' => 'body_bg_repeat',
		'background-position' => 'body_bg_position',
		'background-attachment' => 'body_bg_attachment',
		'font-family' => 'body_font_family',
		'font-weight' => 'body_font_weight',
		'font-size' => 'body_font_size',
		'line-height' => 'body_line_height',
		'color' => 'body_color',
	),
	'body *,
select, 
textarea, 
input[type="text"], 
input[type="password"], 
input[type="datetime"], 
input[type="datetime-local"], 
input[type="date"], 
input[type="month"], 
input[type="time"], 
input[type="week"], 
input[type="number"], 
input[type="email"], 
input[type="url"], 
input[type="search"], 
input[type="tel"], 
input[type="color"], 
.uneditable-input' => array(
		'border-color' => 'body_border_color',
	),
	'body,
textarea, 
input[type="text"], 
input[type="password"], 
input[type="datetime"], 
input[type="datetime-local"], 
input[type="date"], 
input[type="month"], 
input[type="time"], 
input[type="week"], 
input[type="number"], 
input[type="email"], 
input[type="url"], 
input[type="search"], 
input[type="tel"], 
input[type="color"], 
.main_content .input-wrap, 
.uneditable-input' => array(
		'font-size' => 'body_font_size',
	),

	'body.boxed_layout .page-body' => array(
		'background-color' => 'boxed_bg_color',
		'background-image' => 'boxed_bg_image',
		'background-repeat' => 'boxed_bg_repeat',
		'background-position' => 'boxed_bg_position',
		'background-attachment' => 'boxed_bg_attachment',
	),

	/* Button 1 */
	'.btn1, 
.main_content a.btn1, 
.main_content a.btn1:hover, 
input[type="submit"], 
button, 
input[type="button"], 
.main_content .miss_form input[type="submit"], 
.main_content .miss_form button, 
.main_content .miss_form input[type="button"], 
.single_module.portfolio .post_nav_module a *, 
.single_module.portfolio .post_nav_module a:hover *, 
.flex-direction-nav li a,
.flex-control-paging li a:hover,
.flex-control-paging li a.flex-active,
#comments .commentmetadata a ,
.miss_form_row input[type="submit"],
.form-submit input[type="submit"], 
.form-submit button,
.loop_content.products .cart .single_add_to_cart_button, 
.loop_content.products .cart .minus, 
.loop_content.products .cart .plus, 
.widget_shopping_cart .buttons .button, 
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button, 
.woocommerce .cart .quantity .minus, 
.woocommerce .cart .quantity .plus, 
.woocommerce .shop_table input.button,
.woocommerce .shop_table input.button.alt,
.products .product_item .box a.button,
 /* woocommerce without activity */
.main_content .woocommerce .buttons a.button,
.main_content .woocommerce a.button, 
.main_content .woocommerce-page a.button, 
.main_content .woocommerce button.button, 
.main_content .woocommerce-page button.button, 
.main_content .woocommerce input.button, 
.main_content .woocommerce-page input.button, 
.main_content .woocommerce #respond input#submit, 
.main_content .woocommerce-page #respond input#submit, 
.main_content .woocommerce #content input.button, 
.main_content .woocommerce-page #content input.button,
.main_content .woocommerce a.button.alt, 
.main_content .woocommerce-page a.button.alt, 
.main_content .woocommerce button.button.alt, 
.main_content .woocommerce-page button.button.alt, 
.main_content .woocommerce input.button.alt, 
.main_content .woocommerce-page input.button.alt, 
.main_content .woocommerce #respond input#submit.alt, 
.main_content .woocommerce-page #respond input#submit.alt, 
.main_content .woocommerce #content input.button.alt, 
.main_content .woocommerce-page #content input.button.alt,
.main_content .woocommerce .quantity .plus, 
.main_content .woocommerce-page .quantity .plus, 
.main_content .woocommerce #content .quantity .plus, 
.main_content .woocommerce-page #content .quantity .plus, 
.main_content .woocommerce .quantity .minus, 
.main_content .woocommerce-page .quantity .minus, 
.main_content .woocommerce #content .quantity .minus, 
.main_content .woocommerce-page #content .quantity .minus, 
 /* woocommerce .button:hover */
.main_content .woocommerce .buttons a.button:hover,
.main_content .woocommerce a.button:hover, 
.main_content .woocommerce-page a.button:hover, 
.main_content .woocommerce button.button:hover, 
.main_content .woocommerce-page button.button:hover, 
.main_content .woocommerce input.button:hover, 
.main_content .woocommerce-page input.button:hover, 
.main_content .woocommerce #respond input#submit:hover, 
.main_content .woocommerce-page #respond input#submit:hover, 
.main_content .woocommerce #content input.button:hover, 
.main_content .woocommerce-page #content input.button:hover,
.main_content .woocommerce .buttons a.button:hover,
.main_content .woocommerce a.button.alt:hover, 
.main_content .woocommerce-page a.button.alt:hover, 
.main_content .woocommerce button.button.alt:hover, 
.main_content .woocommerce-page button.button.alt:hover, 
.main_content .woocommerce input.button.alt:hover, 
.main_content .woocommerce-page input.button.alt:hover, 
.main_content .woocommerce #respond input#submit.alt:hover, 
.main_content .woocommerce-page #respond input#submit.alt:hover, 
.main_content .woocommerce #content input.button.alt:hover, 
.main_content .woocommerce-page #content input.button.alt:hover,
.main_content .woocommerce .quantity .plus:hover, 
.main_content .woocommerce-page .quantity .plus:hover, 
.main_content .woocommerce #content .quantity .plus:hover, 
.main_content .woocommerce-page #content .quantity .plus:hover, 
.main_content .woocommerce .quantity .minus:hover, 
.main_content .woocommerce-page .quantity .minus:hover, 
.main_content .woocommerce #content .quantity .minus:hover, 
.main_content .woocommerce-page #content .quantity .minus:hover 
 /* woocommerce .button:active */
.main_content .woocommerce .buttons a.button:active,
.main_content .woocommerce a.button:active:active, 
.main_content .woocommerce-page a.button:active, 
.main_content .woocommerce button.button:active, 
.main_content .woocommerce-page button.button:active, 
.main_content .woocommerce input.button:active, 
.main_content .woocommerce-page input.button:active, 
.main_content .woocommerce #respond input#submit:active, 
.main_content .woocommerce-page #respond input#submit:active, 
.main_content .woocommerce #content input.button:active, 
.main_content .woocommerce-page #content input.button:active,
.main_content .woocommerce .buttons a.button:active,
.main_content .woocommerce a.button.alt:active, 
.main_content .woocommerce-page a.button.alt:active, 
.main_content .woocommerce button.button.alt:active, 
.main_content .woocommerce-page button.button.alt:active, 
.main_content .woocommerce input.button.alt:active, 
.main_content .woocommerce-page input.button.alt:active, 
.main_content .woocommerce #respond input#submit.alt:active, 
.main_content .woocommerce-page #respond input#submit.alt:active, 
.main_content .woocommerce #content input.button.alt:active, 
.main_content .woocommerce-page #content input.button.alt:active,
.main_content .woocommerce .quantity .plus:active, 
.main_content .woocommerce-page .quantity .plus:active, 
.main_content .woocommerce #content .quantity .plus:active, 
.main_content .woocommerce-page #content .quantity .plus:active, 
.main_content .woocommerce .quantity .minus:active, 
.main_content .woocommerce-page .quantity .minus:active, 
.main_content .woocommerce #content .quantity .minus:active, 
.main_content .woocommerce-page #content .quantity .minus:active, 
.rev_slider_wrapper a.btn1, 
.rev_slider_wrapper a.btn1:hover' => array(
		'-miss-gradient' => 'btn_1_gradient',
		'background-color' => array( 'btn_1_gradient' => 'start' ),
		'color' => 'btn_1_color',
/*		'line-height' => 'btn_1_line_height',
*/		'font-size' => 'btn_1_font_size',
		'font-weight' => 'btn_1_font_weight',
	),
	'.btn1 *,
.main_content a.btn1 > *,
.main_content a.btn1:hover > *,
.main_content .flex-direction-nav li a *, 
.main_content .flex-direction-nav li a:hover *, 
section .flex-direction-nav li a *, 
section .flex-direction-nav li a:hover *, 
.btn1 *[class*="fa-icon-"], 
.btn1 *[class*="im-icon-"], 
.widget_shopping_cart .widget_shopping_cart_content .buttons .button:first-child:before' => array(
		'color' => 'btn_1_color',
	),
	/* Button 2 */
	'.btn2, 
section a.btn2, 
.btn2:hover, 
.rev_slider_wrapper a.btn2, 
.rev_slider_wrapper a.btn2:hover' => array(
		'-miss-gradient' => 'btn_2_gradient',
		'color' => 'btn_2_color',
		'line-height' => 'btn_2_line_height',
		'font-size' => 'btn_2_font_size',
		'font-weight' => 'btn_2_font_weight',
	),
	'.main_content .inverse a.btn2, 
.main_content .inverse a.btn2 *, 
.main_content .inverse a.btn2:hover, 
.main_content .inverse a.btn2:hover *' => array(
		'color' => 'btn_2_color',
	),
	/* Tabs */
	'.tabs.button li a,
.miss_hot_updates_widget .hot_updates_tabs li a,
.tabs_container.framed .tabs li a,
.blog_tabs_container .blog_tabs li a, 
.main_content .woocommerce-tabs .tabs li a' => array(
		'-miss-gradient' => 'tab_gradient',
		'color' => 'tab_color',
		'font-size' => 'tab_font_size',
		'font-weight' => 'tab_font_weight',
	),
	'.miss_hot_updates_widget .hot_updates_tabs li a *, 
.additional_posts_module .blog_tabs_content .post_grid_module .post_grid_content a
' => array(
		'color' => 'tab_color',
	),
	'.tabs.button a.current, 
.tabs.button a:hover, 
.miss_hot_updates_widget .hot_updates_tabs li a.current, 
.miss_hot_updates_widget .hot_updates_tabs li a:hover, 
.tabs_container.framed .tabs li a:hover, 
.tabs_container.framed .tabs li a.current, 
.blog_tabs_container .blog_tabs li a:hover, 
.blog_tabs_container .blog_tabs li a.current, 
.woocommerce-tabs .tabs li a:hover,
.woocommerce-tabs .tabs li a.current' => array(
		'-miss-gradient' => 'tab_gradient_hover',
		'color' => 'tab_color_hover',
	),
	'.miss_hot_updates_widget .hot_updates_tabs li a.current *, 
.miss_hot_updates_widget .hot_updates_tabs li a:hover *' => array(
		'color' => 'tab_color_hover',
	),
	'.tabs_container.vertical .tabs li, 
.post_grid_image .custom_quote *, 
.post_grid_image .custom_quote a:hover' => array(
		'color'=> 'alt_text_color',
	),
	'.tabs_container.vertical,
.tabs_content.vertical,
.bp a:hover .badge' => array(
		'background-color'=> array( 'color_frame_gradient' => 'start'),
	),
	'blockquote,
table' => array(
		'border-color'=> array( 'color_frame_gradient' => 'start'),
	),

	'.tabs_container.vertical .tabs.vertical li,
.tabs_container.vertical .tabs.vertical' => array(
		'-miss-gradient' => 'tab_vertical_gradient',
	),
	'.tabs_container.vertical .tabs.vertical li:hover,
.tabs_container.vertical .tabs.vertical li.current' => array(
		'-miss-gradient' => 'tab_vertical_gradient_hover',
	),
	'.tabs_container.vertical .tabs.vertical li a' => array(
		'color' => 'tab_color',
		'font-size' => 'tab_font_size',
		'font-weight' => 'tab_font_weight',
	),
	'.tabs_container.vertical .tabs.vertical li a *' => array(
		'color' => 'tab_color',
	),
	'.tabs_container.vertical .tabs.vertical li:hover a,
.tabs_container.vertical .tabs.vertical li.current a,
.tabs_container.vertical .tabs.vertical li:hover a *,
.tabs_container.vertical .tabs.vertical li.current a *
' => array(
		'color' => 'tab_color_hover',
	),
	/* Toggles */
	'.toggle_frame_set.framed .toggle_header,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header,
.showbiz-container,
.showbiz-container .tofullwidth,
.data-image img,
.blog_index_image_load img, 
.post_grid_image img, 
.single_post_image img' => array(
		'background-color'=> 'toggle_bg',
	),
	'.toggle_frame_set.framed .toggle_header a,
.toggle_frame_set.framed .toggle_header .plus_minus,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header .ui-accordion-header-icon' => array(
		'color' => 'toggle_color',
	),
	'.toggle_frame_set.framed .toggle_header:hover a
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover a,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-state-hover a' => array(
		'color' => 'toggle_color_hover',
	),
	'.toggle_frame_set.framed .toggle_header:hover .plus_minus_alt,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover .ui-accordion-header-icon' => array(
		'color' => 'body_bg_color',
	),
	'.toggle_frame_set.framed .toggle_header .plus_minus,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header .ui-accordion-header-icon' => array(
		'background-color' => 'body_bg_color',
	),
	'.toggle_frame_set.framed .toggle_header:hover .plus_minus' => array(
		'color' => 'toggle_color_hover',
	),
	'.toggle_frame_set.framed .toggle_header:hover .plus_minus,
.main_content .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover .ui-accordion-header-icon' => array(
		'background-color'=> 'toggle_color_hover',
	),

	/* Color Frame And Bottom Bulk Box Field And Framed Tabs */
	'.color_frame, 
.after_main_content,
.woocommerce table.shop_table, 
.miss_hot_updates_widget .hot_updates, 
.tabs_container.framed .tabs_content.framed, 
.blog_tabs_content, 
.post_grid_image .custom_quote,
.woocommerce-tabs .panel, 
.woocommerce > form, 
.product_item:hover .bottom_bulk_box_field, 
.benefit.box, 
.testimony_avatar, 
.before_footer_twitter, 
.audioplayer .player-controls' => array(
		'-miss-gradient' => 'color_frame_gradient',
	),
	'.color_frame .wrap, 
.after_main_content,
.miss_hot_updates_widget .hot_updates .wrap, 
.tabs_container.framed .tabs_content .wrap, 
.portfolio_item .second_layer,
.tabs_container.vertical .tabs_content .tabs_wrap, 
#comments .blog_tabs_container .blog_tabs_content, 
.share_this_module,
.post .post_nav_module,
.blog_tabs_content .post_grid, 
.woocommerce-tabs .panel .wrap, 
.product_item:hover .frame .wrap, 
.product_item:hover .bottom_bulk_box_field .box, 
.audioplayer .player-controls,
blockquote,
.post.type-post .single_content .rating_box' => array(
		'background-color' => 'color_frame_wrap_bg',
		'color' => 'body_color',
	),
	'body,
.loop_module.portfolio .post_grid_image, 
.gallery.air, 
.pricetable-inner .pricetable-column .pricetable-column-inner .table-head, 
.pricetable-inner .pricetable-column .pricetable-column-inner .features,
.blog_tabs_content .commentlist, 
.woocommerce > form > table.shop_table,
.woocommerce #order_review #payment div.payment_box, 
.woocommerce-page #order_review #payment div.payment_box, 
.tabs_content.vertical .tabs_wrap, 
.featured_tabs_content ' => array(
		'background-color' => 'body_bg_color',
		'color' => 'body_color',
	),
	'.boxed_layout .loop_module.portfolio .post_grid_image, 
.boxed_layout .gallery.air, 
.boxed_layout .pricetable-inner .pricetable-column .pricetable-column-inner .table-head, 
.boxed_layout .pricetable-inner .pricetable-column .pricetable-column-inner .features,
.boxed_layout .blog_tabs_content .commentlist, 
.boxed_layout .woocommerce > form > table.shop_table,
.boxed_layout .woocommerce #order_review #payment div.payment_box, 
.boxed_layout .woocommerce-page #order_review #payment div.payment_box, 
.boxed_layout .tabs_content.vertical .tabs_wrap, 
.boxed_layout .featured_tabs_content ' => array(
		'background-color' => 'boxed_bg_color',
	),
	'.woocommerce #order_review #payment div.payment_box:after, 
.woocommerce-page #order_review #payment div.payment_box:after 
' => array(
		'border-bottom-color' => 'body_bg_color',
	),

	/* Sidebar Framed Caption */
	'.sidebar_framed_caption, 
.sidebar .widgettitle, 
.woocommerce .color_frame .wrap h3, 
.woocommerce .checkout #order_review_heading, 
.cart-collaterals .cart_totals h2, 
.miss_gallery .gallery_info .widgettitle, 
.woocommerce .checkout .color_frame .wrap h3, 
.woocommerce .checkout #order_review_heading' => array(
/*
		'-miss-gradient' => 'sidebar_framed_caption_gradient',
*/
		'color' => 'sidebar_framed_caption_color',
		'font-size' => 'sidebar_framed_caption_font_size',
		'font-weight' => 'sidebar_framed_caption_font_weight',
	),
	/* Inverse colors */
	'.main_content .inverse h1,
.main_content .inverse h2,
.main_content .inverse h3,
.main_content .inverse h4,
.main_content .inverse h5,
.main_content .inverse h6,
.main_content .inverse h7' => array(
		'color' => 'before_footer_caption_color',
	),
	'.main_content .inverse *' => array(
		'color' => 'before_footer_text_color',
	),
	'.main_content .inverse a,
.main_content .inverse a *,
.showbiz-title,
.showbiz-title a,
.showbiz-title a:visited,
.showbiz-title a:hover' => array(
		'color' => 'before_footer_link_color',
	),
	'.main_content .inverse a:hover, 
.main_content .inverse a:hover *' => array(
		'color' => 'before_footer_link_color_hover',
	),
	'.main_content .inverse a[class*="btn1"],
.main_content .inverse a[class*="btn1"] *' => array(
		'color' => 'btn_1_color',
	),
	'.main_content .inverse a[class*="btn1"]:hover, 
.main_content .inverse a[class*="btn1"]:hover *' => array(
		'color' => 'btn_1_color',
	),
	'.main_content .inverse i' => array(
		'color' => 'before_footer_icon_color_hover',
	),
	'.main_content .inverse i:hover' => array(
		'color' => 'before_footer_icon_color',
	),
	/* Sidebar WIDGETS */
	'.sidebar .widget, 
.miss_twitter_widget ul li a .comment' => array(
		'color' => 'sidebar_widget_text_color',
	),
	'.sidebar .widget a' => array(
		'color' => 'sidebar_widget_link_color',
		'font-size' => 'sidebar_widget_link_font_size',
		'font-weight' => 'sidebar_widget_link_font_weight',
	),
	'.sidebar .widget a:hover,
.sidebar .widget a:hover:before' => array(
		'color' => 'sidebar_widget_link_color_hover',
	),

	/* Extra Header */
	'.extra_header' => array(
		'font-size' => 'extra_header_font_size',
		'height' => 'extra_header_height',
		'color' => 'extra_header_text_color',
		'background-color' => 'extra_header_bg_color',
		'background-image' => 'extra_header_bg_image',
		'background-repeat' => 'extra_header_bg_repeat',
		'background-position' => 'extra_header_bg_position',
		'background-attachment' => 'extra_header_bg_attachment',
	),
	'.extra_header, .extra_header a, .extra_header a:link, .extra_header a:visited' => array(
		'font-size' => 'extra_header_font_size',
		// 'line-height' => 'extra_header_height',
	),
	'.extra_header a, .extra_header a:link, .extra_header a:visited' => array(
		'color' => 'extra_header_link_color',
	),
	'.extra_header a:hover' => array(
		'color' => 'extra_header_hover_color',
	),

	/* Header */
	'.site_info' => array(
		'background-color' => 'header_bg_color',
		'background-repeat' => 'header_bg_repeat',
		'background-position' => 'header_bg_position',
		'background-attachment' => 'header_bg_attachment',
		'-miss-gradient' => 'header_gradient',
		'background-image' => 'header_bg_image',
		'font-family' => 'header_font_family',
	),

	'header' => array(
		'background-repeat' => 'main_menu_bg_repeat',
		'background-position' => 'main_menu_bg_position',
		'background-attachment' => 'main_menu_attachment',
		'-miss-gradient' => 'main_menu_gradient',
		'background-image' => 'main_menu_bg_image',
	),
	'header .navbar .nav > li > a' => array(
		'background-color' => 'main_menu_item_bg_color',
		'color' => 'main_menu_color',
		'font-family' => 'main_menu_font_family',
		'font-size' => 'main_menu_font_size',
		'font-weight' => 'main_menu_font_weight',
	),
	'header .navbar .nav > li:hover > a, 
header .navbar .nav > .current-menu-item > a
' => array(
		'background-color' => 'main_menu_item_bg_color_hover',
		'color' => 'main_menu_color_hover',
	),
	'header .navbar .nav > li > a > i,
.navbar .btn-menu,
.navbar .btn-menu i
' => array(
		'color' => 'main_menu_icon_color',
	),
	'header .navbar .nav > li:hover > a > i, 
header .navbar .nav > .current-menu-item > a > i
' => array(
		'color' => 'main_menu_icon_color_hover',
	),
	'header .navbar .nav > li:hover > a:before, 
header .navbar .nav > .current-menu-item > a:before,
header .navbar .nav .nav-search-box .search-form .search-input,
header .navbar .nav .nav-search-box .search-form fieldset' => array(
		'background-color' => 'main_menu_dropdown_border_color',
	),
	'header .navbar .nav .nav-search-box .search-form .search-input' => array(
		'color' => 'alt_text_color',
	),
	'header .navbar .nav .nav-search-box .search-form input.search-input::-webkit-input-placeholder, 
header .navbar .nav .nav-search-box .search-form input.search-input:-moz-placeholder, 
header .navbar .nav .nav-search-box .search-form input.search-input:-ms-input-placeholder' => array(
		'color' => 'alt_text_color',
	),
	'header .navbar .nav > li:hover > a:after, 
header .navbar .nav > .current-menu-item > a:after,
header .navbar .nav .nav-search-box .search-form fieldset:before' => array(
		'border-bottom-color' => 'main_menu_dropdown_border_color',
	),

	'.nav-collapse .nav>li>a, 
.nav-collapse .dropdown-menu a' => array(
		'font-size' => 'main_menu_font_size',
		'font-weight' => 'main_menu_font_weight',
	),
	'.nav .dropdown-menu.multicolumn_dropdown .dropdown-menu a' => array(
		'font-size' => 'main_menu_dropdown_font_size',
	),
	'.navbar .nav-collapse .dropdown-menu, 
.nav .dropdown-menu > li .after_menu_details ' => array(
		'border-color' => 'main_menu_dropdown_border_color',
	),
	'.nav .dropdown-menu > li .after_menu_details' => array(
		'background-color' => 'main_menu_dropdown_item_bg',
	),
	'.navbar .nav>li>.dropdown-menu:before' => array(
		'border-bottom-color' => 'main_menu_dropdown_border_color',
	),
	'.dropdown-menu,
.dropdown-menu > li, 
.nav-collapse .dropdown-menu,
.nav-collapse .dropdown-menu > li,
.nav-collapse .dropdown-menu > li+li' => array(
		'color' => 'main_menu_dropdown_item_color',
		'background-color' => 'main_menu_dropdown_item_bg',
	),
	'.nav > li > .dropdown-menu.std_dropdown li:hover > a,
.nav > li > .dropdown-menu.std_dropdown li+li:hover > a' => array(
		'color' => 'main_menu_dropdown_item_color_hover',
		'background-color' => 'main_menu_dropdown_item_bg_hover',
	),
	'.nav > li > .dropdown-menu li a:hover,
.nav > li > .dropdown-menu li+li a:hover' => array(
		'color' => 'main_menu_dropdown_item_color_hover',
		'background-color' => 'main_menu_dropdown_item_bg_hover',
	),
	'.nav > li > .dropdown-menu li a:hover *,
.nav > li > .dropdown-menu li+li a:hover *' => array(
		'color' => 'main_menu_dropdown_item_color_hover',
	),
	'.dropdown-menu > *,
.dropdown-menu > li > a, 
.nav-collapse .dropdown-menu a,
.nav-collapse .dropdown-menu li+li a,
.dropdown-menu > li > a i, 
.nav-collapse .dropdown-menu a i,
.nav-collapse .dropdown-menu li+li a i

' => array(
		'color' => 'main_menu_dropdown_item_color',
	),
/*
	'.dropdown-menu li>a:hover, 
.dropdown-menu a:hover,
.dropdown-menu li+li a:hover' => array(
		'color' => 'main_menu_dropdown_item_color_hover',
		'background-color' => 'main_menu_dropdown_item_bg_hover',
	),
*/
	'.nav li > a > .teaser, 
header .navbar .nav .nav-search-box .icosearch' => array(
		'color' => 'main_menu_icon_color'
	),
	/* Page Caption And Before Main Content */
	'.page_caption' => array(
		'-miss-gradient' => 'page_caption_and_before_main_content_sections_gradient',
	),
	'.page_caption #breadcrumbs, 
div.bbp-breadcrumb,
div.bbp-topic-tags' => array(
		'color' => 'breadcrumbs_color',
		'font-size' => 'breadcrumbs_font_size',
	),
	'header .container .row-fluid .span12 .company_logo .site_title h1,
.page_caption h1.page_title, 
h4, 
.blog_header h4, 
.miss_hearts .text .number, 
.miss_hearts.active .icon, 
.summary .product_title, 
.products h2, 
.widgettitle, 
.page_caption h1.page_title, 
.products_loop_module .price .amount, 
.products_loop_content .woocommerce-tabs .panel .wrap h2, 
.products_loop_content .related h2,
.toggle_frame_set .toggle_frame .toggle_accordion a,
.main_content .twitter_time, 
h1,
h2,
h3,
h4,
h5,
h6,
h7' => array(
		'color' => 'most_caption_color',
	),
'h1,
h2,
h3,
h4,
h5,
h6,
h7' => array(
		'font-family' => 'content_h_font_family',
	),
	'h1' => array(
		'font-size' => 'content_h1_font_size',
	),
	'h2' => array(
		'font-size' => 'content_h2_font_size',
	),
	'h3' => array(
		'font-size' => 'content_h3_font_size',
	),
	'h4' => array(
		'font-size' => 'content_h4_font_size',
	),
	'h5' => array(
		'font-size' => 'content_h5_font_size',
	),
	'h6' => array(
		'font-size' => 'content_h6_font_size',
	),
	'section .blog_header h4.caption, 
.products_loop_module .product_title, 
.page_caption h1.page_title, 
.products_loop_content .woocommerce-tabs .panel .wrap h2, 
.products_loop_content .related h2,
.loop_module.blog .loop_content.blog > .post_title a, 
.single_module.post .single_content.post > .post_title, 
.track-info h2.title' => array(
		'font-size' => 'most_caption_font_size',
		'font-weight' => 'most_caption_font_weight',
	),
	'.page_caption h1.page_title span.page_tagline, 
.page_caption #breadcrumbs a, 
.page_caption #breadcrumbs .delimiter,
.blog_header h6,
.sc_layout.post_grid.staff .sociable_icon' => array(
		'color' => 'most_caption_tagline_color',
	),
	'.blog_header h6' => array(
		'font-size' => 'most_caption_font_size',
		'font-weight' => 'most_caption_font_weight',
	),
	'.page_caption h1.page_title span.page_tagline, 
.blog_header h6' => array(
		'font-size' => 'most_caption_tagline_font_size',
		'font-weight' => 'most_caption_tagline_font_weight',
	),
	'.benefit i' => array(
		'color' => 'most_icon_color',
		'border-color' => 'toggle_bg',
	),
	'.testimony_avatar:after' => array(
		'border-left-color' => 'toggle_bg',
	),
	'footer .container .footer_contact_info, 
.miss_in_focus_widget .in_focus .in_focus_bottom .post_title a, 
.benefit.box *, 
.miss_message.success,
.audioplayer .main i, 
.audioplayer .player-controls .duration,
.bp .badge,
.bp a:hover .badge,
.before_footer_twitter *, 
.before_footer_twitter * [class*="fa-icon-"], 
.before_footer_twitter * [class*="im-icon-"] 
' => array(
		'color' => 'alt_text_color',
	),
	/* Preview Info Wrap (circle icon on hover image) */
	'.preview_info_wrap, 
.miss_message.success,
.audioplayer .player-controls .progress .elapsed, 
.showbiz-container .hovercover,
.showbiz-container .linkicon,
.showbiz-container .lupeicon' => array(
		'-miss-gradient' => 'preview_info_wrap_gradient',
	),
	'.preview_info_wrap .controls, 
.preview_info_wrap .controls:hover' => array(
		'color' => 'preview_info_wrap_icon_color',
		'background-color' => 'preview_info_wrap_icon_bg',
	),
	'.preview_info_wrap i[class*="fa-icon-"], 
.main_content .preview_info_wrap i[class*="im-icon-"], 
.main_content .preview_info_wrap .controls:hover i[class*="im-icon-"]' => array(
		'color' => 'preview_info_wrap_icon_color',
	),
	/* Scroll box (recent slider) */
	'.scroll-box .item .description' => array(
		'-miss-gradient' => 'preview_info_wrap_gradient',
	),
	'.scroll-box .item .description *' => array(
		'color' => 'alt_text_color',
	),
	'#ascrail2000-hr, 
.audioplayer .progress' => array(
		'background-color' => 'toggle_bg',
	),
	'#ascrail2000-hr > div' => array(
		'background-color' => array( 'preview_info_wrap_gradient' => 'start' ),
	),
	/* blog layouts */
	'.benefit .header, 
.sc_layout.grid .post_title *, 
.sc_layout.grid .post_title, 
.sc_layout.grid.staff .post_title,
.sc_layout.list > li .post_title,
.loop_module.portfolio .second_layer .portfolio_item_title 
' => array(
		'font-size' => 'shortcodes_grid_title_font_size',
		'font-weight' => 'shortcodes_grid_title_font_weight',
	),
	'.sc_layout.grid .column:hover' => array(
		'border-color' => 'most_link_color_hover',
	),
	/* Boxed Date */
	'.month, .main_content a.month, .main_content a.month:hover' => array(
		'background-color' => 'boxed_date_month_bg',
		'color' => 'boxed_date_month_color',
	),
	'.month .day, .main_content a.month .day' => array(
		'background-color' => 'boxed_date_day_bg',
		'color' => 'boxed_date_day_color',
	),
	'.before_footer .month, .before_footer a.month, .before_footer a.month:hover' => array(
		'background-color' => 'footer_boxed_date_month_bg',
		'color' => 'footer_boxed_date_month_color',
	),
	'.before_footer .month .day, .before_footer a.month .day, .before_footer a.month .day:hover' => array(
		'background-color' => 'footer_boxed_date_day_bg',
		'color' => 'footer_boxed_date_day_color',
	),
	/* Meta Tags and isotope nav and WP Pagenavi */
	'.isonav li a, 
.main_content .wp-pagenavi a, 
.main_content .wp-pagenavi a > *[class*="-icon-"], 
.widget_tag_cloud .tagcloud a, 
.single_module .post_meta .meta_post_tag a, 
.single_module .post_meta .meta_category a, 
.pagination-links .page-numbers,
.wp-pagenavi .pagenavi-pages' => array(
		'-miss-gradient' => 'pagenavi_gradient',
		'color' => 'meta_tags_color',
	),
	'.wp-pagenavi .pagenavi-pages,
.wp-pagenavi a,
.wp-pagenavi .current, 
.pagination-links .page-numbers' => array(
		'-miss-shadow' => 'pagenavi_shadow',
	),
	'.isonav li a:hover, 
.isonav li a.iso-active, 
.main_content .wp-pagenavi a:hover, 
.main_content .wp-pagenavi a:hover > *[class*="-icon-"], 
.main_content .wp-pagenavi .current, 
.widget_tag_cloud .tagcloud a:hover,
.single_module .post_meta .meta_post_tag a:hover, 
.single_module .post_meta .meta_category a:hover, 
.pagination-links .page-numbers.current' => array(
		'-miss-gradient' => 'pagenavi_gradient_hover',
		'color' => 'meta_tags_color_hover',
	),
	'.flex-control-paging li a,
.socialCounterBox' => array(
		'background-color' => 'color_frame_wrap_bg',
	),
	/* Price Tables */
	'.message_center h4' => array(
		'color' => 'alt_caption_color',
	),
	'.message.inverse .message_center, 
.in_focus_bottom .box' => array(
		'background-color' => 'alt_caption_color',
	),
	/* All Post More Link */
	'.post_more_link a' => array(
		'color' => 'post_more_link_color',
	),
	'.post_more_link a:hover' => array(
		'color' => 'post_more_link_color',
	),
	/* All Post links in loop_module or blog_layouts */
	'.sc_layout.grid a, 
.sc_layout.list .post_title a, 
.sc_layout.list .post_meta a, 
.loop_module.blog .loop_content.blog > .post_title a, 
.blog a, 
.miss_gallery .miss_contact_widget ul li span,
.shop_table tbody tr td.product-name a, 
.miss_contact_widget ul li a, 
.main_content .post_meta span i,
.main_content a,
.main_content a > *, 
.main_content a > *[class*="fa-icon-"],
.main_content a > *[class*="im-icon-"],
legend 
' => array(
		'color' => 'most_link_color',
	),
	'.sc_layout.list > li .post_icon i, 
.loop_module.blog .post_icon i, 
.single_module.post .post_icon i' => array(
		'background-color' => 'most_link_color',
		'color' => 'body_bg_color',
	),
	'.loop_module.blog .loop_content.blog .post_title a:hover,
.share_this_module .share_this_content .share_this_list li a:hover,
.blog a:hover,
.sc_layout.grid .column:hover a, 
.sc_layout.list a:hover,
.shop_table tbody tr td.product-name a:hover, 
.miss_contact_widget ul li a:hover, 
.main_content a:hover,
.main_content a:hover > *, 
.main_content a:hover > *[class*="fa-icon-"], 
.main_content a:hover > *[class*="im-icon-"] 
' => array(
		'color' => 'most_link_color_hover',
	),
	/* All Sidebar List Markers and Post Conten Markers (ul li) */
	'.single_module .single_content .post_excerpt ul:not([class]) li:before,
.widget_categories ul li a:before, 
.widget_archive ul li a:before, 
.widget_nav_menu ul li a:before, 
.widget_meta ul li a:before, 
.widget_pages ul li a:before, 
.miss_subnav_widget ul > li a:before, 
.widget_product_categories ul > li a:before' => array(
		'color' => 'sidebar_widget_list_marker_color',
	),
	/* Post nav module (next, previous) */
	'body * .body_text_color,
.single_content.post .post_nav_module a span,
.woocommerce .cart-collaterals .cart_totals table tr th,
.blog .miss_hearts, 
.main_content .miss_hearts,
#socialCounterWidget .title ' => array(
		'color' => 'body_color',
	),
	/* Comments */
	'.commentlist .comment.bypostauthor > div' => array(
		'background-color' => 'comment_by_author_bg',
	),
	/* All Forms Field */
	'#respond #commentform .span4 input, 
#respond #commentform textarea, 
.miss_form .span4 input[type="text"], 
.miss_form .span6 input[type="text"], 
.miss_form .captcha_field input, 
.miss_form textarea, 
.search-form fieldset,
.main_content #group-dir-search, 
.main_content #members-dir-search, 
.woocommerce .input-text, 
input[type="text"], 
input[type="password"], 
body .main_content textarea, 
textarea' => array(
		'background-color' => 'form_field_bg',
		'color' => 'form_field_color',
	),
'.woocommerce .wrap .input-text' => array(
		'background-color' => 'body_bg_color',
	),
'body.boxed_layout .woocommerce .wrap .input-text' => array(
		'background-color' => 'boxed_bg_color',
	),
	'.miss_message.success,
textarea:focus, 
input[type="text"]:focus, 
input[type="password"]:focus, 
input[type="datetime"]:focus, 
input[type="datetime-local"]:focus, 
input[type="date"]:focus, 
input[type="month"]:focus, 
input[type="time"]:focus, 
input[type="week"]:focus, 
input[type="number"]:focus, 
input[type="email"]:focus, 
input[type="url"]:focus, 
input[type="search"]:focus, 
input[type="tel"]:focus, 
input[type="color"]:focus, 
.uneditable-input:focus' => array(
		'border-color' => array( 'color_frame_gradient' => 'start'),
		'-miss-shadow' => array( 'color_frame_gradient' => 'end'),
	),
	/* Before Footer */
	'.before_footer_twitter .twitter_controls div:hover' => array(
		'background-color' => 'before_footer_bg',
	),
	'.before_footer' => array(
		'background-color' => 'before_footer_bg',
		'background-image' => 'before_footer_bg_image',
		'background-repeat' => 'before_footer_bg_repeat',
		'background-position' => 'before_footer_bg_position',
		'background-attachment' => 'before_footer_bg_attachment',
	),
	'.before_footer h4, 
footer h4' => array(
		'color' => 'before_footer_caption_color',
		'font-size' => 'before_footer_caption_font_size',
		'font-weight' => 'before_footer_caption_font_weight',
	),
	'.before_footer h6, footer h6' => array(
		'color' => 'before_footer_caption_tagline_color',
		'font-size' => 'before_footer_caption_tagline_font_size',
		'font-weight' => 'before_footer_caption_tagline_font_weight',
	),
	'.before_footer, 
.before_footer .widget, 
.before_footer .miss_recent_widget .post_list_module .descr, 
.before_footer .miss_twitter_widget ul li a .comment' => array(
		'color' => 'before_footer_text_color',
		'font-size' => 'before_footer_text_font_size',
	),
	'.before_footer a,
	.before_footer .twitter_time' => array(
		'color' => 'before_footer_link_color',
	),
	'.before_footer a:hover,
	.before_footer .twitter_time:hover' => array(
		'color' => 'before_footer_link_color_hover',
	),
	'.miss_twitter_widget ul li a > i' => array(
		'color' => 'before_footer_icon_color',
	),
	'.miss_flickr_widget .flickr_badge_image a' => array(
		'background-color' => 'before_footer_icon_color',
	),
	'.miss_twitter_widget ul li a:hover > i' => array(
		'color' => 'before_footer_icon_color_hover',
	),
	'.miss_flickr_widget .flickr_badge_image a img' => array(
		'border-color' => 'before_footer_icon_color_hover',
	),
	'.miss_flickr_widget .flickr_badge_image a:hover' => array(
		'background-color' => 'before_footer_icon_color_hover',
	),
	/* Footer */
	'footer' => array(
		'background-color' => 'footer_bg',
		'background-image' => 'footer_bg_image',
		'background-repeat' => 'footer_bg_repeat',
		'background-position' => 'footer_bg_position',
		'background-attachment' => 'footer_bg_attachment',
		'color' => 'footer_text_color',
	),

	'footer, 
footer *' => array(
		'color' => 'footer_text_color',
	),
	'footer .navbar .nav li a, 
footer a' => array(
		'color' => 'footer_link_color',
	),
	'footer .navbar .nav li a:hover, 
footer a:hover' => array(
		'color' => 'footer_link_color_hover',
	),
	'footer .sociable a .social_icon i, 
footer i[class]' => array(
		'color' => 'footer_icon_color',
	),
	'footer .sociable a .social_icon i:hover, 
footer i[class]:hover' => array(
		'color' => 'footer_icon_color_hover',
	),
	/* Woocommerce */
	'.products .product_item .onsale, 
.loop_content.products .span5 .onsale' => array(
		'background-color' => 'woo_onsale_bg',
		'color' => 'woo_onsale_color',
		'font-size' => 'woo_onsale_font_size',
		'font-weight' => 'woo_onsale_font_weight',
	),
	'.products .product_item h3 a ' => array(
		'color' => 'woo_product_title_color',
		'font-size' => 'woo_product_title_font_size',
		'font-weight' => 'woo_product_title_font_weight',
	),
	'.products .price .amount, 
.products .price ins .amount, 
.products .price ins ' => array(
		'color' => 'woo_product_price_color',
		'font-size' => 'woo_product_price_font_size',
		'font-weight' => 'woo_product_price_font_weight',
	),
	'.products .price del > .amount,
.products .price del .amount, 
.products .summary .price del .amount ' => array(
		'color' => 'woo_product_old_price_color',
		'font-size' => 'woo_product_old_price_font_size',
		'font-weight' => 'woo_product_old_price_font_weight',
	),
	'.products .add_to_cart_button, 
.products .add_to_cart_button.button' => array(
		'color' => 'alt_text_color',
		'font-size' => 'woo_product_add_to_cart_font_size',
		'font-weight' => 'woo_product_add_to_cart_font_weight',
	),
	'.shop_table thead tr, 
.woocommerce table.shop_table thead th, 
.woocommerce-page table.shop_table thead th' => array(
		'-miss-gradient' => 'woo_table_header_gradient',
		'color' => 'woo_table_header_color',
		'font-size' => 'woo_table_header_font_size',
		'font-weight' => 'woo_table_header_font_weight',
	),
	'.shop_table tbody tr td' => array(
		'font-size' => 'woo_product_title_font_size',
		'font-weight' => 'woo_product_title_font_weight',
	),
	'.shop_table tbody tr.cart_table_item:nth-child(odd), 
.shop_table tbody tr:nth-child(even) td,
.shop_table tbody tr td.actions,
.woocommerce .checkout table.shop_table tr td' => array(
		'background-color' => 'woo_table_odd_row_bg',
	),
	'.shop_table tbody tr.cart_table_item:nth-child(even), 
.shop_table tbody tr:nth-child(odd) td,
.woocommerce .checkout table.shop_table tfoot tr th, 
.woocommerce .cart-collaterals .cart_totals table tr th ' => array(
		'background-color' => 'woo_table_even_row_bg',
		'border-bottom-color' => 'woo_table_odd_row_bg',
	),
	'.shop_table tbody tr td.product-price span, 
.shop_table tbody tr td.product-subtotal span, 
.woocommerce .checkout table.shop_table tr td,
.woocommerce .checkout table.shop_table tr th:first-child, 
.woocommerce .checkout table.shop_table tr td:first-child' => array(
		'color' => 'woo_table_cell_color',
		'font-size' => 'woo_table_cell_font_size',
		'font-weight' => 'woo_table_cell_font_weight',
	),
	'.shop_table tbody tr td.product-remove a.remove' => array(
		'color' => 'woo_table_cell_color',
	),
	'.shop_table tbody tr td.product-remove a.remove:hover' => array(
		'color' => 'woo_table_even_row_bg',
		'background-color' => 'woo_table_cell_color',
	),
	'.woocommerce #order_review #payment, 
.woocommerce-page #order_review #payment' => array(
		'background-color' => 'woo_payment_bg',
	),

	/* Shortcodes and other modifiable colors */

	/* i icons */
	'.im-has_icon_colour,
div[class*="fa-icon-"], 
div[class*="im-icon-"],
.rating_box .active i,
.rating_box .half .cone i' => array(
		'color' => 'most_icon_color',
//		'color' => 'preview_info_wrap_icon_color',
	),
	'[class*="-icon"].box, 
.score.total,
#socialCounterWidget .icon, 
#socialCounterWidget .icon i ' => array(
//		'background-color' => array( 'color_frame_gradient' => 'end'),
		'background-color' => 'most_icon_color',
		'color' => 'body_bg_color',
	),
	/* progress-bars */
	'.progress-bars .caption' => array(
		'color' => array( 'color_frame_gradient' => 'start'),
	),
	'.progress-bars.heavy .caption' => array(
		'color' => 'tab_color',
	),
	'.progress-bars .scorebar' => array(
		'background-color' => 'body_border_color',
	),
	'.progress-bars .scorebar .scorebar-inner' => array(
		'background-color' => array( 'color_frame_gradient' => 'end'),
		'-miss-gradient' => 'color_frame_gradient',
	),
	/* pricetable */
	'.pricetable-inner .pricetable-column .pricetable-column-inner, 
.additional_posts_module .blog_tabs_content .post_grid_module .post_grid_content ' => array(
		'-miss-gradient' => 'tab_gradient',
	),
	'.pricetable-inner .pricetable-column .pricetable-column-inner .table-head .pricetable-name' => array(
		'background-color' => 'color_frame_wrap_bg',
/*
		'color' => 'tab_color_hover',
*/
	),
	'.pricetable-inner .pricetable-column.pricetable-featured .pricetable-column-inner .table-head .pricetable-name' => array(
		'-miss-gradient' => 'color_frame_gradient',
		'color' => 'body_bg_color',
	),
	'.pricetable-inner .pricetable-column .pricetable-column-inner .table-head .price,
.default_table th,
table th' => array(
		'background-color' => 'before_footer_bg',
		'color' => 'alt_text_color',
	),
/*
	'.pricetable-inner .pricetable-column .pricetable-column-inner .table-head .price .currency, 
.pricetable-inner .pricetable-column .pricetable-column-inner .table-head .price .after ' => array(
		'color' => 'most_link_color',
	),
*/
	'.pricetable-inner .pricetable-column.pricetable-featured .pricetable-column-inner .table-head .price .currency, 
.pricetable-inner .pricetable-column.pricetable-featured .pricetable-column-inner .table-head .price .after ' => array(
		'color' => 'body_bg_color',
	),
	'.pricetable-inner .pricetable-column .pricetable-column-inner .features li:nth-child(odd),
.default_table tr:nth-child(odd) td,
table tr:nth-child(odd) td' => array(
		'background-color' => 'color_frame_wrap_bg',
	),
	'.pricetable-inner .pricetable-column .pricetable-column-inner .features .pricetable-feature span' => array(
		'color' => 'body_color',
	),
/*
	'.pricetable-inner .pricetable-column .pricetable-column-inner .features .pricetable-feature .sub' => array(
		'color' => 'body_color',
	),
*/ 

);
$css = '';
foreach( $local as $name => $properties ) {
	$css .= $name . '{' . "\n";
		foreach( $properties as $property => $value ) {
			$miss_tmp = '';
			$this_value = miss_get_css( $value );
			if ( $property == '-miss-gradient' ) {
				$css .= "\t" . miss_css_gradient( $this_value ) . "\n";
			} elseif ( is_array( $value ) ) {
				foreach( $value as $subkey => $subval ) {
					$miss_tmp = miss_get_css( $subkey );
					$value = $miss_tmp[$subval];
				}
				$css .= "\t" . $property . ':' . $value . ';' . "\n";
			} elseif ( $property == '-miss-shadow' ) {
				$css .= "\t" . miss_css_shadow( $this_value ) . "\n";
			} elseif ( $property == 'color' ) {
				//Regenerates IE Compatible Colours
				if ( strpos( $this_value, 'rgba(' ) !== false ) {
					$css .= $this_value ? "\t" . $property . ':' . miss_ms_rgba( $this_value ) . ';' . "\n" : '';
				}
				$css .= $this_value ? "\t" . $property . ':' . $this_value . ';' . "\n" : '';
			} elseif ( $property == 'background-color' ) {
				//Regenerates IE Compatible Colours
				if ( strpos( $this_value, 'rgba(' ) !== false ) {
					$css .= $this_value ? "\t" . $property . ':' . miss_ms_rgba( $this_value ) . ';' . "\n" : '';
				}
				$css .= $this_value ? "\t" . $property . ':' . $this_value . ';' . "\n" : '';
			} elseif ( $property == 'border-color' ) {
				//Regenerates IE Compatible Colours
				if ( strpos( $this_value, 'rgba(' ) !== false ) {
					$css .= $this_value ? "\t" . $property . ':' . miss_ms_rgba( $this_value ) . ';' . "\n" : '';
				}
				$css .= $this_value ? "\t" . $property . ':' . $this_value . ';' . "\n" : '';
			} elseif ( $property == 'background-image' ) {
				$bg_value = $this_value;
				if ( !empty( $bg_value ) && $bg_value != 'none') {
					$css .= "\t" . $property . ':url(' . $bg_value . ');' . "\n";
				}

			} else {
				$css .= $this_value ? "\t" . $property . ':' . $this_value . ';' . "\n" : '';
			}
		}
	$css .= '}' . "\n";
}

miss_generate_css_cache( $css );
?>