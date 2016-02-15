<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImNews {

	/**
	 *
	 */
	public static function im_news( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'News', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_news',
				'icon' => 'im-icon-newspaper',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter news block title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'caption',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Tagline', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter news block tagline.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'tagline',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Number of Posts', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select the number of posts you wish to have displayed on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'showposts',
						'min' => 1,
						'value' => 5,
						'max' => 40,
						'step' => 1,
						'unit' => __( 'posts', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Offset Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple blog shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'offset',
						'min' => 0,
						'value' => 0,
						'max' => 40,
						'step' => 1,
						'unit' => __( 'posts', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __('Disable Post Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'disable',
						'type' => 'checkbox',
						'value' => array(
							__('Disable Post Image', MISS_ADMIN_TEXTDOMAIN ) => 'image',
							__('Disable Post Title', MISS_ADMIN_TEXTDOMAIN ) => 'title',
							__('Disable Post Content', MISS_ADMIN_TEXTDOMAIN ) => 'content',
							__('Disable Post Meta', MISS_ADMIN_TEXTDOMAIN ) => 'meta',
							__('Disable Read More', MISS_ADMIN_TEXTDOMAIN ) => 'more',
						),
					),

		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),
			    )
			);
		}

		$atts = shortcode_atts(array(
			'class'     => 'claen',
			'caption' 		=> '',
			'tagline' 		=> '',
			'thumb' 		=> '',
			'showposts'		=> '',
			'offset' 		=> '',
			'post_content'	=> '',
			'type'			=> 'news_list',
			'categories' 	=> '',
			'pagination' 	=> '',
			'disable' 		=> '',
			'caption'   	=> '',
			'tagline'   	=> '',
			'post_in'		=> '',
			'category_in'	=> '',
			'tag_in'		=> '',
			'animation' => ''
	    ), $atts);
	    extract($atts);

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		global $post, $wp_rewrite, $wp_query, $irish_framework_params;

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

			if( $atts['type'] == 'news_grid' ) {
				$column = ( $column > 0 || $column < 4 ) ? $column : 4;
				switch( $column ) {
					case 2:
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
				if( $atts['type'] == 'news_list' ) {
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
			$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'blog_sc_image_load', 'preload' => true, 'post_content' => $post_content, 'disable' => $disable, 'column' => $column, 'thumb' => $thumb, 'type' => $atts['type'], 'shortcode' => true, 'echo' => false );

			$out .= ( $atts['type'] == 'news_grid' ) ? '<div class="sc_layout ' .  $main_class . '"><div class="row-fluid">' : '<ul class="blogging ' . $main_class . '">';

			$spans_in_row = $column;
			$span_walk = 0;
			$row_walk = 1;

			while( $news_query->have_posts() ) {
				$news_query->the_post();

				$out .= ( $atts['type'] == 'news_grid' ? '<div class="' . $column_class . ' im-transform im-animate-element fade-in">' : '<li class="' . join( ' ', get_post_class( $post_class, get_the_ID() ) ) . '">' );
				if ($atts['type'] == 'news_list') {
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

				$out .= ( $atts['type'] == 'news_grid' ? '</div>' : '</li>' );
			}; //while
			$out .= ( $atts['type'] == 'news_grid' ) ? '</div></div>' : '</ul>';
		}; //if
		wp_reset_query();
		return '<div class="sc-news ' . $class . $animation . '">' . $out . '</div>';
	}

	/**
	 *
	 */
	public static function _options( $method ) {
		return self::$method('generator');
	}

}
endif;
?>