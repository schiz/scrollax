<?php
/**
 *
 */

class IrishMissW_Text extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_Text() {
		$widget_ops = array( 'classname' => 'miss_text', 'description' => __( 'Putting attention to one post', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'miss_text', sprintf( __( '%1$s - Text', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $wpdb, $irish_framework_params;
		$prefix = MISS_PREFIX;
		
		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent News', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$tagline = apply_filters('widget_tagline', empty($instance['tagline']) ? '' : '<h6>' . $instance['tagline'] . '</h6>', $instance, $this->id_base);
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );


		$out = $before_widget;
		$out .= $before_title . $title . $after_title . $tagline;
		$out .= '<div class="textwidget">' . ( !empty( $text ) ? wpautop( $text ) : $text ) . '</div>';
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
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tagline = isset($instance['tagline']) ? esc_attr($instance['tagline']) : '';
		$text = isset($instance['text']) ? esc_textarea($instance['text']) : '';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('tagline'); ?>"><?php _e( 'Tagline:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('tagline'); ?>" name="<?php echo $this->get_field_name('tagline'); ?>" type="text" value="<?php echo $tagline; ?>" /></p>
		
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
        <?php
    }

}

?>
