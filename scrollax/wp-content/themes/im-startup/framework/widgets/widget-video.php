<?php
class IrishMissW_Embedded_Video_Widget extends WP_Widget { 
	// Widget Settings
	function IrishMissW_Embedded_Video_Widget() {
		$widget_ops = array('description' => __('Display Embed Code, such as video, social networks... Max width 300px','framework') );
		$control_ops = array( 'width' => 300, 'height' => 225, 'id_base' => 'embed' );
		$this->WP_Widget( 'embed', sprintf( __( '%1$s - Embedded Code', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
	}
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$embed = $instance['embed'];
		$description = $instance['description'];
		
		// ------
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		echo '<div class="embed_code">';
		echo $embed;
		if (!empty($description)) { echo '<p>' . $description . '</p>'; }
		echo '</div>';
		echo $after_widget;
	}
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['embed'] = $new_instance['embed'];
		$instance['description'] = $new_instance['description'];
		
		return $instance;
	}
	// Backend Form
	function form($instance) {
		
		$defaults = array( 'title' => 'Embed Widget', 'embed' => '', 'description' => '' ); // Default Values
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php   echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input class="widefat" id="<?php   echo $this->get_field_id( 'title' ); ?>" name="<?php   echo $this->get_field_name( 'title' ); ?>" value="<?php   echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php   echo $this->get_field_id( 'embed' ); ?>">Embed Code:</label>
			<textarea class="widefat" rows="4" cols="20" id="<?php   echo $this->get_field_id( 'embed' ); ?>" name="<?php   echo $this->get_field_name( 'embed' ); ?>"><?php   echo $instance['embed']; ?></textarea>
		</p>
		<p>
			<label for="<?php   echo $this->get_field_id( 'description' ); ?>">Description:</label>
			<textarea class="widefat" rows="2" cols="20" id="<?php   echo $this->get_field_id( 'description' ); ?>" name="<?php   echo $this->get_field_name( 'description' ); ?>"><?php   echo $instance['description']; ?></textarea>
		</p>
		
    <?php   }
}
?>