<?php
/**
 *
 */

class IrishMissW_PopularPost_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_PopularPost_Widget() {
		$widget_ops = array( 'classname' => 'miss_popular_widget', 'description' => __( 'Custom popular post widget with post preview image', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'popularwidget', sprintf( __( '%1$s - Popular Post', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $irish_framework_params;
		$prefix = MISS_PREFIX;
		
		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		$count = ( !empty( $count ) ) ? trim( $count ) : '3';
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
		$show_rating = ( !empty($instance['show_rating'] ) ) ? '1' : '0';
		$show_date = ( !empty( $instance['show_date'] ) ) ? '1' : '0';

		$popular_query = new WP_Query(array(
			'showposts' => $number,
			'nopaging' => 0,
			'orderby'=> 'comment_count',
			'post_status' => 'publish',
			'category__not_in' => array( miss_exclude_category_string( $minus = false )),
			'ignore_sticky_posts' => 1
		));
		
		$out = '<ul class="post_list small_post_list">';
		
		while ( $popular_query->have_posts() ) {
			$popular_query->the_post();
			
			$out .= '<li class="post_list_module">';
			
			if( !$disable_thumb ) {
				$widget_thumb_img = $irish_framework_params->layout['small_sidebar_images']['small_post_list'];
				$out .= miss_get_post_image(array(
					'width' => $widget_thumb_img[0],
					'height' => $widget_thumb_img[1],
					'img_class' => 'image',
					'preload' => false,
					'placeholder' => true,
					'echo' => false,
					'wp_resize' => ( miss_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
				));
			}
			
			$out .= '<div class="post_list_content">';
			
			if ($show_rating && score_value(get_the_ID()) != 0) {
				$postid = get_the_ID();
				$score = score_value($postid); 
				$out .= '<div class="rating_box">'.score_output($score,'small').'</div>';
			}

			$out .= '<p class="post_title">';
			$out .= '<a rel="bookmark" href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a>';
			$out .= '</p>';
			$out .= '<div class="post_excerpt">';
			$out .= miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_spotlight_excerpt', 55 ), apply_filters( 'miss_excerpt', THEME_ELLIPSIS ) );
			$out .= '</div>';
		
			$out .= '<div class="clearboth"></div>';
		
/*
			$get_year = get_the_time( 'Y', get_the_ID() );
			$get_month = get_the_time( 'm', get_the_ID() );
*/
			if ($show_date) {
				$out .= '<p class="post_meta">';
				$out .= apply_filters( 'miss_widget_meta', do_shortcode( '[post_date]' ) );
				$out .= '</p>';
			}
			
			$out .= '</div>';
		
			$out .= '</li>';
		}
		
		$out .= '</ul>';



		echo $out;
		echo $after_widget;
		
		wp_reset_postdata();
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
		$instance['show_rating'] = !empty($new_instance['show_rating']) ? 1 : 0;
		$instance['show_date'] = !empty($new_instance['show_date']) ? 1 : 0;
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		$show_rating = isset( $instance['show_rating'] ) ? (bool) $instance['show_rating'] : false;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of popular posts you'd like to display:", MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?', MISS_ADMIN_TEXTDOMAIN ); ?></label></p>

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>"<?php checked( $show_rating ); ?> />
		<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php _e( 'Show rating?', MISS_ADMIN_TEXTDOMAIN ); ?></label></p>		

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>"<?php checked( $show_date ); ?> />
		<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show post date?', MISS_ADMIN_TEXTDOMAIN ); ?></label></p>		
        <?php
    }

}

?>
