<?php
/**
 * Skin Generator
 * @since 1.0
 */

class missIconsGenerator {
	
	private $default;
	private $patterns;
	private $stylesheet;
	private $load_type;
	private $colorscheme;
	private $stylesdir;
	
	/**
	 *
	 */
	function __construct() {
		if ( !is_admin() ) return;
			
		add_action( 'admin_init', array( &$this, 'init' ) );

		// $this->assign_patterns();
		// $this->styles_dir();
		// $this->activate_skin( 'ux.model.aqua.php', $suppress_msg = true, $init = true );
		// $this->default = 'ux.model.aqua.php';
	}
	
	/**
	 *
	 */
	// function assign_patterns() {
	// 	$this->patterns = array();
	// 	$this->patterns['background']['patterns'] = 'Background';
	// 	$this->patterns['color']['patterns'] = 'Color';
	// 	$this->patterns['link']['patterns'] = 'Link';
	// 	$this->patterns['typography']['patterns'] = 'Font';
	// 	$this->patterns['border']['patterns'] = 'Border';
	// 	$this->patterns['toggle_start']['patterns'] = ' ~';
	// 	$this->patterns['toggle_end']['patterns'] = 'End ~';
	// }
	
	/**
	 *
	 */
	function init() {

		if ( miss_ajax_request() ) {
			if ( isset( $_POST['_miss_get_icons_ajax'] ) ) {

				$icons = miss_get_all_font_icons();
				$out = '';
				foreach ( $icons as $key => $option ) {
				    if($key) {
					    $out .= '<a class="im_icon_selector im_' . $key . '" href="#" title="Class: '.$key.'" rel="'.$key.'"><i class="'.$key.'" ></i><span class="hidden">' . $key .'</span></a>';
				    } else {
				        $out .= '<a class="im-no-icon" href="#" rel="">x</a>';
				    }
				}
				$data = array( 'success' => 'true', 'html' => $out );
				$this->json_process( $data );
				// echo $out;
				// exit;
			}
		}

		// if( ( miss_ajax_request() ) && ( isset( $_POST['miss_admin_wpnonce'] ) ) ) {
		// 	check_ajax_referer( MISS_SETTINGS . '_wpnonce', 'miss_admin_wpnonce' );
			
		// 	# Load skin to edit
		// 	if( isset( $_POST['_miss_skin_ajax_load'] ) ) {
				
		// 		if( $_POST['_miss_skin_ajax_load'] == 'create' )
		// 			$this->stylesheet = $this->default;
		// 		else
		// 			$this->stylesheet = $_POST['_miss_skin_ajax_load'];
				
		// 		$this->load_type = $_POST['skin_generator'];
				
		// 		$data = array( 'success' => 'skin_edit', 'html' => $this->options_output() );
		// 		$this->json_process( $data );
				
		// 	# Save new skin
		// 	} elseif( isset( $_POST['_miss_save_custom_skin'] ) ) {
		// 		if( isset( $_POST['_miss_save_manage_skin'] ) )
		// 			$this->stylesheet = $_POST['_miss_save_manage_skin'];
		// 		else
		// 			$this->stylesheet = $this->default;
				
		// 		$data = $this->file_write( $_POST['custom_skin_name'] );
		// 		$this->json_process( $data );
				
		// 	# Save existing skin
		// 	} elseif( isset( $_POST['_miss_save_existing_skin'] ) ) {
		// 		$this->stylesheet = $_POST['_miss_save_manage_skin'];
		// 		$data = $this->file_write( $_POST['_miss_save_manage_skin'], $overwrite = true );
		// 		$this->json_process( $data );

		// 	# Advanced Skin Edit
		// 	} elseif( isset( $_POST['_miss_advanced_skin_edit'] ) ) {
		// 		$this->stylesheet = $_POST['_miss_advanced_skin_edit'];
		// 		$data = array( 'success' => 'skin_advanced', 'html' => $this->advanced_edit() );
		// 		$this->json_process( $data );
				
		// 	# Load skins to manage
		// 	} elseif( isset( $_POST['_miss_manage_custom_skin'] ) ) {
		// 		$data = array( 'success' => 'skin_edit', 'html' => $this->manage_skin() ); //skin_manage
		// 		$this->json_process( $data );

		// 	# Activate new skin
		// 	} elseif ( isset( $_POST['_miss_activate_skin'] ) ) {
		// 		$data =  $this->activate_skin( $_POST['_miss_activate_skin'], $suppress_msg = false );
		// 		$this->json_process( $data );
				
		// 	# Delete skin
		// 	} elseif ( isset( $_POST['_miss_delete_custom_skin'] ) ) {
		// 		$data = $this->delete_skin( $_POST['_miss_delete_custom_skin'] );
		// 		$this->json_process( $data );
			
		// 	# Export skin
		// 	} elseif ( isset( $_POST['_miss_export_custom_skin'] ) ) {
		// 		$data = $this->file_export( $_POST['_miss_export_custom_skin'] );
		// 		$this->json_process( $data );
				
		// 	# Upload skin	
		// 	} elseif ( isset( $_POST['_miss_upload_custom_skin'] ) ) {
		// 		$data = $this->unzip_skin( $_POST['_miss_upload_custom_skin'] );
		// 		$this->json_process( $data );
		// 	}
		// }
		
	}
	
	/**
	 *
	 */
	function json_response( $args = array() ) {
		extract( $args );
		
		if( $type == 'skin_saved' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; saved.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'skin_activated' )
			return sprintf( __( 'Style &quot;%1$s&quot; has been activated.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_activated' )
			return __( 'Error: Custom skin not activated, please try again.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_exists' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; already exists, please select a different name.', MISS_ADMIN_TEXTDOMAIN ), $name );
		
		elseif( $type == 'not_saved' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not saved, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'unzipped' )
			return sprintf( _n( 'Upload Successful. The following skin was added: %1$s', 'Upload Successful. sThe following skins were added: %1$s', count( $cssfile ) ), join( ', ', $cssfile ) );
			
		elseif( $type == 'not_unzipped' )
			return __( 'Error: The skin you uploaded could not be unzipped.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'unzipped_nocss' )
			return __( 'Error: No valid &quot;.css&quot; files were found.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_deleted' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; has been deleted.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_deleted' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not deleted, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'active_skin' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; is currently the active skin, please deactivate it before deleting.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'error_loading' )
			return sprintf( __( 'There was an error loading the following skin &quot;%1$s&quot;, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported_2' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_exported_img' )
			return sprintf( _n( 'The following image could not be add to your export, it will have to be added to your skin manually: %1$s', 'The following images could not be add to your export, they will have to be added to your skin manually: %1$s', count( $image_error ) ), join( ', ', $image_error ) );
			
		elseif( $type == 'upload_error' )
			return sprintf( __( 'Error: The skin %1$s could not be uploaded, unzip it manually and upload it to the following directory on your server: %2$s', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'upload_exists' )
			return sprintf( __( 'The skin %1$s already exists.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'invalid_ext' )
			return __( 'Error: File has an invalid extension, it should be .zip', MISS_ADMIN_TEXTDOMAIN );
	}


	/**
	 *
	 */
	function json_process( $data ) {
		$content = ( miss_ajax_request() ) ? 'application/json;' : 'text/html;';
		$echo = json_encode( $data );
		@header( "Content-Type: {$content} charset=" . get_option( 'blog_charset' ) );
		echo $echo;
		exit();
	}

	
}

?>
