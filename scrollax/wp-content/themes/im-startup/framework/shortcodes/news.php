<?php
/**
 *
 */
class missNews {
	/**
	 *
	 */
	public static function news_grid( $atts, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'News Grid Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'news_grid',
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
//							'1' => __('One Column', MISS_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MISS_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MISS_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MISS_ADMIN_TEXTDOMAIN ),
//							'5' => __('Five Column', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Posts', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select',
					),
					array(
						'name' => __( 'Offset Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple news shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select',
					),
/*
					array(
						'name' => __( 'Post Content <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'options' => array(
							'excerpt' => __('Excerpt', MISS_ADMIN_TEXTDOMAIN ),
							'full' => __('Full Post', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('News Categories <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want posts from specific categories to display then you may choose them here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'category_in',
						'default' => array(),
						'target' => 'cat',
						'type' => 'select',
					),
*/
					array(
						'name' => __('Disable Post Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __('Disable Post Image', MISS_ADMIN_TEXTDOMAIN ),
							'title' => __('Disable Post Title', MISS_ADMIN_TEXTDOMAIN ),
							'content' => __('Disable Post Content', MISS_ADMIN_TEXTDOMAIN ),
							'meta' => __('Disable Post Meta', MISS_ADMIN_TEXTDOMAIN ),
							'more' => __('Disable Read More', MISS_ADMIN_TEXTDOMAIN )
							
						),
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'column' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'categories' 	=> '',
			'pagination' 	=> '',
			'disable' 		=> '',
			'caption'   	=> '',
			'tagline'   	=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> ''
		);
		
		$atts = shortcode_atts( $defaults, $atts );
		
		$args = array( 'type' => $code, 'atts' => $atts );
		
		return self::_news_shortcode( $args );
	}
	
