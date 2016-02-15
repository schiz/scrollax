<?php
/*
 * Generate Isotope Navigation
 * @since 1.5
 */

 if ( !function_exists( "miss_isotope_categories" ) ) :
 function miss_isotope_categories($taxonomy, $terms) {
	if ( is_array ( $terms ) ) {
		$term = Array();
		foreach($terms as $key => $slug) {
			$termObj = get_term_by( 'slug', $slug, $taxonomy );
			if ( is_object( $termObj ) ) {
				$term[] = $termObj->term_id;
			}
		}
	}
	$out = '';
	if ( isset( $terms ) && is_array( $terms ) ) {
		$out .= '<ul id="categories" class="isonav clearfix">';
		$out .= '<li><a href="#" data-filter="*" class="iso-active">'. __( 'Show All', MISS_TEXTDOMAIN ) .'</a></li>';
		$out .= wp_list_categories( array( 'title_li' => '', 'taxonomy' => $taxonomy, 'echo' => false, 'include' => implode(",", $term), 'walker' => new missIsotopeWalker() ) );
		$out .= '</ul>';
	}
	return $out;
 }
endif;

?>