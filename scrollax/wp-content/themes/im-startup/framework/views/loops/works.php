<?php

global $irish_framework_params;

$out = '';

$post_obj = $wp_query->get_queried_object();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$cat = get_post_meta( $post_obj->ID, 'portfolio_term', true );
$limit = get_post_meta( $post_obj->ID, 'portfolio_limit', true ) ? get_post_meta( get_the_ID(), 'portfolio_limit', true ) : 16 ;

$args = array(
	'post_type' => 'portfolio',
/*
	'paged'=> $paged,
	'showposts' => $limit,
*/
	'showposts' => 999,
	'order' => 'desc',
);
if ( isset ( $cat ) && is_array ( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio_category',
			'field' => 'slug',
			'terms' => $cat
		)
	);
}
$loop = new WP_Query();
$loop->query( $args );

$loop->in_the_loop = true; 
	//							print_r ( $loop );

$span = ( get_post_meta( get_the_ID(), 'portfolio_layout', true ) ) ? get_post_meta( get_the_ID(), 'portfolio_layout', true ) : 'span3';
$span .= ( get_post_meta( get_the_ID(), 'portfolio_display_style', true ) ) ? ' ' . get_post_meta( get_the_ID(), 'portfolio_display_style', true ) : '';

echo '<div class="loop_module works portfolio">';
	echo '<div class="loop_content works portfolio">';
		if ( count( $cat ) > 1 ) {
			echo miss_isotope_categories('portfolio_category', $cat);
		}
		echo '<div class="container-isotope">';
			echo '<div class="row-fluid">';
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) {
					$loop->the_post();
					$_term = " ";
					$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
					if($terms) {
						$post_categories = array();
						foreach ($terms as $term) {
							$_term .= 'term'.$term->term_id.' ';
							$post_categories[] = $term->name;
						}
					}
					echo '<div class="' . $span . $_term . 'autoload-item isotope-item portfolio_item">';
						miss_before_post( );
						echo '<div class="first_layer color_frame">';
							echo '<div class="second_layer">';
								echo '<div class="portfolio_item_title">';
									echo '<a href="' . get_permalink() .'">' . get_the_title() . '</a>';
								echo '</div>';
								echo '<div class="portfolio_item_meta">';
								echo implode( $post_categories, ', ');
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				} //while
			}
			echo '</div><!-- /row-fluid -->';
		echo '</div><!-- /container-isotope -->';
	echo '</div><!-- /loop_content -->';
echo '</div><!-- /loop_module -->';

?>