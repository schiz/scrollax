<?php
/* Initial Options */
$options_array = Array( );
$option_tabs = Array( );

$libs = array(
	'general',
	/*'home',*/
	'branding',
	/*'skins',*/
	'resize',
	'layout-blog',
	'pages',
	/*'reviews',*/
	/*'sidebars',*/
	'partners',
	'sociable',
	'slider',
	'store',
	'advanced',
	'footer',
	'support'
);

foreach( $libs as $lib ) {
	include_once( 'lib/' . $lib . '.inc.php' );
	if ( is_array( $option_store ) ) {
		$options_array = array_merge( $options_array, $option_store );
	}
}

$options = Array(
	array(
		'name' => $option_tabs,
		'type' => 'navigation'
	),
);

$options = array_merge( $options, $options_array );

return array(
	'load' => true,
	'name' => 'options',
	'options' => $options
);
