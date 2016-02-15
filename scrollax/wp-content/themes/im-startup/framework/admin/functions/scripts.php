<?php

/**
 *
 */
function miss_admin_enqueue_scripts( $hook ) {
	global $wp_version;
	if ( in_array( $hook,  array( 'appearance_page_miss-options' ) ) ) {
		$url = THEME_URI;
		echo "<script type=\"text/javascript\">
		//<![CDATA[
			var missAjaxUrl = '$url/lib/admin/ajax',
			    missWpVersion = '$wp_version';
		//]]>\r</script>\r";
		//Register Style
		wp_register_style('PTSans', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic,latin-ext', array(), false, 'screen');
		wp_register_style('PTSansN', 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic,latin-ext', array(), false, 'screen');
		wp_register_style('SwankyandMooMoo', 'http://fonts.googleapis.com/css?family=Swanky+and+Moo+Moo', array(), false, 'screen');

		// Enqueue style
		wp_enqueue_style( MISS_PREFIX . '-admin', THEME_ADMIN_ASSETS_URI . '/css/admin.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-admin-menu', THEME_ADMIN_ASSETS_URI . '/css/menu.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-bootstrap', THEME_ADMIN_ASSETS_URI .'/css/bootstrap.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-colorpicker', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/css/bootstrap.colorpicker.css', array(), THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-admin-icofonts', THEME_ASSETS . '/css/fonts/packed.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style('PTSans');
		wp_enqueue_style('PTSansN');
		wp_enqueue_style('SwankyandMooMoo');

		// Enqueue Scripts
		wp_enqueue_script( MISS_PREFIX . '-colorpicker-script', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/js/bootstrap.colorpicker.js', array(), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-jquery-tools', THEME_ADMIN_ASSETS_URI . '/js/jquery.tools.min.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-jquery-md5', THEME_ADMIN_ASSETS_URI . '/js/jquery.md5.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-admin-js', THEME_ADMIN_ASSETS_URI . '/js/admin.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--global', THEME_ADMIN_ASSETS_URI . '/js/im.global.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--common', THEME_ADMIN_ASSETS_URI . '/js/im.common.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--option-tabs', THEME_ADMIN_ASSETS_URI . '/js/im.option.tabs.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--tooltip', THEME_ADMIN_ASSETS_URI . '/js/im.tooltip.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--footersave', THEME_ADMIN_ASSETS_URI . '/js/im.footersave.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--resetunlock', THEME_ADMIN_ASSETS_URI . '/js/im.resetunlock.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--resetconfirm', THEME_ADMIN_ASSETS_URI . '/js/im.resetconfirm.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--save-option', THEME_ADMIN_ASSETS_URI . '/js/im.save.option.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--sidebar', THEME_ADMIN_ASSETS_URI . '/js/im.sidebar.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--delete-sidebar', THEME_ADMIN_ASSETS_URI . '/js/im.delete.sidebar.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--layout', THEME_ADMIN_ASSETS_URI . '/js/im.layout.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--multi-dropdown', THEME_ADMIN_ASSETS_URI . '/js/im.multi-dropdown.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--multi-image', THEME_ADMIN_ASSETS_URI . '/js/im.multi-image.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--toggle-option', THEME_ADMIN_ASSETS_URI . '/js/im.toggle.option.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--toggle-slide', THEME_ADMIN_ASSETS_URI . '/js/im.toggle.slide.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--media', THEME_ADMIN_ASSETS_URI . '/js/im.media.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--color-picker', THEME_ADMIN_ASSETS_URI . '/js/im.colorpicker.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--contactform', THEME_ADMIN_ASSETS_URI . '/js/im.contactform.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--menu', THEME_ADMIN_ASSETS_URI . '/js/im.menu.js', array('jquery','jquery-ui-core', 'jquery-ui-sortable'), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--shortcode', THEME_ADMIN_ASSETS_URI . '/js/im.shortcode.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--skin', THEME_ADMIN_ASSETS_URI . '/js/im.skin.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-dropdown', THEME_ADMIN_ASSETS_URI . '/js/im.custom.dropdown.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-select', THEME_ADMIN_ASSETS_URI . '/js/im.custom.select.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-template', THEME_ADMIN_ASSETS_URI . '/js/im.template.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--savehotkey', THEME_ADMIN_ASSETS_URI . '/js/im.save.hotkey.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--updatesdownloader', THEME_ADMIN_ASSETS_URI . '/js/im.updatesdownloader.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--icons', THEME_ADMIN_ASSETS_URI . '/js/im.icons.js', array( 'jquery' ), THEME_VERSION );

		// Initialize Theme Scripts
		wp_enqueue_script( MISS_PREFIX . '--init', THEME_ADMIN_ASSETS_URI . '/js/im.init.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--init-themeoptions', THEME_ADMIN_ASSETS_URI . '/js/im.init.themeoptions.js', array( 'jquery' ), THEME_VERSION );

		wp_localize_script( MISS_PREFIX . '-admin-js', 'objectL10n', array(
			'resetConfirm' => __( 'This will restore all of your options to default. Are you sure?', MISS_ADMIN_TEXTDOMAIN ),
			'sidebarEmpty' => __( 'Please enter a name for your sidebar.', MISS_ADMIN_TEXTDOMAIN ),
			'sidebarDelete' => __( 'Are you sure you want to delete this sidebar?', MISS_ADMIN_TEXTDOMAIN ),
			'skinEmpty' => __( 'Please enter a name for your custom stylesheet in the &quot;Save Skin As&quot; field.', MISS_ADMIN_TEXTDOMAIN ),
			'skinOverwriteConfirm' => __( 'Are you sure you want to overwrite this stylesheet?', MISS_ADMIN_TEXTDOMAIN ),
			'skinDeleteConfirm' => __( 'Are you sure you want to delete this skin?', MISS_ADMIN_TEXTDOMAIN ),
			'skinUploading' => __( 'Uploading..', MISS_ADMIN_TEXTDOMAIN ),
			'skinUnziping' => __( 'Unziping..', MISS_ADMIN_TEXTDOMAIN ),
			'typeError' => sprintf( __( '%1$s has invalid extension. Only %2$s are allowed.', MISS_ADMIN_TEXTDOMAIN ), '{file}', '{extensions}' ),
			'l10n_print_after' => 'try{convertEntities(objectL10n);}catch(e){};'
		) );
	}
	
	
	if ( in_array( $hook,  array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( MISS_PREFIX . '-admin', THEME_ADMIN_ASSETS_URI . '/css/admin.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-bootstrap', THEME_ADMIN_ASSETS_URI .'/css/bootstrap.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-bootstrap-fix', THEME_ADMIN_ASSETS_URI .'/css/bootstrap-fix.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-colorpicker', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/css/bootstrap.colorpicker.css', array(), THEME_VERSION, 'screen' );
		//Fonts
		wp_enqueue_style( MISS_PREFIX . '-admin-icofonts', THEME_ASSETS . '/css/fonts/packed.css', false, THEME_VERSION, 'screen' );

		/* Pricing Table */
		wp_enqueue_script('placeholder', THEME_ADMIN_ASSETS_URI .'/js/pricetable/placeholder.jquery.js', array('jquery'), '1.1.1', true);
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('pricetable-admin',THEME_ADMIN_ASSETS_URI .'/js/pricetable/pricetable.build.js', array('jquery'), PRICETABLE_VERSION, true);
		
		wp_localize_script('pricetable-admin', 'pt_messages', array(
			'delete_column' => __('Are you sure you want to delete this column?', 'pricetable'),
			'delete_feature' => __('Are you sure you want to delete this feature?', 'pricetable'),
		));
		
		wp_enqueue_style('pricetable-admin', THEME_ADMIN_ASSETS_URI .'/css/pricetable/pricetable.admin.css', array(), PRICETABLE_VERSION);
		wp_enqueue_style('pricetable-icon', THEME_ADMIN_ASSETS_URI .'/css/pricetable/pricetable.icon.css', array(), PRICETABLE_VERSION);
		wp_enqueue_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css', array(), '1.7.0');

		wp_enqueue_script( MISS_PREFIX . '-colorpicker-script', THEME_ADMIN_ASSETS_URI .'/js/colorpicker/js/bootstrap.colorpicker.js', array(), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-jquery-tools', THEME_ADMIN_ASSETS_URI . '/js/jquery.tools.min.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-jquery-md5', THEME_ADMIN_ASSETS_URI . '/js/jquery.md5.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '-admin-js', THEME_ADMIN_ASSETS_URI . '/js/admin.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--global', THEME_ADMIN_ASSETS_URI . '/js/im.global.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--common', THEME_ADMIN_ASSETS_URI . '/js/im.common.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--option-tabs', THEME_ADMIN_ASSETS_URI . '/js/im.option.tabs.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--tooltip', THEME_ADMIN_ASSETS_URI . '/js/im.tooltip.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--footersave', THEME_ADMIN_ASSETS_URI . '/js/im.footersave.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--resetunlock', THEME_ADMIN_ASSETS_URI . '/js/im.resetunlock.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--resetconfirm', THEME_ADMIN_ASSETS_URI . '/js/im.resetconfirm.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--save-option', THEME_ADMIN_ASSETS_URI . '/js/im.save.option.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--sidebar', THEME_ADMIN_ASSETS_URI . '/js/im.sidebar.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--delete-sidebar', THEME_ADMIN_ASSETS_URI . '/js/im.delete.sidebar.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--layout', THEME_ADMIN_ASSETS_URI . '/js/im.layout.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--multi-dropdown', THEME_ADMIN_ASSETS_URI . '/js/im.multi-dropdown.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--multi-image', THEME_ADMIN_ASSETS_URI . '/js/im.multi-image.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--toggle-option', THEME_ADMIN_ASSETS_URI . '/js/im.toggle.option.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--toggle-slide', THEME_ADMIN_ASSETS_URI . '/js/im.toggle.slide.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--media', THEME_ADMIN_ASSETS_URI . '/js/im.media.js', array( 'jquery' ), THEME_VERSION );

		wp_enqueue_script( MISS_PREFIX . '--color-picker', THEME_ADMIN_ASSETS_URI . '/js/im.colorpicker.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--contactform', THEME_ADMIN_ASSETS_URI . '/js/im.contactform.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--menu', THEME_ADMIN_ASSETS_URI . '/js/im.menu.js', array('jquery','jquery-ui-core', 'jquery-ui-sortable'), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--shortcode', THEME_ADMIN_ASSETS_URI . '/js/im.shortcode.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--skin', THEME_ADMIN_ASSETS_URI . '/js/im.skin.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-dropdown', THEME_ADMIN_ASSETS_URI . '/js/im.custom.dropdown.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-select', THEME_ADMIN_ASSETS_URI . '/js/im.custom.select.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--custom-template', THEME_ADMIN_ASSETS_URI . '/js/im.template.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--savehotkey', THEME_ADMIN_ASSETS_URI . '/js/im.save.hotkey.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--icons', THEME_ADMIN_ASSETS_URI . '/js/im.icons.js', array( 'jquery' ), THEME_VERSION );

		// Initialize Theme Scripts
		wp_enqueue_script( MISS_PREFIX . '--init', THEME_ADMIN_ASSETS_URI . '/js/im.init.js', array( 'jquery' ), THEME_VERSION );

	}

	// Scripts for menu
	if ( in_array( $hook,  array( 'nav-menus.php' ) ) ) {
		wp_enqueue_style( MISS_PREFIX . '-smartmenu', THEME_ADMIN_ASSETS_URI .'/css/smart-menu.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_style( MISS_PREFIX . '-admin-icofonts', THEME_ASSETS . '/css/fonts/packed.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_script( MISS_PREFIX . '--global', THEME_ADMIN_ASSETS_URI . '/js/im.global.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--icons', THEME_ADMIN_ASSETS_URI . '/js/im.icons.js', array( 'jquery' ), THEME_VERSION );
		wp_enqueue_script( MISS_PREFIX . '--smart-menu', THEME_ADMIN_ASSETS_URI . '/js/im.smart-menu.js', array( 'jquery' ), THEME_VERSION );
	}

	wp_enqueue_style( MISS_PREFIX . '-admin-global', THEME_ADMIN_ASSETS_URI . '/css/global.css', false, THEME_VERSION, 'screen' );

}

/**
 *
 */
function miss_admin_tinymce() {
	global $wp_version;

	if( version_compare( $wp_version, '3.3', '>=' ) )
	return;
	
	
	if( version_compare( $wp_version, '3.2', '<' ) )
		if (function_exists('wp_tiny_mce')) wp_editor();
	
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}

/**
 *
 */
function miss_tiny_mce_before_init( $initArray ) {
	unset( $initArray['wp_fullscreen_content_css'] );
	$initArray['plugins'] = str_replace( ',wpfullscreen', '', $initArray['plugins'] );
	return $initArray;
}

/**
 *
 */
function miss_admin_print_scripts() {
	echo "<script type=\"text/javascript\">
	//<![CDATA[
	jQuery(document).ready(function(){
		missAdmin.menuSort();
	});
	//]]>\r</script>\r";
}


?>