	/**
	 *
	 */
	public static function news_list($atts, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __('News List Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'news_list',
				'options' => array(
					array(
						'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter here the section header.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'type' => 'text',
					),
					array(
						'name' => __( 'Tagline', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter here tagline that will be displayed next to the section header.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'type' => 'text',
					),
/*
					array(
						'name' => __('Select Thumbnail Size', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( "Select the size of thumbnails that you wish to have displayed.<br /><br />This is a thumbnail of the 'Featured Image' in each of your posts.", MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'thumb',
						'default' => '',
						'options' => array(
							'small' => __('Small', MISS_ADMIN_TEXTDOMAIN ),
							'medium' => __('Medium', MISS_ADMIN_TEXTDOMAIN ),
							'large' => __('Large', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
*/
					array(
						'name' => __('Number of Posts', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to have displayed on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select',
					),
					array(
						'name' => __('Offset Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple news shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select',
					),
/*
					array(
						'name' => __('Post Content <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose to have the post excerpt displayed or the full content of your post including shortcodes.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'post_content',
						'default' => '',
						'options' => array(
							'excerpt' => __('Excerpt', MISS_ADMIN_TEXTDOMAIN ),
							'full' => __('Full Post', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('News Categories <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want posts from specific categories to display then you may choose them here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'category_in',
						'default' => array(),
						'target' => 'cat',
						'type' => 'multidropdown',
					),
					array(
						'name' => __('Show Post Pagination <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will show pagination at the bottom so the reader can go to the next page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'pagination',
						'options' => array('true' => __('Show Post Pagination', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
*/
					array(
						'name' => __( 'Disable Post Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
//							'image' => __( 'Disable Post Image', MISS_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MISS_ADMIN_TEXTDOMAIN ),
							'content' => __( 'Disable Post Content', MISS_ADMIN_TEXTDOMAIN ),
							'meta' => __( 'Disable Post Meta', MISS_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MISS_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'thumb' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'categories' 	=> '',
			'pagination' 	=> '',
			'disable' 		=> '',
			'caption'   	=> '',
			'tagline'   	=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> ''
		);
		
		$atts = shortcode_atts( $defaults, $atts );
		
		$args = array( 'type' => $code, 'atts' => $atts );
		
		return self::_news_shortcode( $args );
	}
	
	function _news_shortcode( $args = array() ) {
		global $post, $wp_rewrite, $wp_query, $irish_framework_params;

		extract( $args['atts'] );

		$out = '';

		$showposts = trim( $showposts );
		$column = ( !empty( $column ) ) ? trim( $column ) : '4';
		$thumb = ( !empty( $thumb ) ) ? trim( $thumb ) : 'small';
		$offset = ( isset( $offset ) ) ? trim( $offset ) : '';
		$post_in = ( !empty($post_in) ) ? explode(",", trim( $post_in )) : '';
		$category_in = ( !empty($category_in) ) ? explode(",", trim( $category_in )) : '';
		$tag_in = ( !empty($tag_in) ) ? explode(",", trim( $tag_in )) : '';

		if( is_front_page() ) {
			$_layout = miss_get_setting( 'homepage_layout' );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' || $template == 'templates/template-wiki.php' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		}
		
		$post_img = '';

		$news_query = new WP_Query();

		if( trim( $pagination ) == 'true' ) {
			$paged = miss_get_page_query();
			$news_query->query(array(
				'post__in' => $post_in,
				'category__in' => $category_in,
				'tag__in' => $tag_in,
				'post_type' => 'news',
				'posts_per_page' => $showposts,
				'paged' => $paged,
				'offset' => $offset,
				'ignore_sticky_posts' => 1
			));

		} else {

			$news_query->query(array(
				'post__in' => $post_in,
				'category__in' => $category_in,
				'tag__in' => $tag_in,
				'post_type' => 'news',
				'showposts' => $showposts,
				'nopaging' => 0,
				'offset' => $offset,
				'ignore_sticky_posts' => 1
			));
		}

		if( $news_query->have_posts() ) {

			$img_sizes = $irish_framework_params->layout[$images];

			$width = '';
			$height = '';

			if( $args['type'] == 'news_grid' ) {
				$column = ( $column > 0 || $column < 4 ) ? $column : 4;
				switch( $column ) {
	/*				case 1:
						$main_class = 'grid one_column';
						$post_class = 'grid_module';
						$content_class = 'content';
						$img_class = 'image';
						$column_class = 'span12 column';
						$excerpt_lenth = 400;
						$width = $img_sizes['blog_layout1'][0];
						$height = $img_sizes['blog_layout1'][1];
						break;
	*/				case 2:
						$main_class = 'grid two_column';
						$post_class = 'grid_module';
						$content_class = 'content';
						$img_class = 'image';
						$column_class = 'span6 column';
						$excerpt_lenth = 150;
						$width = $img_sizes['blog_layout3'][0];
						$height = $img_sizes['blog_layout3'][1];
						break;
					case 3:
						$main_class = 'grid three_column';
						$post_class = 'grid_module';
						$content_class = 'content';
						$img_class = 'image';
						$column_class = 'span4 column';
						$excerpt_lenth = 150;
						$width = $img_sizes['blog_layout4'][0];
						$height = $img_sizes['blog_layout4'][1];
						break;
					case 4:
						$main_class = 'grid four_column';
						$post_class = 'grid_module';
						$content_class = 'content';
						$img_class = 'image';
						$column_class = 'span3 column';
						$excerpt_lenth = 115;
						$width = $img_sizes['blog_layout5'][0];
						$height = $img_sizes['blog_layout5'][1];
						break;
					default:
						$main_class = 'grid four_column';
						$post_class = 'grid_module';
						$content_class = 'content';
						$img_class = 'image';
						$column_class = 'span3 column';
						$excerpt_lenth = 115;
						$width = $img_sizes['blog_layout5'][0];
						$height = $img_sizes['blog_layout5'][1];
						break;
				}
			} else {
				if( $args['type'] == 'news_list' ) {
					switch( $thumb ) {
						case 'small':
							$main_class = 'list small_post_list';
							$post_class = 'post_list_module';
							$content_class = 'content';
							$img_class = 'image';
							$excerpt_lenth = 180;
							$width = $img_sizes['small_post_list'][0];
							$height = $img_sizes['small_post_list'][1];
							break;
/*
						case 'medium':
							$main_class = 'medium_post_list';
							$post_class = 'post_list_module';
							$content_class = 'content';
							$img_class = 'image';
							$excerpt_lenth = 180;
							$width = $img_sizes['medium_post_list'][0];
							$height = $img_sizes['medium_post_list'][1];
							break;
						case 'large':
							$main_class = 'large_post_list';
							$post_class = 'post_list_module';
							$content_class = 'content';
							$img_class = 'image';
							$excerpt_lenth = 180;
							$width = $img_sizes['large_post_list'][0];
							$height = $img_sizes['large_post_list'][1];
							break;
*/
						default:
							$main_class = 'list small_post_list';
							$post_class = 'post_list_module';
							$content_class = 'content';
							$img_class = 'image';
							$excerpt_lenth = 180;
							$width = $img_sizes['small_post_list'][0];
							$height = $img_sizes['small_post_list'][1];
							break;
					}
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
			$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'blog_sc_image_load', 'preload' => true, 'post_content' => $post_content, 'disable' => $disable, 'column' => $column, 'thumb' => $thumb, 'type' => $args['type'], 'shortcode' => true, 'echo' => false );

			$out .= ( $args['type'] == 'news_grid' ) ? '<div class="sc_layout ' .  $main_class . '"><div class="row-fluid">' : '<ul class="blogging ' . $main_class . '">';

			$spans_in_row = $column;
			$span_walk = 0;
			$row_walk = 1;

			while( $news_query->have_posts() ) {
				$news_query->the_post();

				if ( ($spans_in_row * $row_walk) == $span_walk ) {
					$out .= '</div><!-- /.row-fluid --> <div class="row-fluid">';
				} else {
					$out .= '';
				}
				if ( ($spans_in_row * $row_walk) == $span_walk ) {
					$row_walk++;
				}
				$span_walk++;


				$out .= ( $args['type'] == 'news_grid' ? '<div class="' . $column_class . ' im-transform im-animate-element fade-in">' : '<li class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">' );
		/*
				$out .= ( $args['type'] == 'news_list' ) ? '<div class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">' : '<li class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">';
		*/		

				if ($args['type'] == 'news_list') {
					$out .= '<div class="month pull-left">';
					$out .= '<span class="day">';
					$out .= '<span>';
					$out .= get_the_date('M');
					$out .= '</span>';
					$out .= get_the_date('d');
					$out .= '</span>';
					$out .= '</div>';
					$filter_args['disable'] .= 'image';
				}
				$out .= miss_before_post_sc( $filter_args );
				
				$out .= '<div class="' . $content_class . '">';
				if( strpos( $disable, 'content' ) === false ) {
					$out .= '<div class="post_excerpt">';
					$out .= miss_excerpt( get_the_excerpt(), $excerpt_lenth, THEME_ELLIPSIS );
					if( ( !empty( $disable ) && strpos( $disable, 'more' ) === false ) || empty( $disable ) ) {
						$out .= miss_full_read_more();
					}
					$out .= '</div><!-- /.post_excerpt -->';
				}
				$out .= '</div><!-- /.content -->';

				$out .= ( $args['type'] == 'news_grid' ? '</div>' : '</li>' );
			}; //while
			$out .= ( $args['type'] == 'news_grid' ) ? '</div></div>' : '</ul>';
		}; //if
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
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __('News', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of news you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'news',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
