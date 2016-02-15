<?php
/**
 *
 */

class missShortcodeMetaBox extends missOptionGenerator {
	
	private $pages;
	
	/**
	 * 
	 */
	function __construct( $pages ) {
		if ( !is_admin() ) return;
			
		$this->pages = $pages;
		
		add_action( 'admin_menu', array( &$this, 'create' ) );
	}
	
	/**
	 * 
	 */
	function create() {
		foreach( $this->pages as $page ) {
			add_meta_box('miss_shortcode_meta_box', sprintf( __( '%1$s Shortcode Generator', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), array(&$this, 'show'), $page, 'normal', 'high');
		}
	}
	
	/**
	 * 
	 */
	function show() {
		
		$out = '';
		
		$out .= '<div class="miss_option_set shortcode_selector">';
		$out .= '<div class="miss_option_header"><h5>' . __( 'Shortcode', MISS_ADMIN_TEXTDOMAIN ) . '</h5></div>';
		
		$out .= '<div class="miss_option">';
		$out .= '<select name="shortcode_select" class="miss_select">';
		$out .= '<option value="">' . esc_attr__( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
		
		$options = miss_shortcode_generator();
		
		foreach( $options as $sc_name ) {
			$out .= '<option value="' . $sc_name['value'] . '">' . esc_attr( $sc_name['name'] ) . '</option>';
		}

		$out .= '</select>';
		$out .= '</div><!-- .miss_option -->';
		
		$out .= '<div class="clear"></div>';
		$out .= '</div>';
		
		/**
		 * 
		 */
		foreach( $options as $sc_options ) {
			
			$out .= '<div id="shortcode_' . $sc_options['value'] . '" class="' . ( !empty( $sc_options['shortcode_has_types'] )
			? 'shortcode_has_types ' : '' ) . 'miss_option_set shortcode_wrap" style="display:none;">';
			
			/*
			 *
			 */
			if( isset( $sc_options['shortcode_has_types'] ) )
			{
				$out .= '<div class="shortcode_type_selector">';
				$out .= '<div class="miss_option_header">Type</div>';
				
				$out .= '<div class="miss_option">';
				$out .= '<select name="shortcode_' .$sc_options['value']. '_selector" class="miss_select">';
				$out .= '<option value="">' . esc_attr__( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
				
				foreach( $sc_options['options'] as $sc )
				{
					$out .= '<option value="' . $sc['value'] . '">' . esc_attr( $sc['name'] ) . '</option>';
				}
				$out .= '</select>';
				$out .= '</div><!-- .miss_option -->';
				
				if( !empty( $sc_options['desc'] ) ) {
					$out .= '<div class="miss_option_help">';
					$out .= '<a href="#"><img src="' . esc_url( THEME_ADMIN_ASSETS_URI ) . '/images/help-icon.png" alt="" /></a>';
					$out .= '<div class="miss_help_tooltip">' . $sc_options['desc'] . '</div>';
					$out .= '</div>';
				}

				$out .= '<div class="clear"></div>';
				$out .= '</div>';
			}
			
			/**
			 * 
			 */
			if( isset( $sc_options['options'] ) )
			{
				foreach( $sc_options['options'] as $sc_option )
				{
					if ( !empty( $sc_option['options']['shortcode_has_atts'] ) )
					{
						foreach( $sc_option['options'] as $option )
						{
							$type = ( !empty( $option['type'] ) ) ? $option['type'] : '';
							if ( method_exists( $this, $type ) )
							{
								$classes = ( !empty( $option['shortcode_multiplier'] ) ? ' shortcode_multiplier'
								: ( !empty( $option['shortcode_dont_multiply'] ) ? ' shortcode_dont_multiply'
								: ( !empty( $option['shortcode_multiply'] ) ? ' shortcode_multiply' : ''
								)));
								$classes .= ( !empty( $option['shortcode_optional_wrap'] ) ) ? ' shortcode_optional_wrap' : '';
								$classes .= ( !empty( $sc_option['options']['shortcode_carriage_return'] ) ) ? ' shortcode_carriage_return' : '';

								if( $option['type'] == 'toggle_start' || $option['type'] == 'toggle_end' ) {
									$option['option_class'] = 'shortcode_atts_' . $sc_option['value'];
									$out .= $this->$option['type']( $option );
								}
								else
								{
									$out .= '<div class="shortcode_atts_' . $sc_option['value'] . $classes . '">';
									$option['id'] = ( !empty( $option['value'] ) ) ?  'sc-' . $option['value'] . '-' . $option['id'] : 'sc-' . $sc_option['value'] . '-' . $option['id'];
									$out .= $this->$option['type']( $option );
									$out .= '</div>';
								}
							}

							if ( isset( $option['nested'] ) )
							{
								$out .= '<input type="hidden" name="sc_nested_' . $sc_option['value'] . '" value="' . $option['value'] .'" />';
							}
						}
					}
					elseif ( isset( $sc_option['options'] ) ) {
						if ( method_exists( $this, $sc_option['options']['type'] ) )
						{
							$classes = ( !empty( $sc_option['shortcode_carriage_return'] ) ) ? ' shortcode_carriage_return' : '';
							$out .= '<div class="shortcode_atts_' . $sc_option['value'] . $classes . '">';
							$sc_option['options']['id'] = 'sc-' . $sc_option['value'] . '-' . $sc_option['options']['id'];
							$out .= $this->$sc_option['options']['type']( $sc_option['options'] );
							$out .= '</div>';
						}
					}
				}
				
			}
			elseif ( isset( $sc_options['custom'] ) ) {
				$out .= $this->$sc_options['custom']( $sc_options );
			}
			
			$out .= '</div><!-- .shortcode_wrap -->';
		}
					
		$out .= '<div class="miss_sc_send"><input type="button" id="shortcode_send" class="btn" value="' . esc_attr__( 'Send Shortcode to Editor &raquo;' , MISS_ADMIN_TEXTDOMAIN ) . '"/></div>';
		
		echo $out;
	}
	
}

?>
