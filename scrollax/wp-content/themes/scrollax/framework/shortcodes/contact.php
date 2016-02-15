<?php
/**
 *
 */
class missContact{

	private static $form_id = 1;
	
	/**
	 *
	 */
	private static function _form_id() {
	    return self::$form_id++;
	}
	
	/**
	 *
	 */
	public static function contactform( $atts = null, $content = null ) {
		if( $atts == 'generator' )
			return;
		
		extract(shortcode_atts(array(
	        'email'		=> '',
			'subject'	=> '',
			'success'	=> '',
			'captcha'	=> '',
			'akismet'	=> '',
			'attachment'=> '',
			'sidebar'	=> false
	    ), $atts));
	
		$out = '';
		$out_textarea = '';
		$out_attachment = '';
		$out_captcha = '';
		$out_submit = '';
		$form_id = self::_form_id();
		$miss_form_id = 'miss_form' . $form_id;
		$url = add_query_arg( array() ) . '#' . $miss_form_id;
		$required_error = '';

		$form_inputs = array();
		$submit_button = false;
		$form_inputs['miss_email'] = ( is_email( trim( $email ) ) ) ? trim( $email ) : get_option('admin_email');
		$form_inputs['miss_subject'] = ( !empty( $subject ) ) ? $subject : false;
		$form_inputs['success'] = ( !empty( $success ) ) ? $success : 'mail_sent';
		$form_inputs['akismet'] = ( $akismet == 'true' ) ? true : false;
		$form_inputs['sidebar'] = ( !empty( $sidebar ) ) ? true : false;
		
		if( isset( $_POST['_miss_form_nonajax_response']['errored_fields'] ) )
			foreach( $_POST['_miss_form_nonajax_response']['errored_fields'] as $key => $value ) {
				$errored_fields[$value] = $value;
			}
		if( empty( $content ) )
			$content = '[name label="' . __( 'Name', MISS_TEXTDOMAIN ) . '" required="true"][email label="' . __( 'Email', MISS_TEXTDOMAIN ) . '" required="true"][textfield label="' . __( 'Website', MISS_TEXTDOMAIN ) . '"][textarea required="true"][captcha]';
		
		if ( preg_match_all("/\[([^\s^\]]+)\s?([^\]]*)/", $content, $matches ) ) {
			
			miss_stripslashes();
			
			$out .= '<div id="' . $miss_form_id . '" class="miss_form">';
			
			$out .= '<form action="' . esc_url_raw( $url ) . '" method="post">';
			$out .= ( ( isset( $_POST['_miss_form_nonajax_response'] ) ) && ( $_POST['_miss_form_nonajax_response']['id'] == $form_id ) &&
			( !$_POST['_miss_form_nonajax_response']['sidebar'] || empty( $_POST['_miss_form_nonajax_response']['errored_fields'] ) ) ) ?
			$_POST['_miss_form_nonajax_response']['messages'] : '';
			$out .= '<div class="row-fluid">';
			
			
			for( $i = 0; $i < count($matches[0]); $i++ ) {
				
				if ( !$form_inputs['sidebar'] ) {
					if( $matches[1][$i] != 'textarea' && $matches[1][$i] != 'autoresponder' && $matches[1][$i] != 'submit' && $matches[1][$i] != 'captcha' && $matches[1][$i] != 'attachment' ) {
						$span = 'span4 ';
						$out .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'submit' || $matches[1][$i] == 'captcha' ) {
						$span = 'span6 ';
						$out_submit .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'textarea' ) {
						$span = 'span12 ';
						$out_textarea .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'attachment' ) {
						$span = 'span12 ';
					} else {
						$span = '';
						$out .= '<div class=" ' . $span . $matches[1][$i] . '_field' . '">';
					}
				} else {
					if( $matches[1][$i] != 'textarea' && $matches[1][$i] != 'autoresponder' && $matches[1][$i] != 'submit' && $matches[1][$i] != 'captcha' && $matches[1][$i] != 'attachment' ) {
						$span = 'span6 ';
						$out .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'captcha' ) {
						$span = 'span8 ';
						$out_submit .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'submit' ) {
						$span = 'span4 ';
						$out_submit .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'textarea' ) {
						$span = 'span12 ';
						$out_textarea .= '<div class="' . $span . $matches[1][$i] . '_field' . '">';
					} elseif( $matches[1][$i] == 'attachment' ) {
						$span = 'span12 ';
					} else {
						$span = '';
						$out .= '<div class=" ' . $span . $matches[1][$i] . '_field' . '">';
					}
				}
				$field_id = 'miss_field' . $i . $form_id;
				$matches[2][$i] = shortcode_parse_atts( $matches[2][$i] );
				
				if( isset( $errored_fields ) )
					$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : ' required_error';
				
				$required = ( $matches[1][$i] == 'captcha' ? 'captcha'
				: ( empty( $matches[2][$i]['required'] ) ? false
				: ( $matches[1][$i] == 'email' ? 'email'
				: 'true' 
				)));
				$label = ( !empty( $matches[2][$i]['label'] ) ) ? $matches[2][$i]['label'] : '';
				
				if( $required == 'captcha' ) {
					$num1 = rand(1,10);
					$num2 = rand(1,10);
					$label = $num1 .' + '. $num2 . ' ';
				}

				if( ( $required ) && ( $required != 'captcha' ) && $label != '' ) {
					//$out .= '<span class="star">*</span>';
					$label .= ' *';
				}

				if( $required == 'captcha' ) {

					$out_submit .= '<label class="span4" for="' . $field_id . '">' . $label . '</label>';

					$out_submit .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" size="auto" class="im-capthca_input span8 ' . $required_error .
					( $matches[1][$i] != 'textfield' ? ' ' . $matches[1][$i] : '' ) . '' . ( $required ? ' required' : '' ) . '" value="' .
					( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" placeholder="' . __( 'Enter sum', MISS_ADMIN_TEXTDOMAIN ) . '" />';

					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
					
					if( $required == 'captcha' ) {
						$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;
					}
				}
				if( $matches[1][$i] == 'textfield' || $matches[1][$i] == 'name' || $matches[1][$i] == 'email' ) {
					$out .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" size="auto" class="span12 ' . $required_error .
					( $matches[1][$i] != 'textfield' ? ' ' . $matches[1][$i] : '' ) . '' . ( $required ? ' required' : '' ) . '" value="' .
					( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" placeholder="' . $label . '"/>';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
					
					if( $required == 'captcha' ) {
						$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;
					}
				} elseif( $matches[1][$i] == 'textarea' ) {
/*
					$out_textarea .= '<label for="' . $field_id . '">' . $label;
					$out_textarea .= '</label>';
*/
					$out_textarea .= '';
				} elseif( $matches[1][$i] == 'submit' || $matches[1][$i] == 'autoresponder' || $matches[1][$i] == 'captcha' || $matches[1][$i] == 'attachment' ) {
					$out .= '';
					$out .= '';
				} else {
					$out .= '<label for="' . $field_id . '">' . $label;
					$out .= '</label>';
				}

				if( $matches[1][$i] == 'attachment' ) {
					$out_attachment .= '<label for="' . $field_id . '"><h3>' . $label;
					$out_attachment .= '</h3></label>';
					$out_attachment .= '<input type="file" style="line-height: 0" name="' . $field_id . '" id="' . $field_id . '" size="auto" class="span12 ' . $required_error .
					( $matches[1][$i] != 'attachment' ? ' ' . $matches[1][$i] : '' ) . '' . ( $required ? ' required' : '' ) . '" placeholder="' . $label . '"/>';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
				}

				if( $matches[1][$i] == 'textarea' ) {
					$out_textarea .= '<textarea name="' . $field_id . '" id="' . $field_id . '" class="span12 ' . $required_error . ( $required ? ' required' : '' ) . '" rows="5" cols="40" placeholder="' . $label . '">' .
					( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '</textarea>';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
				}
				
				if( $matches[1][$i] == 'checkbox' ) {
/*					$out .= '<input type="checkbox" name="' . $field_id . '" id="' . $field_id . '" class="styled' . $required_error . ( $required ? ' required' : '' ) . '"' .
					( isset( $_POST[$field_id] ) ? ' checked="checked"' : '' ) . ' value="1" />';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
*/

					if( !empty( $matches[2][$i]['value'] ) ) {
						$options = explode( ',', $matches[2][$i]['value'] );
						foreach( $options as $key => $value ) {
							$value = trim( $value );
							$radio_id = $field_id . '_' . $key;
							$out .= '<input type="checkbox" name="' . $radio_id .'['. $key . ']" id="' . $radio_id . '" class="styled ' . $required_error . ( $required ? ' required': '' ) . '"' . ( !isset( $_POST[$radio_id] ) ? '' : ( $_POST[$radio_id][$key] == $value  ? ' checked="checked"' : '' ) ) . ' value="' . $value . '" /> <label for="' . $radio_id . '" class="radio_label">' . $value . '</label>';
						}
						$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'value' => $options, 'required' => $required );
					}
				}

				if( $matches[1][$i] == 'radio' ) {
					if( !empty( $matches[2][$i]['value'] ) ) {
						$options = explode( ',', $matches[2][$i]['value'] );
						foreach( $options as $key => $value ) {
							$radio_id = $field_id . '_' . $key;
							$out .= '<input type="radio" name="' . $field_id . '" id="' . $radio_id . '" class="styled' . $required_error . ( $required ? ' required': '' ) . '"' .
							( !isset( $_POST[$field_id] ) ? ( $key == 0 ? ' checked="checked"' : '' ) : ( $_POST[$field_id] == $key  ? ' checked="checked"' : '' ) ) . ' value="' . $key . '" />';
							$out .= '<label for="' . $radio_id . '" class="radio_label">' . $value . '</label>';
						}
						$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'value' => $options, 'required' => $required );
					}
				}
				
				if( $matches[1][$i] == 'select' ) {
					if( !empty( $matches[2][$i]['value'] ) ) {
						$options = explode( ',', $matches[2][$i]['value'] );
						$out .= '<select name="' . $field_id . '" id="' . $field_id . '" class="span12' . $required_error . ( $required ? ' required' : '' ) . '">';
						foreach( $options as $key => $value ) {
							$out .= '<option value="' . $value . '"' .
							( !isset( $_POST[$field_id] ) ? '' : ( $_POST[$field_id] == $value ? ' selected="selected"' : '' ) ) . '>' . $value . '</option>';
						}
						$out .= '</select>';
						$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
					}
				}
				
				if( $matches[1][$i] == 'submit' ) {
					$submit_button = true;
					$submit_value = ( !empty( $matches[2][$i]['value'] ) ) ? $matches[2][$i]['value'] : 'Submit';
					$out_submit .= '<input type="submit" value="' . $submit_value . '" class="contact_form_submit styled_button" />';
					
					$out_submit .= '<div class="miss_contact_feedback">';
					$out_submit .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/dummy/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloaders/preloader.gif);" alt="Loading...">';
					$out_submit .= '</div>';
				}
				
				if( $matches[1][$i] == 'autoresponder' ) {
					$name = ( !empty( $matches[2][$i]['fromname'] ) ) ? $matches[2][$i]['fromname'] : get_bloginfo('name');
					$email = ( !empty( $matches[2][$i]['fromemail'] ) ) ? trim( $matches[2][$i]['fromemail'] ) : $form_inputs['miss_email'];
					$subject = ( !empty( $matches[2][$i]['subject'] ) ) ? $matches[2][$i]['subject'] : false;
					$message = ( !empty( $matches[2][$i]['message'] ) ) ? $matches[2][$i]['message'] : false;
					$form_inputs['autoresponder'][] = array( 'name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message );
				}
				
				if( $matches[1][$i] != 'textarea' && $matches[1][$i] != 'autoresponder' && $matches[1][$i] != 'submit' && $matches[1][$i] != 'captcha' && $matches[1][$i] != 'attachment' ) {
					$out .= '</div>';
				} elseif( $matches[1][$i] == 'submit' || $matches[1][$i] == 'captcha' ) {
					$out_submit .= '</div>';
				} elseif( $matches[1][$i] == 'textarea' ) {
					$out_textarea .= '</div>';
				} elseif( $matches[1][$i] == 'attachment' ) {
					$out_textarea .= '</div>';
				} else {
					$out .= '</div>';
				}
			}
			
			if( $captcha == 'true' ) {
				
				$field_id = "miss_field{$i}{$form_id}";
				
				if( isset( $errored_fields ) )
					$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : ' required_error';
				
				$captch_span = ($form_inputs['sidebar']) ? 'span8' : 'span6';
				$out_captcha .= '<div class="' . $captch_span . ' captcha_field">';
				
				$num1 = rand(1,10);
				$num2 = rand(1,10);
				$label = $num1 .' + '. $num2 . ' ';

				$out_captcha .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" class="span8 required' . $required_error .  '" value="' .
				( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" placeholder="' . __( 'Sum', MISS_ADMIN_TEXTDOMAIN ) . '" />';
				$form_inputs['fields'][$field_id] = array( 'type' => 'captcha', 'label' => $label, 'required' => 'captcha' );
					
				$out_captcha .= '<label class="span4" for="' . $field_id . '">' . $label . '</label>';
				
				$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;
					
				$out_captcha .= '</div>';
			}
			
			if( !$submit_button ) {
				$submit_span = ($form_inputs['sidebar']) ? 'span4' : 'span6';

				$out_submit .= '<div class="' . $submit_span . ' submit_field">';
				$out_submit .= '<input type="submit" value="' . __( 'Submit', MISS_TEXTDOMAIN ) . '" class="contact_form_submit styled_button" />';
				
				$out_submit .= '<div class="miss_contact_feedback">';
				$out_submit .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/dummy/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloaders/preloader.gif);" alt="Loading...">';
				$out_submit .= '</div>';
				
				$out_submit .= '</div>';
			}
			
			$honeypot_captcha_input = array('miss_required', 'miss_name_required', 'miss_email_required',  'miss_date_required', 'miss_zip_required' );
			$honeypot_captcha_rand = array_rand( $honeypot_captcha_input, 2 );
			
			foreach( $honeypot_captcha_rand as $key ) {
				$out .= '<div class=" ' . $honeypot_captcha_input[$key] . '">';
				$out .= '<input type="text" name="' . $honeypot_captcha_input[$key] . '" id="' . $honeypot_captcha_input[$key] . '" />';
				$out .= '</div>';
				$form_inputs['fields'][$honeypot_captcha_input[$key]] = array( 'required' => 'honeypot' );
			}
			
			$encode_form_inputs = miss_encode( $form_inputs, $serialize = true );
			
			if ( !empty( $out_textarea ) ) {
				$out .= '<div class="row-fluid">';
				$out .= $out_textarea;
				$out .= '</div>';
			}
			if ( !empty( $out_attachment ) ) {
				$out .= '<div class="row-fluid">';
				$out .= $out_attachment;
				$out .= '</div>';
			}

			$out .= '<div class="row-fluid">';
			$out .= $out_captcha;
			$out .= $out_submit;
			$out .= '</div>';

			$out .= '<div class="" style="display:none;">';
			$out .= '<input type="hidden" name="_miss_form" value="' . $form_id . '">';
			$out .= '<input type="hidden" name="_miss_form_encode" value="' . $encode_form_inputs . '">';
			$out .= '</div>';
			
			$out .= '</div>';
			$out .= '</form>';
			$out .= '</div>';
		}
		
		if( $sidebar == false )
			return $out;
			//return '[raw]' . $out . '[/raw]';
		else
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
			'name' => 'Contact Form',
			'value' => 'contactform',
			'custom' => 'contact'
		);

		return $options;
	}

}

?>
