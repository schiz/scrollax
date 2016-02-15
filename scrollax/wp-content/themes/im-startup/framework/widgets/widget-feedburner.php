<?php
class IrishMissW_Feedburner_Link_Widget extends WP_Widget {
	// Widget Settings
	function IrishMissW_Feedburner_Link_Widget() {
		$widget_ops = array('description' => __('Displaying Feedburner link','framework') );
		$control_ops = array( 'width' => 300, 'height' => 225, 'id_base' => 'feedburner' );
		$this->WP_Widget( 'feedburner', sprintf( __( '%1$s - Feedburner Link', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
	}
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$feedburner = $instance['feedburner'];
		$description = $instance['description'];
		
		// ------
		echo $before_widget;
		//echo $before_title . $title . $after_title;
		echo '<div class="feed_link_widget"><a id="sc_rss" class="socialCounterBox" href="' . $feedburner . '" target="_blank"><i class="fa-icon-rss icon"></i>';
		echo '<span class="title">' . $title . '</span>';
		echo '</a>';
		echo '<span class="description">';
		if (!empty($description)) {
		    echo $description;
		} else {
		    echo __('Subscribe now',MISS_ADMIN_TEXTDOMAIN);
		}
		echo'</span>';
		echo '</div>';
		echo $after_widget;
	}
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feedburner'] = $new_instance['feedburner'];
		$instance['description'] = $new_instance['description'];
		
		return $instance;
	}
	// Backend Form
	function form($instance) {
		
		$defaults = array( 'title' => '', 'feedburner' => '', 'description' => '' ); // Default Values
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php   echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input class="widefat" id="<?php   echo $this->get_field_id( 'title' ); ?>" name="<?php   echo $this->get_field_name( 'title' ); ?>" value="<?php   echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php   echo $this->get_field_id( 'feedburner' ); ?>">Feed Link:</label>
			<input class="widefat" rows="4" cols="20" id="<?php   echo $this->get_field_id( 'feedburner' ); ?>" name="<?php   echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" />
		</p>
		<p>
			<label for="<?php   echo $this->get_field_id( 'description' ); ?>">Description:</label>
			<textarea class="widefat" rows="2" cols="20" id="<?php   echo $this->get_field_id( 'description' ); ?>" name="<?php   echo $this->get_field_name( 'description' ); ?>"><?php   echo $instance['description']; ?></textarea>
		</p>
		
    <?php   }
}
?>