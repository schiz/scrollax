<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImWoocommerce {
	/**
	 *
	 */
	public static function im_woocommerce( $atts, $content = null, $code = null ) {
		$classes = array(
			__( 'Grid', MISS_ADMIN_TEXTDOMAIN ) => 'grid',
			__( 'Comments Slider', MISS_ADMIN_TEXTDOMAIN ) => 'comslider',
			__( 'List', MISS_ADMIN_TEXTDOMAIN ) => 'list',
			__( 'more-links', MISS_ADMIN_TEXTDOMAIN ) => 'more-links',
			__( 'Portfolio small', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-small',
			__( 'Portfolio fullwidth', MISS_ADMIN_TEXTDOMAIN ) => 'portfolio-fullwidth',
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
				'name' => __( 'WooCommerce Layout', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_woocommerce',
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
						'heading' => __( 'Number of Columns', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set number of columns in a row.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'column',
						'min' => 1,
						'max' => 4,
						'step' => 1,
						'unit' => __( 'columns', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
						'value' => 3,
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
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", MISS_ADMIN_TEXTDOMAIN ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", MISS_ADMIN_TEXTDOMAIN )
		            ),
				)
			);
		}
		
		global $post, $wp_rewrite, $wp_query, $irish_framework_params, $woocommerce;

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

		$class = ( array_search( $class, $classes ) != false ) ? $class : 'grid';

		$query_args = array(
			'post_type' => 'product',
			'showposts' => $showposts,
			'offset' => $offset,
			'nopaging' => 0,
			'ignore_sticky_posts' => 1
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
			$filter_args = array( 'width' => 220, 'height' => 220, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => 'product', 'shortcode' => true, 'echo' => false, 'wraptitle' => false );

            
			$spans_in_row = $column;
			$span_walk = 0;
			$row_walk = 1;
            
            /**
             * ¬озвращение контента в зависимости от класса
             * 
             * */
             if ( is_user_logged_in() ) {
                $linkprofile = '<a class="nav-item text small-text" href='.get_permalink( get_option('woocommerce_myaccount_page_id') ).' title="My Account">My Account</a>';
             } 
             else
             {
                $linkprofile = '<a class="nav-item text small-text" href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="My Account">My Account</a>';
             }
             
             if (sizeof($woocommerce->cart->cart_contents)>0) {
                $linkcheck = '<a href="'.$woocommerce->cart->get_checkout_url().'" class="nav-item text small-text">Checkout</a>';
             } else {
                $linkcheck = '';
             }
             
            $out_caption = '';
    		if($caption != ''){
                $out_caption = '<header class="section-header span12">
                                  <nav class="basket-cpanel breaking-alignment">
                                    <a class="basket" href="'.$woocommerce->cart->get_cart_url().'">
                                      <i class="marker"></i>
                                    </a>
                    
                                    <div class="text-link-wrapper">
                                      <a class="nav-item text" href="'.$woocommerce->cart->get_cart_url().'">Cart</a>
                                      <span class="nav-item text cost">Total '.$woocommerce->cart->get_cart_total().'</span>
                    
                                      <div class="break"></div>
                                      '.$linkprofile.'
                                      <span class="nav-item separator">&nbsp;|&nbsp;</span>
                                      '.$linkcheck.'
                                    </div>
                                  </nav>
                                  <h1 class="header">
                                    <span>'.$caption.'</span>
                                  </h1>';
                                    
                if($tagline != '')
                {
                    $out_caption .=   '<h3 class="header">'.$tagline.'</h3>';
                }
                $out_caption .= '</header>';
            }
                $out .= '<div class="inner-wrapp span12">';
                while( $sc_post_query->have_posts() ) {
                    if ( ($spans_in_row * $row_walk) == $span_walk ) {
                        $row_walk++;
                    }
                    $span_walk++;
                
				    $sc_post_query->the_post();
                    
                    $price = get_post_meta(get_the_id(), '_regular_price', true); 
                    $price_disc = get_post_meta(get_the_id(), '_sale_price', true); 
                    
                    $out .= '<section class="content-item '. $column_class . ' ' .$animation.'">
                                <header class="header">
                                  <div class="preview-container preview-small base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => false) ).'" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="price">';
                    if($price)
                    {
                        $out .= '<span class="small">'.get_woocommerce_currency_symbol().' '.$price.'</span>
                        <span class="big">'.get_woocommerce_currency_symbol().' '.$price_disc.'</span>';
                    }
                                    
                                    
                    $out .=  '</div>
                                </header>
                
                                <article class="article">
                                  <p>'.miss_post_title( $filter_args ).'</p>
                                </article>
                                
                                <a href="'.esc_url( get_permalink() ).'" class="btn ribbon-style small-ribbon">Read more</a>
                              </section>';
                }
                $out .= '</div><!-- /.row-fluid -->';
                $out = '<div class="row featured-products">' . $out_caption . $out . '</div><!-- /.sc_layout-->';
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