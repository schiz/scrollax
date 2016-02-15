<?php
/**
 *
 */

class IrishMissW_WorkHours_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_WorkHours_Widget() {
		$widget_ops = array( 'classname' => 'miss_workhours_widget', 'description' => __( 'Widget will display workhours table.', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'workhours', sprintf( __( '%1$s - WorkHours', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Work Hours', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$descr_before = ( isset( $instance['descr_before'] ) ? $instance['descr_before'] : '' );
		$descr_after = ( isset( $instance['descr_after'] ) ? $instance['descr_after'] : '' );

		$workdays = Array (
			'mon' => ( isset( $instance['mon'] ) ? $instance['mon'] : '' ),
			'tue' => ( isset( $instance['tue'] ) ? $instance['tue'] : '' ),
			'wed' => ( isset( $instance['wed'] ) ? $instance['wed'] : '' ),
			'thu' => ( isset( $instance['thu'] ) ? $instance['thu'] : '' ),
			'fri' => ( isset( $instance['fri'] ) ? $instance['fri'] : '' ),
			'sat' => ( isset( $instance['sat'] ) ? $instance['sat'] : '' ),
			'sun' => ( isset( $instance['sun'] ) ? $instance['sun'] : '' ),
		);

		$weekday = Array (
			'mon' => __( 'Monday',   MISS_TEXTDOMAIN ),
			'tue' => __( 'Tuesday',  MISS_TEXTDOMAIN ),
			'wed' => __( 'Wednesday',MISS_TEXTDOMAIN ),
			'thu' => __( 'Thursday', MISS_TEXTDOMAIN ),
			'fri' => __( 'Friday',   MISS_TEXTDOMAIN ),
			'sat' => __( 'Saturday', MISS_TEXTDOMAIN ),
			'sun' => __( 'Sunday',   MISS_TEXTDOMAIN )
		);

		?>
	
        <?php echo $before_widget; ?>

		<?php echo $before_title . $title . $after_title; ?>
		<?php echo'<div>'; ?>
		<?php if ( !empty( $descr_before ) ): ?>
			<div>
					<?php echo do_shortcode( $descr_before ); ?>
			</div>
		<?php endif; ?>
			<div>
		<?php
			foreach( $workdays as $days => $day ) {
				if ( !empty( $day ) ) {
					$values = explode(',', $day);
					$columns = floatval ( (12 / ( count( $values ) + 1 ) ) );
					echo '<div class="row-fluid weekdays weekday_' . $days . '">';
					echo '<div class="span' . $columns . '"><i class="fa-icon-time"></i> ' . $weekday[ $days ] . '</div>';
					foreach( $values as $time ) {
						echo '<div class="span' . $columns . '">' . $time . '</div>';
					}
					echo '</div>';
/*
					$columns = floatval ( (12 / ( count( $values ) + 1 ) ) );
					echo '<tr class="weekdays weekday_' . $days . '">';
					echo '<td><i class="fa-icon-time"></i> ' . $weekday[ $days ] . '</td>';
					foreach( $values as $time ) {
						echo '<td>' . $time . '</td>';
					}
					echo '</tr>';
*/
				}
			}
		?>
			</div>
		<?php if ( !empty( $descr_after ) ): ?>
			<div>
					<?php echo do_shortcode( $descr_after ); ?>
			</div>
		<?php endif; ?>
		<?php echo'</div>'; ?>
        <?php echo $after_widget; ?>
<?php
	}

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['descr_before'] = strip_tags($new_instance['descr_before']);
		$instance['descr_after'] = strip_tags($new_instance['descr_after']);

		$instance['mon'] = strip_tags($new_instance['mon']);
		$instance['tue'] = strip_tags($new_instance['tue']);
		$instance['wed'] = strip_tags($new_instance['wed']);
		$instance['thu'] = strip_tags($new_instance['thu']);
		$instance['fri'] = strip_tags($new_instance['fri']);
		$instance['sat'] = strip_tags($new_instance['sat']);
		$instance['sun'] = strip_tags($new_instance['sun']);
			
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $descr_before = isset($instance['descr_before']) ? esc_attr($instance['descr_before']) : '';
        $descr_after = isset($instance['descr_after']) ? esc_attr($instance['descr_after']) : '';
        $mon = isset($instance['mon']) ? esc_attr($instance['mon']) : '9am,5pm';
        $tue = isset($instance['tue']) ? esc_attr($instance['tue']) : '9am,5pm';
        $wed = isset($instance['wed']) ? esc_attr($instance['wed']) : '9am,5pm';
        $thu = isset($instance['thu']) ? esc_attr($instance['thu']) : '9am,5pm';
        $fri = isset($instance['fri']) ? esc_attr($instance['fri']) : '9am,5pm';
        $sat = isset($instance['sat']) ? esc_attr($instance['sat']) : '11am,4pm';
        $sun = isset($instance['sun']) ? esc_attr($instance['sun']) : 'Close';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('descr_before'); ?>"><?php _e( 'Description Before:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('descr_before'); ?>" name="<?php echo $this->get_field_name('descr_before'); ?>" type="text"><?php echo $descr_before; ?></textarea></p>

		<!-- Monday -->
		<p><label for="<?php echo $this->get_field_name('mon'); ?>"><?php _e( 'Monday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('mon'); ?>" name="<?php echo $this->get_field_name('mon'); ?>" type="text" value="<?php echo $mon; ?>" /></p>

		<!-- Tuesday -->
		<p><label for="<?php echo $this->get_field_name('tue'); ?>"><?php _e( 'Tuesday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('tue'); ?>" name="<?php echo $this->get_field_name('tue'); ?>" type="text" value="<?php echo $tue; ?>" /></p>

		<!-- Wednesday -->
		<p><label for="<?php echo $this->get_field_name('wed'); ?>"><?php _e( 'Wednesday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('wed'); ?>" name="<?php echo $this->get_field_name('wed'); ?>" type="text" value="<?php echo $wed; ?>" /></p>

		<!-- Thursday -->
		<p><label for="<?php echo $this->get_field_name('thu'); ?>"><?php _e( 'Thursday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('thu'); ?>" name="<?php echo $this->get_field_name('thu'); ?>" type="text" value="<?php echo $thu; ?>" /></p>

		<!-- Friday -->
		<p><label for="<?php echo $this->get_field_name('fri'); ?>"><?php _e( 'Friday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fri'); ?>" name="<?php echo $this->get_field_name('fri'); ?>" type="text" value="<?php echo $fri; ?>" /></p>

		<!-- Saturday -->
		<p><label for="<?php echo $this->get_field_name('sat'); ?>"><?php _e( 'Saturday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('sat'); ?>" name="<?php echo $this->get_field_name('sat'); ?>" type="text" value="<?php echo $sat; ?>" /></p>

		<!-- Sunday -->
		<p><label for="<?php echo $this->get_field_name('sun'); ?>"><?php _e( 'Sunday:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('sun'); ?>" name="<?php echo $this->get_field_name('sun'); ?>" type="text" value="<?php echo $sun; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id('descr_after'); ?>"><?php _e( 'Description After:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('descr_after'); ?>" name="<?php echo $this->get_field_name('descr_after'); ?>" type="text"><?php echo $descr_after; ?></textarea></p>
        <?php
    }
}
?>