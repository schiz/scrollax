<?php
/**
 *
 */

class IrishMissW_RecentPost_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_RecentPost_Widget() {
		$widget_ops = array( 'classname' => 'miss_recent_widget', 'description' => __( 'Custom recent post widget with post preview image', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'recentposts', sprintf( __( '%1$s - Recent Post', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $wpdb, $shortname, $irish_framework_params;
		$prefix = MISS_PREFIX;
		
        	extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$tagline = apply_filters('widget_tagline', empty($instance['tagline']) ? '' : '<h6>' . $instance['tagline'] . '</h6>', $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		$out = $before_widget;
		$out .= $before_title . $title . $after_title . $tagline;
		
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
		$show_rating = ( isset( $instance['show_rating'] ) ) ? '1' : '0';
		
		$recent_query = new WP_Query(array(
			'showposts' => $number,
			'nopaging' => 0,
			'post_status' => 'publish',
			'category__not_in' => array( miss_exclude_category_string( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
		if ( $recent_query->have_posts() ) {
			$out .= '<ul class="post_list small_post_list">';
			
			while ( $recent_query->have_posts() ) {
				$recent_query->the_post();
			
				$out .= '<li class="post_list_module">';
			
/*				
					$out .= miss_get_post_image( $filter_args );
				$get_year = get_the_time( 'Y', get_the_ID() );
				$get_month = get_the_time( 'm', get_the_ID() );
 else {
					$out .= '<div class="month pull-left">';
					$out .= '<span class="day">';
					$out .= get_the_date('d');
					$out .= '</span>';
					$out .= get_the_date('M');
					$out .= '</div>';
				}
*/
				if( !$disable_thumb ) {
					$widget_thumb_img = $irish_framework_params->layout['big_sidebar_images']['small_post_list'];
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
				$out .= '<p class="post_title">';
				$out .= '<a rel="bookmark" href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a>';
				$out .= '</p>';
				$out .= '<div class="post_excerpt">';
				$out .= miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_spotlight_excerpt', 60 ), apply_filters( 'miss_excerpt', THEME_ELLIPSIS ) );
				$out .= '</div>';
			
				$out .= '<div class="clearboth"></div>';

			
				$out .= '</li>';
			}
			
			$out .= '</ul>';
		}
		
		$out .= $after_widget;
		
		wp_reset_postdata();
		echo $out;
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['tagline'] = strip_tags($new_instance['tagline']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
		$instance['show_rating'] = !empty($new_instance['show_rating']) ? 1 : 0;		
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tagline = isset($instance['tagline']) ? esc_attr($instance['tagline']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		$show_rating = isset( $instance['show_rating'] ) ? (bool) $instance['show_rating'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('tagline'); ?>"><?php _e( 'Tagline:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('tagline'); ?>" name="<?php echo $this->get_field_name('tagline'); ?>" type="text" value="<?php echo $tagline; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of recent posts you'd like to display:", MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?', MISS_ADMIN_TEXTDOMAIN ); ?></label></p>


        <?php 
/*
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>"<?php checked( $show_rating ); ?> />
		<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php _e( 'Show rating?', MISS_ADMIN_TEXTDOMAIN ); ?></label></p>		
*/
    }

}

?>
