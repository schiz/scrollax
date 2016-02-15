<?php
if ( !function_exists( 'miss_slider_module' ) ) :
/**
 *
 */
function miss_slider_module() {
    global $post, $wp_query;
    
    $postObj = $wp_query->get_queried_object();
    if ( isset( $postObj->ID )) {
	    $slider_custom = get_post_meta($postObj->ID, 'slider_type', true);
	}

	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && function_exists( 'is_shop' ) && is_shop() ) {
		$slider_custom = miss_get_setting('store_slider') ? miss_get_setting('store_slider') : get_post_meta(get_option('woocommerce_shop_page_id'), 'slider_type', true); 
	}

	$out = '';
	$slider = '';
	
	if ( $slider_custom == 'layerslider' )  {
		$slider = miss_layer_slider();
	}

	if ( $slider_custom == 'revslider' )  {
		$slider = miss_revslider();
	}

	if ( $slider_custom == 'expose' ) {
 	   $slider = miss_scroll_slider();
	}

	if ( $slider_custom == 'expose_products' ) {
 	   $slider = miss_scroll_products_slider();
	}

	if ( $slider_custom == 'roadmap' ) {
 	   $slider = miss_roadmap_slider();
	}
  

	if ( $slider_custom == 'featured' )  {
		$slider = miss_featured_slide();
	}
		
	if( !empty( $slider ) ) {
		$out .= '<div class="slider_module top-layerslider">';
		$out .= '<div class="slider_module_inner">';
		
		$out .= $slider;
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div>';
		$out .= '</div>';
	}
	
	return $out;
	//echo apply_atomic( 'slider', $out );
}
endif;



if ( !function_exists( 'miss_roadmap_slider' ) ) :
/**
 *
 */
function miss_roadmap_slider() {
	global $post, $wpdb, $wp_query;
	    $postObj = $wp_query->get_queried_object();
		$roadmap_options['title'] = get_post_meta( $postObj->ID, '_roadmap_title', true );
		$roadmap_options['height'] = get_post_meta( $postObj->ID, '_roadmap_height', true );
		$roadmap_options['zoom'] = get_post_meta( $postObj->ID, '_roadmap_zoom', true );
		$roadmap_options['type'] = get_post_meta( $postObj->ID, '_roadmap_type', true );
		$roadmap_marker['address'] = get_post_meta( $postObj->ID, '_roadmap_address', true );
		$roadmap_marker['placemark'] = get_post_meta( $postObj->ID, '_roadmap_placemarks', true );
		/* Init empty values */
		$shortcode_options = '';
		$marker_options = '';
		if ( isset( $roadmap_options['title'] ) && !empty( $roadmap_options['title'] ) ) {
			$roadmap_options['title'] = '<strong>' . $roadmap_options['title'] . '</strong><br />';
		}
		/* Build options */
		foreach( $roadmap_options as $sc_key => $sc_option ) {
			if ( !empty( $sc_option ) ) {
				$shortcode_options .= $sc_key . '="' . $sc_option . '" ';
			}
		}

		foreach( $roadmap_marker as $marker_key => $marker_option ) {
			if ( !empty( $marker_option ) ) {
				$marker_options .= $marker_key . '="' . $marker_option . '" ';
			}
		}
		$roadmap_shortcode = '[map width="100%" ' . $shortcode_options . '][marker ' . $marker_options . ']' . $roadmap_marker['address'] . '[/marker][/map]';
		$out = do_shortcode( $roadmap_shortcode );
		return $out;
}

endif;


if ( !function_exists( 'miss_layer_slider' ) ) :
/**
 *
 */
function miss_layer_slider() {
	global $post, $wpdb, $wp_query;
	    $postObj = $wp_query->get_queried_object();

	    if (isset( $postObj->ID ) ) {
		    $post_id = $postObj->ID;
		}

		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && function_exists( 'is_shop' ) && is_shop() ) {
			$layer_slider_id = miss_get_setting('store_layerslider') ? miss_get_setting('store_layerslider') : get_post_meta(get_option('woocommerce_shop_page_id'), 'slider_type', true); 
			// $post_id = get_option('woocommerce_shop_page_id');
			// $layer_slider_id = get_post_meta($post_id, 'layerslider_id', true);
		} else {
			$layer_slider_id = get_post_meta($post_id, 'layerslider_id', true);
		}

        // $layer_slider_id = get_post_meta($post_id, 'layerslider_id', true);
        $out  = '<!-- Slider -->';
		$out .= '<div class="page_slider">';
	    if( is_numeric( $layer_slider_id ) ) {
	    	$out .= '<div class="layerslider-container">';
	      	$out .= '<div class="layerslider-wrapper">';
	        $out .= '<div class="ls-shadow-top"></div>';
	        $out .= do_shortcode('[layerslider id="'. $layer_slider_id.'"]');
	        $out .= '<div class="ls-shadow-bottom"></div>';
	    	$out .= '</div>';
	    	$out .= '</div>';
		}
		$out .= '</div><!-- /.page_slider -->';
		return $out;
}

