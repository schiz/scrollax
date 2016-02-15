<?php
/**
 *
 */
class missLayouts {
	
	/**
	 *
	 */
	public static function row_fluid ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Row Fluid', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'row_fluid',
				'options' => array(
					array(
						'name' => __( 'Row Fluid', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your row.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'row_fluid',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span6_span6 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Two Column Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span6_span6',
				'options' => array(

					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span4_span4_span4 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Three Column Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span4_span4_span4',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span4',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span4',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span4',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span3_span3_span3_span3 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Four Column Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span3_span3_span3_span3',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span2_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Six Column Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span2_span2_span2_span2_span2_span2',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fifth column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your sixth column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span4_span8 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Third - Two Third', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span4_span8',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span4',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span8',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span8_span4 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Two Third - One Third', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span8_span4',
				'options' => array(
					array(
						'name' => __('Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span8',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __('Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span4',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span3_span9( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - Three Fourth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span3_span9',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span9',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span9_span3 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Three Fourth - One Fourth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span9_span3',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span9',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span3_span3_span6 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - One Fourth - One Half', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span3_span3_span6',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span3_span6_span3 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - One Half - One Fourth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span3_span6_span3',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your  second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span6_span3_span3 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Half - One Fourth - One Fourth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span6_span3_span3',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span3',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span2_span10 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Sixth - Five Sixth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span2_span10',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span10',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span10_span2 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Five Sixth - One Sixth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span10_span2',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span10',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __('Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	public static function span2_span2_span2_span6 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Sixth - One Sixth - One Sixth - One Half', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'span2_span2_span2_span6',
				'options' => array(
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span2',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __('Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'span6',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}

	public static function autocolumn_col2 ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array (
				'name' => __( 'Auto Column', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'auto_column',
				'options' => array(
					array(
						'name' => __( 'Number of Columns', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Columns will separate content inside in to columns. Please choose number of columns that you want to use.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'columns',
						'default' => '2',
						'options' => array(
							'2' => __( 'Two Columns', MISS_ADMIN_TEXTDOMAIN ),
							'3' => __( 'Three Columns', MISS_ADMIN_TEXTDOMAIN ),
							'4' => __( 'Four Columns', MISS_ADMIN_TEXTDOMAIN ),
							'5' => __( 'Five Columns', MISS_ADMIN_TEXTDOMAIN ),
							'6' => __( 'Six Columns', MISS_ADMIN_TEXTDOMAIN ),
							'7' => __( 'Seven Columns', MISS_ADMIN_TEXTDOMAIN ),
							'8' => __( 'Eight Columns', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Column Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your columns. Content will be separated on RESPONSIVE columns. All shortcodes are accepted here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'auto_column',
						'default' => '',
				'type' => 'textarea',
					),
					array(
						'name' => __( 'Responsive resize', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Allow column resizing (to less columns) on mobile devices.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'responsive',
						'options' => array('true' => __('Allow responsive resizing', MISS_ADMIN_TEXTDOMAIN) ),
						'value' => 'responsive',
						'type' => 'checkbox',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
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
			'name' => __( 'Column Layouts', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of layout you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'layouts',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>