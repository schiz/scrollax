<?php
/**
 *
 */

class IrishMissW_Contact_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function IrishMissW_Contact_Widget() {
		$widget_ops = array( 'classname' => 'miss_contact_widget', 'description' => __( 'Quickly add contact info to your sidebar (e.g. address, phone #, email)', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'contact', sprintf( __( '%1$s - Contact Us', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Info', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$name = ( isset( $instance['name'] ) ? $instance['name'] : '' );
		$address = ( isset( $instance['address'] ) ? $instance['address'] : '' );
		$city = ( isset( $instance['city'] ) ? $instance['city'] : '' );
		$state = ( isset( $instance['state'] ) ? $instance['state'] : '' );
		$zip = ( isset( $instance['zip'] ) ? $instance['zip'] : '' );
		$phone = ( isset( $instance['phone'] ) ? $instance['phone'] : '' );
		$fax = ( isset( $instance['fax'] ) ? $instance['fax'] : '' );
		$email = ( isset( $instance['email'] ) ? $instance['email'] : '' );
		$site = ( isset( $instance['site'] ) ? $instance['site'] : '' );
		?>
	
        <?php echo $before_widget; ?>

		<?php echo $before_title . $title . $after_title; ?>
		<ul class="plain_contacts_widget">
		<li class="contact_widget_addres"><i class="im-icon-office"></i>
		<?php if ( $name ) : ?>
		<?php echo $name . ', <br />'; ?><?php endif; ?>
		<?php if ( $address ) : ?>
		<?php echo $address . '<br />'; ?><?php endif; ?>
		<?php if ( $zip ) : ?>
		<?php echo $zip . ', '; ?><?php endif; ?>
		<?php if ( $state ) : ?>
		<?php echo $state . ' '; ?><?php endif; ?>
		<?php if ( $city ) : ?>
		<?php echo $city; ?><?php endif; ?>
		</li>
		<?php if ( $phone ) : ?>
		<li class="contact_widget_phone"><i class="im-icon-phone-3"></i><?php echo $phone; ?></li><?php endif; ?>
		<?php if ( $fax ) : ?>
		<li class="contact_widget_fax"><i class="im-icon-print-2"></i><?php echo $fax; ?></li><?php endif; ?>
		<?php if ( $email ) : ?>
		<li class="contact_widget_email"><i class="im-icon-envelop"></i><a href="#" rel="<?php echo miss_nospam( $email ); ?>" class="email_link_replace mailto"><?php echo miss_nospam( $email ); ?></a></li> <?php endif; ?>
		<?php if ( $site ) : ?>
		<li class="contact_widget_site"><i class="im-icon-earth"></i><a href="<?php echo $site; ?>"><?php echo $site; ?></a></li> <?php endif; ?>
		</ul>
        <?php echo $after_widget;
	}

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['city'] = strip_tags($new_instance['city']);
		$instance['state'] = strip_tags($new_instance['state']);
		$instance['zip'] = strip_tags($new_instance['zip']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['site'] = strip_tags($new_instance['site']);
			
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$name = isset($instance['name']) ? esc_attr($instance['name']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$city = isset($instance['city']) ? esc_attr($instance['city']) : '';
		$state = isset($instance['state']) ? esc_attr($instance['state']) : '';
		$zip = isset($instance['zip']) ? esc_attr($instance['zip']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$fax = isset($instance['fax']) ? esc_attr($instance['fax']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$site = isset($instance['site']) ? esc_attr($instance['site']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e( 'Name:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_name('address'); ?>"><?php _e( 'Address:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('city'); ?>"><?php _e( 'City:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('state'); ?>"><?php _e( 'State:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo $state; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e( 'Zip:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e( 'Phone:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e( 'Fax:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" /></p>

		<p><label for="<?php echo $this->get_field_name('email'); ?>"><?php _e( 'Email:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>

		<p><label for="<?php echo $this->get_field_name('site'); ?>"><?php _e( 'Web Site:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('site'); ?>" name="<?php echo $this->get_field_name('site'); ?>" type="text" value="<?php echo $site; ?>" /></p>
        <?php
    }

}

?>
