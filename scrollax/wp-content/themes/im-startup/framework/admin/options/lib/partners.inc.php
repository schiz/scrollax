<?php
/**
 * Partners
 * @since 1.5
 */

$option_tabs['miss_partners_tab'] = array('class' => 'partners', 'title' => __( 'Partners', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_partners_tab' => $option_tabs ),
		'class'=> 'partners',
		'icon' => 'icon-partners.png',
		'type' => 'tab_start'
	),

	array(
		'name' => __( 'Displaying options', MISS_ADMIN_TEXTDOMAIN ),
		'desc' => __( 'Partners displaying options.', MISS_ADMIN_TEXTDOMAIN ),
		'id' => 'disable_partners_section',
		'options' => array( 
			'display_all' => __( 'Display partners on all pages', MISS_ADMIN_TEXTDOMAIN ), 
			'only_front_page' => __( 'Keep partners ONLY for Front page', MISS_ADMIN_TEXTDOMAIN ), 
			'disable_all' => __( 'Disable partners globally', MISS_ADMIN_TEXTDOMAIN ), 
		),
		'type' => 'radio'
	),

	array(
		'name' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
		'desc' => __( 'Caption for partners block.', MISS_ADMIN_TEXTDOMAIN ),
		'id' => 'partners_caption',
		'default' => 'Some of Our Clients',
		'htmlspecialchars' => true,
		'type' => 'text'
	),

	array(
		'name' => __( 'Tagline', MISS_ADMIN_TEXTDOMAIN ),
		'desc' => __( 'Alternative title for partners block.', MISS_ADMIN_TEXTDOMAIN ),
		'id' => 'partners_tagline',
		'default' => 'Innovation and Excellence',
		'htmlspecialchars' => true,
		'type' => 'text'
	),

	array(
		'name' => __( 'Partners', MISS_ADMIN_TEXTDOMAIN ),
		'desc' => __( 'Partners Generator helping create link and add partner\'s logo to website footer.', MISS_ADMIN_TEXTDOMAIN ),
		'id' => 'partners',
		'type' => 'partners'
	),
	
	array(
		'type' => 'tab_end'
	),
);
?>
