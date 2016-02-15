<?php
/**
 *
 */
class missStaff {
	/**
	 *
	 */
	public static function staff_grid( $atts, $content = null, $code = null ) {
		if ( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Staff Grid Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'staff_grid',
				'options' => array(
					array(
						'name' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Here you can add section title (Leave blank to hide).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'type' => 'text',
					),
					array(
						'name' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Here you can add section tagline that will appears right/below after section title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'type' => 'text',
					),
					array(
						'name' => __( 'Number of Columns', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you wish to have your posts displayed in.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'options' => array(
							'2' => __( 'Two Column', MISS_ADMIN_TEXTDOMAIN ),
							'3' => __( 'Three Column', MISS_ADMIN_TEXTDOMAIN ),
							'4' => __( 'Four Column', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Turn on CSS3 transitions. You may specify animation effect.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => '',
						'type' => 'select',
						'target'=> 'css_animation',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Number of Posts', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'options' => array_combine( range( 1, 40 ), array_values( range( 1, 40 ) ) ),
						'type' => 'select',
					),
					array(
						'name' => __( 'Offset Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple staff shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'options' => array_combine( range( 1, 10 ), array_values( range( 1, 10 ) ) ),
						'type' => 'select',
					),
/*					
					array(
						'name' => __( 'Post Content <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'options' => array(
							'excerpt' => __( 'Excerpt', MISS_ADMIN_TEXTDOMAIN ),
							'full' => __( 'Full Post', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
*/
					array(
						'name' => __( 'Show Post Pagination <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will show pagination at the bottom so the reader can go to the next page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'pagination',
						'options' => array( 'true' => 'Show Post Pagination' ),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Disable Post Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MISS_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MISS_ADMIN_TEXTDOMAIN ),
							'content' => __( 'Disable Post Content', MISS_ADMIN_TEXTDOMAIN ),
							'meta' => __( 'Disable Post Meta', MISS_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MISS_ADMIN_TEXTDOMAIN )

						),
						'type' => 'checkbox',
					),
					'shortcode_has_atts' => true,
				)
			);

			return $option;
		}

		$defaults = array(
			'column'   => '',
			'showposts'  => '',
			'offset'   => '',
			'animation' => '',
			'post_content' => '',
			'categories'  => '',
			'pagination'  => '',
			'disable'   => '',
			'caption'   => '',
			'tagline'   => '',
			'post_in'  => '',
			'category_in' => '',
			'tag_in'  => ''
		);

		$atts = shortcode_atts( $defaults, $atts );

		$args = array( 'type' => $code, 'atts' => $atts );

		return self::_staff_shortcode( $args );
	}
	function _staff_shortcode( $args = array() ) {
		global $post, $wp_rewrite, $wp_query, $irish_framework_params;

		extract( $args['atts'] );

		$out = '';

		$showposts = trim( $showposts );
		$column = ( !empty( $column ) ) ? trim( $column ) : '3';
		$thumb = ( !empty( $thumb ) ) ? trim( $thumb ) : 'medium';
		$offset = ( isset( $offset ) ) ? trim( $offset ) : '';
		$post_in = ( !empty( $post_in ) ) ? explode( ",", trim( $post_in ) ) : '';
		$category_in = ( !empty( $category_in ) ) ? explode( ",", trim( $category_in ) ) : '';
		$tag_in = ( !empty( $tag_in ) ) ? explode( ",", trim( $tag_in ) ) : '';

		if ( is_front_page() ) {
			$_layout = miss_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' || $template == 'templates/template-wiki.php' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}

		$post_img = '';

		$staff_query = new WP_Query();

		if ( trim( $pagination ) == 'true' ) {
			$paged = miss_get_page_query();
			$staff_query->query( array(
					'post__in' => $post_in,
					'category__in' => $category_in,
					'tag__in' => $tag_in,
					'post_type' => 'staff',
					'posts_per_page' => $showposts,
					'paged' => $paged,
					'offset' => $offset,
					'ignore_sticky_posts' => 1
				) );

		} else {

			$staff_query->query( array(
					'post__in' => $post_in,
					'category__in' => $category_in,
					'tag__in' => $tag_in,
					'post_type' => 'staff',
					'showposts' => $showposts,
					'nopaging' => 0,
					'offset' => $offset,
					'ignore_sticky_posts' => 1
				) );
		}

		if ( $staff_query->have_posts() ) :

			$img_sizes = $irish_framework_params->layout[$images];

		$width = '';
		$height = '';

		if ( $args['type'] == 'staff_grid' ) {
			$column = ( $column > 0 || $column < 4 ) ? $column : 4;
			switch ( $column ) {
			case 1:
				$main_class = 'grid one_column staff';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'image';
				$excerpt_lenth = 400;
				$width = $img_sizes['blog_layout5'][0];
				$height = $img_sizes['blog_layout5'][1];
				break;
			case 2:
				$main_class = 'grid two_column staff';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'image';
				$column_class = 'span6';
				$excerpt_lenth = 150;
				$width = $img_sizes['blog_layout5'][0];
				$height = $img_sizes['blog_layout5'][1];
				break;
			case 3:
				$main_class = 'grid three_column staff';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'image';
				$column_class = 'span4';
				$excerpt_lenth = 75;
				$width = $img_sizes['blog_layout5'][0];
				$height = $img_sizes['blog_layout5'][1];
				break;
			case 4:
				$main_class = 'grid four_column staff';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'image';
				$column_class = 'span3';
				$excerpt_lenth = 10;
				$width = $img_sizes['blog_layout5'][0];
				$height = $img_sizes['blog_layout5'][1];
				break;
			default:
				$main_class = 'grid four_column staff';
				$post_class = 'post_grid_module';
				$content_class = 'post_grid_content';
				$img_class = 'image';
				$column_class = 'span3';
				$excerpt_lenth = 10;
				$width = $img_sizes['blog_layout5'][0];
				$height = $img_sizes['blog_layout5'][1];
				break;
			}

		} 
		
		if($caption != ''){
			$out .= '					<div class="blog_header">';
			$out .= '						<h4 class="pull-left caption">';
			$out .= '							' . $caption;
			$out .= '						</h4>';
			$out .= '						<h6 class="pull-left tagline">';
			$out .= '							' . $tagline;
			$out .= '						</h6>';
			$out .= '						<div class="clearboth">';
			$out .= '						</div>';
			$out .= '					</div><!-- /.blog_header-->';
		}
		$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'staff_sc_image_load', 'preload' => true, 'no_link' => true, 'post_content' => $post_content, 'disable' => $disable, 'column' => $column, 'thumb' => $thumb, 'type' => $args['type'], 'shortcode' => true, 'echo' => false );

		$out .= ( $args['type'] == 'staff_grid' ) ? '<div class="sc_layout ' .  $main_class . '"><div class="row-fluid">' : '<ul class="' . $main_class . '">';

		$spans_in_row = $column;
		$span_walk = 0;
		$row_walk = 1;

		while ( $staff_query->have_posts() ) : $staff_query->the_post();

			if ( ($spans_in_row * $row_walk) == $span_walk ) {
				$out .= '</div><!-- /.row-fluid --> <div class="row-fluid">';
			} else {
				$out .= '';
			}
			if ( ($spans_in_row * $row_walk) == $span_walk ) {
				$row_walk++;
			}
			$span_walk++;

			if ( !empty( $animation )) {
				$animation = ' im-transform im-animate-element ' . $animation;
			}


			$out .= ( $args['type'] == 'staff_list' ? '' : ( $column != 1 ? '<div class="' . $column_class . $animation . '">' : '' ) );

			$out .= ( $args['type'] == 'staff_grid' ) ? '<div class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">' : '<li class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">';

			if( in_array( 'post_list_image', $filter_args ) )
				$filter_args = array_merge( $filter_args, array( 'inline_width' => true ) );

			if( strpos( $filter_args['disable'], 'image' ) === false ){
//				$image = miss_get_post_image( $filter_args );
//				$out .= str_replace( array( '<a', '</a' ), array( '<span', '</span' ), $image) ;
				$out .= miss_get_post_image( $filter_args );
			} 
			if( strpos( $filter_args['disable'], 'title' ) === false )
				$out .= $title = the_title( '<h2 class="post_title">', '</h2>', false );
			
			if( strpos( $filter_args['disable'], 'meta' ) === false )
				$out .= miss_post_meta_diferent( $filter_args );
			
			$out .= '<div class="employee_position">' . get_post_meta( get_the_id( ), 'position', true ) . '</div>';
			$out .= '<div class="' . $content_class . '">';

			$out .= '<div class="post_excerpt">';
			if ( strpos( $disable, 'content' ) === false ) {
				$out .= miss_excerpt( get_the_excerpt(), 115, THEME_ELLIPSIS );
				if ( ( !empty( $disable ) && strpos( $disable, 'more' ) === false ) || empty( $disable ) ) {
					$out .= miss_full_read_more();
				}
			}
			$out .= '</div>';

	//		$out .= miss_after_entry_sc( $filter_args );

			$sociable_pages = get_post_meta( get_the_id( ), 'sociable' );
			foreach ( $sociable_pages[0] as $key => $value ) {
				//$out .= $key ;
				if ( ( $key != '#' ) and ( $key != 'keys' ) ) {
					$out .= '<a class="sociable_icon" href="' . $value['link'] . '"><i class="fs-icon-' . $value['icon'] . '"></i></a>';
				}
			}
			$out .= '<div class="clearboth"></div>';

			$out .= '</div><!-- .post_class -->';

			$out .= ( $args['type'] == 'staff_grid' ) ? '</div>' : '</li>';

			$out .= ( $args['type'] == 'staff_list' ? '' : ( $column != 1 ? '</div>' : '' ) );

		endwhile;

		$out .= ( $args['type'] == 'staff_grid' ) ? '</div></div>' : '</ul>';

		if ( $pagination == 'true' ) {
			$out .= miss_pagenavi( '', '', $staff_query );
		}

		endif;

		wp_reset_query();

		return $out;
	}

	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();

		$class_methods = get_class_methods( $class );
		$atts = "";
		foreach ( $class_methods as $method ) {
			if ( $method[0] != '_' ) {
				$shortcode[] = call_user_func( array( &$class, $method ), $atts = 'generator' );
			}
		}

		$options = array(
			'name' => __( 'Staff', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of staff you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'staff_grid',
			'options' => $shortcode
		);

		return $options;
	}

}

?>
