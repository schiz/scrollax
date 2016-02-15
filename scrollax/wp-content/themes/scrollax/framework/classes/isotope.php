<?php
/**
 * Isotope Walker
 * @since 1.5
 */
class missIsotopeWalker extends Walker_Category {
	 function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$cat_name = esc_attr( $item->name);
		$link = '<a href="#" data-filter=".term'.$item->term_id.'">' . $cat_name . '</a>';
		if ( 'list' == $args['style'] ) {
			$output .= '<li';
			$class = 'cat-item cat-item-'.$item->term_id;
			if ( isset($current_category) && $current_category && ($item->term_id == $current_category) ) {
				 $class .= ' current-cat';
			}
			elseif ( isset($_current_category) && $_current_category && ($item->term_id == $_current_category->parent) ) {
				 $class .= ' current-cat-parent';
			}
			$output .= '';
			$output .= ">$link\n";
		 } else {
				$output .= "\t$link<br />\n";
		 }
	 }
}
?>