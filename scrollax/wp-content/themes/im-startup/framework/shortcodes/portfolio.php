<?php
/**
 *
 */
class missPortfolio {
	
	/**
	 *
	 */
	public static function portfolio_grid( $atts ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Portfolio Grid', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'portfolio_grid',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you would like your posts to display in.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'default' => '',
						'options' => array(
							'1' => __('One Column', MISS_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MISS_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MISS_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Portfolio Posts', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you would like to display on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select',
					),
					array(
						'name' => __( 'Portfolio Categories <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which portfolio categories you would like to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'portfolio_category',
						'type' => 'select',
					),
					array(
						'name' => __( 'Offset Portfolio Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple portfolio shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select',
					),
					array(
						'name' => __( 'Disable Portfolio Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MISS_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MISS_ADMIN_TEXTDOMAIN ),
							'excerpt' => __( 'Disable Post Excerpt', MISS_ADMIN_TEXTDOMAIN ),
							'date' => __( 'Disable Date', MISS_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MISS_ADMIN_TEXTDOMAIN ),
							'visit' => __( 'Disable Visit Site', MISS_ADMIN_TEXTDOMAIN ),
							'pagination' => __( 'Disable Pagination', MISS_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'column' 	=> '4',
			'showposts'	=> '8',
			'cat' 		=> array(),
			'offset' 	=> '',
			'disable'	=> ''
		), $atts));
		
		$out = '';
		
		$portfolio_query = new WP_Query();
		
		if( isset( $cat ) ) :
			global $post, $wp_rewrite, $wp_query, $irish_framework_params;
			
			$column = trim( $column );
			$showposts = trim( $showposts );
//			$cat = trim( $cat );
			$offset = trim( $offset );
			
			if( is_front_page() ) {
				$_layout = miss_get_setting( 'homepage_layout' );
//				$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
			} else {
				$post_obj = $wp_query->get_queried_object();
				$_layout = get_post_meta( $post_obj->ID, '_layout', true );
//				$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
			}
			
			$paged = miss_get_page_query();
			
			$gallery_post = $post->post_name;
			
			if( $post->post_parent) {
				$parent_query = get_post( $post->post_parent );	 
			 	$gallery_parent = $parent_query->ID;
			}
			
			if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
				$irish_framework_params->offset = $offset;
				$irish_framework_params->posts_per_page = $showposts;
				add_filter('post_limits', 'my_post_limit');
			}
			
			if( strpos( $disable, 'pagination' ) === false ) {
				
				$args = array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'taxonomy' => 'portfolio_category',
					'term' => $cat,
					'offset' => $offset,
					'paged' => $paged
				);
				
			} else {
				
				$args = array(
					'post_type' => 'portfolio',
					'showposts' => $showposts,
					'taxonomy' => 'portfolio_category',
					'term' => $cat,
					'offset' => $offset,
					'nopaging' => 0
				);
			}
			if ( isset ( $cat ) && !empty($cat) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => $cat
					)
				);
			}
			
		$portfolio_query = new WP_Query();
		$portfolio_query->query( $args );
		endif;

		if( $portfolio_query->have_posts() ) :
		$img_sizes = $irish_framework_params->layout['big_sidebar_images'];

		$img_group = 'portfolio_img_group_' . rand(1,1000);
		$width = '';
		$height = '';
		switch( $column ) {
			case 1:
				$column_class = 'span12 has_preview';
				$width = $img_sizes['span12'][0];
				$height = $img_sizes['span12'][1];
				break;
			case 2:
				$column_class = 'span6 has_preview';
				$width = $img_sizes['span6'][0];
				$height = $img_sizes['span6'][1];
				break;
			case 3:
				$column_class = 'span4 has_preview';
				$width = $img_sizes['span4'][0];
				$height = $img_sizes['span4'][1];
				break;
			case 4:
				$column_class = 'span3 has_preview';
				$width = $img_sizes['span3'][0];
				$height = $img_sizes['span3'][1];
				break;
		}
		$main_class = 'loop_module works portfolio row-fluid';
		
		$out .= '<div class="' .  $main_class . '">';
		
		$i = 1;
		while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
		
		$id = get_the_ID();
		
