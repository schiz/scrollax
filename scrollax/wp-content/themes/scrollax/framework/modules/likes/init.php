<?php

/**
 * Get Post likes array
 */
function miss_get_post_likes_array( $post_id ) {
	$meta_values = get_post_meta( $post_id, 'miss_post_likes', true );
	if ( isset( $meta_values ) && is_array( $meta_values ) ) {
		return $meta_values;
	} else {
		return false;
	}
}
/**
 * Verify user and post
 */
function miss_verify_like( $post_id, $uid ) {
	$likes = miss_get_post_likes_array( $post_id );
	if ( isset( $likes ) && isset( $likes[$uid] ) ) {
		return 'dislike';
	} else {
		return 'like';
	}
}
/**
 * Like post
 */

function miss_like_this_post( $post_id, $uid ) {
	/* like */
	//dev: reset
	//update_post_meta($post_id, 'miss_post_likes', '0');
	$miss_like_state = miss_verify_like( $post_id, $uid );
	if ( $miss_like_state == 'like' ) {
		$instance = miss_get_post_likes_array( $post_id );
		$new_instance = array( $uid => 1 );


		if ( isset( $instance ) && is_array( $instance ) ) {
			$new_instance = array_merge( $instance, $new_instance );

			// if ( isset($new_instance) && isset($instance[0]) ) {
			// 	unset( $new_instance[0] );
			// }

			$count = count( $new_instance );
			update_post_meta($post_id, 'miss_post_likes', $new_instance);
			update_post_meta($post_id, 'miss_post_likes_total', ( $count ) );
		} elseif ( isset( $instance ) && $instance == 0 ) {

			// if ( isset($new_instance) && isset($instance[0]) ) {
			// 	unset( $new_instance[0] );
			// }

			$count = count( $new_instance );

			update_post_meta($post_id, 'miss_post_likes', $new_instance);
			update_post_meta($post_id, 'miss_post_likes_total', ( $count ) );
		} else {

			// if ( isset($new_instance) && isset($instance[0]) ) {
			// 	unset( $new_instance[0] );
			// }

			$count = count( $new_instance );
			add_post_meta($post_id, 'miss_post_likes', $new_instance);
			add_post_meta($post_id, 'miss_post_likes_total', ( $count ) ) ;
		}
		return array( 'count' => $count, 'state' => $miss_like_state );
	} else {
		/* unlike */
		$instance = miss_get_post_likes_array( $post_id );
		// if ( isset($instance) && isset($instance[0]) ) {
		// 	unset( $instance[0] );
		// }
		if ( isset( $instance ) && is_array( $instance ) ) {
			unset( $instance[$uid] );
			if ( count( $instance ) == 0 ) {
				$new_instance = '0';
			} else {
				$new_instance = $instance;
			}
			$count = count( $instance );
			update_post_meta($post_id, 'miss_post_likes', $new_instance);
			update_post_meta($post_id, 'miss_post_likes_total', ( $count ) );

		}
		//  else {
		// 	$new_instance = '0';
		// 	$count = count( $instance );
		// 	add_post_meta($post_id, 'miss_post_likes', $new_instance, false);
		// 	add_post_meta($post_id, 'miss_post_likes_total', ( $count ), false );
		// }
		return array( 'count' => $count, 'state' => $miss_like_state );
	}
}



/**
 * Parse Requests
 */
if ( isset( $_POST['miss-like'] ) ) {
	header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache");
	header("Content-type: application/json");
	if ( miss_get_basic_user_identification() ) {
		$response = miss_like_this_post( $_POST['post_id'], miss_get_basic_user_identification() );
		
		echo '{"success": true, "response": {"count": "' . ( $response['count'] ) . '", "state": "' . $response['state'] . '"}}';
	} else {
		echo '{"success": false, "error": "' . __('Your browser doesn\'t support cookies. Please enable cookies first!', MISS_TEXTDOMAIN) . '"}';
	}

	get_post_meta( $_POST['post_id'], 'miss_post_likes_total', true );
	exit;
}
?>