endif;


if ( !function_exists( 'miss_revslider' ) ) :
/**
 *
 */
function miss_revslider() {
	global $post, $wpdb, $wp_query;
	    $postObj = $wp_query->get_queried_object();
	    if (isset( $postObj->ID ) ) {
		    $post_id = $postObj->ID;
		}
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && function_exists( 'is_shop' ) && is_shop() ) {
			//$post_id = get_option('woocommerce_shop_page_id');
			$rev_slider = miss_get_setting('store_revslider');
		} else {
	        $rev_slider = get_post_meta( $post_id, 'revslider_alias', true );
	    }
        $out  = '<!-- Slider -->';
		$out .= '<div class="page_slider">';
	    //if(get_post_meta( $post_id, 'slider_type', true ) == 'revslider' ) {
		$out .= '<div class="layerslider-container">';
		$out .= '<div class="layerslider-wrapper">';
		$out .= '<div class="ls-shadow-top"></div>';
		$out .= putRevSlider( $rev_slider );
		$out .= '<div class="ls-shadow-bottom"></div>';
		$out .= '</div>';
		$out .= '</div>';
		//}
		$out .= '</div><!-- /.page_slider -->';
		return $out;
}

endif;


if ( !function_exists( 'miss_featured_slide' ) ) :
/**
 *
 */