		$custom_fields = get_post_custom( $id );
		foreach( $custom_fields as $key => $value ) {
			${$key}[$id] = $value[0];
			
			if( is_serialized( ${$key}[$id] ) ) {
				${$key}[$id] = unserialize( ${$key}[$id] );
			}
		}
		
		if ( has_post_thumbnail() || !empty( $_image[$id] ) || !empty( $_featured_video[$id] ) ) {
			
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );
			else :
				$img[0] = ( !empty( $_image[$id] ) ) ? $_image[$id] : '';
			endif;
			
			if( $wp_rewrite->using_permalinks() ) :
				$url = home_url( '/' ) . 'portfolio/' . $post->post_name . '/gallery/' . $gallery_post . '/';
			else :
				$url = htmlspecialchars( add_query_arg( array( 'gallery' => $gallery_post ), get_permalink( $id )) );
			endif;
			
			$link_to = ( empty( $_post[$id][0] )
			? ( empty( $_featured_video[$id] )
			? ( empty( $_image[$id] )
			? $img[0]
			: $_image[$id] )
			: $_featured_video[$id] )
			: $url
			);
						
			$out .= '<div class="portfolio_item ' . ( $i%$column == 0 ? $column_class . ' last' : $column_class ) . ' im-transform im-animate-element scale-up">';

			$out .= '<div class="' .  join( ' ', get_post_class( 'post_grid_module', get_the_ID() ) ) . '">';
			
			if( strpos( $disable, 'image' ) === false ) {
				$offset = $irish_framework_params->layout['images']['image_padding'];
				$load_width = $width + $offset;
				$load_height = $height + $offset;
				
				$out .= '<div class="post_grid_image" data-style="width:' . $load_width . 'px;">';
				
				ob_start(); miss_portfolio_image_begin();
				$out .= ob_get_clean();
				
				if( empty( $img[0] ) && !empty( $_featured_video[$id] ) )
					$video_check = miss_video( $args = array( 'url' => $_featured_video[$id], 'parse' => true, 'width' => $width, 'height' => $height ) );
				else
					$video_check = false;
					
				if( !empty( $video_check ) )
				{
					$out .= $video_check;
				}
				else
				{
					$out .= miss_display_image( array(
									'src' => $img[0], 
									'alt' => '',
									'title' => '',
									'height' => $height,
									'width' => $width,
									'class' => 'hover_fade_js',
									'link_to' => $link_to,
									'img_class' => 'post_grid_image has_preview',
									'link_class' => 'portfolio_img_load',
									'prettyphoto' => ( empty( $_post[$id][0] ) ? true : false ),
									'group' => $img_group,
									'preload' => false
								) );
				}
							
				ob_start(); miss_portfolio_image_end( array( 'column' => $column, 'disable' => $disable, 'date' => ( !empty(  $_date[$id] ) ?  $_date[$id] : '' ) ) );
				$out .= ob_get_clean();

				$out .= '</div>';
			}
			
			$out .= '<div class="first_layer color_frame">';
			$out .= '<div class="second_layer sidebar_framed_caption">';
			
			if( strpos( $disable, 'title' ) === false ) {
				$out .= '<div class="portfolio_item_title"><a href="' . get_permalink() .'">' . get_the_title() . '</a></div>';

//				$title = ( empty( $_more[$id][0] ) ) ? '<a href="' . esc_url( $url ) . '">' . get_the_title( $id ) . '</a>' : get_the_title( $id );
				
				/*
				if( $column == 1 || $column == 2 )
					$out .= '<h2 class="post_title">' . $title . '</h2>';
				else
					$out .= '<h3 class="post_title">' . $title . '</h3>';
				*/
			}
			if( strpos( $disable, 'meta' ) === false ) {
				$out .= '<div class="portfolio_item_meta">' . miss_post_meta_diferent( array('echo' => false) ) . '</div>';
			}
/*			
			if( ( !empty( $_date[$id] ) ) && ( strpos( $disable, 'date' ) === false ) )
				$out .= apply_filters( 'miss_portfolio_date', '<p class="date">' . $_date[$id] . '</p>', array( 'column' => $column ) );
			
			
			if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) || !empty( $_teaser[$id] ) ) {
				$out .= '<div class="post_excerpt">';
				
				$out .= ( ( !empty( $_teaser[$id] ) ) && ( strpos( $disable, 'excerpt' ) === false ) ) ? '<p>' . do_shortcode( $_teaser[$id] ) . '</p>' : '';
				
				if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) ) {
					$out .= '<p>';
*/
					/*
					if( ( empty( $_more[$id][0] ) ) && ( strpos( $disable, 'more' ) === false ) ) {
						$read_more = '<a href="' . esc_url( $url )  . '" class="post_more_link">' . __( 'Read More', MISS_TEXTDOMAIN ) . '</a>&nbsp;&nbsp;';
						$out .= apply_filters( 'miss_portfolio_read_more', $read_more, esc_url( $url ) );
					}
					
					if( ( !empty( $_link[$id] ) ) && ( strpos( $disable, 'visit' ) === false ) ) {
						$visit_site = '<a href="' . esc_url( $_link[$id] )  . '" class="post_more_link">' . __( 'Visit Site', MISS_TEXTDOMAIN ) . '</a>';
						$out .= apply_filters( 'miss_portfolio_visit_site', $visit_site, esc_url( $_link[$id] ) );
					}
					*/
/*
					$out .= '</p>';
				}
				
				$out .= '</div>';
			}
*/				
			$out .= '</div><!-- /.second_layer-->';
			$out .= '</div><!-- /.first_layer-->';
						
