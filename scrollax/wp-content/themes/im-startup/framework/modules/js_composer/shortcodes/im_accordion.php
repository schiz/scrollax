<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 * accordion shortcode
 */

class misscomposerImAccordion_VC_ShortCode {
	/**
	 *
	 */
	public static function im_accordion( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(				
				'name' => __( 'Irish Accordion', WJ_ADMIN_TEXTDOMAIN ),
				'base' => 'vc_accordion',
				'icon' => 'im-icon-text-height',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				"show_settings_on_create" => false,
  				"is_container" => true,
				'params' => array(

				    array(
				      "type" => "textfield",
				      "heading" => __("Widget title", "js_composer"),
				      "param_name" => "title",
				      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
				    ),
				    array(
				      "type" => "dropdown",
				      "heading" => __("Style", "js_composer"),
				      "param_name" => "el_class",
				      "value" => array(
				      	'Default' => ' ',
				      	'Style 1' => 'style1',
				      	'Style 2' => 'style2',
				      	'Style 3' => 'style3',
				      ),
				      "description" => __("Select accordion style.", "js_composer")
				    ),





					array(
						'name' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'textfield',
					),
					array(
						'name' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block alternative caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'default' => '',
						'type' => 'textfield',
					),
					array(
						'name' => __( 'Toggle Title Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify caption colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_title_color',
						'default' => '',
						'type' => 'colorpicker',
					),
					array(
						'name' => __( 'Framed Toggles <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Use framed style for this toggle.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'framed',
						'value' => array(
							__('Put toggle title in a frame', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Toggle Frame Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify toggle frame colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_frame_color',
						'default' => '',
						'type' => 'colorpicker',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Accordion <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When using an accordian only one toggle can be opened at a time.<br /><br />When clicking on another toggle the previous one will close before opening the next.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'accordion_group',
						'value' => array(
							__('Group toggles into an accordion set', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),

						'type' => 'checkbox',
					),
				),

				  "custom_markup" => '
				  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
				  %content%
				  </div>
				  <div class="tab_controls">
				  <button class="add_tab" title="'.__("Add accordion section", "js_composer").'">'.__("Add accordion section", "js_composer").'</button>
				  </div>
				  ',
				  'default_content' => '
				  [vc_accordion_tab title="'.__('Section 1', "js_composer").'"][/vc_accordion_tab]
				  [vc_accordion_tab title="'.__('Section 2', "js_composer").'"][/vc_accordion_tab]
				  ',
				  'js_view' => 'VcAccordionView'
			);
		}
			
		extract(shortcode_atts(array(
			'title'   => '',
			'styled' => '',
			'active_tab' => '',
			'collapsible'   => '',
			'el_class' => '30',

			'caption'	=> '',
			'tagline'	=> '',
			'accordion_group' => '',
			'animation' => '',
			'toggles_title_color'	=> '',
			'toggles_frame_color'	=> '',
			'framed' => '',

	    ), $atts));



		if ( !empty( $animation )) {
			$animation = ' im-transform im-animate-element ' . $animation;
		}


		$togle_class = ( $accordion_group == 'true' ) ? 'toggle_accordion' : 'toggle';
		$framed = ( $framed == 'true' ) ? ' framed' : '';
		$color = ( $toggles_title_color != '' ) ? $toggles_title_color : '';
		$bg_color = ( $toggles_frame_color != '' ) ? $toggles_frame_color : '';
		$bg_color = ( $framed != '' ) ? $bg_color : '';
		$plus_minus_bg_color = ( $framed != '' ) ? 'background-color:' . $color . ';' : '';


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

		if ( !preg_match_all( '/(.?)\[(toggle)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle\])?(.?)/s', $content, $matches ) ) {
			return miss_content_group( $content );
			// No items, do nothing
		} else {

			$out .= '<div>';
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {
				$matches[3][$i] = strstr( $matches[3][$i], '"' ); 
				$out .= '<div class="' . $togle_class . ' toggle_header' . $animation . '" style="background-color:' . $bg_color .'; color:' . $color . ';"><span class="plus_minus" style="color:' . $color . ';"><span class="plus_minus_alt" style="background-color:' . $color .'; color:' . $bg_color . ';"></span></span><a href="#" style="color:' . $color . ';">' . str_replace('"', '', $matches[3][$i]) . '</a></div>';
				$out .= '<div class="toggle_content" style="display: none;">';
				$out .= '<div class="block">';
				$out .= miss_content_group( $matches[5][$i] );
				$out .= '</div>';
				$out .= '</div>';
			}
			$out .= '</div>';
			return '<div class="toggle_frame_set' . $framed .'">' . $out . '</div>';
		}
	}
	public static function _options( $method ) {
		return self::$method('generator');
	}
	
}
endif;
?>