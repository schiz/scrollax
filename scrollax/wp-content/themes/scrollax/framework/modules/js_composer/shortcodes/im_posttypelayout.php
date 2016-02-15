<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImPosttypelayout {
	/**
	 *
	 */
	public static function im_posttypelayout( $atts, $content = null, $code = null ) {
		$posttypes = array(
			__( 'Posts', MISS_ADMIN_TEXTDOMAIN ) => 'post',
			__( 'News', MISS_ADMIN_TEXTDOMAIN ) => 'news',
			__( 'Portfolio', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio',
			__( 'Staff', MISS_ADMIN_TEXTDOMAIN ) => 'staff',
			__( 'Testimonials', MISS_ADMIN_TEXTDOMAIN ) => 'testimonials',
			__( 'Services', MISS_ADMIN_TEXTDOMAIN ) => 'service',
		);
		$classes = array(
			__( 'Grid', MISS_ADMIN_TEXTDOMAIN ) => 'grid',
			__( 'Comments Slider', MISS_ADMIN_TEXTDOMAIN ) => 'comslider',
			__( 'List', MISS_ADMIN_TEXTDOMAIN ) => 'list',
			__( 'more-links', MISS_ADMIN_TEXTDOMAIN ) => 'more-links',
			__( 'Portfolio small', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-small',
			__( 'Portfolio fullwidth', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-fullwidth',
			__( 'Portfolio two columns', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-two',
			__( 'Portfolio three columns', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-three',
		);
		$entries = get_categories( 'orderby=name&hide_empty=0' );
		foreach( $entries as $key => $entry ) {
			$categories[$entry->name] = $entry->term_id;
		}

		$entries = get_terms('portfolio_category','orderby=name&hide_empty=0');
		foreach($entries as $key => $entry) {
			$portfolio_categories[$entry->name] = $entry->slug;
		}

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Posts/Pages Layout', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_posttypelayout',
				'icon' => 'im-icon-grid-5',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Here you can add section title (leave blank to hide).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'caption',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Here you can add section tagline that will appears right from section title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'tagline',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __('Post types', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __('Select post types to populate items from.', MISS_ADMIN_TEXTDOMAIN),
						'param_name' => 'posttype',
						'type' => 'dropdown',
						'value' => $posttypes,
					),
					array(
						'heading' => __( 'Layout Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select layout type.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => $classes,
					),
					array(
						'heading' => __( 'Number of Columns', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set number of columns in a row.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'column',
						'min' => 1,
						'max' => 4,
						'step' => 1,
						'unit' => __( 'columns', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('grid', 'comslider')
						),
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
						'heading' => __('Posts Categories', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'By default shortcode will pushing recent posts from all categories.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'category_in',
						'type' => 'checkbox',
						'value' => $categories,
						'dependency' => array(
							'element' => 'posttype', 
							'value' => array( 'post' )
						),
					),
					array(
						'heading' => __('Portfolio Categories', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'By default shortcode will pushing recent work from all categories.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'portfolio_terms',
						'type' => 'checkbox',
						'value' => $portfolio_categories,
						'dependency' => array(
							'element' => 'posttype', 
							'value' => array( 'portfolio' )
						),
					),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", MISS_ADMIN_TEXTDOMAIN ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", MISS_ADMIN_TEXTDOMAIN )
		            ),
				)
			);
		}
		
		global $post, $wp_rewrite, $wp_query, $irish_framework_params;

		$defaults = array(
			'caption' => '',
			'tagline' => '',
			'posttype' => 'post',
			'class' => 'grid',
			'column' => '',
			'showposts' => '',
			'offset' => '',
			'disable' => '',
			'category_in' => '',
			'portfolio_terms' => '',
			'animation' => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );

		$out = '';

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$posttype = ( array_search( $posttype, $posttypes ) != false ) ? $posttype : 'post';
		$class = ( array_search( $class, $classes ) != false ) ? $class : 'grid';
		$category_in = ( !empty($category_in) && $posttype == 'post' ) ? explode(",", trim( $category_in )) : '';

		$query_args = array(
			'post_type' => $posttype,
			'showposts' => $showposts,
			'category__in' => $category_in,
			'offset' => $offset,
			'nopaging' => 0,
			'ignore_sticky_posts' => 1
		);

		if ( !empty($portfolio_terms) && $posttype == 'portfolio' ) {
			$taxonomy = 'portfolio_category';
			$term = ( explode( ",", trim( $portfolio_terms ) ) ) ? explode( ",", trim( $portfolio_terms ) ) : $portfolio_terms;
			$query_args['taxonomy'] = 'portfolio_category';
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => $term
				)
			);
		} else {
			$taxonomy = '';
			$portfolio_terms = '';
		}

		if( is_front_page() ) {
			$_layout = ( miss_get_setting( 'homepage_layout' ) ) ? miss_get_setting( 'homepage_layout' ) : 'full_width';
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} elseif ( $wp_query->get_queried_object() ) {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
			$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		} else {
			$_layout = 'full_width';
			$images = 'images';
		}

		$sc_post_query = new WP_Query();
		$sc_post_query->query( $query_args );

		if( $sc_post_query->have_posts() ) {

			$img_sizes = $irish_framework_params->layout[$images];

			$width = '';
			$height = '';

			if( $class == 'list' ) {
				$column_class = 'span12 content-item';
				$excerpt_lenth = 180;
				$width = $img_sizes['small_post_list'][0];
				$height = $img_sizes['small_post_list'][1];
			} else {
				$column = ( $column > 0 || $column < 4 ) ? $column : 4;
				switch( $column ) {
					case 1:
						$column_class = 'content-item span12';
						$excerpt_lenth = 400;
						$width = $img_sizes['blog_layout1'][0];
						$height = $img_sizes['blog_layout1'][1];
						break;
					case 2:
						$column_class = 'content-item span6';
						$excerpt_lenth = 150;
						$width = $img_sizes['blog_layout3'][0];
						$height = $img_sizes['blog_layout3'][1];
						break;
					case 3:
						$column_class = 'content-item span4';
						$excerpt_lenth = 138;
						$width = $img_sizes['blog_layout4'][0];
						$height = $img_sizes['blog_layout4'][1];
						break;
					case 4:
						$column_class = 'content-item span3';
						$excerpt_lenth = 115;
						$width = $img_sizes['blog_layout5'][0];
						$height = $img_sizes['blog_layout5'][1];
						break;
					default:
						$column_class = 'content-item span3';
						$excerpt_lenth = 115;
						$width = $img_sizes['blog_layout5'][0];
						$height = $img_sizes['blog_layout5'][1];
						break;
				}
			}
			$img_class = 'image';
			$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false );

			/*if ( $class == 'comslider') {
				$carousel_item_start = '<li class="embedded">';
				$carousel_item_end = '</li><!-- /.embedded -->';
			} else {
				$carousel_item_start = '';
				$carousel_item_end = '';
			}*/
            
			$spans_in_row = $column;
			$span_walk = 0;
			$row_walk = 1;
            
            /**
             * Возвращение контента в зависимости от класса
             * 
             * */
            $out_caption = '';
    		if($caption != ''){
                $out_caption = '<header class="section-header span12">
                                  <h1 class="header">
                                    <span>'.$caption.'</span>
                                  </h1>';
                                    
                if($tagline != '')
                {
                    $out_caption .=   '<h3 class="header">'.$tagline.'</h3>';
                }
                $out_caption .= '</header>';
            }
			if($class == 'grid')
            {
                $row_delimeter = '</div><!-- /.inner-wrapp --><div class="inner-wrapp">';
                $out .= '<div class="inner-wrapp">';
                while( $sc_post_query->have_posts() ) {
                    if ( ($spans_in_row * $row_walk) == $span_walk ) {
                        $out .= $row_delimeter;
                    }
                    if ( ($spans_in_row * $row_walk) == $span_walk ) {
                        $row_walk++;
                    }
                    $span_walk++;
                
				    $sc_post_query->the_post();
                    $out .= '<section class="' . $column_class . $animation . '">';
                    $out .= '   <header class="header">';
                    $out .=         miss_post_icon( $filter_args );
                    $out .=         miss_post_title( $filter_args );
                    $out .= '   </header>';
    				$out .= '   <article class="article">';
    				if( strpos( $disable, 'content' ) === false ) {
    					$out .= '<p>'.miss_excerpt( get_the_excerpt(), $excerpt_lenth, THEME_ELLIPSIS ).'</p>'; // описание
    				}
    				$out .= '   </article><!-- /.content -->';
   					$out .=     miss_full_read_more();
    				$out .= '</section><!-- /.' . $column_class . ' -->';
                }
                $out .= '</div><!-- /.row-fluid -->';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'list')
            {
                $filter_args['wraptitle'] = false;
                $row_delimeter = '</div><!-- /.inner-wrapp --><div class="inner-wrapp">';
                $out .= '<div class="inner-wrapp">';
                while( $sc_post_query->have_posts() ) {
                    if ( ($spans_in_row * $row_walk) == $span_walk ) {
                        $out .= $row_delimeter;
                    }
                    if ( ($spans_in_row * $row_walk) == $span_walk ) {
                        $row_walk++;
                    }
                    $span_walk++;
                    
				    $sc_post_query->the_post();
                    $filter_args['get_src'] = true;
                    $filter_args['width'] = 300;
                    $filter_args['height'] = 220;
                    //print_r($filter_args);
                    $out .= '<section class="content-item span4 hover-slide-effect '.$animation.'">';
                    $out .= '<div class="preview" data-src="'.miss_get_post_image( $filter_args ).'" style="background-image: url('.miss_get_post_image( $filter_args ).');"></div>';
                    $out .= '<div class="desc">
                              <header class="header">
                                <h4>'.miss_post_title( $filter_args ).'</h4>
                              </header>';
                    $out .= '<article class="article">';
                    $out .= '<p>'.miss_excerpt( get_the_excerpt(), $excerpt_lenth, THEME_ELLIPSIS ).'</p>'; // описание
                    $out .= '</article><!-- /.content -->';
                    $out .= '<a href="'.esc_url( get_permalink() ).'" class="btn ribbon-style smallest-ribbon">View details</a>';
                    $out .= '</div></section>';
                }
                $out .= '</div><!-- /.inner-wrapp -->';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'more-links')
            {
                $out .= '<div class="span12 ' .  $class . ' ' . $posttype . '">';
                while( $sc_post_query->have_posts() ) {
				    $sc_post_query->the_post();
                    $out .= '<a class="nav-item" href="'.esc_url( get_permalink() ).'" title="' .esc_attr( the_title_attribute( 'echo=0' ) ) . '">'.miss_excerpt( the_title('', '', false ), 30, THEME_ELLIPSIS ).'</a>';
                }
                $out .= '</div><!-- /.inner-wrapp -->';
                $out = '<div class="row sc_layout">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'comslider')
            {
                $out .= '<div class="flex_slideshow_container arrows_top span12">
                			<div class="flexslider text-slider">
                            <div class="additional-layer left-layer">
                                <div class="triangle top left"></div>
                                <div class="triangle bottom left"></div>
                            </div>
                			<ul class="slides">';
                            
                while( $sc_post_query->have_posts() ) {
				    $sc_post_query->the_post();
                    $out .= '<li>
                                <div class="testimonial">
                                    <div class="descr"><span class="quot ql"></span>'.miss_excerpt( get_the_excerpt(), 90, THEME_ELLIPSIS ).'<span class="quot qr"></span></div> 
                                    <div class="name">'.miss_excerpt( the_title('', '', false ), 30, THEME_ELLIPSIS ).'</div>
                                    <div class="caption">'.get_post_meta(get_the_ID(), 'testimonial_caption', true).'</div>
                                </div>
                            </li>';
                }
                
                $out .= '</ul>
                            <div class="additional-layer right-layer">
                                <div class="triangle top right"></div>
                                <div class="triangle bottom right"></div>
                            </div>
                			</div>
            			</div>';
               
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'portfolio-small')
            {     
                $out .= '<div class="inner-wrapp span12"><div class="row gallery">';
                $filter_args['width'] = $filter_args['height'] = 220;
                while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="content-item span3 '.$animation.'">
                                  <div class="preview-container preview-small base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.esc_url( get_permalink() ).'" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                }
                
                $out .= '</div></div>';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . ' works">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'portfolio-fullwidth')
            {
                $filter_args['width'] = 940;
                $filter_args['height'] = 587;
                $out .= '<div class="inner-wrapp span12 works"><div class="row gallery">';
                while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="content-item span12 '.$animation.'">
                                  <div class="preview-container preview-largest base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.esc_url( get_permalink() ).'" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                                //print_r($filter_args);
                }
                
                $out .= '</div></div>';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'portfolio-two')
            {
                $filter_args['width'] = 460;
                $filter_args['height'] = 300;
                $out .= '<div class="inner-wrapp span12 gallery"><div class="row">';
                while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="content-item span6 '.$animation.'">
                                  <div class="preview-container preview-large base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.esc_url( get_permalink() ).'" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                                //print_r($filter_args);
                }
                
                $out .= '</div></div>';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
            elseif($class == 'portfolio-three')
            {
                $filter_args['width'] = 300;
                $filter_args['height'] = 300;
                $out .= '<div class="inner-wrapp span12 gallery"><div class="row">';
                while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="content-item span4 '.$animation.'">
                                  <div class="preview-container preview-normal base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.esc_url( get_permalink() ).'" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                                //print_r($filter_args);
                }
                
                $out .= '</div></div>';
                $out = '<div class="row sc_layout ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . '</div><!-- /.sc_layout ' .  $class . '-->';
            }
		}
		return $out;
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