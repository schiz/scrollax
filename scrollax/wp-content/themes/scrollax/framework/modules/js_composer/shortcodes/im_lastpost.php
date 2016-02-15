<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImLastpost {
	/**
	 *
	 */
	public static function im_lastpost( $atts, $content = null, $code = null ) {
		$posttypes = array(
			__( 'Posts', MISS_ADMIN_TEXTDOMAIN ) => 'post',
			__( 'News', MISS_ADMIN_TEXTDOMAIN ) => 'news',
			__( 'Portfolio', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio',
			__( 'Staff', MISS_ADMIN_TEXTDOMAIN ) => 'staff',
			__( 'Testimonials', MISS_ADMIN_TEXTDOMAIN ) => 'testimonials',
			__( 'Services', MISS_ADMIN_TEXTDOMAIN ) => 'services',
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
				'name' => __( 'Last posts Layout', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_lastpost',
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
						'heading' => __('Post types', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __('Select post types to populate items from.', MISS_ADMIN_TEXTDOMAIN),
						'param_name' => 'posttype',
						'type' => 'dropdown',
						'value' => $posttypes,
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
			'posttype' => 'post',
			'showposts' => '',
			'category_in' => '',
			'animation' => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );

		$out = '';

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$posttype = ( array_search( $posttype, $posttypes ) != false ) ? $posttype : 'post';
		$category_in = ( !empty($category_in) && $posttype == 'post' ) ? explode(",", trim( $category_in )) : '';
        
        $offset = $showposts;
        
		$query_args = array(
			'post_type' => $posttype,
			'showposts' => $offset,
			'category__in' => $category_in,
			'nopaging' => 0,
			'ignore_sticky_posts' => 1,
            'orderby' => 'post_date',
            'order' => 'DESC'
		);

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

			$img_class = 'image';
			$filter_args = array( 'width' => 220, 'height' => 220, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );

            
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
            $rand = rand(1000,9999);
			     
                $excerpt_lenth = 150;
                
                $row_delimeter = '</div><!-- /.inner-wrapp --> ' . $carousel_item_end . $carousel_item_start . '<div class="inner-wrapp">';
                $out .= '<div class="inner-wrapp" id="lposts'.$rand.'">';
                $i = 1;  
                while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="span3 content-item">';
                    if($i % 2 == 1)
                    {
                        $out .= '<div class="preview-container preview-small extended-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <!--a href="#" class="control zoom"><i class="marker im-icon-zoom-in"></i></a-->
                                        <a title="" href="'.miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => false) ).'" class="control zoom" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="marker im-icon-zoom-in"></i></a>
                                        <a href="'.esc_url( get_permalink() ).'" class="control link"><i class="marker im-icon-link"></i></a>
                                      </div>
                                    </div>
                                  </div>';
                    }
                    
                    $out .= '<div class="content">';
                    $out .= '<h4 class="header">'.miss_post_title( $filter_args ).'</h4>
                            <div class="article-info">
                              <div class="published">On <span class="date">'.get_the_date().'</span></div>';
                    $out .= '<div class="comments"><i class="marker im-icon-bubble-10"></i>';
                    $num_comments = get_comments_number(); // возвратит число

                    if ( comments_open() ) {
                    	if ( $num_comments == 0 ) {
                    		$comments = __('No Comments');
                    	} elseif ( $num_comments > 1 ) {
                    		$comments = $num_comments . __(' Comments');
                    	} else {
                    		$comments = __('1 Comment');
                    	}
                    	$out .= '<a class="caption" href="' . get_comments_link() .'">'. $comments.'</a>';
                    } else {
                    	$out .=  __('Comments are off for this post.');
                    }
                    $out .= '</div>
                            </div>';
                    if($i % 2 != 1)
                    {
                        $out .= '<div class="article">
                                  <p>'.miss_excerpt( get_the_excerpt(), $excerpt_lenth, THEME_ELLIPSIS ).'</p>
                                </div>';
                    }
                    $out .= '<a href="'.esc_url( get_permalink() ).'" class="btn ribbon-style smallest-ribbon">View details</a>';
                    $out .= '</div>';
                    $out .= '</div>';
                    
                    $i++;
                }
                $out .= '</div><!-- /.row-fluid -->';
                
                $button_more = '<div class="more-posts span12 big-ribbon-style" onclick="get_lastpost_ajax(lpost_posttype, lpost_limit, lpost_offset, lpost_catin);">
                                  <div class="wrapper">
                                    <div class="additional-wrapper">
                                      <div class="remaining"></div>
                                      <div class="title">
                                        <span>Show more posts</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                $script = '<script>
                            var lpost_posttype = "'.$posttype.'";
                            var lpost_limit = "'.$offset.'";
                            var lpost_offset = "'.$offset.'";
                            var lpost_catin = "'.implode(',', $category_in).'";
                            var lpost_id = "lposts'.$rand.'";
                         </script>';
                $out = $script.'<div class="row sc_layout last-posts ' .  $class . ' ' . $posttype . '">' . $out_caption . $out . $button_more . '</div><!-- /.sc_layout ' .  $class . '-->';
            
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