function miss_featured_slide() {
	global $post, $wpdb;
	$use_featured = get_post_meta($post->ID, 'featured_featured_as_background', true);
	$background = get_post_meta($post->ID, 'featured_bg', true);
	if ( isset( $use_featured ) && is_array( $use_featured ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		$thumb = $thumb[0];
	} else {
		if ( isset( $background ) && !empty( $background ) ) {
			$thumb = $background;
		}
	}
	$imagesize = get_post_meta($post->ID, 'featured_size', true);
	$imagefullsize = get_post_meta($post->ID, 'featured_size_full_width', true);

	$banner_image = get_post_meta($post->ID, 'featured_banner_image', true);
	$banner_position = get_post_meta($post->ID, 'featured_banner_position', true);
	$banner_size = get_post_meta($post->ID, 'featured_banner_size', true) ? get_post_meta($post->ID, 'featured_banner_size', true) : array( 'w' => 0, 'h' => 0 );
	$banner_caption_color = get_post_meta($post->ID, 'featured_caption_color', true);
	$banner_caption_font_size = get_post_meta($post->ID, 'featured_caption_font_size', true);
	$banner_content_color = get_post_meta($post->ID, 'featured_content_color', true);
	$banner_content_font_size = get_post_meta($post->ID, 'featured_content_font_size', true);

	// Define background color
	$bg_color = get_post_meta($post->ID, 'featured_bg_color', true);
	if ( isset( $bg_color ) && !empty( $bg_color ) ) {
		$bg_color = 'background-color:#red;';
	} else {
		$bg_color = '';
	}
	// Define caption
	$caption = get_post_meta($post->ID, 'featured_caption', true);
	if ( isset( $caption ) && !empty( $caption ) ) {
		$caption = '<h2 style="color:' . $banner_caption_color . '; font-size:' . $banner_caption_font_size . ';">' . $caption . '</h2>';
	} else {
		$caption = '';
	}
	// Define button
	$button_caption = get_post_meta($post->ID, 'featured_button_caption', true);
	$button_link = get_post_meta($post->ID, 'featured_button_link', true);
	$button_disable = get_post_meta($post->ID, 'featured_disable_button', true);
	$button_disable = ( is_array($button_disable) ) ? implode('', $button_disable) : '';

	if ( isset( $button_caption ) && !empty( $button_caption ) && ( $button_disable != 'true' ) ) {
		$button = '<div class="btn_wrap"><a href="' .$button_disable . $button_link . '" class="btn2">' . $button_caption . '</a></div>';
	} else {
		$button = '';
	}
	
	// Define content
	$content = get_post_meta($post->ID, 'featured_content', true);
	if ( isset( $content ) && !empty( $content ) ) {
		$content = '<p style="color:' . $banner_content_color . ';font-size:' . $banner_content_font_size . ';">' . $content . '</p>';
	} else {
		$content = '';
	}
	
	$banner_disabled = get_post_meta($post->ID, 'featured_banner_disabled', true);
	$banner_disabled = ( isset( $banner_disabled[0] ) ) ? $banner_disabled[0] : false;
	$banner_style = ' style="';
	if ( $banner_position == 'center' ) {
		$banner_style .= 'position: relative;margin:auto;float:none;';
	} else {
		$banner_style .= 'position: absolute;top:50%;float:' . $banner_position . ';margin-top:-' . ( $banner_size['h'] / 2 ) . 'px;';
		if ( $banner_position == 'left' ) {
			$banner_style .= 'left:0;';
		} else {
			$banner_style .= 'right:0;';
		}
	}
	$banner_style .= 'width:' . $banner_size['w'] . 'px;height:' . $banner_size['h'] . 'px;';
	$banner_style .= '"';
	if ( !isset($imagesize) || !is_array($imagesize) ) {
		$_width = 2200;
		$_height = 388;
	} else {
		$_width = ( empty( $imagefullsize[0] ) ) ? $imagesize['w'] : '9999' ;
		$_height = $imagesize['h'];
	}
	if ( isset( $thumb ) ) {
		$thumb = miss_wp_image( $thumb, $_width, $_height );
		$image = miss_image_signature( $thumb );
		$thumb = 'background-image:url(' . $thumb . ');';
	} else {
		$thumb = '';
	}
	//$out .= '<img src="' . $thumb . '" alt="" />';
	$out = '';
	$out .= '<div class="relative" style="' . $bg_color . $thumb . 'background-repeat:no-repeat; background-position:top center; height:' . $_height . 'px; ">';
	if ( $banner_disabled != 'true' ) {
		$out .= '<div class="container relative" style="height:' . $_height . 'px"><div class="row" style="height:' . $_height . 'px"><div class="span12" style="height:' . $_height . 'px"><div class="miss_billboard"' . $banner_style . '>' . $caption . $content . $button . '</div></div></div></div>';
	}
	$out .= '</div>';
	return $out;
}
endif;


if ( !function_exists( 'miss_scroll_slider') ) :
/*
 * Expose Slider
 */
function miss_scroll_slider( $slider_type = false, $slider = false ) {
  global $post, $wpdb;

        $display_title = false;

        $template  = '';
        $template .= '<div class="page-wrap"><div class="wrap">';
        $template .= '<div class="scroll-box flex_slideshow_container circles" data-boxed="true">';
        $template .= '<div class="dragger flexslider">';
        $template .= '<ul class="grid slides">';

                    $expose_type = 'post';
                    $_expose_category = ( get_post_meta( get_the_ID(), '_expose_category', true ) ) ? get_post_meta( get_the_ID(), '_expose_category', true ) : '';

                    $args = array(
                        'post_type' =>  $expose_type,
						'category__in' => $_expose_category,
                        'posts_per_page' => 18
                    );

                    $the_query = new WP_Query($args);
                    $count = 1;
                    $counter_reset = $count;
                    $box_counter = 1;
                    while ($the_query->have_posts()) : $the_query->the_post();

                        global $data;
                        $id = get_the_ID();
                        $post_desc = get_post_meta($id, 'post_description_display', true);

						$marklet = get_post_meta($id, '_icon', true);
						if ( empty( $marklet ) ) {
							$marklet = "fa-icon-calendar";
						}
                        $not_disp = get_post_meta($id, 'display_post_in_slider', true);

                        if(!$not_disp){
                            $list = '';
                            $terms = get_the_terms( get_the_ID(), 'project_type' );

                            if (has_post_thumbnail()) {
                                $thumb = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                            } else {
                                $img_url = get_template_directory_uri() . '/assets/images/error/no-image-large.png';

                            }

                            if ($post_desc == 'opened'){
                                $item_class_desc = 'hided';
                            }   else {
                                $item_class_desc = 'disp';
                            }

                            $triple_wrapper = '';
                            if( $count%3 == 1 ){
                                if($count == 1) {
                                    $box_counter = 1;
                                    $triple_wrapper = '<li><div class = "gr-box">';
                                }
                                else {
                                    $box_counter++;
		                            if( $count%6 == 1 ){
		                            	$template .= '</div></li><li><div class = "gr-box">';
			                        } else {
	                                  	$triple_wrapper = '</div><div class = "gr-box">';	
	                                }
                                }
                            }
                            $folio_size = '';
                            if ( ($box_counter%2 == 1) && ($count %3 == 1) ) {
                                $folio_size = 'large';
                            }
                            if ( ($box_counter%2 == 0) && ($count %3 == 0) ) {
                                $folio_size = 'large';
                            }

                            if ($folio_size == 'large') {
                                $item_class_width = 'large '.$count.' '.$box_counter;
                                if($img_url != get_template_directory_uri() . '/assets/images/error/no-image-large.png') {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $thumb = miss_wp_image($thumb[0], 720, 240);
                                } else {
                                    $thumb = $img_url;
                                }
                                $numb = '80';

                            } else {
                                $item_class_width = 'half';
                                if($img_url != get_template_directory_uri() . '/assets/images/error/no-image-large.png') {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $thumb = miss_wp_image($thumb[0], 356, 240);
                                } else {
                                    $thumb = get_template_directory_uri() . '/assets/images/error/no-image-small.png';
                                }
                                $numb = '40';
                            }

                            if (($count %2) == 1) {
                                $item_class_count = 'odd';
                            }else {
                                $item_class_count = 'even';
                            }
                            add_filter( 'excerpt_length', 'miss_excerpt_length_medium', 999 );
                            $template .=  $triple_wrapper;
                            $template .= '<div class="item ' . $item_class_width . ' ' .$item_class_count . '">';
                            $template .= '<img src="' . $thumb . '" style="margin:0 0;" alt="' . get_the_title() . '" title="' . get_the_title() . '" >';
                            $template .= '<div class="description ' . $item_class_desc . '">';
                            $template .= '<div class="head"><i class="' . $marklet . ' icon-block float-left icon32 fa-icon-3x"></i>';
                            $template .= '<time>' . get_the_date() . ' ' . get_the_time('', $post->ID) . '</time>';
                            $template .= '<h4>' . get_the_title() . '</h4>';
                            $template .= '</div><p>' . miss_excerpt( get_the_excerpt(), 300, '...' ) . '</p>';
                            $template .= '</div>';
                            $template .= '<a href="' . get_permalink() . '"></a>';
                            $template .= '</div>';
                            $count++;
                            $counter_reset++;
                        }
                        endwhile;
                    $template .= '</div>';
                    $template .= '</li>';
                    wp_reset_query();
                    //$template .= miss_expose_print_script();
                $template .= '</ul>';
                $template .= '</div>';
                //$template .= '</div>';

                /* REMOVED FROM 1.7 */
                wp_register_script('expose_init', ''. THEME_JS .'/expose/init.js', false, null, false);
                wp_register_script('expose', ''. THEME_JS .'/expose/expose.js', false, null, true);
                wp_register_script('qs', ''. THEME_JS .'/jquery/jquery.quicksand.js', false, null, true);
                wp_register_script('nicescroll', ''. THEME_JS .'/jquery/jquery.nicescroll.js', false, null, true);
                wp_register_script('foundation', ''. THEME_JS .'/extensions/foundation.min.js', false, null, true);

                //wp_enqueue_script('expose_init');
                //wp_enqueue_script('foundation');
                // wp_enqueue_script('expose');
                // wp_enqueue_script('nicescroll');
                // wp_enqueue_script('qs');
                $template .= '</div></div>';
                $template .= '</div>';
    return $template;
}
endif;


if ( !function_exists( 'miss_scroll_products_slider') ) :
/*
 * Expose Slider
 */
function miss_scroll_products_slider( $slider_type = false, $slider = false ) {
  global $post, $wpdb;

        $display_title = false;

        $template  = '';
        $template .= '<div class="page-wrap"><div class="wrap " ';
        $template .= 'style="height:500px; padding-top:55px; width: auto;"';
        $template .= '>';
        $template .= '<div class="scroll-box" data-boxed="true">';
        $template .= '<div class = "dragger">';
        $template .= '<div class="grid">';

                    $expose_type = 'product';

                    $args = array(
                        'post_type' =>  $expose_type,
                        'posts_per_page' => 18
                    );


                    $the_query = new WP_Query($args);
                    $count = 1;
                    $box_counter = 1;
                    while ($the_query->have_posts()) : $the_query->the_post();

                        global $data;
                        $id = get_the_ID();
                        $post_desc = get_post_meta($id, 'post_description_display', true);


						$marklet = get_post_meta($id, '_icon', true);
						if ( empty( $marklet ) ) {
							$marklet = "im-icon-cart";
						}
                        $not_disp = get_post_meta($id, 'display_post_in_slider', true);

                        if(!$not_disp){
                            $list = '';
                            $terms = get_the_terms( get_the_ID(), 'project_type' );

                            if (has_post_thumbnail()) {
                                $thumb = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                            } else {
                                $img_url = get_template_directory_uri() . '/assets/images/error/no-image-large.png';

                            }

                            if ($post_desc == 'opened'){
                                $item_class_desc = 'hided';
                            }   else {
                                $item_class_desc = 'disp';
                            }

                            $triple_wrapper = '';
                            if( $count%3 == 1 ){
                                if($count == 1) {
                                    $box_counter = 1;
                                    $triple_wrapper = '<div class = "gr-box">';
                                }
                                else {
                                    $box_counter++;
                                    $triple_wrapper =  '</div><div class = "gr-box">';
                                }
                            }

                            $folio_size = '';
                            if ( ($box_counter%2 == 1) && ($count %3 == 1) ) {
                                $folio_size = 'large';
                            }
                            if ( ($box_counter%2 == 0) && ($count %3 == 0) ) {
                                $folio_size = 'large';
                            }

                            if ($folio_size == 'large') {
                                $item_class_width = 'large '.$count.' '.$box_counter;
                                if($img_url != get_template_directory_uri() . '/assets/images/error/no-image-large.png') {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $thumb = miss_wp_image($thumb[0], 720, 240);
                                } else {
                                    $thumb = $img_url;
                                }
                                $numb = '80';

                            } else {
                                $item_class_width = 'half';
                                if($img_url != get_template_directory_uri() . '/assets/images/error/no-image-large.png') {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $thumb = miss_wp_image($thumb[0], 356, 240);
                                } else {
                                    $thumb = get_template_directory_uri() . '/assets/images/error/no-image-small.png';
                                }
                                $numb = '40';
                            }

                            if (($count %2) == 1) {
                                $item_class_count = 'odd';
                            }else {
                                $item_class_count = 'even';
                            }
                            add_filter( 'excerpt_length', 'miss_excerpt_length_medium', 999 );
                            $template .=  $triple_wrapper;
                            $template .= '<div class="item ' . $item_class_width . ' ' .$item_class_count . '">';
                            $template .= '<img src="' . $thumb . '" style="margin:0 0;" alt="' . get_the_title() . '" title="' . get_the_title() . '" >';
                            $template .= '<div class="description ' . $item_class_desc . '">';
                            $template .= '<div class="head"><i class="' . $marklet . ' icon-block float-left icon32 fa-icon-3x"></i>';
                            $template .= '<time>' . get_the_date() . ' ' . get_the_time('', $post->ID) . '</time>';
                            $template .= '<h4>' . get_the_title() . '</h4>';
                            $template .= '</div><p>' . miss_excerpt( get_the_excerpt(), 300, '...' ) . '</p>';
                            $template .= '</div>';
                            $template .= '<a href="' . get_permalink() . '"></a>';
                            $template .= '</div>';
                            $count++;
                        }
                        endwhile;
                    $template .= '</div>';
                    wp_reset_query();
                    $template .= miss_expose_print_script();
                $template .= '</div>';
                $template .= '</div>';
                //$template .= '</div>';

                /* REMOVED FROM 1.7 */
                wp_register_script('expose_init', ''. THEME_JS .'/expose/init.js', false, null, false);
                wp_register_script('expose', ''. THEME_JS .'/expose/expose.js', false, null, true);
                wp_register_script('qs', ''. THEME_JS .'/jquery/jquery.quicksand.js', false, null, true);
                wp_register_script('nicescroll', ''. THEME_JS .'/jquery/jquery.nicescroll.js', false, null, true);
                wp_register_script('foundation', ''. THEME_JS .'/extensions/foundation.min.js', false, null, true);

                //wp_enqueue_script('expose_init');
                //wp_enqueue_script('foundation');
                wp_enqueue_script('expose');
                wp_enqueue_script('nicescroll');
                wp_enqueue_script('qs');
                $template .= '</div></div>';
                $template .= '</div>';
    return $template;
}
endif;

if ( !function_exists( 'miss_expose_print_script' ) ):
function miss_expose_print_script() {

                $script = '<script type="text/javascript">
                    jQuery(document).ready(function() {
                        var countElements = jQuery(".scroll-box .grid .gr-box").size();
                        jQuery(".scroll-box .grid").width(countElements*728);

                        var scrollbox = jQuery(".scroll-box");
                        var indent = ( jQuery(window).width() - jQuery(".fifteen.columns>.wrap").width() ) / 2;

                        setBoxedSlider();

                        var animateTime = 1,
                                offsetStep = 5;

                        scrollWrapper = jQuery(".scroll-box");
                        scrollContent = jQuery(".scroll-box .grid");

                        //event handling for buttons "left", "right"
                        jQuery(".bttL")
                                .mousedown(function() {
                                    scrollContent.data("loop", true).loopingAnimation(jQuery(this), jQuery(this).is(".bttR") );
                                })
                                .bind("mouseup mouseout", function(){
                                    //scrollContent.data("loop", false).stop();
                                });

                        jQuery.fn.loopingAnimation = function(el, dir){
                            if(this.data("loop")){
                                var sign = (dir) ? "-=" : "+=";
                                this.animate({ marginLeft: sign + offsetStep + "px" }, animateTime, function(){ jQuery(this).loopingAnimation(el,dir) });
                            }
                            return false;
                        };
                    });

                    jQuery(window).resize(function(){
                        setBoxedSlider();
                        setBoxedSlider();
                    });

                    function setBoxedSlider(){
                        scrollbox = jQuery(".scroll-box");

                        if(scrollbox.data("boxed") == "3"){
                            var marginLeft = jQuery(".fifteen.columns").width();
                            marginLeft = (jQuery(window).width() - marginLeft)/2 - 9;

                            scrollbox.width(jQuery(window).width() );

                            if(marginLeft > 0)
                                scrollbox.closest(".wrap").css("margin-left",(-marginLeft)+"px");
                            scrollbox.closest(".wrap").width(jQuery(window).width());
                        }
                        else if(scrollbox.data("boxed") == "1"){
                            scrollbox.closest(".wrap").css("width","100%");
                            scrollbox.css("width","100%");
                        }
                        else if(scrollbox.data("boxed") == "2") {

                            scrollbox.closest(".wrap").css("width","100%");
                            scrollbox.css("width","100%");
                            var indent = jQuery(window).width() - jQuery(".fifteen").width();
                            console.log(indent);
                            scrollbox.width(jQuery(".fifteen").width() + indent/2 + 9);
                        }
                        scrollbox.getNiceScroll().resize();
                    }
              </script>';
    return $script;
}
endif;

if ( !function_exists( 'miss_category_slider' ) ) :
/**
 *
 */
function miss_category_slider() {
	global $post, $wpdb;
	$slider_settings = array();
	$counter = 0;
	$slider_showcats = 0;
	$slider_count = 4;
	$slider_cats = miss_get_setting( 'slider_cats' );
	$slider_cat_count = miss_get_setting( 'slider_cat_count' );

	$_len_title = miss_get_setting('flex_info_title_len');
	$_len_descr = miss_get_setting('flex_info_descr_len');
	if (strlen($_len_descr) == 0) {$_len_descr = 120;}
	if (strlen($_len_title) == 0) {$_len_title = 120;}
	if ($slider_cats) $slider_showcats = join( ',', $slider_cats );
	$slider_keys = array();
	
	$slider_count = ( is_numeric( $slider_cat_count ) ) ? $slider_cat_count : 5;
	$cat_slider_query = new WP_Query("cat={$slider_showcats}&showposts={$slider_count}");
	
	if( $cat_slider_query->have_posts() ) : while( $cat_slider_query->have_posts() ) : $cat_slider_query->the_post();
	
	$_homepage_image = get_post_meta( $post->ID, '_homepage_image', true );
	$_homepage_slider_stage = get_post_meta( $post->ID, '_homepage_slider_stage', true );
	$_homepage_disable_excerpt = get_post_meta( $post->ID, '_homepage_disable_excerpt', true );
	$_homepage_link = get_permalink($post->ID);

	
	if (!$_homepage_image) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$_homepage_image = $thumb[0];
		
	}

	//echo $_homepage_image. '<br/>' ;

	$_homepage_image = miss_wp_image($_homepage_image,720,480);

	if( $_homepage_image || $_homepage_slider_stage == 'raw_html' ) {
		$slider_settings[$counter]['slider_url'] = esc_url( $_homepage_image );
		$slider_settings[$counter]['alt_attr'] = esc_attr( get_the_title() );
		$slider_settings[$counter]['stage_effect'] =  ( !empty( $_homepage_slider_stage ) ) ? $_homepage_slider_stage : 'staged_slide';
		$slider_settings[$counter]['link_url'] = esc_url( get_permalink() );
		$slider_keys = array_merge( $slider_keys, array( (int)$counter ) );
		
		if( !$_homepage_disable_excerpt && $_homepage_slider_stage != 'raw_html' ) {
			$slider_settings[$counter]['description'] = miss_excerpt( get_the_excerpt(), apply_filters( 'miss_cat_slider_excerpt_length', $_len_descr ), apply_filters( 'miss_cat_slider_excerpt_ellipsis', ' ... ' ) );
			$slider_settings[$counter]['title'] = miss_excerpt(get_the_title() . " ", apply_filters( 'miss_cat_slider_excerpt_length', $_len_title), '');
			$slider_settings[$counter]['read_more'] = false;
		} else {
			$slider_settings[$counter]['read_more'] = true;
		}
		
		if( $_homepage_slider_stage == 'raw_html' )
			$slider_settings[$counter]['description'] = get_the_excerpt();
		
		$counter++;
	}
	endwhile; endif;
	
	$slider_keys = array_merge( $slider_keys, array( '#' ) );
	$slider_settings['slider_keys'] = join( ',', $slider_keys );
	
	wp_reset_query();
	
	return $slider_settings;
}
endif;


