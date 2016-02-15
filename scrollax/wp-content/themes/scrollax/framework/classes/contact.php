<?php
/**
 *
 */

class missForm {
	
	private static $posted_data;
	private static $sender;
	private static $content;
	private static $messages;
	
	/**
	 *
	 */
	public static function init() {
		if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['_miss_form_ajax_submit'] ) ) {
			self::$messages = self::messages();
			self::ajax_submit();
			exit();
		} elseif ( isset( $_POST['_miss_form'] ) ) {
			self::$messages = self::messages();
			self::nonajax_submit();
		}
	}
	
	/**
	 *
	 */
	public static function messages() {
		$messages = array(
			'lable' => __( 'Form Field %1$s', MISS_TEXTDOMAIN ),
			'sender_name' => __( 'Your Website', MISS_TEXTDOMAIN ),
			'subject' => __( 'Message sent from your %1$s website', MISS_TEXTDOMAIN ),
			'auto_subject' =>  __( '%1$s Auto Responder', MISS_TEXTDOMAIN ),
			'captcha' => __( 'Your captcha result is wrong.', MISS_TEXTDOMAIN ),
			'email' => __( 'You have entered an invalid e-mail address.', MISS_TEXTDOMAIN ),
			'required' => __( '&rdquo;%1$s&rdquo; is required.', MISS_TEXTDOMAIN ),
			'spam' => __( 'Failed to send your message. Please try later or contact administrator by other way.', MISS_TEXTDOMAIN ),
			'mail_sent' => __( 'Your message has been sent successfully. Thank you.', MISS_TEXTDOMAIN )
		);
		
		return $messages;
	}
	
	/**
	 *
	 */
	private static function ajax_submit() {
		$echo = '';
		
		if ( isset( $_POST['_miss_form'] ) ) {
			
			miss_stripslashes();
			
			self::$posted_data = miss_decode( $_POST['_miss_form_encode'], $unserialize = true );
			
			$id = (int) $_POST['_miss_form'];
			
			$validation = self::validate();
			
			$items = array(
				'mail_sent' => false,
				'into' => '#miss_form' . $id,
				'sidebar' => self::$posted_data['sidebar']
			);
			
			if( !$validation['vaild'] ) {
				if( $validation['errors'] )
				 	$items['errors'] = self::process_messages( $type = 'errors', $validation['errors'] );
					$items['errored_fields'] = $validation['errored_fields'];

			} elseif ( ( $validation['vaild'] ) && ( !$validation['send_email'] ) ) {
				$items['errors'] = self::process_messages( $type = 'errors', '%spam%' );
				
			} elseif ( ( $validation['vaild'] ) && ( $validation['send_email'] ) ) {
				if( self::send() ) {
					$items['mail_sent'] = true;
					$items['success'] = self::process_messages( $type = 'success', '%mail_sent%' );
					self::autoresponder();
				}
			}
		}
		
		$echo = json_encode( $items );
		if ( miss_ajax_request() ) {
			@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
			echo $echo;
		} else {
			@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
			echo '<textarea>' . $echo . '</textarea>';
		}
	}
	/**
	 *
	 */
	private static function nonajax_submit() {
		
		if ( isset( $_POST['_miss_form'] ) ) {
			
			miss_stripslashes();
			
			self::$posted_data = miss_decode( $_POST['_miss_form_encode'], $unserialize = true );
			
			$id = (int) $_POST['_miss_form'];
			$validation = self::validate();
			if( !$validation['vaild'] ) {
				if( $validation['errors'] )
					$_POST['_miss_form_nonajax_response'] = array(
						'id' => $id,
						'sidebar' => self::$posted_data['sidebar'],
						'errored_fields' => $validation['errored_fields'],
						'messages' => self::process_messages( $type = 'errors', $validation['errors'] ) );
			} elseif ( ( $validation['vaild'] ) && ( !$validation['send_email'] ) ) {
				$_POST['_miss_form_nonajax_response'] = array( 'id' => $id, 'messages' => self::process_messages( $type = 'errors', '%spam%' ) );
				
			} elseif ( ( $validation['vaild'] ) && ( $validation['send_email'] ) ) {
				if( self::send() ) {
					$_POST['_miss_form_nonajax_response'] = array( 'id' => $id, 'messages' => self::process_messages( $type = 'success', '%mail_sent%' ) );
					self::autoresponder();
					self::clear_post();
				}
			}
		}
	}
	/**
	 *
	 */
	private static function validate() {
		$form_errors ='';
		$send_email = true;

		$i=1;
		$errored_fields = array();
		foreach( self::$posted_data['fields'] as $key => $value ) {

			if( $value['required'] ) {
				
				if( $value['required'] == 'email' ) {
					if( !is_email( $_POST[$key] ) ) {
						$form_errors .= '%email%';
						$errored_fields[] = $key;
					}

				} elseif ( $value['required'] == 'true' && $value['type'] == 'checkbox' ) {
					$how_many_checkbox_checked = 0;
					foreach ($value['value'] as $checkbox_key => $checkbox_value) {
						if( !empty( $_POST[$key . '_' . $checkbox_key] ) === true ) {
							$how_many_checkbox_checked++;
						}
					}
					if ( $how_many_checkbox_checked == 0 ) {
						$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
						$form_errors .= "%required|$label%";
						$errored_fields[] = $key;
					}

				} elseif ( $value['required'] == 'true' && $value['type'] != 'radio' ) {
					if( empty( $_POST[$key] ) === true ) {
						$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
						$form_errors .= "%required|$label%";
						$errored_fields[] = $key;
					}

				} elseif ( $value['required'] == 'captcha' ) {
					if( trim( $_POST[$key] ) != $value['captcha'] ) {
						$form_errors .= '%captcha%';
						$errored_fields[] = $key;
					}

				} elseif ( $value['required'] == 'honeypot' ) {
					if( empty( $_POST[$key] ) !== true ) {
						$send_email = false;
						$errored_fields[] = $key;
					}
				}
			}

			if ( !empty( $_POST[$key] ) && !empty( $value['type'] ) ) {
				if( $value['type'] == 'name' ) self::$sender['name'][] = $_POST[$key];
				if( $value['type'] == 'email' ) self::$sender['email'][] = trim( $_POST[$key] );
				self::$content .= $_POST[$key] . "\n\n";
			}

			$i++;
		}
		
		if( ( self::$posted_data['akismet'] ) && ( empty( $form_errors ) ) && ( $send_email ) ) {
			$akismet_check = self::akismet();
			if( $akismet_check ) {
				$form_errors .=	'%spam%';
			}
		}

		if ( empty( $form_errors ) )
			return array( 'vaild' => true, 'send_email' => $send_email, 'sender' => self::$sender );
		else
			return array( 'vaild' => false, 'errors' => $form_errors, 'errored_fields' => $errored_fields );
	}
	
	/**
	 *
	 */
	private static function send() {
		$msg = '';

		$i=1;
		foreach( self::$posted_data['fields'] as $key => $value ) {

			if( !empty( $value['type'] ) ) {

				if( $value['type'] == 'textfield' || $value['type'] == 'name' || $value['type'] == 'email' ) {
					$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
					$field = ( !empty( $_POST[$key] ) ) ? $_POST[$key] : '-';
					$msg .= $label . ': ' . $field . PHP_EOL . PHP_EOL;

				} elseif ( $value['type'] == 'textarea' ) {
					$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
					$field = ( !empty( $_POST[$key] ) ) ? $_POST[$key] : '-';
					$msg .= $label . ':' . PHP_EOL . $field . PHP_EOL . PHP_EOL;

				} elseif ( $value['type'] == 'checkbox' ) {
					$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
					foreach ($value['value'] as $val_key => $checkbox_value) {
						$msg .= $label . ' (' .$value['value'][$val_key] . '): ' . ( isset( $_POST[$key . '_' . $val_key][$val_key] ) ? __( 'Yes', MISS_TEXTDOMAIN ) : __( 'No', MISS_TEXTDOMAIN ) ) . PHP_EOL . PHP_EOL;
					}

				} elseif ( $value['type'] == 'radio' ) {
					$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
					$msg .= $label . ': ' . $value['value'][$_POST[$key]] . PHP_EOL . PHP_EOL;

				} elseif ( $value['type'] == 'select' ) {
					$label = ( $value['label'] ) ? str_replace( ':', '', $value['label'] ) : sprintf( self::$messages['lable'], $i );
					$msg .= $label . ': ' . $_POST[$key] . PHP_EOL . PHP_EOL;
				} elseif( $value['type'] == 'attachment' ) {
					$attachment = $field;
					$afid = $key;
				}
			}
			$i++;
		}

		$sender_name = ( !empty( self::$sender['name'] ) ) ? join( ' ', self::$sender['name'] ) : self::$messages['sender_name'];
		$sender_email = ( !empty( self::$sender['email'] ) ) ? self::$sender['email'][0] : self::$posted_data['miss_email'];
		$subject = ( !empty( self::$posted_data['miss_subject'] ) ) ? self::$posted_data['miss_subject']
		: sprintf( self::$messages['subject'], get_bloginfo('name') );
		
		$headers = "From: $sender_name <$sender_email>" . "\r\n";

		$miss_wp_upload_dir = wp_upload_dir();
		$miss_wp_upload_dir = $miss_wp_upload_dir['basedir'];

		// Adding attachment
		if ( isset($attachment) && !empty($attachment) && $_FILES[$afid] ) {

			if ( is_writable( $miss_wp_upload_dir ) ) {
				if ( !file_exists( $miss_wp_upload_dir . '/cv' ) ) {
					if ( @mkdir( $miss_wp_upload_dir . '/cv' ) ) {
						// Crete safe index to hide default apache output (if index.html missing)
						@touch( $miss_wp_upload_dir . '/cv/index.html' );
					}
				}
				$miss_wp_upload_dir = $miss_wp_upload_dir . '/cv';
			} else {
				$miss_wp_upload_dir = $miss_wp_upload_dir;
			}

			$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx","odt","txt","rtf","zip");

			$attachment_location = $miss_wp_upload_dir . "/_" . $_FILES[$afid]["name"];

			if (move_uploaded_file( $_FILES[$afid]["tmp_name"], $attachment_location ) ) {
				$attachment = $attachment_location;
			}

		} else {
			$attachment = '';
		}


		if ( @wp_mail( self::$posted_data['miss_email'], $subject, $msg, $headers, $attachment ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 *
	 */
	private static function process_messages( $type, $string ) {
		$msg = preg_replace_callback( '/%([^%]+)%/', 'missForm::messages_callback', $string );
		
		$out = '<div class="miss_message ' . $type . '">';
		$out .= ( $type == 'errors' ) ? '<ul>' . $msg . '</ul>' : $msg;
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	private static function messages_callback( $matches ) {
		$msg = '';
		
		if( !$matches )
			return $msg;
		
		$string = explode('|', $matches[1] );

		if( $string[0] == 'required' )
			$msg = '<li><i class="im-icon-warning-2"></i>' . sprintf( self::$messages['required'], $string[1] ) . '</li>';
			
		elseif ( $string[0] == 'mail_sent' )
			$msg = ( self::$posted_data['success'] == $string[0] ? self::$messages['mail_sent'] : self::$posted_data['success'] );
			
		else
			$msg = '<li><i class="im-icon-warning-2"></i>' . self::$messages[$string[0]] . '</li>';

		return $msg;
	}
	
	/**
	 *
	 */
	private static function autoresponder() {
		
		if( empty( self::$posted_data['autoresponder'] ) )
			return true;
		
		$subject = self::$posted_data['autoresponder'][0]['subject'];
		$msg = self::$posted_data['autoresponder'][0]['message'];
		
		if( ( miss_mbstrlen( $msg ) ) && ( self::$sender['email'] ) ) {
			
			$sender_name = self::$posted_data['autoresponder'][0]['name'];
			$sender_email = self::$posted_data['autoresponder'][0]['email'];
			$headers = "From: $sender_name <$sender_email>" . "\r\n";
			
			$subject = ( miss_mbstrlen( $subject ) ) ? preg_replace_callback( '/%([^%]+)%/', 'missForm::autoresponder_callback', $subject )
			: sprintf( self::$messages['auto_subject'], get_bloginfo('name') );
			
			$msg = preg_replace_callback( '/%([^%]+)%/', 'missForm::autoresponder_callback', $msg );
			
			@wp_mail( self::$sender['email'][0], $subject, $msg, $headers );
		}
		
		return true;
	}

	/**
	 *
	 */
	private static function autoresponder_callback( $matches ) {
		$msg = '';
		
		if( !$matches )
			return $msg;
		
		foreach( self::$posted_data['fields'] as $key => $value ) {
			if( !empty( $value['label'] ) ) {
				if( strtolower(trim( $value['label'] )) == strtolower(trim( $matches[1] )) )
					$msg = $_POST[$key];

			} elseif ( 'return' == strtolower(trim( $matches[1] )) ) {
				$msg = PHP_EOL;
			}
		}

	  	return $msg;
	}
	
	/**
	 *
	 */
	private static function akismet() {
		global $akismet_api_host, $akismet_api_port;

		if ( ! function_exists( 'akismet_http_post' ) ||
			! ( get_option( 'wordpress_api_key' ) || $wpcom_api_key ) )
			return false;

		$author = ( !empty( self::$sender['name'] ) ) ? join( ' ', self::$sender['name'] ) : '';
		$author_email = ( !empty( self::$sender['email'] ) ) ? self::$sender['email'][0] : '';
		$content = ( !empty( self::$content ) ) ? self::$content : '';
		
		
		$c['blog'] = home_url();
		$c['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
		$c['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$c['referrer'] = $_SERVER['HTTP_REFERER'];
		$c['comment_type'] = 'comment';
		if ( $permalink = get_permalink() )
			$c['permalink'] = $permalink;
		if ( '' != $author )
			$c['comment_author'] = $author;
		if ( '' != $author_email )
			$c['comment_author_email'] = $author_email;
		if ( '' !=  $content )
			$c['comment_content'] = $content;

		$ignore = array( 'HTTP_COOKIE' );
		
		foreach ( $_SERVER as $key => $value ) {
			if ( ! in_array( $key, (array) $ignore ) ) {
				$c["$key"] = $value;
			}
		}

		$query_string = '';
		foreach ( $c as $key => $data ) {
			$query_string .= $key . '=' . urlencode( stripslashes( (string) $data ) ) . '&';
		}

		$response = akismet_http_post( $query_string, $akismet_api_host,
			'/1.1/comment-check', $akismet_api_port );
		if ( 'true' == $response[1] )
			return true;
		else
			return false;
	}
	
	/**
	 *
	 */
	private static function clear_post() {
		foreach( self::$posted_data['fields'] as $key => $value ) {
			if ( isset( $_POST[$key] ) )
				unset( $_POST[$key] );
		}
	}

}

?>