			$out .= '</div>';
			
			$out .= '</div><!-- /.portfolio_item -->';
			
			if( ( $i % $column ) == 0 )
				$out .= '<div class="clearboth"></div>';
			
			$i++;
		}
		
		endwhile;
		
		$out .= '</div>';
		
		$out .= ( strpos( $disable, 'pagination' ) === false ) ? miss_pagenavi( '', '', $portfolio_query ) : '';
		
		else :
		
			$out .= __( 'No portfolio posts were found for the category selected.', MISS_TEXTDOMAIN );
		
		endif;
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			remove_filter('post_limits', 'my_post_limit');
		}
		
		wp_reset_query();
		
		//return '[raw]' . $out . '[/raw]';
		return $out;
	}
	
	/**
	 *
	 */
/*
	public static function portfolio_list( $atts ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Portfolio List', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'portfolio_list',
				'options' => array(
					array(
						'name' => __( 'Select Thumbnail Size', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the size of thumbnails that you wish to have displayed.<br /><br />This is a thumbnail of the "Featured Image" in each of your posts.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'thumb',
						'default' => '',
						'options' => array(
							'small' => __( 'Small', MISS_ADMIN_TEXTDOMAIN ),
							'medium' => __( 'Medium', MISS_ADMIN_TEXTDOMAIN ),
							'large' => __('Large',  MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Number of Portfolio Posts', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you would like to display on each page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'showposts',
						'default' => '',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select',
					),
					array(
						'name' => __( 'Portfolio Categories <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which portfolio categories you would like to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'portfolio_category',
						'type' => 'multidropdown',
					),
					array(
						'name' => __( 'Offset Portfolio Posts <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will skip a number of posts at the beginning.<br /><br />Useful if you are using multiple portfolio shortcodes on the same page.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'offset',
						'default' => '',
						'options' => array_combine(range(1,10), array_values(range(1,10))),
						'type' => 'select',
					),
					array(
						'name' => __( 'Disable Portfolio Elements <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide certain elements from displaying here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable',
						'options' => array(
							'image' => __( 'Disable Post Image', MISS_ADMIN_TEXTDOMAIN ),
							'title' => __( 'Disable Post Title', MISS_ADMIN_TEXTDOMAIN ),
							'excerpt' => __( 'Disable Post Excerpt', MISS_ADMIN_TEXTDOMAIN ),
							'date' => __( 'Disable Date', MISS_ADMIN_TEXTDOMAIN ),
							'more' => __( 'Disable Read More', MISS_ADMIN_TEXTDOMAIN ),
							'visit' => __( 'Disable Visit Site', MISS_ADMIN_TEXTDOMAIN ),
							'pagination' => __( 'Disable Pagination', MISS_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'thumb' 	=> 'small',
			'showposts'	=> '8',
			'cat' 		=> '',
			'offset' 	=> '',
			'disable'	=> ''
		), $atts));
		
		$out = '';
		
		$portfolio_query = new WP_Query();
		
		if( !empty( $cat ) ) :
			global $post, $wp_rewrite, $wp_query, $irish_framework_params;
			
			$thumb = trim( $thumb );
			$showposts = trim( $showposts );
			$cat = trim( $cat );
			$offset = trim( $offset );
			
			if( is_front_page() ) {
				$_layout = miss_get_setting( 'homepage_layout' );
				$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
			} else {
				$post_obj = $wp_query->get_queried_object();
				$_layout = get_post_meta( $post_obj->ID, '_layout', true );
				$images = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
			}
			
			$paged = miss_get_page_query();
			
			$gallery_post = $post->post_name;
			
			if( $post->post_parent) {
				$parent_query = get_post( $post->post_parent );	 
			 	$gallery_parent = $parent_query->ID;
			}
			
			if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
				$irish_framework_params->offset = $offset;
				$irish_framework_params->posts_per_page = $showposts;
				add_filter('post_limits', 'my_post_limit');
			}
			
			if( strpos( $disable, 'pagination' ) === false ) {
				
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'taxonomy' => 'portfolio_category',
					'term' => $cat,
					'offset' => $offset,
					'paged' => $paged
				));
				
			} else {
				
				$portfolio_query->query(array(
					'post_type' => 'portfolio',
					'showposts' => $showposts,
					'taxonomy' => 'portfolio_category',
					'term' => $cat,
					'offset' => $offset,
					'nopaging' => 0
				));
			}
			
		endif;
		
		if( $portfolio_query->have_posts() ) :
		
		$img_sizes = $irish_framework_params->layout[$images];
		$img_group = 'portfolio_img_group_' . rand(1,1000);
		
		$width = '';
		$height = '';
		
		switch( $thumb ) {
			case 'small':
				$main_class = 'post_list small_post_list';
				$width = $img_sizes['small_post_list'][0];
				$height = $img_sizes['small_post_list'][1];
				break;
			case 'medium':
				$main_class = 'post_list medium_post_list';
				$width = $img_sizes['medium_post_list'][0];
				$height = $img_sizes['medium_post_list'][1];
				break;
			case 'large':
				$main_class = 'post_list large_post_list';
				$width = $img_sizes['large_post_list'][0];
				$height = $img_sizes['large_post_list'][1];
				break;
		}
		
		$out .= '<ul class="portfolio_gallery ' .  $main_class . '">';
		
		$i = 1;
		while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
		
		$id = get_the_ID();
		
		$custom_fields = get_post_custom( $id );
		foreach( $custom_fields as $key => $value ) {
			${$key}[$id] = $value[0];
			
			if( is_serialized( ${$key}[$id] ) ) {
				${$key}[$id] = unserialize( ${$key}[$id] );
			}
		}
		
		if ( has_post_thumbnail() || !empty( $_image[$id] ) || !empty( $_featured_video[$id] ) ) {
			
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );
			else :
				$img[0] = ( !empty( $_image[$id] ) ) ? $_image[$id] : '';
			endif;
			
			if( $wp_rewrite->using_permalinks() ) :
				$url = home_url( '/' ) . 'portfolio/' . $post->post_name . '/gallery/' . $gallery_post . '/';
			else :
				$url = htmlspecialchars( add_query_arg( array( 'gallery' => $gallery_post ), get_permalink( $id )) );
			endif;
			
			$link_to = ( empty( $_post[$id][0] )
			? ( empty( $_featured_video[$id] )
			? ( empty( $_image[$id] )
			? $img[0]
			: $_image[$id] )
			: $_featured_video[$id] )
			: $url
			);
			
			$out .= '<li class="' . join( ' ', get_post_class( 'post_list_module', get_the_ID() ) ) . '">';
			
			if( strpos( $disable, 'image' ) === false ) {
				$offset = $irish_framework_params->layout['images']['image_padding'];
				$load_width = $width + $offset;
				$load_height = $height + $offset;
				$out .= '<div class="post_list_image" style="width:' . $load_width . 'px;">';
				
				if( $thumb != 'small' ) {
					ob_start(); miss_portfolio_image_begin();
					$out .= ob_get_clean();
				}
				
				if( empty( $img[0] ) && !empty( $_featured_video[$id] ) )
					$video_check = miss_video( $args = array( 'url' => $_featured_video[$id], 'parse' => true, 'width' => $width, 'height' => $height ) );
				else
					$video_check = false;

				if( !empty( $video_check ) )
				{
					$out .= $video_check;
				}
				else
				{
					$out .= miss_display_image( array(
									'src' => $img[0], 
									'alt' => '',
									'title' => '',
									'height' => $height,
									'width' => $width,
									'class' => 'hover_fade_js',
									'link_to' => $link_to,
									'link_class' => 'portfolio_img_load',
									'prettyphoto' => ( empty( $_post[$id][0] ) ? true : false ),
									'group' => $img_group,
									'preload' => true
								) );
				}
				if( $thumb != 'small' ) {
					ob_start(); miss_portfolio_image_end( array( 'thumb' => $thumb, 'disable' => $disable, 'date' => ( !empty(  $_date[$id] ) ?  $_date[$id] : '' ) ) );
					$out .= ob_get_clean();
				}

				$out .= '</div>';
		
		}
			if ($width > 0) {
				$post_list_content_margin = ' style="margin-left: '.($width + $offset + 10).'px;"';
			} else {
				$post_list_content_margin = '';
			}
			$out .= '<div class="post_list_content"' . $post_list_content_margin . '>';
			
			if( strpos( $disable, 'title' ) === false ) {
				$title = ( empty( $_more[$id][0] ) ) ? '<a href="' . esc_url( $url ) . '">' . get_the_title( $id ) . '</a>' : get_the_title( $id );
				
				if( $thumb == 'small' )
					$out .= '<p class="post_title">' . $title . '</p>';
				else
					$out .= '<h2 class="post_title">' . $title . '</h2>';
			}
			
			if( ( !empty( $_date[$id] ) ) && ( strpos( $disable, 'date' ) === false ) )
				$out .= apply_filters( 'miss_portfolio_date', '<p class="date">' . $_date[$id] . '</p>', array( 'thumb' => $thumb ) );
			
			
			if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) || !empty( $_teaser[$id] ) ) {
				$out .= '<div class="post_excerpt">';
				
				$out .= ( ( !empty( $_teaser[$id] ) ) && ( strpos( $disable, 'excerpt' ) === false ) ) ? '<p>' . do_shortcode( $_teaser[$id] ) . '</p>' : '';
				
				if( empty( $_more[$id][0] ) || !empty( $_link[$id] ) ) {
					$out .= '<p>';
					
					if( ( empty( $_more[$id][0] ) ) && ( strpos( $disable, 'more' ) === false ) ) {
						$read_more = '<a href="' . esc_url( $url )  . '" class="post_more_link">' . __( 'Read More', MISS_TEXTDOMAIN ) . '</a>&nbsp;&nbsp;';
						$out .= apply_filters( 'miss_portfolio_read_more', $read_more, esc_url( $url ) );
					}
					
					if( ( !empty( $_link[$id] ) ) && ( strpos( $disable, 'visit' ) === false ) ) {
						$visit_site = '<a href="' . esc_url( $_link[$id] )  . '" class="post_more_link">' . __( 'Visit Site', MISS_TEXTDOMAIN ) . '</a>';
						$out .= apply_filters( 'miss_portfolio_visit_site', $visit_site, esc_url( $_link[$id] ) );
					}
					
					$out .= '</p>';
				}
				
				$out .= '</div>';
			}
				
			$out .= '</div>';
						
			$out .= '</li>';
		}
		
		endwhile;
		
		$out .= '</ul>';
		
		$out .= ( strpos( $disable, 'pagination' ) === false ) ? miss_pagenavi( '', '', $portfolio_query ) : '';
		
		else :
		
			$out .= __( 'No portfolio posts were found for the category selected.', MISS_TEXTDOMAIN );
		
		endif;
		
		if( ( is_numeric( $offset ) ) && ( strpos( $disable, 'pagination' ) === false  ) ) {
			remove_filter('post_limits', 'my_post_limit');
		}
		
		wp_reset_query();
		//return '[raw]' . $out . '[/raw]';
		return $out;
	}
*/	
	
	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();

		$class_methods = get_class_methods( $class );

		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}

		$options = array(
			'name' => __( 'Portfolio', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of portfolio you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'portfolio_grid',
			'options' => $shortcode,
//			'shortcode_has_types' => true
		);

		return $options;
	}

}

?>
