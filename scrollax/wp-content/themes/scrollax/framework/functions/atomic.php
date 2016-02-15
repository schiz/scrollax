<?php
/**
 * Theme Atomic Methods
 *
 * @since 1.7
 */

/**
 * do_atomic( @tag=string, @args=array )
 */
function do_atomic( $tag = '', $args = array() ) {
	if ( !$tag )
		return false;

	# Get the theme prefix.
	$pre = MISS_PREFIX;

	# Do actions on the basic hook.
	do_action( "{$pre}_{$tag}", $args );

	# Loop through context array and fire actions on a contextual scale.
	foreach ( (array)miss_get_context() as $context ) {
		do_action( "{$pre}_{$context}_{$tag}", $args );
	}
}

/**
 * apply_atomic( @tag=string, @value=string )
 */
function apply_atomic( $tag = '', $value = '' ) {
	if ( !$tag )
		return false;

	# Get theme prefix.
	$pre = MISS_PREFIX;

	# Apply filters on the basic hook.
	$value = apply_filters( "{$pre}_{$tag}", $value );

	# Loop through context array and apply filters on a contextual scale.
	foreach ( (array)miss_get_context() as $context ) {
		$value = apply_filters( "{$pre}_{$context}_{$tag}", $value );
	}
	# Return the final value once all filters have been applied.
	return $value;
}

/**
 * apply_atomic_shortcode( @tag=string, @value=string )
 */
function apply_atomic_shortcode( $tag = '', $value = '' ) {
	return do_shortcode( apply_atomic( $tag, $value ) );
}

?>