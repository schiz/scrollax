<?php
/**
 *
 */

class IrishMissW_Gmap_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_Gmap_Widget() {
		$widget_ops = array( 'classname' => 'miss_gmap_widget', 'description' => __( 'Quickly add google map with single marker to sidebar.', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'gmap', sprintf( __( '%1$s - Gmap', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Google Map', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$descr_before = ( isset( $instance['descr_before'] ) ? $instance['descr_before'] : '' );
		$descr_after = ( isset( $instance['descr_after'] ) ? $instance['descr_after'] : '' );

		$params = Array (
			'width' => '100%',
			'zoom' => ( isset( $instance['mzoom'] ) ? $instance['mzoom'] : '15' ),
			'type' => ( isset( $instance['mtype'] ) ? $instance['mtype'] : 'ROADMAP' ),
			'height' => ( isset( $instance['mheight'] ) ? $instance['mheight'] : '200' ),
			'marker' => Array(
				'address' => ( isset( $instance['maddr'] ) ? $instance['maddr'] : '' ),
				'description' => ( isset( $instance['mdescr'] ) ? $instance['mdescr'] : '' ),
			),
		);

		?>
	
        <?php echo $before_widget; ?>

		<?php echo $before_title . $title . $after_title; ?>
		<?php if ( !empty( $descr_before ) ): ?>
			<div>
					<?php echo do_shortcode( $descr_before ); ?>
			</div>
		<?php endif; ?>
		<?php
			$out = '[map width="' . $params['width'] . '" height="' . $params['height'] . '" zoom="' . $params['zoom'] . '" type="' . $params['type'] . '"]';
			$out .= '[marker address="' . $params['marker']['address'] . '"]';
			$out .= $params['marker']['description'];
			$out .= '[/marker]';
			$out .= '[/map]';
			echo do_shortcode( $out );
		?>
		<?php if ( !empty( $descr_after ) ): ?>
			<div>
					<?php echo do_shortcode( $descr_after ); ?>
			</div>
		<?php endif; ?>
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
		$instance['mzoom'] = strip_tags($new_instance['mzoom']);
		$instance['mtype'] = strip_tags($new_instance['mtype']);
		$instance['mheight'] = strip_tags($new_instance['mheight']);
		$instance['maddr'] = strip_tags($new_instance['maddr']);
		$instance['mdescr'] = strip_tags($new_instance['mdescr']);
			
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $descr_before = isset($instance['descr_before']) ? esc_attr($instance['descr_before']) : '';
        $descr_after = isset($instance['descr_after']) ? esc_attr($instance['descr_after']) : '';
        $mzoom = isset($instance['mzoom']) ? esc_attr($instance['mzoom']) : '15';
        $mtype = isset($instance['mtype']) ? esc_attr($instance['mtype']) : 'ROADMAP';
        $mheight = isset($instance['mheight']) ? esc_attr($instance['mheight']) : '200';
        $maddr = isset($instance['maddr']) ? esc_attr($instance['maddr']) : '';
        $mdescr = isset($instance['mdescr']) ? esc_attr($instance['mdescr']) : '';
        $map = Array(
	        'zoom' => range(1,17),
	        'type' => Array('ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN'),
	        'width' => '100%'
        );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('descr_before'); ?>"><?php _e( 'Description Before:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('descr_before'); ?>" name="<?php echo $this->get_field_name('descr_before'); ?>" type="text"><?php echo $descr_before; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('mzoom'); ?>"><?php _e( 'Zoom:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('mzoom'); ?>" id="<?php echo $this->get_field_id('mzoom'); ?>" class="widefat">
		<?php
			foreach( $map['zoom'] as $_zoom ) {
				echo '<option value="' . $_zoom .'" ' . selected($mzoom, $_zoom) . '>' . $_zoom . '</option>';
			}
		?>
		</select></p>

		<p><label for="<?php echo $this->get_field_id('mtype'); ?>"><?php _e( 'Type:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('mtype'); ?>" id="<?php echo $this->get_field_id('mtype'); ?>" class="widefat">
		<?php
			foreach( $map['type'] as $_type ) {
				echo '<option value="' . $_type .'" ' . selected($mtype, $_type) . '>' . $_type . '</option>';
			}
		?>
		</select></p>

		<!-- Address -->
		<p><label for="<?php echo $this->get_field_name('sun'); ?>"><?php _e( 'Marker Address:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('maddr'); ?>" name="<?php echo $this->get_field_name('maddr'); ?>" type="text" value="<?php echo $maddr; ?>" /><br />
			<em>Example: Broadcasting House, Portland Place, London, United Kingdom</em>
	    </p>

		<p><label for="<?php echo $this->get_field_id('mdescr'); ?>"><?php _e( 'Marker Description:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('mdescr'); ?>" name="<?php echo $this->get_field_name('mdescr'); ?>"><?php echo $mdescr; ?></textarea>
			<em>Example: Main Office</em>
		</p>

		<!-- Height -->
		<p><label for="<?php echo $this->get_field_name('sun'); ?>"><?php _e( 'Height:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('mheight'); ?>" name="<?php echo $this->get_field_name('mheight'); ?>" type="text" value="<?php echo $mheight; ?>" /><br />
	    </p>

		<p><label for="<?php echo $this->get_field_id('descr_after'); ?>"><?php _e( 'Description After:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('descr_after'); ?>" name="<?php echo $this->get_field_name('descr_after'); ?>"><?php echo $descr_after; ?></textarea></p>
        <?php
    }
}
?>