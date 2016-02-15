<?php
/**
 *
 */
class missWidgets {

	/**
	 *
	 */
	public static function twitter( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Twitter', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'twitter',
				'options' => array(
					array(
						'name' => __( 'Username', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste your twitter username here.  You can find your username by going to your settings page within twitter.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Count', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many tweets you want to be displayed.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'id' 		=> '',
			'number'	=> '1',
			'title' 	=> ' '
		);
		
		if( isset( $atts['count'] ) )
			$atts['number'] = $atts['count'];
		
		if( isset( $atts['username'] ) )
			$atts['id'] = $atts['username'];
			
		if( empty( $atts['id'] ) )
			$atts['id'] = miss_get_setting( 'twitter_id' );
			
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'IrishMissW_Twitter_Widget', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function flickr( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Flickr', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'flickr',
				'options' => array(
					array(
						'name' => __( 'Flickr id (<a target="_blank" href="http://idgettr.com/">idGettr</a>)', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set your Flickr ID here.  You can use the idGettr service to easily find your ID.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Count', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many flickr images you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'count',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
					array(
						'name' => __( 'Size', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the size of your flickr images.<br /><br />Each setting will display differently so try and experiment with them to find which one suits you best.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '',
						'options' => array(
							's' => __('Square', MISS_ADMIN_TEXTDOMAIN ),
							't' => __('Thumbnail', MISS_ADMIN_TEXTDOMAIN ),
							'm' => __('Medium', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Display', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select whether you want your latest images to display or a random selection.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'display',
						'default' => '',
						'options' => array(
							'latest' => __('Latest', MISS_ADMIN_TEXTDOMAIN ),
							'random' => __('Random', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'id' 		=> '44071822@N08',
			'number'	=> '9',
			'display'	=> 'latest',
			'size'		=> 's',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'IrishMissW_Flickr_Widget', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function recent_posts( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Recent Posts', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'recent_posts',
				'options' => array(
					array(
						'name' => __( 'Number', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
					array(
						'name' => __( 'Thumbnail', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose whether you want thumbnails to display alongside your posts.  The thumbnail uses the featured image of your post.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable_thumb',
						'default' => '',
						'options' => array(
							'0' => __( 'Yes', MISS_ADMIN_TEXTDOMAIN ),
							'1' => __( 'No', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

		return $option;
		
		}
		
		$defaults = array(
			'number'	=> '',
			'disable_thumb'	=> '',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'IrishMissW_RecentPost_Widget', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function popular_posts( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Popular Posts', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'popular_posts',
				'options' => array(
					array(
						'name' => __( 'Number', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
					array(
						'name' => __( 'Thumbnail', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose whether you want thumbnails to display alongside your posts.  The thumbnail uses the featured image of your post.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable_thumb',
						'default' => '',
						'options' => array(
							'0' => __( 'Yes', MISS_ADMIN_TEXTDOMAIN ),
							'1' => __( 'No', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

		return $option;
		
		}
		
		$defaults = array(
			'number'	=> '',
			'disable_thumb'	=> '',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'IrishMissW_PopularPost_Widget', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function contact_info( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Contact Info', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'contact_info',
				'options' => array(
					array(
						'name' => __( 'Name', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your name.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'name',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Phone', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your phone number.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'phone',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Email', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your email address.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'email',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Address', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your address.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'address',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'City', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your city.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'city',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'State', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your state.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'state',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Zip', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your zip.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'zip',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'name'          => '',
			'address' 	=> '',
			'city'          => '',
			'state'         => '',
			'zip'           => '',
			'phone'         => '',
			'email'         => '',
			'title'         => ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'IrishMissW_Contact_Widget', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function comments( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Comments', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'comments',
				'options' => array(
					array(
						'name' => __( 'Number', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of comments you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
			
		$defaults = array(
			'title' => ' ',
			'number' => '5'
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Recent_Comments', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function tags( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Tags', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'tags',
				'options' => array(
					array(
						'name' => __( 'Taxonomy', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select whether you wish to display categories or tags.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'taxonomy',
						'default' => '',
						'options' => array(
							'post_tag' => __( 'Post Tags', MISS_ADMIN_TEXTDOMAIN ),
							'category' => __( 'Category', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'title' => ' ',
			'taxonomy' => 'post_tag'
		);
			
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Tag_Cloud', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}

	/**
	 *
	 */
	public static function rss( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Rss', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'rss',
				'options' => array(
					array(
						'name' => __( 'RSS feed URL ', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL to your feed.  For example if you are using feedburner then you would paste something like this,<br /><br />http://feeds.feedburner.com/username', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'url',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'How many items would you like to display?', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of RSS items you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'items',
						'default' => '',
						'options' => $number,
						'type' => 'select',
					),
					array(
						'name' => __( 'Show Summary', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this if you wish to display a summary of the item.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'show_summary',
						'options' => array( '1' => __( 'Show Summary', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Show Author', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to display the author of the item.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'show_author',
						'options' => array( '1' => __( 'Show Author', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Show Date', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to display the date of the item.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'show_date',
						'options' => array( '1' => __( 'Show Date', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'title' => ' ',
			'url' => '',
			'items' => 3,
			'error' => false,
			'show_summary' => 0,
			'show_author' => 0,
			'show_date' => 0
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_RSS', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	public static function search( $atts = null ) {
		
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Search', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'search'
			);

			return $option;
		}
		
		$defaults = array( 'title' => ' ' );
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Search', 'instance' => $instance );
		
		$widget = new missWidgets();
		return $widget->_widget_generator( $args );
	}

	/**
	 *
	 */
	public static function _widget_generator( $args = array() ) {
		global $wp_widget_factory;
		
		$widget_name = esc_html( $args['widget_name'] );

		ob_start();
		the_widget( $widget_name, $args['instance'], array( 'before_title' => '', 'after_title' => '', 'widget_id' => '-1' ) );
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Widget', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which widget shortcode you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'widget',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
