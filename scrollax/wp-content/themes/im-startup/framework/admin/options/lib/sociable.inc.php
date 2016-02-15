<?php
/**
 * Sociable
 * @since 1.5
 */

$option_tabs['miss_sociable_tab'] = array('class' => 'social', 'title' => __( 'Sociable', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_sociable_tab' => $option_tabs ),
		'class'=> 'social',
		'icon' => 'icon-social.png',
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Twitter username', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter twitter user name (screen name).', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'twitter_id',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),


		array(
			'name' => __( 'Twitter access token', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter global oAuth access token.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'oauth_access_token',
			'help' => __( 'You can get Twitter API 1.1 tokens from dev.twitter.com. Please <a href="http://cdn.irishmiss.com/d/startup/doc-twitter-oauth.html">follow API 1.1 instructions here</a>', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),

		array(
			'name' => __( 'Twitter access secret', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter global oAuth access secret.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'oauth_access_token_secret',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),

		array(
			'name' => __( 'Twitter consumer key', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter global consumer key.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'consumer_key',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),

		array(
			'name' => __( 'Twitter consumer secret', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter global consumer secret.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'consumer_secret',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
        
		array(
			'name' => __( 'Sociable Heading', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please enter Sociable Heading.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sociable_heading',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),

		array(
			'name' => __( 'Sociable', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Sociable Generator helping link and add social icons to website', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sociable',
			'type' => 'sociable'
		),
		
	array(
		'type' => 'tab_end'
	),
);
