<?php
/**
 *
 */
class missBenefits {
	/**
	 *
	 */
	public static function benefits( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Benefits', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'benefits',
				'options' => array(
					array(
						'name' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter benefits block title or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter tagline (alternative title) or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select display style (required for icon box).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'class',
						'type' => 'radio',
						'options' => array( 
							'claen' => __( 'Clean', MISS_ADMIN_TEXTDOMAIN ),
							'circle' => __( 'Round Frame', MISS_ADMIN_TEXTDOMAIN ),
							'box' => __( 'Square Box', MISS_ADMIN_TEXTDOMAIN ),
						),
						'default' => 'clean',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of Benefits', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select number of the benefits.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => range(1,6),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Benefit 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter benefit title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Benefit 1 Icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select benefit icon.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Benefit 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter benefit content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'benefit',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);			
			return $option;
		}
		
		$out = '';

		$defaults = array(
			'caption' => '', 
			'tagline' => '',
			'class' => 'clean',
			'multiply' => '', 
		);

		$atts = shortcode_atts( $defaults, $atts);

		extract($atts);
		
		$caption = trim( $caption );
		$tagline = trim( $tagline );

		switch( $multiply ) {
			case 1:
				$span = 'span12';
				break;
			case 2:
				$span = 'span6';
				break;
			case 3:
				$span = 'span4';
				break;
			case 4:
				$span = 'span3';
				break;
			case 6:
				$span = 'span2';
				break;
			default:
				$span = 'span3';
				break;
		}

		if($caption != ''){
			$out .= '					<div class="blog_header">';
			$out .= '						<h4 class="pull-left caption">';
			$out .= '							' . $caption;
			$out .= '						</h4>';
			$out .= '						<h6 class="pull-left tagline">';
			$out .= '							' . $tagline;
			$out .= '						</h6>';
			$out .= '						<div class="clearboth">';
			$out .= '						</div>';
			$out .= '					</div><!-- /.blog_header-->';
		}
		$out .= '<div class="row-fluid">';
		if ( !preg_match_all( '/(.?)\[(benefit)\b(.*?)(?:(\/))?\](?:(.+?)\[\/benefit\])?(.?)/s', $content, $matches ) ) {
			// No items, do nothing
		} else {
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {

				$title = strstr( $matches[3][$i], 'title="' );
				$title = str_replace( 'title="', '', $title );
				$title = substr( $title, 0, strpos( $title, '"' ) );

				$icon = strstr( $matches[3][$i], 'icon="' );
				$icon = str_replace( 'icon="', '', $icon );
				$icon = substr( $icon, 0, strpos( $icon, '"' ) );

				$out .= '<div class="column ' . $span . ' benefit ' . $class . '">';
				if ( $class == 'box' ) {
					$out .= '<h5 class="header">';
					$out .= $title;
					$out .= '</h5>';
					$out .= '<i class="'. $icon .'"></i>';
				} else {
					$out .= '<i class="'. $icon .'"></i>';
					$out .= '<h5 class="header">';
					$out .= $title;
					$out .= '</h5>';
				}
				$out .= '<div class="post_excerpt">';
				$out .= $matches[5][$i];
				$out .= '</div>';
				$out .= '</div>';
			}
		}
		$out .= '</div><!-- /.row-fluid-->';
		return '<div class="benefits">' . $out . '</div>';
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
			'name' => __('Benefits', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'benefits',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
