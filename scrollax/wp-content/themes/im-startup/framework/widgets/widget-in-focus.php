<?php
/**
 *
 */

class IrishMissW_InFocus_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_InFocus_Widget() {
		$widget_ops = array( 'classname' => 'miss_in_focus_widget', 'description' => __( 'Putting attention to one post', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 200, 'height' => 200 );
		$this->WP_Widget( 'infocus', sprintf( __( '%1$s - In-Focus', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $wpdb, $irish_framework_params;
		$prefix = MISS_PREFIX;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('In Focus', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);

		extract( $args );

		$post_id = array( $instance['post_id'] ) ? array( $instance['post_id'] ) : false;
		$args = Array(
			
			'showposts' => 1,
			'post_status' => 'publish'
		);
		if ( isset( $post_id ) && $post_id ) {
			$args['post__in'] = $post_id;
		}
		$infocus_query = new WP_Query( $args );
		$out = ''; 
		echo $before_widget;
		$out .= '<div class="in_focus">';
		while ( $infocus_query->have_posts() ) {
			$infocus_query->the_post();
			if( !isset( $disable_thumb ) ) {
				$widget_thumb_img = $irish_framework_params->layout['images']['blog_layout5'];
				$out .= miss_get_post_image(array(
					'width' => $widget_thumb_img[0],
					'height' => $widget_thumb_img[1],
					'img_class' => 'in_focus_image',
					'preload' => false,
					'placeholder' => true,
					'echo' => false,
					'wp_resize' => ( miss_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
				));
			} 
			$out .= '<div class="in_focus_bottom">';
			$out .= '	<div class="bottom_bulk_box_field">';
			$out .= '		<div class="box">';
			$out .= '			<div class="post_title">';
			$out .= '				<a rel="bookmark" href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a>';
			$out .= '			</div>';
			$out .= '		</div>';
/*
			$out .= '		<div class="bulk">';
			$out .= '		</div>';
			$out .= '		<div class="shadow">';
			$out .= '		</div>';
*/
			$out .= '	</div><!--  class="bottom_bulk_box_field" -->';
			$out .= '</div><!--  class="in_focus_bottom" -->';
		}
		$out .= '</div><!--  class="in_focus" -->';

		echo $out;
		echo $after_widget;
		
    }

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_id'] = (int) $new_instance['post_id'];
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$post_id = ( isset( $instance['post_id'] ) ) ? (int) $instance['post_id'] : '';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('post_id'); ?>"><?php _e( "Enter the ID of post you'd like to display:", MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" type="text" value="<?php echo $post_id; ?>" /></p>
        <?php
    }

}

?>