if ( !function_exists( 'miss_flex' ) ) :
/**
 *
 */
function miss_flex( $slider_type, $slider ) {
	global $irish_framework_params;
	
	$img_sizes = $irish_framework_params->layout['images_slider'];
	$slider_keys = explode(',', $slider['slider_keys']);
	if (!isset($img_sizes['flexslide'])) {
		$img_sizes['flexslide'][0] = 'auto';
		$img_sizes['flexslide'][1] = 'auto';
	}
	$img = array( 'w' => $img_sizes['flexslide'][0], 'h' => $img_sizes['flexslide'][1] );
		
	$out = '<div class="miss_preloader_large" style="text-align:center;">';
	$out .= '<img src="' . THEME_IMAGES_ASSETS . '/transparent.gif" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.gif);">';
	$out .= '</div>';
	
	$out .='<div class="miss_flexslider">';
	$out .='<ul class="slides">';
	
	foreach ( $slider_keys as $key ) {
		if( $key != '#' ) {
			$link_n = ( !empty( $slider[$key]['link_url'] ) ) ? $slider[$key]['link_url'] : '';

			$slide_img = esc_url( $slider[$key]['slider_url'] );

			$img_alt = !empty( $slider[$key]['alt_attr'] ) ? esc_attr( $slider[$key]['alt_attr'] ) : '';
			
			$out .= '<li>';

			if( preg_match_all( '!.+\.(?:jpe?g|png|gif)!Ui', $slide_img, $matches ) ) {
				
				$title = ( !empty( $slider[$key]['title'] ) ) ? $slider[$key]['title'] : '';
				$description = ( !empty( $slider[$key]['description'] ) ) ? $slider[$key]['description'] : '';
				
				if( !empty( $title ) || !empty( $description ) ) {
					$out .= '<a href="'.$link_n.'" class="flex-imageLink">';
					$out .= miss_display_image( array( 'src' => $slide_img, 'alt' => $img_alt, 'width' => 'auto', 'height' => 'auto' ) );
					if (!empty ($description)) {
						$out .= '<div class="flex-caption"><h2 class="slider_title">'.$title.'</h2><div class="slider_desc">'.$description.'</div></div>';
					}
					else {
						$out .= '<p class="flex-caption"><span class="slider_title">'.$title.'</span>';	
					}

					$out .= '</a>';
				} 
				else {
					$out .= '<a href="'.$link_n.'" class="flex-imageLink">';
					$out .= miss_display_image( array( 'src' => $slide_img, 'alt' => $img_alt) );
					$out .= '</a>';
				}
				
			}
			else {
				if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $slide_img, $match)) {
					$video_source = "youtube";
					$video_id = $match[1];
					$out .= '<iframe id="player" src="http://www.youtube.com/embed/' . $video_id . '" width="580" height="387" frameborder="0" webkitallowfullscreen allowfullscreen></iframe>';
					// $out .= '<div id="' . $video_id . '" rel="' . $slide_img . '" class="' . $video_source . '_video"></div>';
				}
				if (0 === preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $slide_img, $match)) {
				} else {
					$video_source = "vimeo";
					$video_id = $match[3];
					$out .= '<iframe id="player" src="http://player.vimeo.com/video/' . $video_id . '?api=1&amp;player_id=player" width="580" height="387" frameborder="0" webkitallowfullscreen allowfullscreen></iframe>';
				}
				
			}
			$out .= '</li>';
		}
	}	
	$out .= '</ul>';
	
	$out .= '</div><!-- #miss_flexslider -->';

	
	miss_slider_script( $slider_type );
	
	return $out;
}
endif;

