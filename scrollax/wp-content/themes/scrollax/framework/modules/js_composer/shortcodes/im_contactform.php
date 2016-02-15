<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImContactform {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_contactform( $atts = null, $content = null ) {

		$multiplier_cycle_number = 15;
		$multiple_params = array(
			array(
				'heading' => __( '{{1}} Field Type', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Select here type for this field', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'type_{{1}}',
				'value' => array(
					__( 'Textfield', MISS_ADMIN_TEXTDOMAIN ) => 'textfield',
					__( 'E-mail', MISS_ADMIN_TEXTDOMAIN ) => 'email',
					__( 'Textarea', MISS_ADMIN_TEXTDOMAIN ) => 'textarea',
					__( 'Checkbox', MISS_ADMIN_TEXTDOMAIN ) => 'checkbox',
					__( 'Radio', MISS_ADMIN_TEXTDOMAIN ) => 'radio',
					__( 'Select', MISS_ADMIN_TEXTDOMAIN ) => 'select',
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( '{{1}} Field Label', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Type here name (Label) for this field', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'label_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( '{{1}} Field Values', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Only for Field Type: checkbox, radio, select. You can add several values. Separate values bu comma. Example: I agree, I do not agree, ...', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'values_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( '{{1}} Required Field', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Check here if field is required', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'required_{{1}}',
				'type' => 'checkbox',
				'value' => array(
					__( 'Required', MISS_ADMIN_TEXTDOMAIN ) => 'required',
				),
			),
		);

		if( $atts == 'generator' ) {
			$params = array(
					array(
						'heading' => __( 'Your E-mail', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'E-mail address that will receive the message from this form.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'email',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Subject', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can place a custom subject line here. This is the subject that you will see in your emails.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'subject',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Success Message', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'When the form is submitted successfully this message will be displayed to the user. Common examples would be, "Thanks you" or something similar.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'success',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Spam Protection', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can choose whether to use a captcha for spam protection or the akismet plugin. If using akismet then make sure you sign up with their service and have the akismet plugin enabled.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'spam',
						'value' => array(
							__( 'Captcha', MISS_ADMIN_TEXTDOMAIN ) => 'captcha',
							__( 'Akismet', MISS_ADMIN_TEXTDOMAIN ) => 'akismet',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Autoresponder', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check here for automatically respond for user which uses this form', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoresponder',
						'value' => array(
							__( 'Enable', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'From Name (Autoresponder)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Name that will be displayed in a auto response letter.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoresponder_name',
						'type' => 'textfield',
						'dependency' => array(
							'element' => 'autoresponder', 
							'value' => array( 'true' ),
						),
					),
					array(
						'heading' => __( 'From E-mail (Autoresponder)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'E-mail that will be displayed in a auto response letter.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoresponder_email',
						'type' => 'textfield',
						'dependency' => array(
							'element' => 'autoresponder', 
							'value' => array( 'true' ),
						),
					),
					array(
						'heading' => __( 'Subject (Autoresponder)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Subject that will be displayed in a auto response letter.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoresponder_subject',
						'type' => 'textfield',
						'dependency' => array(
							'element' => 'autoresponder', 
							'value' => array( 'true' ),
						),
					),
					array(
						'heading' => __( 'Message (Autoresponder)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Message that will be displayed in a auto response letter.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoresponder_message',
						'type' => 'textarea',
						'dependency' => array(
							'element' => 'autoresponder', 
							'value' => array( 'true' ),
						),
					),
					array(
						'heading' => __( 'Number Of Fields', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many fields you want.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'multiplier',
						'value' => range(1, $multiplier_cycle_number),
						'type' => 'dropdown',
					),
				);

			$params = array_merge( $params, miss_vc_multiple_params( $multiplier_cycle_number, $multiple_params ) );

			return array(
				'name' => __( 'Custom Contact Form', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_contactform',
				'icon' => 'im-icon-envelop',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params

			);
		}
			
/* START check all variables and set default values */
		miss_stripslashes();
		$out = '';
		extract(shortcode_atts(array(
			'email'	=> '',
			'subject' => '',
			'success' => '',
			'spam' => '',
			'autoresponder'	=> '',
			'autoresponder_name' => '',
			'autoresponder_email' => '',
			'autoresponder_subject' => '',
			'autoresponder_message' => '',
			'sidebar' => false,
			'multiplier' => 1,
		), $atts));
		$i=1;

		for ($i = 1; $i <= $multiplier; $i++ ) {
			foreach ($multiple_params as $key => $value) {
				$value['param_name'] = str_replace( '{{1}}', $i, $value['param_name'] );
				$atts[$value['param_name']] = ( isset( $atts[$value['param_name']] ) and $atts[$value['param_name']] != '' ) ? $atts[$value['param_name']] : '';
			}
		}

		$spam = explode( ',', $spam );
		$akismet = ( in_array( 'akismet', $spam ) ) ? 'true' : '';
		$captcha = ( in_array( 'captcha', $spam ) ) ? 'true' : '';

		$form_id = self::_shortcode_id();
		$miss_form_id = 'miss_form' . $form_id;
		$url = add_query_arg( array() ) . '#' . $miss_form_id;
		$form_inputs = array();
		$form_inputs['miss_email'] = ( is_email( trim( $email ) ) ) ? trim( $email ) : get_option('admin_email');
		$form_inputs['miss_subject'] = ( !empty( $subject ) ) ? $subject : '';
		$form_inputs['success'] = ( !empty( $success ) ) ? $success : 'mail_sent';
		$form_inputs['akismet'] = ( $akismet == 'true' ) ? true : false;
		$form_inputs['sidebar'] = ( !empty( $sidebar ) ) ? true : false;	
		if( $autoresponder == 'true' ) {
			$name = ( !empty( $autoresponder_name ) ) ? $autoresponder_name : get_bloginfo('name');
			$email = ( !empty( $autoresponder_email ) ) ? trim( $autoresponder_email ) : $form_inputs['miss_email'];
			$subject = ( !empty( $autoresponder_subject ) ) ? $autoresponder_subject : false;
			$message = ( !empty( $autoresponder_message ) ) ? $autoresponder_message : false;
			$form_inputs['autoresponder'][] = array( 'name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message );
		}

		if( isset( $_POST['_miss_form_nonajax_response']['errored_fields'] ) ) {
			foreach( $_POST['_miss_form_nonajax_response']['errored_fields'] as $key => $value ) {
				$errored_fields[$value] = $value;
			}
		}
/* END check all variables and set default values */
/* START assembling output variable */
		$out .= '<div id="' . $miss_form_id . '" class="miss_form">';
		$out .= '<form action="' . esc_url_raw( $url ) . '" method="post">';
		$out .= ( ( isset( $_POST['_miss_form_nonajax_response'] ) ) && ( $_POST['_miss_form_nonajax_response']['id'] == $form_id ) &&
		( !$_POST['_miss_form_nonajax_response']['sidebar'] || empty( $_POST['_miss_form_nonajax_response']['errored_fields'] ) ) ) ?
		$_POST['_miss_form_nonajax_response']['messages'] : '';
		$out .= '<div class="row-fluid">';
		for ($i = 1; $i <= $multiplier; $i++ ) {

			$field = '';
			$if_textarea_container = '';
			$field_id = 'miss_field' . $i . $form_id;
			$atts['required_' . $i] = ( empty( $atts['required_' . $i] ) ) ? false : ( $atts['type_' . $i] == 'email' ? 'email'	: 'true' ) ;
 			$atts['label_' . $i] = ( $atts['required_' . $i] != '' ) ? $atts['label_' . $i] . ' *' : $atts['label_' . $i];
			if( isset( $errored_fields ) ) {
				$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : 'required_error';
			} else {
				$required_error = '';
			}
			if( $atts['type_' . $i] == 'textarea' ) {
				$span = 'span12 ';
				$if_textarea_container = '</div><!-- class="row-fluid" --><div class="row-fluid">';
			} elseif ( !$form_inputs['sidebar'] ) {
				$span = 'span4 ';
			} else {
				$span = 'span6 ';
			}
/* START check field type $atts['type_' . $i] (textarea, checkbox, select ...) and set $field variable */
			if( $atts['type_' . $i] == 'textarea' ) {
				$field = '<textarea name="' . $field_id . '" id="' . $field_id . '" class="span12 ' . $required_error . ' ' . ( $atts['required_' . $i] ? ' required' : '' ) . '" rows="5" cols="40" placeholder="' . $atts['label_' . $i] . '">' . ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '</textarea>';
			} elseif( $atts['type_' . $i] == 'textfield' || $atts['type_' . $i] == 'email' ) {
				$field = '<input type="text" name="' . $field_id . '" id="' . $field_id . '" size="auto" class="span12 ' . $required_error . ' ' . ( $atts['required_' . $i] ? ' required' : '' ) . '" value="' . ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" placeholder="' . $atts['label_' . $i] . '"/>';
			} elseif( $atts['type_' . $i] == 'radio' ) {
				if( explode( ',', $atts['values_' . $i] ) ) {
					$options = explode( ',', $atts['values_' . $i] );
					$field .= '<label for="' . $field_id . '">' . $atts['label_' . $i] . '</label>';
					foreach( $options as $key => $value ) {
						$radio_id = $field_id . '_' . $key;
						$field .= '<div class="connector"><input type="radio" name="' . $field_id . '" id="' . $radio_id . '" class="styled ' . $required_error . ' ' . ( $atts['required_' . $i] ? ' required' : '' ) . '"' . ( !isset( $_POST[$field_id] ) ? ( $key == 0 ? ' checked="checked"' : '' ) : ( $_POST[$field_id] == $key  ? ' checked="checked"' : '' ) ) . ' value="' . $key . '" /> <label for="' . $radio_id . '" class="radio_label">' . trim( $value ) . '</label></div>';
					}
				}
			} elseif( $atts['type_' . $i] == 'checkbox' ) {
				if( explode( ',', $atts['values_' . $i] ) ) {
					$options = explode( ',', $atts['values_' . $i] );
					$field .= '<label for="' . $field_id . '">' . $atts['label_' . $i] . '</label>';
					foreach( $options as $key => $value ) {
						$value = trim( $value );
						$radio_id = $field_id . '_' . $key;
						$field .= '<div class="connector"><input type="checkbox" name="' . $radio_id .'['. $key . ']" id="' . $radio_id . '" class="styled ' . $required_error . ' ' . ( $atts['required_' . $i] ? ' required' : '' ) . '"' . ( !isset( $_POST[$radio_id] ) ? '' : ( $_POST[$radio_id][$key] == $value  ? ' checked="checked"' : '' ) ) . ' value="' . $value . '" /> <label for="' . $radio_id . '" class="radio_label">' . trim( $value ) . '</label></div>';
					}
				}
			} elseif( $atts['type_' . $i] == 'select' ) {
				if( explode( ',', $atts['values_' . $i] ) ) {
					$options = explode( ',', $atts['values_' . $i] );
					$field .= '<label for="' . $field_id . '">' . $atts['label_' . $i] . '</label>';
					$field .= '<select name="' . $field_id . '" id="' . $field_id . '" class="span12' . $required_error . ( $atts['required_' . $i] ? ' required' : '' ) . '">';
					foreach( $options as $key => $value ) {
						$field .= '<option value="' . trim( $value ) . '"' . ( !isset( $_POST[$field_id] ) ? '' : ( $_POST[$field_id] == $value ? ' selected="selected"' : '' ) ) . '>' . trim( $value ) . '</option>';
					}
					$field .= '<select>';
				}
			} else {
				$field = '';
			}
/* END check field type (textarea, ..., select) and set $field variable */
			$options = ( isset( $options ) && is_array( $options ) && count( $options ) > 0 ) ? $options : false ;
			$form_inputs['fields'][$field_id] = array( 'type' => $atts['type_' . $i], 'label' => $atts['label_' . $i], 'required' => $atts['required_' . $i], 'value' => $options );
			$out .= $if_textarea_container . '<div class="' . $span . $atts['type_' . $i] . '_field' . '">' . $field . '</div><!-- class="' . $span . $atts['type_' . $i] . '_field' . '" -->' . $if_textarea_container;

		} // for ($i = 1; $i <= $multiplier; $i++ )


/* close previous row and open new row for captcha_and_submit */
		$out .= '</div><!-- class="row-fluid" --><div class="row-fluid captcha_and_submit">';
		if( $captcha == 'true' ) {
			
			$field_id = 'miss_field' . $i . $form_id;
			if( isset( $errored_fields ) ) {
				$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : ' required_error';
			}
			$out .= '<div class="span8 captcha_field">';
			$num1 = rand(1,10);
			$num2 = rand(1,10);
			$label = $num1 .' + '. $num2;
			$out .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" class="span6 required' . $required_error .  '" value="' . ( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" placeholder="' . __( 'Sum *', MISS_ADMIN_TEXTDOMAIN ) . '" />';
			$out .= '<label class="span6" for="' . $field_id . '"> ' . $label . ' </label>';
			$out .= '</div><!-- class="captcha_field" -->';
			$form_inputs['fields'][$field_id] = array( 'type' => 'captcha', 'label' => $label, 'required' => 'captcha' );
			$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;

		}

		$out .= '<div class="span4 submit_field">';
		$out .= '<input type="submit" value="' . __( 'Submit', MISS_TEXTDOMAIN ) . '" class="contact_form_submit styled_button" />';
		$out .= '<div class="miss_contact_feedback">';
		$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/dummy/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloaders/preloader.gif);" alt="Loading">';
		$out .= '</div>';
		$out .= '</div><!-- class="submit_field" -->';

		$encode_form_inputs = miss_encode( $form_inputs, $serialize = true );
		$out .= '<div class="" style="display:none;">';
		$out .= '<input type="hidden" name="_miss_form" value="' . $form_id . '">';
		$out .= '<input type="hidden" name="_miss_form_encode" value="' . $encode_form_inputs . '">';
		$out .= '</div>';
		
		$out .= '</div>';
/* close row captcha_and_submit */
		$out .= '</form>';
		$out .= '</div><!-- id="' . $miss_form_id . '" class="miss_form" -->';
/* END assembling output variable */

		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>