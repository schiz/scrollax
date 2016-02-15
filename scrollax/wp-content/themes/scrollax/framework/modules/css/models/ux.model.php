<?php
/* Check if skin name stored in database and file exists */
$saved_skin_name = get_option( MISS_ACTIVE_SKIN, false);

if ( isset( $saved_skin_name ) && isset( $saved_skin_name['style_variations'] ) && !empty( $saved_skin_name['style_variations'] ) && file_exists( __DIR__ . '/' . $saved_skin_name['style_variations'] ) ) {
	include( $saved_skin_name['style_variations'] );

/* Otherwise returning default style */
} else {
	include( DEFAULT_SKIN . '.php' );
}
?>