if ( !function_exists( 'miss_slider_script' ) ) :
/**
 *
 */
function miss_slider_script( $slider_type ) {
	
	$defaults = array(
		'slider_disable_trans' => miss_get_setting( 'slider_disable_trans' ), // true | false
		'slider_hover_pause' => miss_get_setting( 'slider_hover_pause' ), // true | false
		'slider_speed' => miss_get_setting( 'slider_speed' ), // 2000 milli
		'hover_pause' => ( !empty( $slider_hover_pause ) ? 'false' : 'true' ) // true | fasle
	);
	
	$args = wp_parse_args( apply_filters( 'miss_slider_options', '' ), $defaults );

	extract( $args );
		
	if( $slider_type == 'flexslider' )
		$disable_trans = ( !empty( $slider_disable_trans ) ) ? 'true' : 'false';

	else
		$disable_trans = ( !empty( $slider_disable_trans ) ) ? 'false' : 'true';
		
	if( $slider_type != 'flexslider' && $disable_trans == 'false' )
		$hover_pause = 'false';
		
?>
<script type="text/javascript">
jQuery(document).ready(function(){
<?php
switch ( $slider_type ) {
	
    case 'flexslider': ?>

	<?php
	$flex_animation = miss_get_setting('flex_animation');
	$flex_direction = miss_get_setting('flex_direction');
	$flex_slideshow = miss_get_setting('flex_slideshow');
	$flex_slideshow_speed = miss_get_setting('flex_slideshow_speed');
	$flex_animation_duration = miss_get_setting('flex_animation_duration');
	$flex_direction_navigation = miss_get_setting('flex_direction_navigation');
	$flex_control_navigation = miss_get_setting('flex_control_navigation');
	$flex_keyboard_navigation = miss_get_setting('flex_keyboard_navigation');
	$flex_mousewheel_navigation = miss_get_setting('flex_mousewheel_navigation');
	$flex_prevtext = miss_get_setting('flex_prevtext');
	$flex_nexttext = miss_get_setting('flex_nexttext');
	$flex_pauseplay = miss_get_setting('flex_pauseplay');
	$flex_pausetext = miss_get_setting('flex_pausetext');
	$flex_playtext = miss_get_setting('flex_playtext');
	$flex_randomize = miss_get_setting('flex_randomize');
	$flex_startingslide = miss_get_setting('flex_startingslide');
	$flex_loop = miss_get_setting('flex_loop');
	$flex_pauseonaction = miss_get_setting('flex_pauseonaction');
	$flex_pauseonhover = miss_get_setting('flex_pauseonhover');
	$defaults = array(	
	);
	$args = wp_parse_args( apply_filters( 'miss_flexoptions', '' ), $defaults );
	extract( $args );
	?>
	<?php
	/* Fix for older PHP versions */
	if (!$flex_slideshow) {$flex_slideshow = "true";}
	if (!$flex_slideshow_speed) {$flex_slideshow_speed = "6000";}
	if (!$flex_animation_duration) {$flex_animation_duration = "400";}
	if (!$flex_direction_navigation) {$flex_direction_navigation = "true";}
	if (!$flex_control_navigation) {$flex_control_navigation = "true";}
	if (!$flex_keyboard_navigation) {$flex_keyboard_navigation = "true";}
	if (!$flex_mousewheel_navigation) {$flex_mousewheel_navigation = "false";}
	if (!$flex_pauseplay) {$flex_pauseplay = "false";}
	if (!$flex_randomize) {$flex_randomize = "false";}
	if (!$flex_loop) {$flex_loop = "true";}
	if (!$flex_pauseonaction) {$flex_pauseonaction = "false";}
	if (!$flex_pauseonhover) {$flex_pauseonhover = "false";}
	?>
	jQuery('.miss_flexslider').flexslider({
		animation:'<?php echo $flex_animation; ?>',
		slideDirection:'<?php echo $flex_direction; ?>',
		slideshow: <?php echo $flex_slideshow; ?>,
		slideshowSpeed: <?php echo $flex_slideshow_speed; ?>,
		animationDuration: <?php echo $flex_animation_duration; ?>,
		directionNav: <?php echo $flex_direction_navigation; ?>,
		controlNav: <?php echo $flex_control_navigation; ?>,
		keyboardNav: <?php echo $flex_keyboard_navigation; ?>,
		mousewheel: <?php echo $flex_mousewheel_navigation; ?>,
		prevText: '<?php echo $flex_prevtext; ?>',
		nextText: '<?php echo $flex_nexttext; ?>',
		pausePlay: <?php echo $flex_pauseplay; ?>,
		pauseText: '<?php echo $flex_pausetext; ?>',
		playText: '<?php echo $flex_playtext; ?>',
		randomize: <?php echo $flex_randomize; ?>,
		slideToStart: <?php echo '0'; ?>,
		height: 'auto',
        animationLoop: <?php echo $flex_loop; ?>,
		pauseOnAction: <?php echo $flex_pauseonaction; ?>,
		pauseOnHover: <?php echo $flex_pauseonhover; ?>,
		after: function() {
			jQuery('.slider_module .miss_preloader_large').remove();
			jQuery('.miss_flexslider').removeClass('noscript');
		}
	});
	
	<?php break; ?>
<?php } ?>

});
/* ]]> */
</script>
<?php
do_action( 'miss_after_slider_script' );
}
endif;

// Turning off some jetpack features
if ( function_exists( 'im_remove_jetpack_sharebuttons' ) ) {
  add_action( 'im_before_header-blog', 'im_remove_jetpack_sharebuttons' );
}
?>
