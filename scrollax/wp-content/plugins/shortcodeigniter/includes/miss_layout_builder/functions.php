<?php

class tinymce_layout_builder {

	function __construct() {
		add_filter('mce_external_plugins', array( &$this, 'add_tcustom_tinymce_plugin' ));
		add_filter('mce_buttons_3', array(&$this, 'register_button' ));
	}
	
	//include the tinymce javascript plugin
	function add_tcustom_tinymce_plugin($plugin_array) {
		global $ShortcodeIgniterPath;
		$plugin_array['miss_mce_plugin_shortcode_layout_builder'] =  plugins_url ( '/miss_layout_builder/plugin.js', dirname( __FILE__ ) );
		return $plugin_array;
	}

	//include the css file to style the graphic that replaces the shortcode
	function myformatTinyMCE($in) {
		$in['content_css'] .= ",".WP_PLUGIN_URL.'/tinymce-graphical-shortcode/tinymce-plugin/icitspots/editor-style.css';
		return $in;
	}

	// used to insert button in wordpress 2.5x editor
	function register_button($buttons) {
		array_unshift( $buttons, '', 'miss_createColumn', 'miss_removeColumn', 'miss_lineBefore', 'miss_lineAfter', 'separator', 'separator' );
		return $buttons;
	}

}

add_action("init", create_function('', 'new tinymce_layout_builder();'));

?>
