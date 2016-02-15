<?php
/**
 *
 */

class IrishMissW_Testimonials_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_Testimonials_Widget() {
		$widget_ops = array( 'classname' => 'miss_testimonials_widget', 'description' => __( 'Widget will display testimonials carousel.', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'testimonials', sprintf( __( '%1$s - Testimonials', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $wpdb, $shortname, $irish_framework_params;
		$prefix = MISS_PREFIX;
		
        	extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		$out = $before_widget;
		$out .= $before_title . $title . $after_title;
		
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
		$show_rating = ( isset( $instance['show_rating'] ) ) ? '1' : '0';
		
		$recent_query = new WP_Query(array(
			'showposts' => $number,
			'nopaging' => 0,
			'post_type' => 'testimonials',
			'post_status' => 'publish',
			'category__not_in' => array( miss_exclude_category_string( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
		if ( $recent_query->have_posts() ) {
			$out .= '<div class="contents">
                        <div class="wrap">';
			
			while ( $recent_query->have_posts() ) {
				$recent_query->the_post();
			
				$out .= '<div class="module-replies">
                            <div class="quote">
                                “
                            </div>
                            <div class="reply">';
				$out .= get_the_content();
                $out .= '</div>
                            <i class="im-icon-user " style=""></i>
                            <div class="name">';
				$out .= get_the_title();
				$out .= '</div>
                          </div>';
			}
			
			$out .= '</div>
                      </div>';
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
		$instance['number'] = (int) $new_instance['number'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		$show_rating = isset( $instance['show_rating'] ) ? (bool) $instance['show_rating'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of testimonials to show:", MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>


        <?php 
    }

}

?>
