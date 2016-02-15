<?php

// media uploader for gallery filter
function miss_f_album_mu($tabs) {
	if ( isset( $_REQUEST['post_id'] ) && 'miss_gallery' == get_post_type( $_REQUEST['post_id'] ) && ! empty( $_GET['miss_custom'] ) ) {
		global $wpdb;
        
        if( isset($tabs['library']) ) {
			unset($tabs['library']);
		}
		
        if( isset($tabs['gallery']) ) {
			unset($tabs['gallery']);
		}
        
        if( isset($tabs['type_url']) ) {
			unset($tabs['type_url']);
		}
        
        $post_id = intval($_REQUEST['post_id']);
  
        if ( $post_id ) {
            $attachments = intval( $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status != 'trash' AND post_parent = %d", $post_id ) ) );
        }
        
        if ( empty($attachments) ) {
            unset($tabs['gallery']);
            return $tabs;
        }
    
		if( !isset($tabs['miss_gallery_media'])) {
			$tabs['miss_gallery_media'] = sprintf( _x( 'Images (%s)', 'backend gallery', MISS_ADMIN_TEXTDOMAIN ), "<span id='attachments-count'>$attachments</span>");
		}
        
        if( isset($tabs['type']) ) {
            $tabs['type'] = 'Upload';
        }
	}
	return $tabs;
}
add_filter('media_upload_tabs', 'miss_f_album_mu', 99 );

// filter prevent loading gallery after save uploaded images
function miss_f_album_aftos( $post, $attachments ) {
    if( 'miss_gallery' == get_post_type($_REQUEST['post_id']) && !empty($_GET['miss_custom']) ) {
        if( isset($_GET['tab']) && 'type' == $_GET['tab']) {
            unset($_POST['save']);
        }
    }
    return $post;
}
add_filter( 'attachment_fields_to_save', 'miss_f_album_aftos', 99, 2 );

// add custon column 'miss_album_thumbs' in albums list for thumbnails
function miss_f_album_col_thumb( $defaults ){
    $defaults['miss_album_cat'] = _x( 'Category', 'backend albums', MISS_ADMIN_TEXTDOMAIN );
	
	$head = array_slice( $defaults, 0, 1 );
    $tail = array_slice( $defaults, 1 );
    
    $head['miss_album_thumbs'] = _x( 'Thumbs', 'backend albums', MISS_ADMIN_TEXTDOMAIN );
    
    $defaults = array_merge( $head, $tail );
    
    return $defaults;
}
add_filter('manage_edit-miss_gallery_columns', 'miss_f_album_col_thumb', 5);

function miss_f_album_hide_mboxes( $hidden, $screen, $use_defaults ) {
    $template = miss_core_get_template_name();
    if( 'miss-albums-fullwidth.php' == $template || 'miss-albums-sidebar.php' == $template ) {
        $meta_boxes = miss_core_get_metabox_list();
        if( !empty($meta_boxes) ) {
            $hidden = array_unique( array_merge($hidden, $meta_boxes) );
             
            foreach( $hidden as $index=>$box ){
                if( 'miss_page_box-albums_list' == $box ||
                    'miss_page_box-albums_options' == $box ||
                    'miss_page_box-footer_options' == $box ||
					'miss_page_box-background_options' == $box ||
                    ('miss-albums-sidebar.php' == $template && 'miss_page_box-sidebar_options' == $box)
                ) {
                    unset( $hidden[$index] );
                }
            }
        }
    }
    return $hidden;
}
add_filter('hidden_meta_boxes', 'miss_f_album_hide_mboxes', 99, 3);

?>
