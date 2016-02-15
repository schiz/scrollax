<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}


/**
 *
 */
class missOptionGenerator {
	
	private $saved_options;
	private $saved_internal;
	private $saved_sidebars;
	private $saved_skin;
	
	function __construct( $options ) {
		
		$this->saved_options();

		$miss_theme_details = wp_get_theme();
		$remote = 'http://helpdesk.irishmiss.com/api/theme/?theme=' . str_replace(" ", "", $miss_theme_details->Name);
		$remote = (array) wp_remote_get($remote);
		if ( isset( $remote['body'] ) ) {
			$remote = json_decode($remote['body'],true); 
		}
		$out = '<div id="miss_admin_panel">';
		$out .= '<form name="miss_admin_form" method="post" action="options.php" id="miss_admin_form">';
		
		$out .= $this->settings_fields();
		$out .= '<input type="hidden" name="miss_full_submit" value="0" id="miss_full_submit" />';
		$out .= '<input type="hidden" name="miss_admin_wpnonce" value="' . wp_create_nonce( MISS_SETTINGS . '_wpnonce' ) . '" />';
		$out .= '<div id="miss_header">';
		$out .= '<div id="miss_logo"><img src="' . ( !empty( $this->saved_options['admin_logo_url'] ) ? esc_url( $this->saved_options['admin_logo_url'] ) :
		esc_url( THEME_ADMIN_ASSETS_URI ) . '/images/logo.png' ) . '" alt="" /></div>';
		$out .= '<div id="miss_theme_details">';
		$out .= '<p> <i class="im-icon-arrow-up-12"></i> '.$miss_theme_details->Name.' '.__( 'v', MISS_ADMIN_TEXTDOMAIN ).' '.$miss_theme_details->Version.' | <i class="im-icon-notebook"></i> <a href="http://cdn.irishmiss.com/d/startup/" target="_BLANK">'.__( 'Theme Documentation', MISS_ADMIN_TEXTDOMAIN ).'</a></p>';

		if ( isset( $remote['success'] ) && $remote['success'] == true && $remote['data']['version'] ) {
			$out .= '<p>';
			if ($remote['data']['version'] > $miss_theme_details->Version ) {
				$out .= '<a class="btn btn-small dltv" data-version="' . $remote['data']['version'] . '" data-title="' . $miss_theme_details->Name . '" data-url="' . $remote['data']['distributor']['url'] . '" data-download="' . __( 'Download', MISS_ADMIN_TEXTDOMAIN ) . '" data-cancel="' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '" data-downloading="' . __( 'Downloading...' , MISS_ADMIN_TEXTDOMAIN ) . '" data-view-title="' . __( 'View on ThemeForest', MISS_ADMIN_TEXTDOMAIN ) . '" data-purchasecode-title="' . __( 'Enter Purchase Code', MISS_ADMIN_TEXTDOMAIN ) . '">' . sprintf( __( 'Download New Version %1$s', MISS_ADMIN_TEXTDOMAIN ), $remote['data']['version'] ) . '</a>';
			}
			$out .= '</p>';
		}
		$out .='</div>';
		$out .= '</div><!-- #miss_header -->';
		
		$out .= '<div id="miss_body">';
		
		foreach( $options as $option ) {
			$out .= $this->$option['type']( $option );
		}

		$out .= '</div><!-- #miss_tab_content -->';
		$out .= '<div class="clear"></div>';
		$out .= '</div><!-- #miss_body -->';
		
		$out .= '</form><!-- #miss_admin_form -->';
		
		$out .= '</div><!-- #miss_admin_panel -->';
		
		echo $out;
	}
	
	/**
	 *
	 */
	function saved_options() {
		$this->saved_options = get_option( MISS_SETTINGS );
		$this->saved_internal = get_option( MISS_INTERNAL_SETTINGS );
		$this->saved_sidebars = get_option( MISS_SIDEBARS );
		$this->saved_skin = get_option( MISS_ACTIVE_SKIN );
	}
	
	/**
	 *
	 */
	function messages() {
		$message = '';
		if( isset( $_GET['reset'] ) )
			$message = __( 'All Options Restored To Default.', MISS_ADMIN_TEXTDOMAIN );
		if( isset( $_GET['settings-updated'] ) )
			$message = __( 'Settings Saved.', MISS_ADMIN_TEXTDOMAIN );
		if( isset( $_GET['import'] ) && $_GET['import'] == 'true' )
			$message = __( 'Options has been imported successful.', MISS_ADMIN_TEXTDOMAIN );
		if( isset( $_GET['import'] ) && $_GET['import'] == 'false' )
			$message = __( 'An error occurred importing your options, please try again.', MISS_ADMIN_TEXTDOMAIN );
		$style = ( !$message ) ? ' style="display:none;"' : '';
		$out = '<div id="message" class="error fade below-h2"' . $style . '>' . $message . '</div>';
		$out .= '<div id="ajax-loader"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
		return $out;
	}
	
	/**
	 * 
	 */
	function settings_fields() {
		ob_start(); settings_fields( MISS_SETTINGS ); $out = ob_get_clean();
		return $out;
	}
	
	/**
	 * 
	 */
	function navigation( $value ) {
		global $current_user;
		if ($current_user->user_firstname && $current_user->user_lastname) {
			$username = $current_user->user_firstname." ".$current_user->user_lastname;
		} else if ($current_user->user_firstname && !$current_user->user_lastname) {
			$username = $current_user->user_firstname;
		} else if (!$current_user->user_firstname && $current_user->user_lastname) {
			$username = $current_user->user_lastname;
		} else {
			$username = $current_user->user_login;
		}

		$out = '<div id="miss_admin_tabs">';
		$out .= '<div><div class="userpic">'.get_avatar( $current_user->user_email, 48 ).'</div><div class="welcome"><h5>'.__( 'Welcome', MISS_ADMIN_TEXTDOMAIN ).'</h5>' . $username . '</div></div>';
		$out .= '<ul>';
		foreach( $value['name'] as $key => $item ) {
			$out .= '<li><a title="' . $item['title'] . '" href="#' . $key . '" class="miss-icon-' . $item['class'] . '">' . $item['title'] . '</a></li>';
		}
		$out .= '</ul>';
		$out .= '</div><!-- #miss_admin_tabs -->';
		$out .= '<div id="miss_tab_content">';
		
		$out .= $this->messages();
		
		$out .= '<div class="controls">';
		$out .= '<h2 id="current_section_title"><span>'.__( 'General', MISS_ADMIN_TEXTDOMAIN ).'</span> '.__( 'Settings', MISS_ADMIN_TEXTDOMAIN ).'</h2>';
		$out .= '<div class="miss-button-group"><div class="miss_admin_reset"><div data-name="' . MISS_SETTINGS . '[reset]" value="' . esc_attr__( 'Erase All Options' , MISS_ADMIN_TEXTDOMAIN ) . '" class="miss_reset_button"><span class="locker unlock"></span>' . esc_attr__( 'Erase All Options' , MISS_ADMIN_TEXTDOMAIN ) . '</div></div><div class="miss_admin_save"><input type="submit" name="submit" value="' . esc_attr__( 'Save All Changes' , MISS_ADMIN_TEXTDOMAIN ) . '" class="button" /></div></div></div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function tab_start( $value ) {
		foreach( $value['name'] as $key => $name ) {
			$out = '<div id="' . $key . '" class="miss_tab">';
			$out .= '<div>';
			$out .= '</div>';
		}
		
		return $out;
	}
	
	/**
	 * 
	 */
	function tab_end( $value ) {
		$out = '</div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function option_start( $value ) {
		$out = '';
		
		if( $value['name'] ) {
			$out .= '<div class="miss_option_header"><h5 class="caption">' . $value['name'] . '</h5>';

			if( !empty( $value['help'] ) ) {
				$out .= '<div class="miss_option_help">';
				$out .= '<a href="#" class="tooltip-icon"><img src="' . esc_url( THEME_ADMIN_ASSETS_URI ) . '/images/help-icon.png" alt="" /></a>';
				$out .= '<div class="miss_help_tooltip"><div class="tooltip-inner">' . $value['help'] . '</div><div class="tooltip-arrow"></div></div>';
				$out .= '</div>';
			}
			if (isset($value['desc'])) { $out .= '<p>'.$value['desc'].'</p>'; }
			$out .= '</div>';
		}
		
		$out .= '<div class="miss_option">';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function option_end( $value ) {
		$out = '</div><!-- miss_option -->';

		$out .= '<div class="clear"></div>';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function toggle_start( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div class="miss_option_set toggle_option_set section_' . $toggle_class . '">';
		$out .= '<h3 class="option_toggle ' . $toggle_class . 'trigger"><a href="#">' . str_replace( ' ~', '', $value['name'] ) . ' <span>[+]</span></a></h3>';
		$out .= '<div class="toggle_container" style="display:none;">';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function toggle_end ($value ) {
		$out = '</div></div>';
		
		return $out;
	}
	

	/**
	 *
	 */
	function table( $value ) {
		$size = isset( $value['size'] ) ? $value['size'] : '10';
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set text_option_set">';
		
		$out .= $this->option_start( $value );

		$out .= '<div class="virtual_prototype_inner">';
		$out .= '<div class="btn-group input-append inline">';
		$out .= '<select class="table_field btn_small" name="table_field">';
		$table_fields = Array(
			'prototype_caption' => 'Caption Field',
			'prototype_textarea' => 'Text Field',
			'prototype_button' => 'Button',
		);
		foreach( $table_fields as $table_field_key => $table_field_value ) {
			$out .= '<option value="' . $table_field_key . '">' . $table_field_value . '</option>';
		}
		$out .= '</select>';
		$out .= '<input type="button" value="' . esc_attr__( 'Add' , MISS_ADMIN_TEXTDOMAIN ) . '" class="table_field btn" />';

		$out .= '</div>';
		$out .= '<!-- Prototype --><div class="prototype">';

		//Text Field
		$out .= '<div class="prototype prototype_caption">';
		$out .= '<label>' . __( 'Caption field', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<input type="text" class="prototype_caption_field" name="prototype_caption_field" />';
		$out .= '</div>';

		//Text Area
		$out .= '<div class="prototype prototype_textarea">';
		$out .= '<label>' . __( 'Text field', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<textarea class="prototype_textarea_field" name="prototype_textarea_field"></textarea>';
		$out .= '</div>';

		//Button
		$out .= '<div class="prototype prototype_button">';
		$out .= '<label>' . __( 'Button Title', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<input type="text" class="prototype_button_title_field" name="prototype_button_title_field" />';

		$out .= '<label>' . __( 'Button Address URL', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<input type="text" class="prototype_button_url_field" name="prototype_button_url_field" />';

		$out .= '<label>' . __( 'Button Style', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<select name="prototype_button_style_field" class="prototype_button_style_field">';
		$button_style_field = Array(
			'small' => 'Small Button',
			'medium' => 'Medium Button',
			'large' => 'Large Button',
		);
		foreach( $button_style_field as $bs_key => $bs_value ) {
			$out .= '<option value="' . $bs_key . '">' . $bs_value . '</option>';
		}
		$out .= '</select>';
		$out .= '</div>';

		$out .= '</div><!-- /Prototype -->';
		$out .= '</div>';



		$out .= $this->option_end( $value );
		$out .= '</div><!-- .text_option_set -->';
		
		return $out;
	}

	
	/**
	 *
	 */
	function numeral( $value ) {
		$size = isset( $value['size'] ) ? $value['size'] : '3';
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set text_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="number" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="miss_numberfield" value="' .
		( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
		? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
		? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
		: ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) ) . '" size="5" style="width: auto" />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .text_option_set -->';
		
		return $out;
	}

	
	/**
	 *
	 */
	function text( $value ) {
		$size = isset( $value['size'] ) ? $value['size'] : '10';
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set text_option_set">';
		
		$out .= $this->option_start( $value );

		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="miss_textfield" value="' .
		( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
		? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
		? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
		: ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) ) . '" />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .text_option_set -->';
		
		return $out;
	}

	
	/**
	 *
	 */
	function range( $value ) {
		$param = array(
			'param_name' => MISS_SETTINGS . '[' . $value['id'] . ']',
			'type' => 'range',
			'id' => $value['id'],
			'value' => ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
		? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
		? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
		: ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) ),
			'unit' => isset( $value['unit'] ) ? $value['unit'] : 'px',
			'step' => isset( $value['step'] ) ? $value['step'] : '1',
			'min' => isset( $value['min'] ) ? $value['min'] : '0',
			'max' => isset( $value['max'] ) ? $value['max'] : '100'

		);

		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';

		$out = '<div class="' . $toggle_class . 'miss_option_set text_option_set">';

		$out .= $this->option_start( $value );

		$out .= '<div class="im-range-option im-range-input"><input id="' . $param['id'] . '" name="'.$param['param_name'].'" min="'.$param['min'].'" max="'.$param['max'].'" step="'.$param['step'].'" class="range-input-selector range-input-composer wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="range" value="' . $param['value'] . '" /><span class="value">' . $param['value'] . '</span><span class="unit">' . $param['unit'] . '</span></div>';

		$out .= $this->option_end( $value );

		$out .= '</div><!-- .text_option_set -->';

		return $out;
	}

	
	/**
	 *
	 */
	function textarea( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set textarea_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<textarea rows="8" cols="8" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="miss_textarea">' .
		( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '</textarea><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .textarea_option_set -->';
		
		return $out;
	}
	/**
	 *
	 */
	function hidden( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div style="display:none;">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<textarea rows="8" cols="8" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="miss_textarea">' .
		( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '</textarea><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .hidden_option_set -->';
		
		return $out;
	}


	function links( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set description-wrap textarea_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<p>'.$value['std'].'</p><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .textarea_option_set -->';
		return $out;
	}
	
	/**
	 *
	 */
	function select( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? $value['toggle'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set select_option_set">';

		$out .= $this->option_start( $value );
		
		if( isset( $value['target'] ) ) {
			if( isset( $value['options'] ) ) {
				$value['options'] = $value['options'] + $this->select_target_options( $value['target'] );
			} else {
				$value['options'] = $this->select_target_options( $value['target'] );
			}
		}
		
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="' . $toggle . 'miss_select">';
		
		$out .= '<option value="">' . __( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
		
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '"';
			if( isset( $this->saved_options[$value['id']] ) ) {
				if( $this->saved_options[$value['id']] == $key ) {
					$out .= ' selected="selected"';
				}
				
			} elseif( isset( $value['default'] ) ) {
				if( $value['default'] == $key ) {
					$out .= ' selected="selected"';
				}
			}
			
			$out .= '>' . esc_attr( $option ) . '</option>';
		}
		
		$out .= '</select>';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .select_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function multidropdown( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set multidropdown_option_set">';
		
		$out .= $this->option_start( $value );
		
		if( isset( $value['target'] ) ) {
			if( isset( $value['options'] ) ) {
				$value['options'] = $value['options'] + $this->select_target_options( $value['target'] );
			} else {
				$value['options'] = $this->select_target_options( $value['target'] );
			}
		}
		if (isset($value['id']) && isset ($value['default']) && is_array($value['default'])) {
			$selected_keys = ( isset ($value['default']) ) ? $value['default'] : array();
		} else {
			$selected_keys = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array();
		}
		$out .= '<div id="' . MISS_SETTINGS . '[' . $value['id'] . ']" class="multidropdown">';
		
		$i = 0;
		foreach( $selected_keys as $selected ) {
			$out .= '<select name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="miss_select">';
			$out .= '<option value=""> ' . __( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
			foreach( $value['options'] as $key => $option ) {
				$out .= '<option value="' . $key . '"';
				if( $selected == $key ) {
					$out .= ' selected="selected"';
				}
				$out .= '>' . esc_attr( $option ) . '</option>';
			}
			$i++;
			$out .= '</select>';
		}
		
		$out .= '<select name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="miss_select">';
		$out .= '<option value="">' . __( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '">' . $option . '</option>';
		}
		$out .= '</select></div>';
		
		$out .= $this->option_end( $value );
	
		$out .= '</div><!-- .multidropdown_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function checkbox( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set checkbox_option_set">';
		
		$out .= $this->option_start( $value );
		
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = '';
			if( isset( $this->saved_options[$value['id']] ) ) {
				if( is_array( $this->saved_options[$value['id']] ) ) {
					if( in_array( $key, $this->saved_options[$value['id']] ) ) {
						$checked = ' checked="checked"';
					}
				}
				
			} elseif ( isset( $value['default'] ) ){
				if( is_array( $value['default'] ) ) {
					if( in_array( $key, $value['default'] ) ) {
						$checked = ' checked="checked"';
					}
				}
			}
			$out .= '<input type="checkbox" name="' . MISS_SETTINGS . '[' . $value['id'] . '][]" value="' . $key . '" id="' . $value['id'] . '-' . $i . '"' . $checked . $toggle . ' />';
			$out .= '<label for="' . $value['id'] . '-' . $i . '">' . esc_html( $option ) . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .checkbox_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function radio( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set radio_option_set">';
		
		$out .= $this->option_start( $value );
		
		$checked_key = ( isset( $this->saved_options[$value['id']] ) ? $this->saved_options[$value['id']] : ( isset( $value['default'] ) ? $value['default'] : '' ) );
			
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = ( $key == $checked_key ) ? ' checked="checked"' : '';
			
			$out .= '<input type="radio" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '_' . $i . '"' . $toggle .' />';
			$out .= '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .radio_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function upload( $value ) {
		$out = '<div class="miss_option_set upload_option_set">';
		
		$out .= $this->option_start( $value );

		$reformatted_id = str_replace( array("]","["), array("_","_"), $value['id'] );
		$out .= '<div class="btn-group input-append inline" data-toggle="buttons-checkbox">';
		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" value="' . ( isset( $this->saved_options[$value['id']] )
		? esc_url(stripslashes( $this->saved_options[$value['id']] ) )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" id="' . $reformatted_id . '" class="btn miss_upload" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="btn upload_button ' . $value['id'] . ' button" /><br />';
		$out .= $this->option_end( $value );
		$out .= '</div><!-- .btn-group -->';
		
		$out .= '</div><!-- .upload_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function multi_image( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set multi_image_option_set">';
		
		$out .= $this->option_start( $value );
		$selected_keys = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array();
		
		$out .= '<div id="' . MISS_SETTINGS . '[' . $value['id'] . ']" class="multi_image">';
		
		$i = 0;
		foreach( $selected_keys as $selected ) {
			$out .= '<input type="text" name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="miss_upload" />';
			$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value['id'] . '_'.$i.' button" /><br />';
			$i++;
		}
		
		$out .= '<input type="text" name="' . $value['id'] . '_' . $i . '" id="' . $value['id'] . '_' . $i . '" class="miss_upload" />';
		$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="upload_button ' . $value['id'] . '_'.$i.' button" /><br />';
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '">' . $option . '</option>';
		}
		$out .= '<!-- </select>--></div>';
		
		$out .= $this->option_end( $value );
		$out .= '</div><!-- .multi_image_option_set -->';
		
		return $out;
	}

	/**
	 *
	 */
	function resize( $value ) {
		if ( !isset($value['options']) ) {
			if ( isset($value['default']) ) {
				$value['options'] = $value['default'];
			} else {
				$value['options'] = Array();
			}
		}
		$option = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $value['options'];
		$out = '<div class="miss_option_set resize_option_set">';
		
		$out .= '<div class="row-fluid">';
		$out .= $this->option_start( $value );
		
		$out .= '<div class="span6" style="width:50%; float: left;">';
		$out .= '<label for="' . $value['id'] . '_w">' . __( 'Width', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . '][w]" id="' . $value['id'] . '_w" class="miss_textfield" value="' . ( isset( $option['w'] )
		? stripslashes( $option['w'] )
		: '' ) . '" />';
		$out .= '</div>';
		
		$out .= '<div class="span6" style="width:50%; float: left;">';
		$out .= '<label for="' . $value['id'] . '_h">' . __( 'Height', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . '][h]" id="' . $value['id'] . '_h" class="miss_textfield" value="' . ( isset( $option['h'] )
		? stripslashes( $option['h'] )
		: '' ) . '" />';
		$out .= '</div>';
		$out .= $this->option_end( $value );
		$out .= '</div>';
		$out .= '</div><!-- .resize_option_set -->';
		
		return $out;
	}


	/**
	 * 
	 */
	function editor( $value ) {
		global $wp_version, $post, $post_type;
		
		$out = '';
		
		if( !isset( $value['no_header'] ) && isset( $value['name'] ) ) {
			$out .= '<div class="miss_option_header"><h5 class="caption editor_option_header">' . $value['name'] . '</h5></div>';
			$value['name'] = '';
		}
		
		$out .= '<div class="miss_option_set editor_option_set">';
		
		$out .= $this->option_start( $value );

		$content = ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) );
		
		$content_id = MISS_SETTINGS . '[' . $value['id'] .']';
		
		if( version_compare( $wp_version, '3.3', '>=' ) ) {
			
			ob_start();
			$args = array("textarea_name" => $content_id);
			wp_editor( $content, $content_id, $args );
			$editor = ob_get_contents();
			ob_end_clean();

			$out .= $editor;
		}
		else
		{
			$out .= '<div id="poststuff"><div id="post-body"><div id="post-body-content"><div class="postarea" id="postdivrich">';
			
			ob_start();
			wp_editor( $content, $content_id );
			$editor = ob_get_contents();
			ob_end_clean();

			$content_replace = MISS_SETTINGS . '_' . $value['id'];

			$editor = str_replace( $content_id, $content_replace, $editor );
			$out .= str_replace( 'name=\'' . $content_replace . '\'', 'name=\'' . $content_id . '\'', $editor );
			
			$out .= '</div></div></div></div>';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .editor_option_set -->';

		return $out;
	}
	
	/**
	 * 
	 */
	function layout( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div class="' . $toggle_class . 'miss_option_set layout_option_set">';
		
		$out .= $this->option_start( $value );
		
		foreach( $value['options'] as $rel => $image ) {
			$out .= '<a href="#" rel="' . $rel . '"><img src="' . esc_url( $image ) . '" alt="" /></a>';
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" value="' . ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] ) ? $value['default'] : '' ) ) . '" />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .layout_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function export_options( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set textarea_option_set">';
		
		$out .= $this->option_start( $value );
		
		$options = $this->saved_options;
		
		$export_options = array();
		if( !empty( $options ) ) {
			foreach( $options as $key => $option ) {
				if( is_string( $option ) )
					$export_options[$key] = preg_replace( "/(\r\n|\r|\n)\s*/i", '<br /><br />', stripslashes( $option ) );
				else
					$export_options[$key] = $option;
			}
		}
		
		if( !empty( $export_options ) ) {
			$export_options = array_merge( $export_options, array( 'missmyway_options_export' => true ) );
			$export_options = miss_encode( $export_options, $serialize = true );
		}
					
		$out .= '<textarea rows="8" cols="8" name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . $value['id'] . '" class="miss_textarea">' . $export_options . '</textarea><br />';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .textarea_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function contact( $value ) {
		
		$out = '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Email', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the email address that you wish to be used when the form is submitted.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-email',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$form_options = array(
			array( 
				'name' => __( 'Name', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a textfield that is used as the name of the sender.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Email', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a textfield that is used as the email of the sender. This field will be validated for a correct email.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Textfield', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a basic textfield which can be used for anything.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Textarea', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a basic textarea which can be used for anything. This is usually used as the "Message" section of a form.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,required'
			),
			array(
				'name' => __( 'Checkbox', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a checkbox to your form. The checkbox can be used for anything and the value will be displayed in your email.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,value,required'
			),
			array(
				'name' => __( 'Radio', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds radio buttons to your form. You will need to separate your values with a comma.<br /><br />For example if you wanted to offer the choice of male or female then you would enter the value like this: "male, female".', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,value,required'
			),
			array(
				'name' => __( 'Select', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Adds a select box to your form. You will need to separate your values with a comma.<br /><br />For example if you wanted to offer the choice of male or female then you would enter the value like this: "male, female".', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'label,value,required'
			),
			array(
				'name' => __( 'Submit', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'By default the submit button will be displayed as "Submit". If you wish to change the text then you can add this to the form with a custom value.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'value'
			),
			array(
				'name' => __( 'Autoresponder', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Allows you to setup an automated response after the form is submitted. You can use the tags by typing them out like so, %name%, %email%, etc etc.', MISS_ADMIN_TEXTDOMAIN ),
				'options' => 'autoresponder'
			)
		);
		
		$out .= '<div class="toggle_option_set">';
		$out .= '<h5 class="option_toggle contactform_trigger"><a href="#">' . __( 'Advanced Settings', MISS_ADMIN_TEXTDOMAIN ) . ' <span>[+]</span></a></h5>';
		$out .= '<div class="contactform_toggle_container" style="display: none;" >';
		
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Subject', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can place a custom subject line here. This is the subject that you will see in your emails.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-subject',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->text( array(
			'name' => __( 'Success Message', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'When the form is submitted successfully this message will be displayed to the user.  Common examples would be, "Thanks you" or something similar.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'sc-contactform-success',
			'default' => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_atts_contactform">';
		$out .= $this->checkbox( array(
			'name' => __( 'Spam Protection', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => 'You can choose whether to use a captcha for spam protection or the akismet plugin. If using akismet then make sure you sign up with their service and have the akismet plugin enabled.',
			"id" => "sc-contactform-spam",
			'options' => array(
				'captcha-true' => 'Captcha',
				'akismet-true' => 'Akismet'
			),
			"default" => ''
		));
		
		$out .= '</div>';
		
		$out .= '<div class="shortcode_contactform_multiplier miss_option_set">';
		$out .= $this->option_start( array( 'name' => __( 'Add Form Field', MISS_ADMIN_TEXTDOMAIN ) ) );
		
		$out .= '<select class="miss_select" name="contactform_multiplier">';
		$out .= '<option value="">' . __( 'Choose one...', MISS_ADMIN_TEXTDOMAIN ) . '</option>';
		foreach( $form_options as $key => $value ) {
			$out .= '<option value="' . strtolower( $value['name'] ) . '">' . $value['name'] . '</option>';
		}
		$out .= '</select>';
		
		$out .= '<input type="button" value="' . __( 'Add Field &raquo;', MISS_ADMIN_TEXTDOMAIN ) . '" id="multiply_contactform" class="btn3">';
		$out .= $this->option_end( array( 'desc' => __( 'You can add fields to display with your form.  When the form is submitted these fields will display in your email.', MISS_ADMIN_TEXTDOMAIN ) ) );
		
		$out .= '</div>';
		
		foreach( $form_options as $key => $value ) {
			
			$out .= '<div class="shortcode_atts_contactform miss_option_set select_option_set contactform_clone clone_' . strtolower( $value['name'] ) . '" style="display:none;">';
			$out .= $this->option_start(  array( 'name' => $value['name'] ) );
			
			if( strpos( $value['options'], 'label' ) !== false ) {
				$out .= '<label for="sc-contactform-label-#">' . __( 'Form Label:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-label-#" type="text" value="" class="miss_textfield" id="sc-contactform-label-#" style="width:40%;"><br />';
			}
			if( strpos( $value['options'], 'value' ) !== false ) {
				$out .= '<label for="sc-contactform-label-#">' . __( 'Form Value:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-value-#" type="text" value="" class="miss_textfield" id="sc-contactform-value-#" style="width:40%;"><br />';
			}
			if ( strpos( $value['options'], 'required' ) !== false ) {
				$out .= '<label for="sc-contactform-required-#">' . __( 'Require Field:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input type="checkbox" value="true" name="sc-contactform-required-#" id="sc-contactform-required-#"><br />';
			}
			if( strpos( $value['options'], 'autoresponder' ) !== false ) {
				$out .= '<label for="sc-contactform-fromName-#">' . __( 'From Name:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-fromName-#" type="text" value="" class="miss_textfield" id="sc-contactform-fromName-#" style="width:40%;"><br />';
				$out .= '<label for="sc-contactform-fromEmail-#">' . __( 'From Email:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-fromEmail-#" type="text" value="" class="miss_textfield" id="sc-contactform-fromEmail-#" style="width:40%;"><br />';
				$out .= '<label for="sc-contactform-subject-#">' . __( 'Subject:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<input name="sc-contactform-subject-#" type="text" value="" class="miss_textfield" id="sc-contactform-subject-#" style="width:40%;"><br />';
				
				$out .= '<div class="contactform_available_tags">' . __( 'Available Tags:', MISS_ADMIN_TEXTDOMAIN ) . '&nbsp;&nbsp;<span>%return%</span></div>';
				$out .= '<label for="sc-contactform-message-#">' . __( 'Message:', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
				$out .= '<textarea name="sc-contactform-message-#" class="miss_textarea" id="sc-contactform-message-#" cols="8" rows="8"></textarea><br />';
			}
			
			$out .= '<a class="submitdelete contactform_field_deletion" id="delete-1" href="#">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= $this->option_end( array( 'desc' => $value['desc'] ) );
			$out .= '</div>';
		}
		
		$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function sidebar( $value ) {
		$out = '<div class="miss_option_set sidebar_option_set">';
		
		$out .= $this->option_start( $value );
		
		$out .= '<input type="text" name="' . $value['id'] . '" id="' . $value['id'] . '" class="miss_textfield top4m" onkeyup="missAdmin.fixField(this);" value="" />';
		
		$out .= '<div class="add_sidebar">';
		$out .= '<div class="miss-button-group fright"><div class="button btn3 miss_add_sidebar">' . __( 'Add Sidebar', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		$out .= '</div><!-- .add_sidebar -->';
		
		$out .= $this->option_end( $value );
		
		$init = ( !empty( $this->saved_sidebars ) ) ? false : true;
		
		$out .= '<div class="clear menu_clear"' . ( $init ? ' style="display:none;"' : '' ) . '></div>';
		
		$out .= '<ul id="sidebar-to-edit" class="menu"' . ( $init ? ' style="display:none;"' : '' ) . '>';
		
		if( !$init ){
			foreach( $this->saved_sidebars as $key => $sidebar ){
				$out .= '<li class="menu-item" id="sidebar-item-' . $key . '">';
				$out .= '<dl class="menu-item-bar">';
				$out .= '<dt class="menu-item-handle">';
				$out .= '<span class="sidebar-title">' . $sidebar . '</span>';
				$out .= '<span class="item-controls"><a href="#" class="item-type delete_sidebar" rel="sidebar-item-' . $key . '">' . __( 'Delete', MISS_ADMIN_TEXTDOMAIN ) . '</a></span>';
				$out .= '</dt>';
				$out .= '</dl>';
				$out .= '</li>';
			}
			
		} elseif( $init ) {
			$out .= '<li></li>';
		}
		$out .= '</ul><!-- #sidebar-to-edit -->';
		
		$out .= '<ul id="sample-sidebar-item" class="menu" style="display:none;"> ';
		$out .= '<li class="menu-item" id="sidebar-item-:">';
		$out .= '<dl class="menu-item-bar">';
		$out .= '<dt class="menu-item-handle">';
		$out .= '<span class="sidebar-title">:</span>';
		$out .= '<span class="item-controls"><a href="#" class="item-type delete_sidebar" rel="sidebar-item-:">' . __( 'Delete', MISS_ADMIN_TEXTDOMAIN ) . '</a></span>';
		$out .= '</dt>';
		$out .= '</dl>';
		$out .= '</li>';
		$out .= '</ul><!-- #sample-sidebar-item -->';
		
		$out .= '</div><!-- .sidebar_option_set -->';
		
		return $out;
	}
	
	/**
	 * Slideshow: Basic
	 */
	function slideshow( $value ) {
		if (isset($value['default']) && count($value['default']) > 0) {
			$options = $value['default'];
		} else {
			$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'slider_keys' => '#' );
		}
		$init = false;
		$obo = ( isset( $value['obo'] ) ) ?  $value['obo'] : false;
		$captions = ( isset ( $value['captions'] ) ) ? $value['captions'] : false;

		if( $options['slider_keys'] == '#' ) {
			$init = true;
		}

		if ( !isset( $captions['add'] ) ) {
		    $captions['add'] =  __( 'Add New Slider', MISS_ADMIN_TEXTDOMAIN );
		}

		$slider_keys = explode( ',', $options['slider_keys'] );
		$key_count = count( $slider_keys );

		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out = '<div class="' . $toggle_class . 'miss_option_set slideshow_option_set">';
		$out .= '<div class="miss_option_heading"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="miss-button-group"><div class="button btn3 miss_add_menu">' . $captions['add'] . '</div></div>';
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $slider_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';
			
			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MISS_SETTINGS . '[slideshow][' . $id . ']';
			$url = ( !empty( $val['slider_url'] ) ) ? esc_url(stripslashes( $val['slider_url'] ) ) : '';
			$alt = ( !empty( $val['alt_attr'] ) ) ? stripslashes( $val['alt_attr'] ) : '';
			$link_url = ( !empty( $val['link_url'] ) ) ? esc_url(stripslashes( $val['link_url'] ) ) : '';
			$title = ( !empty( $val['title'] ) ) ? stripslashes( $val['title'] ) : '';
			$description = ( !empty( $val['description'] ) ) ? stripslashes( $val['description'] ) : '';
			$stage = ( !empty( $val['stage_effect'] ) ) ? $val['stage_effect'] : '';
			
			$out .= '<li id="slideshow-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			if (isset( $captions['title'] ) && $captions['title']) {
				$caption = sprintf($captions['title'] . ' %1$s', $i );
			} else {
				$caption = sprintf( __( 'Slideshow %1$s', MISS_ADMIN_TEXTDOMAIN ), $i );
			}
			if (isset ($captions['edit']) && $captions['edit']) {
				$edit_title = $captions['edit'];
				
			} else {
				$edit_title = __( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN );
			}
			$out .= '<span class="item-title">' . $caption . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="slideshow-menu-item-settings-' . $id .'" title="Edit Menu Item" id="edit-' . $id . '" class="item-edit">' . $edit_title . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="slideshow-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';

			# obo element options
			if ($obo == true) {
				# obo variables
				$picker = ( !empty( $val['picker'] ) ) ? stripslashes( $val['picker'] ) : '';
				$pos = ( !empty( $val['pos'] ) ) ? stripslashes( $val['pos'] ) : '';
				$type = ( !empty( $val['type'] ) ) ? stripslashes( $val['type'] ) : '';
				$top = ( !empty( $val['top'] ) ) ? stripslashes( $val['top'] ) : '';
				$left = ( !empty( $val['left'] ) ) ? stripslashes( $val['left'] ) : '';
				$zindex = ( !empty( $val['zindex'] ) ) ? stripslashes( $val['zindex'] ) : '';
				$fx = ( !empty( $val['fx'] ) ) ? stripslashes( $val['fx'] ) : '';
				# FX type
				$fx_types = Array(

 					'Flippers (Webkit, Firefox, & IE10 only)'	=> false,
					'flip'						=> 'flip',
					'flipInX'					=> 'flipInX',
					'flipOutY'					=> 'flipOutY',
					'flipInY'					=> 'fpliInY',
					'flipOutX'					=> 'flipOutX',

 					'Fading Exits'				=> false,
					'fadeOut'					=> 'fadeOut',
					'fadeOutUp'					=> 'fadeOutUp',
					'fadeOutDown'				=> 'fadeOutDown',
					'fadeOutLeft'				=> 'fadeOutLeft',
					'fadeOutRight'				=> 'fadeOutRight',
					'fadeOutUpBig'				=> 'fadeOutUpBig',
					'fadeOutDownBig'			=> 'fadeOutDownBig',
					'fadeOutLeftBig'			=> 'fadeOutLeftBig',
					'fadeOutRightBig'			=> 'fadeOutRightBig',

 					'Bouncing Entrances'		=> false,
					'bounceIn'					=> 'bounceIn',
					'bounceInDown'				=> 'bounceInDown',
					'bounceInUp'				=> 'bounceInUp',
					'bounceInLeft'				=> 'bounceInLeft',
					'bounceInRight'				=> 'bounceInRight',

 					'Bouncing Exits'			=> false,
					'bounceOut'					=> 'bounceOut',
					'bounceOutDown'				=> 'bounceOutDown',
					'bounceOutUp'				=> 'bounceOutUp',
					'bounceOutLeft'				=> 'bounceOutLeft',
					'bounceOutRight'			=> 'bounceOutRight',

 					'Rotating'					=> false,
					'rotateIn'					=> 'rotateIn',
					'rotateInDownLeft'			=> 'rotateInDownLeft',
					'rotateInDownRight'			=> 'rotateInDownRight',
					'rotateInUpLeft'			=> 'rotateInUpLeft',
					'rotateInUpRight'			=> 'rotateInUpRight',

 					'Rotating Exits'			=> false,
					'rotateOut'					=> 'rotateOut',
					'rotateOutDownLeft'			=> 'rotateOutDownLeft',
					'rotateOutDownRight'		=> 'rotateOutDownRight',
					'rotateOutUpLeft'			=> 'rotateOutUpLeft',
					'rotateOutUpRight'			=> 'rotateOutUpRight',
 
 					'Speed'						=> false,
					'lightSpeedIn'				=> 'lightSpeedIn',
					'lightSpeedOut'				=> 'lightSpeedOut',

 					'Special'					=> false,
					'hinge'						=> 'hinge',
					'rollIn'					=> 'rollIn',
					'rollOut'					=> 'rollOut',
				);

				# slide type
				$slider_types = Array(
				    'h1'		=> 'H1 Caption',
				    'h2'		=> 'H2 Caption',
				    'h3'		=> 'H3 Caption',
				    'h5'		=> 'H5 Caption',
				    'h6'		=> 'H6 Caption',
				    'img'		=> 'Image',
				    'text'		=> 'Text',
				    'video'		=> 'Video',
				    'button'		=> 'Button',
				);

				# position type
				$pos_types = Array(
				    'absolute'		=> 'Absolute',
				    'relative'		=> 'Relative',
				    'static'		=> 'Static',
				);

				$out .= '<label for="edit-menu-type-' . $id . '"><h4>' . __( 'Select Element Type', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<p class="description">';
				$out .= '<select name="' . $name . '[type]" value="' . $type . '" id="edit-menu-type-' . $id . '" class="widefat">';
				foreach($slider_types as $sId => $sName) {
				    $out .= '<option value="'.$sId.'"';
				    if ($sId == $type) {
					$out .= ' selected';
				    }
				    $out .= '>'.$sName.'</option>';
				}
				$out .= '</select>';
				$out .= '</p>';

				$out .= '<label for="edit-menu-pos-' . $id . '"><h4>' . __( 'Element Position', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<select name="' . $name . '[pos]" value="' . $pos . '" id="edit-menu-pos-' . $id . '" class="widefat">';
				foreach($pos_types as $sId => $sName) {
				    $out .= '<option value="'.$sId.'"';
				    if ($sId == $type) {
					$out .= ' selected';
				    }
				    $out .= '>'.$sName.'</option>';
				}
				$out .= '</select>';
				$out .= '</p>';

				# element effect
				$out .= '<label for="edit-menu-fx-' . $id . '"><h4>' . __( 'Element Effect', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<p class="description">';
				$out .= '<select name="' . $name . '[fx]" id="edit-menu-fx-' . $id . '" class="widefat">';
				

					foreach($fx_types as $sId => $sName) {
					    $out .= '<option value="'.$sId.'"';
					    if ($sName == false) {
					    	$out .= " disabled";
					    }
					    if ($sId == $fx) {
							$out .= ' selected';
					    }
					    $out .= '>';
					    $out .= ( $sName != false ) ? $sName : $sId;
					    $out .= '</option>';
					}

				$out .= '</select>';
				$out .= '</p>';

				# top offset
				$out .= '<label for="edit-menu-top-' . $id . '"><h4>' . __( 'Top offset', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<p class="description">';
				$out .= '<input type="text" name="' . $name . '[top]" value="' . $top . '" id="edit-menu-top-' . $id . '" class="widefat" />';
				$out .= '</p>';

				#top offset
				$out .= '<label for="edit-menu-left-' . $id . '"><h4>' . __( 'Left offset', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<p class="description">';
				$out .= '<input type="text" name="' . $name . '[left]" value="' . $left . '" id="edit-menu-left-' . $id . '" class="widefat" />';
				$out .= '</p>';

				#text color
				$out .= '<label for="edit-menu-picker-' . $id . '"><h4>' . __( 'Text Color', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
				$out .= '<div class="color input-append">';
				$out .= '<input type="text" value="' . $picker . '" id="edit-menu-picker-' . $id .'" name="' . $name . '[picker]" class="bootstrap-colorpicker" />';
				$out .= '<span class="add-on"><i style="background-color: ' . $picker . ';"></i></span>';
				$out .= '</div>';

			}

			#source types
			$source_types = Array(
			    'default'		=> 'Image (default)',
			    'vimeo'			=> 'Vimeo',
			    'youtube'		=> 'Youtube',
			);


			# slider image url
			$out .= '<label for="edit-menu-image-url-' . $id . '"><h4>' . __( 'Image/Video URL', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
			$out .= '<p class="description">';
			$out .= '<input type="text" name="' . $name . '[slider_url]" value="' . $url . '" id="edit-menu-image-url-' . $id . '" class="widefat" />';
			$out .= '&nbsp;<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="upload_button button" />';
			$out .= '</p>';
			# video type
			$out .= '<label for="slide-source-type-' . $id . '">' . __( 'Slide Source', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
			$out .= '<p class="description">';
			$out .= '<select id="slide-source-type-' . $id . '" name="'.$name.'[source]">';
					foreach($source_types as $sId => $sName) {
					    $out .= '<option value="'.$sId.'"';
					    if ($sName == false) {
					    	$out .= " disabled";
					    }
					    if ( isset( $val['source'] ) && $sId == $val['source'] ) {
							$out .= ' selected';
					    }
					    $out .= '>';
					    $out .= ( $sName != false ) ? $sName : $sId;
					    $out .= '</option>';
					}

			$out .= '</select>';
			$out .= '</p>';
			
			# slider image alt attr
			$out .= '<label for="edit-menu-alt-url-' . $id . '">' . __( 'Image Alt Attribute', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
			$out .= '<p class="description">';
			$out .= '<input type="text" name="' . $name . '[alt_attr]" value="' . $alt . '" id="edit-menu-alt-url-' . $id . '" class="widefat" />';
			$out .= '</p>';
			
			# slider link url
			$out .= '<label for="edit-menu-link-url-' . $id . '"><h4>' . __( 'Link URL', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
			$out .= '<p class="description">';
			$out .= '<input type="text" name="' . $name . '[link_url]" value="' . $link_url . '" id="edit-menu-link-url-' . $id . '" class="widefat" />';
			$out .= '</p>';
			
			# slider title
			$out .= '<label for="edit-menu-title-' . $id . '"><h4>' . __( 'Title', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
			$out .= '<p class="description">';
			$out .= '<input type="text" name="' . $name . '[title]" value="' . $title . '" id="edit-menu-title-' . $id . '" class="widefat" />';
			$out .= '</p>';

			# slider autoplay
			$out .= '<p class="description"><label><input' . ( !empty( $val['autoplay'] )
			? ' checked="checked"': '' ) .' type="checkbox" value="1" name="' . $name . '[autoplay]" />' . __( 'Enable autoplay', MISS_ADMIN_TEXTDOMAIN ) . '</label></p>';


			# slider stage effect
			$out .= '<label for="edit-menu-stage-effect-' . $id . '"><h4>' . __( 'Stage Effect', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
			$out .= '<p class="description">';
			$out .= '<select name="' . $name . '[stage_effect]" id="edit-menu-stage-effect-' . $id . '" class="widefat">';
		
			foreach ( $this->select_target_options( 'slider_stage' ) as $stage_value => $stage_effect ) {
				$selected = ( $stage == $stage_value ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected . ' value="' . $stage_value . '">' . $stage_effect . '</option>';
			}

			$out .= '</select>';
			$out .= '</p>';
			
			# slider read more
			$out .= '<p class="description"><label><input' . ( !empty( $val['read_more'] )
			? ' checked="checked"': '' ) .' type="checkbox" value="1" name="' . $name . '[read_more]" />' . __( 'Disable "Read More" Button', MISS_ADMIN_TEXTDOMAIN ) . '</label></p>';
			
			# slider description
			$out .= '<label for="edit-menu-slider-description-' . $id . '"><h4>' . __( 'Slider Text', MISS_ADMIN_TEXTDOMAIN ) . '</h4></label>';
			$out .= '<p class="field-description description">';
			$out .= '<textarea cols="20" rows="3" name="' . $name . '[description]" id="edit-menu-slider-description-' . $id . '" class="widefat">' . $description . '</textarea>';
			$out .= '</p>';

			# menu item actions
			$out .= '<div class="menu-item-actions submitbox">';
			$out .= '<a href="#" id="delete-slideshow-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="slideshow-menu-item-settings-' . $id . '" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[slideshow][slider_keys]" value="' . $options['slider_keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .slideshow_option_set -->';
		
		return $out;
	}


	/**
	 * Slideshow OBO: Basic
	 */
	function slideshow_OBO( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'slider_keys' => '#' );
		$init = false;
		if( $options['slider_keys'] == '#' ) {
			$init = true;
		}
		$slider_keys = explode( ',', $options['slider_keys'] );
		$key_count = count( $slider_keys );
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$out  = '<div class="' . $toggle_class . 'miss_option_set slideshow_OBO_option_set">';
		$out .= '<div class="miss_option_heading"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="miss-button-group"><div class="button btn3 miss_add_menu">' . __( 'Add New Slider', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		$i=1;
		foreach( $slider_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) ) {
				$out .= '<ul class="menu-to-edit menu">';
			}
			if ( $i == $key_count ) {
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			}
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MISS_SETTINGS . '[slideshow_OBO][' . $id . ']';
			$items = ( !empty( $val['items'] ) ) ? esc_url(stripslashes( $val['items'] ) ) : array();
			$url = ( !empty( $val['slider_url'] ) ) ? esc_url(stripslashes( $val['slider_url'] ) ) : '';
			$alt = ( !empty( $val['alt_attr'] ) ) ? stripslashes( $val['alt_attr'] ) : '';
			$link_url = ( !empty( $val['link_url'] ) ) ? esc_url(stripslashes( $val['link_url'] ) ) : '';
			$title = ( !empty( $val['title'] ) ) ? stripslashes( $val['title'] ) : '';
			$description = ( !empty( $val['description'] ) ) ? stripslashes( $val['description'] ) : '';
			$stage = ( !empty( $val['stage_effect'] ) ) ? $val['stage_effect'] : '';

			$out .= '<li id="slideshow_OBO-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';

			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . sprintf( __( 'Slideshow %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="slideshow_OBO-menu-item-settings-' . $id .'" title="Edit Menu Item" id="edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="slideshow_OBO-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';

			# slider image url
			$out .= '<p class="element-label"><label for="edit-menu-image-url-' . $id . '">' . __( 'Image/Video URL', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[slider_url]" value="' . $url . '" id="edit-menu-image-url-' . $id . '" class="widefat" />';
			$out .= '&nbsp;<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="upload_button button" />';
			$out .= '</label>';
			$out .= '</p>';

			# slider type
			$out .= '<p class="element-label">';
			$out .= '<label for="slide-source-type-' . $id . '">' . __( 'Slide Source', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '</label>';
			$out .= '<select id="slide-source-type-' . $id . '" name="'.$name.'[source]">';
			$out .= '	<option value="default" selected>Default</option>';
			$out .= '	<option value="youtube">Youtube</option>';
			$out .= '	<option value="vimeo">Vimeo</option>';
			$out .= '</select>';
			$out .= '</p>';
			
			# slider image alt attr
			$out .= '<p class="element-label"><label for="edit-menu-alt-url-' . $id . '">' . __( 'Image Alt Attribute', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[alt_attr]" value="' . $alt . '" id="edit-menu-alt-url-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider link url
			$out .= '<p class="element-label"><label for="edit-menu-link-url-' . $id . '">' . __( 'Link URL', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[link_url]" value="' . $link_url . '" id="edit-menu-link-url-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider title
			$out .= '<p class="element-label"><label for="edit-menu-title-' . $id . '">' . __( 'Title', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" name="' . $name . '[title]" value="' . $title . '" id="edit-menu-title-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider stage effect
			$out .= '<p class="element-label"><label for="edit-menu-stage-effect-' . $id . '">' . __( 'Stage Effect', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select name="' . $name . '[stage_effect]" id="edit-menu-stage-effect-' . $id . '" class="widefat">';
			
			foreach ( $this->select_target_options( 'slider_stage' ) as $stage_value => $stage_effect ) {
				
				$selected = ( $stage == $stage_value ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected . ' value="' . $stage_value . '">' . $stage_effect . '</option>';
			}
			$out .= '</select>';
			$out .= '</label>';
			$out .= '</p>';
			
			# slider read more
			$out .= '<p class="element-label"><label><input' . ( !empty( $val['read_more'] )
			? ' checked="checked"': '' ) .' type="checkbox" value="1" name="' . $name . '[read_more]" />' . __( 'Disable "Read More" Button', MISS_ADMIN_TEXTDOMAIN ) . '</label></p>';
			
			# slider description
			$out .= '<p class="field-description"><label for="edit-menu-slider-description-' . $id . '">' . __( 'Description', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<textarea cols="20" rows="3" name="' . $name . '[description]" id="edit-menu-slider-description-' . $id . '" class="widefat">' . $description . '</textarea>';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions submitbox">';
			$out .= '<a href="#" id="delete-slideshow_OBO-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="slideshow_OBO-menu-item-settings-' . $id . '" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[slideshow_OBO][slider_keys]" value="' . $options['slider_keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .slideshow_OBO_option_set -->';
		
		return $out;
	}

	
	/**
	 * Sociable
	 */
	function sociable( $value ) {
		$defaults = array( 'keys' => '#' );
		
		if (isset ($value['default'] ) ) {
			$defaults = $value['default'];
		}
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $defaults;

		$init = false;
		
		if( $options['keys'] == '#' )
			$init = true;
		
		$sociable_keys = explode(',', $options['keys'] );
		
		$key_count = count( $sociable_keys );
		
		$out = '<div class="miss_option_set sociable_option_set">';
		$out .= '<div class="miss_option_heading"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="add_menu button-group"><div class="button btn3 miss_add_menu">' . __( 'Add New Sociable', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $sociable_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) ) {
				$out .= '<ul class="menu-to-edit menu">';
			}

			if ( $i == $key_count ) {
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			}

			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';

			$name = MISS_SETTINGS . '[sociable][' . $id . ']';
			$custom = ( !empty( $val['custom'] ) ) ? esc_url(stripslashes( $val['custom'] ) ) : '';
			$link = ( !empty( $val['link'] ) ) ? stripslashes( $val['link'] ) : '';
			$background = ( !empty( $val['background'] ) ) ? stripslashes( $val['background'] ) : '';
			$icon = ( !empty( $val['icon'] ) ) ? $val['icon'] : '';
			$color = ( !empty( $val['color'] ) ) ? $val['color'] : '';
			
			if( !empty( $icon ) ) {
				$icon_title = ucwords( $icon );
			}
						
			$out .= '<li id="sociable-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . ( $custom || $id == '#' || empty( $icon ) ? sprintf( __( 'Sociable %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ) : $icon_title ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="sociable-menu-item-settings-' . $id .'" title="Edit Menu Item" id="sociable-menu-edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="sociable-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# sociable icon
			$out .= '<p class="field-link-target description description-thin"><label for="edit-menu-sociable-icon-' . $id . '">' . __( 'Sociable Icon', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select id="edit-menu-sociable-icon-' . $id . '" class="widefat" name="' . $name . '[icon]">';
			
			$sociables_icons = miss_sociable_option();
			foreach ( $sociables_icons as $key => $val ) {
				$selected = ( $icon == $key ) ? ' selected="selected"' : '' ;
				$out .= '<option' . $selected. ' value="' . $key . '">' . $val . '</option>';
			}
			$out .= '</select>';
			$out .= '</label>';
			$out .= '</p>';
			
			# sociable link
			$out .= '<p class="description description-thin"><label for="edit-sociable-menu-link-' .$id. '">' . __( 'Sociable Link', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $link . '" name="' . $name . '[link]" id="edit-sociable-menu-link-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
            
            # sociable background
			$out .= '<p class="description description-thin"><label for="edit-sociable-menu-background-' .$id. '">' . __( 'Sociable background', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $background . '" name="' . $name . '[background]" id="edit-sociable-menu-background-' . $id . '" class="bootstrap-colorpicker" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-sociable-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="sociable-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			$out .= '</div><!-- #sociable-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[sociable][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .sociable_option_set -->';
		
		return $out;
	}

	/**
	 * Partners
	 */
	function partners( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'keys' => '#' );
		
		$init = false;
		
		if( $options['keys'] == '#' )
			$init = true;
		
		$partners_keys = explode(',', $options['keys'] );
		
		$key_count = count( $partners_keys );
		
		$out =  '<div class="miss_option_set partner_option_set">';
		$out .= '<div class="miss_option_heading"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="add_menu button-group"><div class="button btn3 miss_add_menu">' . __( 'Add New Partner', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $partners_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';

			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MISS_SETTINGS . '[partners][' . $id . ']';
			$custom = ( !empty( $val['custom'] ) ) ? esc_url(stripslashes( $val['custom'] ) ) : '';
			$link = ( !empty( $val['link'] ) ) ? esc_url(stripslashes( $val['link'] ) ) : '';
			$icon = ( !empty( $val['icon'] ) ) ? $val['icon'] : '';
			$color = ( !empty( $val['color'] ) ) ? $val['color'] : '';
			
			if( !empty( $icon ) ) {
				$parts = explode( '.', $icon );
				$icon_title = str_replace( '_',' ', $parts[count($parts) - 2] );
				$icon_title = ucwords( $icon_title );
				$icon_title = str_replace( ' ','', $icon_title );
			}
						
			$out .= '<li id="partner-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . ( $custom || $id == '#' || empty( $icon ) ? sprintf( __( 'Partner %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ) : $icon_title ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="partner-menu-item-settings-' . $id .'" title="Edit Menu Item" id="partner-menu-edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="partner-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			

			# partners url
			$out .= '<p class="description description-thin"><label for="edit-partner-menu-url-' . $id . '">' . __( 'Partner Logo', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $custom . '" name="' . $name . '[custom]" id="edit-partner-menu-url-' . $id . '" class="widefat partner_custom" />';
			$out .= '&nbsp;<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="upload_button button" /><br />';
			$out .= '</label>';
			$out .= '</p>';
			
			# partners link
			$out .= '<p class="description description-thin"><label for="edit-partner-menu-link-' .$id. '">' . __( 'Partner Link', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $link . '" name="' . $name . '[link]" id="edit-partner-menu-link-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-partner-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="partner-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			
			$out .= '</div><!-- #partner-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[partners][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- /.partner_option_set -->';
		
		return $out;
	}



	/**
	 * Google Fonts
	 */
	function google_web_fonts( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'keys' => '#' );
		
		$init = false;
		
		if( $options['keys'] == '#' )
			$init = true;
		
		$google_fonts_keys = explode(',', $options['keys'] );
		
		$key_count = count( $google_fonts_keys );
		
		$out =  '<div class="miss_option_set google_font_option_set">';
		$out .= '<div class="miss_option_heading"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="add_menu button-group"><div class="button btn3 miss_add_menu">' . __( 'Add New Font', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		$gwf_array = miss_gwf_list();
		foreach( $google_fonts_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';

			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MISS_SETTINGS . '[google_web_fonts][' . $id . ']';
			$gwf_face_name = ( !empty( $val['gwf_face_name'] ) ) ? $val['gwf_face_name'] : '';

			$custom = ( !empty( $val['custom'] ) ) ? esc_url(stripslashes( $val['custom'] ) ) : '';
			$link = ( !empty( $val['link'] ) ) ? esc_url(stripslashes( $val['link'] ) ) : '';
			$icon = ( !empty( $val['icon'] ) ) ? $val['icon'] : '';
			$color = ( !empty( $val['color'] ) ) ? $val['color'] : '';
			
			if( !empty( $icon ) ) {
				$parts = explode( '.', $icon );
				$icon_title = str_replace( '_',' ', $parts[count($parts) - 2] );
				$icon_title = ucwords( $icon_title );
				$icon_title = str_replace( ' ','', $icon_title );
			}
						
			$out .= '<li id="google_font-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . ( empty( $gwf_face_name ) ? sprintf( __( 'Google Web Font %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ) : $gwf_face_name ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="google_font-menu-item-settings-' . $id .'" title="Change Font" id="google_font-menu-edit-' . $id . '" class="item-edit">' . __( 'Change Font', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="google_font-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# google fonts
			$out .= '<label for="edit-google_font-menu-url-' . $id . '">' . __( 'Font-Face', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<select data-value="' . $gwf_face_name . '" name="' . $name . '[gwf_face_name]" id="edit-google_font-menu-url-' . $id . '" class="google_font_gwf_face_name">';
			foreach( $gwf_array as $font ) {
				if ( !empty( $font ) ) {
					if ( $gwf_face_name == $font ) {
						$selected = " selected";
					} else {
						$selected = "";
					}

					$out .= '<option value="' . $font . '"'. $selected .'>' . $font . '</option>';
				}
			}
			$out .= '</select>';
			$out .= '</label>';

			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-google_font-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="google_font-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			
			$out .= '</div><!-- #google_font-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[google_web_fonts][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- /.google_font_option_set -->';
		
		return $out;
	}

	/**
	 * Extra header Lang
	 */
	function extra_header_langs( $value ) {
		$defaults = array( 'keys' => '#' );
		
		if (isset ($value['default'] ) ) {
			$defaults = $value['default'];
		}
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $defaults;

		$init = false;
		
		if( $options['keys'] == '#' )
			$init = true;
		
		$extra_header_langs_keys = explode(',', $options['keys'] );
		
		$key_count = count( $extra_header_langs_keys );
		
		$out = '<div class="miss_option_set extra_header_langs_option_set">';
		$out .= '<div class="miss_option_header"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="add_menu button-group"><div class="button btn3 miss_add_menu">' . __( 'Add New Language', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $extra_header_langs_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) ) {
				$out .= '<ul class="menu-to-edit menu">';
			}

			if ( $i == $key_count ) {
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			}

			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';

			$name = MISS_SETTINGS . '[extra_header_langs][' . $id . ']';
			$custom = ( !empty( $val['custom'] ) ) ? stripslashes( $val['custom'] ) : '';
			$link = ( !empty( $val['link'] ) ) ? esc_url(stripslashes( $val['link'] ) ) : '';
			$icon = ( !empty( $val['icon'] ) ) ? $val['icon'] : '';
			$color = ( !empty( $val['color'] ) ) ? $val['color'] : '';
			
			if( !empty( $icon ) ) {
				$icon_title = ucwords( $icon );
			}
						
			$out .= '<li id="extra_header_langs-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' . ( $custom || $id == '#' || empty( $icon ) ? sprintf( __( 'Language %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ) : $icon_title ) . '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="extra_header_langs-menu-item-settings-' . $id .'" title="Edit Menu Item" id="extra_header_langs-menu-edit-' . $id . '" class="item-edit">' . __( 'Edit Item', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="extra_header_langs-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# extra_header_langs name
			$out .= '<p class="description description-thin"><label for="edit-extra_header_langs-menu-custom-' . $id . '">' . __( 'Language Name', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $custom . '" name="' . $name . '[custom]" id="edit-extra_header_langs-menu-custom-' . $id . '" class="widefat language_custom" />';
			$out .= '</label>';
			$out .= '</p>';

			# extra_header_langs link
			$out .= '<p class="description description-thin"><label for="edit-extra_header_langs-menu-link-' .$id. '">' . __( 'Language Link', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $link . '" name="' . $name . '[link]" id="edit-extra_header_langs-menu-link-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-extra_header_langs-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="extra_header_langs-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			$out .= '</div><!-- #extra_header_langs-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[extra_header_langs][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .extra_header_langs_option_set -->';
		
		return $out;
	}

	
	/**
	 * Criteria
	 */
	
	function criteria( $value ) {
		$options = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : array( 'keys' => '#' );
		$init = false;
		if( $options['keys'] == '#' )
			$init = true;
		$criteria_keys = explode(',', $options['keys'] );
		$key_count = count( $criteria_keys );
		$out = '<div class="miss_option_set criteria_option_set">';
		$out .= '<div class="miss_option_header"><h5 class="caption">' . $value['name'] . '</h5></div>';
		$out .= '<div class="add_menu button-group"><div class="btn3 button miss_add_menu">' . __( 'Add New Criteria', MISS_ADMIN_TEXTDOMAIN ) . '</div></div>';
		$out .= '<div class="clear menu_clear"' . ( $init == true ? ' style="display:none;"' : '' ) . '></div>';
		if( $init == true )
			$out .= '<ul class="menu-to-edit menu" style="display:none;"><li></li></ul><!-- .menu-to-edit -->';
		
		$i=1;
		foreach( $criteria_keys as $key ) {
			if( ( $i == 1 ) && ( $init == false ) )
				$out .= '<ul class="menu-to-edit menu">';

			if ( $i == $key_count )
				$out .= '<ul class="sample-to-edit menu" style="display:none;">';
			
			$id = $key;
			$val = ( ( $id != '#' ) && ( isset( $options[$key] ) ) ) ? $options[$key] : '';
			
			$name = MISS_SETTINGS . '[criteria][' . $id . ']';
			$link = ( !empty( $val['link'] ) ) ? stripslashes($val['link'])  : '';
			$custom = '';
			
			$out .= '<li id="criteria-menu-item-' . $id . '" class="menu-item menu-item-edit-inactive">';
			
			# menu handle
			$out .= '<dl class="menu-item-bar">';
			$out .= '<dt class="menu-item-handle">';
			$out .= '<span class="item-title">' .sprintf( __( 'Criteria %1$s', MISS_ADMIN_TEXTDOMAIN ), $i ). '</span>';
			$out .= '<span class="item-controls">';
			$out .= '<a href="criteria-menu-item-settings-' . $id .'" title="Edit Menu Item" id="criteria-menu-edit-' . $id . '" class="item-edit">' . __( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</span>';
			$out .= '</dt>';
			$out .= '</dl>';
			
			# menu settings
			$out .= '<div id="criteria-menu-item-settings-' . $id . '" class="menu-item-settings" style="display:none;">';
			
			# criteria name
			$out .= '<p class="description description-thin"><label for="edit-criteria-menu-link-' .$id. '">' . __( 'Criteria Name', MISS_ADMIN_TEXTDOMAIN ) . '<br />';
			$out .= '<input type="text" value="' . $link . '" name="' . $name . '[link]" id="edit-criteria-menu-link-' . $id . '" class="widefat" />';
			$out .= '</label>';
			$out .= '</p>';
			
			# menu item actions
			$out .= '<div class="menu-item-actions description-wide submitbox">';
			$out .= '<a href="" id="delete-criteria-menu-item-' . $id . '" class="submitdelete slider_deletion">' . __( 'Remove', MISS_ADMIN_TEXTDOMAIN ) . '</a> ';
			$out .= '<span class="meta-sep"> | </span> <a href="criteria-menu-item-settings-' . $id .'" class="slider_cancel submitcancel">' . __( 'Cancel', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '</div>';
			
			
			$out .= '</div><!-- #criteria-menu-item-settings-## -->';
			$out .= '</li>';
			
			if( $i == $key_count-1 )
				$out .= '</ul><!-- .menu-to-edit -->';
			
			if( $i == $key_count )
				$out .= '</ul><!-- .sample-to-edit -->';
			
			$i++;
		}
		
		$out .= '<input type="hidden" name="' . MISS_SETTINGS . '[criteria][keys]" value="' . $options['keys'] . '" class="menu-keys" />';
		$out .= '</div><!-- .criteria_option_set -->';
		
		return $out;
	}


	/**
	 * Old Colour Picker
	 */
	function colorSimplified($value) {
		$out = '<div class="miss_option_set color_option_set">';

		$out .= $this->option_start($value);

		$val = ( isset( $this->saved_options[$value['id']] )
			? stripslashes( $this->saved_options[$value['id']] )
			: ( isset( $value['default'] )
		? $value['default'][0]
		: '' ) );

		$out .= '<div class="colorSelector" id="' .$value['id']. '_picker"><div></div></div>';
		$out .= '<input type="color" value="' .$val. '" id="' .$value['id']. '" name="' .$value['id']. '" class="miss_colorselector"><br />';
	
		$out .= $this->option_end($value);

		$out .= '</div><!-- color_option_set -->';

		return $out;
	}


	/**
	 * Bootstrap Colour Box
	 */
	function color_box( $name = 0, $id = 0, $el = false, $value, $format ) {
		if ( is_array( $value ) ) {
			$value = 'rgba(255,250,0,1)';
		}
 
		$out  = '<div class="input-append color bootstrap-colorpicker" data-color="' . (string) $value . '" data-color-format="' . $format . '">';
		$out .= '<input type="text" name="' . $name . '" id="' . $id . '" value="' . (string) $value . '" data-color-format="' . $format . '" />';
		$out .= '<span class="add-on"><i style="background-color: ' . (string) $value . ';"></i></span>';
		$out .= '</div>';
		return $out;
	}


	/**
	 * Gradient
	 */
	function gradient( $value ) {
		if ( !isset($value['options']) ) {
			if ( isset($value['default']) ) {
				$value['options'] = $value['default'];
			} else {
				$value['options'] = Array();
			}
		}
		$option = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $value['options'];

		$location = range(0,100);
		$orientation = Array(
			'top' => 'Vertical',
			'left' => 'Horizontal',
		);
		$out = '<div class="miss_option_set resize_option_set">';
		$toggle = $value['id'] . '_toggle';
		$out .= '<div class="row-fluid">';
		$out .= $this->option_start( $value );
		$out .= '<div class="span6">';
		$out .= '<label for="' . $value['id'] . '_start">' . __( 'Start Colour', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= $this->color_box( MISS_SETTINGS . '[' . $value['id'] . '][start]', MISS_SETTINGS . '[' . $value['id'] . '][start]', false, (string) ( isset( $option['start'] ) ? $option['start'] : '' ), 'rgba' );
		$out .= '</div>';
		$out .= '<div class="span6">';
		$out .= '<label for="' . $value['id'] . '_end">' . __( 'End Colour', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= $this->color_box( MISS_SETTINGS . '[' . $value['id'] . '][end]', MISS_SETTINGS . '[' . $value['id'] . '][end]', false, (string) ( isset( $option['end'] ) ? $option['end']: '' ), 'rgba' );
		$out .= '</div>';

		$out .= '<div class="row-fluid">';

		$out .= '<div class="span4">';
		$out .= '<label for="' . $value['id'] . '_l1">' . __( 'Start Location %', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . '][l1]" id="' . MISS_SETTINGS . '[' . $value['id'] . '][l1]"" class="' . $toggle . 'miss_select">';
		foreach( $location as $table_field_key => $table_field_value ) {
			$out .= '<option value="' . $table_field_key . '"';
			if ( isset( $value['options']['l1'] ) && $table_field_key == $value['options']['l1'] ) {
				$out .= ' selected';
			}
			$out .= '>' . $table_field_value . '</option>';
		}
		$out .= '</select>';

		$out .= '</div>';

		$out .= '<div class="span4">';
		$out .= '<label for="' . $value['id'] . '_l2">' . __( 'End Location %', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . '][l2]" id="' . $value['id'] . '_l2" class="' . $toggle . 'miss_select">';
		foreach( $location as $table_field_key => $table_field_value ) {
			$out .= '<option value="' . $table_field_key . '"';
			if ( isset( $value['options']['l2'] ) && $table_field_key == $value['options']['l2'] ) {
				$out .= ' selected';
			}
			$out .= '>' . $table_field_value . '</option>';
		}
		$out .= '</select>';

		$out .= '</div>';

		$out .= '<div class="span4">';
		
		$out .= '<label for="' . $value['id'] . '_orientation">' . __( 'Orientation', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . '][orientation]" id="' . $value['id'] . '_orientation" class="' . $toggle . 'miss_select">';
		foreach( $orientation as $table_field_key => $table_field_value ) {
			$out .= '<option value="' . $table_field_key . '"';
			if ( isset( $value['options']['orientation'] ) && $table_field_key == $value['options']['orientation'] ) {
				$out .= ' selected';
			}
			$out .= '>' . $table_field_value . '</option>';
		}
		$out .= '</select>';
		$out .= '</div>';

		$out .= '</div><!-- /.row-fluid -->';

		$out .= $this->option_end( $value );
		$out .= '</div>';
		$out .= '</div><!-- .resize_option_set -->';
		
		return $out;
	}


	/**
	 * Box Shadow
	 */
	function boxshadow( $value ) {
		if ( !isset($value['options']) ) {
			if ( isset($value['default']) ) {
				$value['options'] = $value['default'];
			} else {
				$value['options'] = Array();
			}
		}
		$option = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $value['options'];

		$location = range(0,100);
		$insets = Array(
			'true' => 'Inset',
			'false' => 'Outset',
		);
		$out = '<div class="miss_option_set resize_option_set">';
		$toggle = $value['id'] . '_toggle';
		$out .= '<div class="row-fluid">';
		$out .= $this->option_start( $value );
		$out .= '<div class="span6">';
		$out .= '<label for="' . $value['id'] . '_color">' . __( 'Shadow Colour', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
		$out .= $this->color_box( MISS_SETTINGS . '[' . $value['id'] . '][color]', MISS_SETTINGS . '[' . $value['id'] . '][color]', false, (string) ( isset( $option['color'] ) ? $option['color'] : '' ), 'rgba' );
		$out .= '</div>';
		$out .= '<div class="span6">';
		$out .= '<label for="' . $value['id'] . '_blur">' . __( 'Blur', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';

		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . '][blur]" id="' . MISS_SETTINGS . '[' . $value['id'] . '][blur]"" class="' . $toggle . 'miss_input" value="';
		$out .= ( isset( $value['options']['blur'] ) ) ? $value['options']['blur'] : '5px';
		$out .= '" />';
		
		$out .= '</div>';

		$out .= '<div class="row-fluid">';

		$out .= '<div class="span4">';
		$out .= '<label for="' . $value['id'] . '_v">' . __( 'Vertical Offset', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';

		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . '][v]" id="' . MISS_SETTINGS . '[' . $value['id'] . '][v]"" class="' . $toggle . 'miss_input" value="';
		$out .= ( isset( $value['options']['v'] ) ) ? $value['options']['v'] : '-1px';
		$out .= '" />';

		$out .= '</div>';

		$out .= '<div class="span4">';
		$out .= '<label for="' . $value['id'] . '_h">' . __( 'Horizontal Offset', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';

		$out .= '<input type="text" name="' . MISS_SETTINGS . '[' . $value['id'] . '][h]" id="' . MISS_SETTINGS . '[' . $value['id'] . '][v]"" class="' . $toggle . 'miss_input" value="';
		$out .= ( isset( $value['options']['h'] ) ) ? $value['options']['h'] : '-1px';
		$out .= '" />';

		$out .= '</div>';

		$out .= '<div class="span4">';
		
		$out .= '<label for="' . $value['id'] . '_inset">' . __( 'Inset', MISS_ADMIN_TEXTDOMAIN ) . '</label><br />';
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . '][inset]" id="' . $value['id'] . '_inset" class="' . $toggle . 'miss_select">';
		foreach( $insets as $table_field_key => $table_field_value ) {
			$out .= '<option value="' . $table_field_key . '"';
			if ( isset( $value['options']['inset'] ) && $table_field_key == $value['options']['inset'] ) {
				$out .= ' selected';
			}
			$out .= '>' . $table_field_value . '</option>';
		}
		$out .= '</select>';
		$out .= '</div>';

		$out .= '</div><!-- /.row-fluid -->';

		$out .= $this->option_end( $value );
		$out .= '</div>';
		$out .= '</div><!-- .resize_option_set -->';
		
		return $out;
	}



	function color( $value ) {
		if ( !isset($value['options']) ) {
			if ( isset($value['default']) ) {
				$value['options'] = $value['default'];
			} else {
				$value['options'] = Array();
			}
		}
		$option = ( isset( $this->saved_options[$value['id']] ) ) ? $this->saved_options[$value['id']] : $value['options'];
		$out = '<div class="miss_option_set resize_option_set">';
		$out .= $this->option_start( $value );
		$out .= $this->color_box( MISS_SETTINGS . '[' . $value['id'] . ']', $value['id'], false, 
		( isset( $this->saved_options[$value['id']] ) ? (string) $this->saved_options[$value['id']] : ( isset( $value['default'] ) ? $value['default'] : '' ) ), 'rgba' );
		$out .= $this->option_end( $value );
		$out .= '</div><!-- .resize_option_set -->';
		
		return $out;
	}
	
	/**
	 * Color Picker
	 */
	function color2($value) {
		$out = '<div class="miss_option_set color_option_set">';
		$out .= $this->option_start($value);
		$value['default'][0] = ( isset( $value['default'][0] ) ) ? $value['default'][0] : '';
		$val = ( isset( $this->saved_options[$value['id']] )
		? stripslashes( $this->saved_options[$value['id']] )
		: ( isset( $value['default'] )
		? $value['default'][0]
		: '' ) );
		if ( isset( $value ) && isset( $value['properties'] ) && is_array( $value['properties'] ) ) {
			$width = range(0,72);
			$style = array( 'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
				print_r($value);
			$prop = $value['properties'];
			foreach ( $prop as $el_key => $el ) {
				$property = $value['properties'][$el_key];
				$val = $value['default'][$el_key];
				$el = str_replace( array("\n", "\r", "\t", "\x20"), array('','',''), $el );
				//. '[' . $value['properties'][0] . ']"
				$out .= '<div class="row-fluid">';
				$out .= '<div class="span4">';
				$out .= '<label>' . $el . '</label>';
				$out .= '</div>';
				$out .= '<div class="span7">';
				$property = $value['properties'][$el_key];
				if ( isset( $value['alpha'] ) && $value['alpha'] == true ) {
					$color_format = 'rgba';
				} else {
					$color_format = 'hex';
				}
				if ( $el == 'color' || empty( $el ) ) {
					$out .= color_box( $value['id'], $el, $val, $color_format );
				} else {
					$out .= '<div class="btn-group">';
					$out .= '<input type="text" value="' . $val . '" name="' . $value['id'] . '[' . $el . ']" id="edit-' . $el . '-menu-link-' . $value['id'] . '" />';
					$out .= '</div>';
				}
				$out .= '</div>'; //Close span7
				$out .= '</div>'; //Close row-fluid
			}
		} else {
				$val = ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
				? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
				? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
				: ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) );
				if ( isset( $value['alpha'] ) && $value['alpha'] == true ) {
					$color_format = 'rgba';
				} else {
					$color_format = 'hex';
				}
				if (is_array($val)){
					$val = implode( '', $val );
				}

				$out .= $this->color_box( MISS_SETTINGS . '[' . $value['id'] . ']', false, $val, $color_format );
		}
		$out .= $this->option_end($value);
		$out .= '</div><!-- color_option_set -->';
		return $out;
	}
	
	/**
	 *
	 */
	function border( $value ) {
		$out = '<div class="miss_option_set border_option_set">';
		
		$out .= $this->option_start( $value );
				
		if ( isset( $value ) && is_array( $value['properties'] ) ) {
			$width = range(0,72);
			$style = array( 'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
			$prop = $value['properties'];
			foreach ( $prop as $el_key => $el ) {
				$property = $prop[$el_key];
				$val = $value['default'][$el_key];
				$el = str_replace( array("\n", "\r", "\t", "\x20"), array('','',''), $el );
				//. '[' . $value['properties'][0] . ']"
				$out .= '<div class="row-fluid">';
				$out .= '<div class="span4">';
				$out .= '<label>' . $el . '</label>';
				$out .= '</div>';
				$out .= '<div class="span7">';
				$property = $value['properties'][$el_key];
				if ( $el == 'border-color' || $el == 'border-left-color' || $el == 'border-right-color' || $el == 'border-top-color' || $el == 'border-bottom-color' ) {
					$out .= '<div class="color input-append">';
					$out .= '<input type="text" name="' . $value['id'] . '[' . $el . ']" value="' . $val . '"  id="' . $value['id'] . '_color" class="bootstrap-colorpicker" />';
					$out .= '<span class="add-on"><i style="background-color: ' . $val . ';"></i></span>';
					$out .= '</div>';
				} elseif ( $el == 'border-style' || $el == 'border-left-style' || $el == 'border-right-style' || $el == 'border-top-style' || $el == 'border-bottom-style' ) {
					$out .= '<div class="btn-group">';
					$out .= '<select name="' .$value['id'] . '[' . $el . ']" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($style as $name => $option){
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
					$out .= '</div>';
				} elseif ( $el == 'border-width' || $el == 'border-left-width' || $el == 'border-right-width' || $el == 'border-top-width' || $el == 'border-bottom-width' ) {
					$out .= '<div class="btn-group">';
					$out .= '<select name="' .$value['id'] . '[' . $el . ']" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($width as $name => $option){
						$option = ( $option > 0 ) ?  $option . 'px' : $option;
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
					$out .= '</div>';
				} else {
					$out .= '<div class="btn-group">';
					$out .= '<input type="text" value="' . $val . '" name="' . $value['id'] . '[' . $el . ']" id="edit-' . $el . '-menu-link-' . $value['id'] . '" />';
					$out .= '</div>';
				}
				$out .= '</div>'; //Close span7
				$out .= '</div>'; //Close row-fluid
			}
		}

		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- border_option_set -->';
		
		return $out;
	}
	

	/**
	 * Background
	 */
	function background($value) {
		
		$out = '<div class="miss_option_set background_option_set">';
		
		$out .= $this->option_start($value);
		
		/* Building Properties */
		if ( isset( $value ) && is_array( $value['properties'] ) ) {
			$prop = $value['properties'];
			$repeat = array('repeat', 'repeat-x', 'repeat-y', 'no-repeat');
			$attachment = array('scroll', 'fixed');
			$width = range(0,72);
			$style = array( 'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );

			foreach ( $prop as $el_key => $el ) {
				$val = $value['default']["$el_key"];
				//echo $val;
				$el = str_replace( array("\n", "\r", "\t", "\x20"), array('','',''), $el );
				$out .= '<div class="row-fluid">';
				$out .= '<div class="span4">';
				$out .= '<label>' . $el . '</label>';
				$out .= '</div>';
				$out .= '<div class="span7">';

				if ( $el == 'background-image' ) {
					$val = str_replace('"', '', $val);
					$val = str_replace('\'', '', $val);
					$val = str_replace(')', '', $val);
					
					//$patterns = miss_pattern_presets();
					$patterns = miss_pattern_presets();
					if( !empty( $patterns) ) {
						$out .= '<div class="pattern_images">';
						foreach( $patterns as $image => $class ) {
							$out .= '<a class="single_pattern ' . $class . '" href="#" title="' . THEME_PATTERNS . '/' . $image . '">' . ucfirst( $class ) . '</a>';
						}
						$out .= '</div>';
					}
					$out .= '<div class="btn-group input-append inline" data-toggle="buttons-checkbox">';
					$out .= '<input type="text" name="' . $value['id'] . '[' . $el . ']" value=\'' . $val . '\' data-value="' . $val . '" id="' . $value['id'] . '" class="background_image_url btn-small miss_upload" />';
					$out .= '<input type="button" value="' . esc_attr__( 'Upload' , MISS_ADMIN_TEXTDOMAIN ) . '" class="btn upload_button ' . $value['id'] . '" />';
					$out .= '<input type="button" value="' . esc_attr__( 'Select Preset' , MISS_ADMIN_TEXTDOMAIN ) . '" class="btn preset_pattern ' . $value['id'] . '" />';
					/*
					if( !empty( $patterns) ) {
						$out .= '<div class="pattern_images">';
						foreach( $patterns as $image => $class ) {
							$out .= '<a class="btn upload_button single_pattern ' . $class . '" href="#" title="' . THEME_PATTERNS . '/' . $image . '">' . ucfirst( $class ) . '</a>';
						}
						$out .= '</div>';
					}
					*/
					$out .= '</div>';
				} elseif ( $el == 'background-color' ) {
					if ( substr($val, 0,4) == "rgba" ) {
						$data_color_type = 'rgba';
					} else if ( substr($val, 0,3) == "rgb" ) {
						$data_color_type = 'rgb';
					} else {
						$data_color_type = '';
					}
					$out .= '<div class="color input-append">';
					$out .= '<input type="text" value="' . $val . '" id="' . $value['id'] . '_color" name="' . $value['id'] . '[background-color]" class="bootstrap-colorpicker" data-color-format="'. $data_color_type .'" />';
					$out .= '<span class="add-on"><i style="background-color: ' . $val . ';"></i></span>';
					$out .= '</div>';
				} elseif ( $el == 'color' ) {
					if ( substr($val, 0,4) == "rgba" ) {
						$data_color_type = 'rgba';
					} else if ( substr($val, 0,3) == "rgb" ) {
						$data_color_type = 'rgb';
					} else {
						$data_color_type = '';
					}
					$out .= '<div class="color input-append">';
					$out .= '<input type="text" value="' . $val . '" id="' . $value['id'] . '_color" name="' . $value['id'] . '[color]" class="bootstrap-colorpicker" data-color-format="'. $data_color_type .'" />';
					$out .= '<span class="add-on"><i style="background-color: ' . $val . ';"></i></span>';
					$out .= '</div>';
				} elseif ( $el == 'background-position' ) {
					$out .= '<input type="text" value="' . $val . '" name="' . $value['id'] . '[background-position]" id="edit-' . $el . '-menu-link-' . $value['id']  . '" />';
				} elseif ( $el == 'background-size' ) {
					$out .= '<input type="text" value="' . $val . '" name="' . $value['id'] . '[background-size]" id="edit-' . $el . '-menu-link-' . $value['id']  . '" />';
				} elseif ( $el == 'background-repeat' ) {
					$out .= '<select name="' .$value['id'] . '[background-repeat]" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($repeat as $name => $option){
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
				} elseif ( $el == 'background-attachment' ) {
					$out .= '<select name="' .$value['id'] . '[background-attachment]" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($attachment as $name => $option){
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
				} elseif ( $el == 'border-color' || $el == 'border-left-color' || $el == 'border-right-color' || $el == 'border-top-color' || $el == 'border-bottom-color' ) {
					$out .= '<div class="color input-append">';
					$out .= '<input type="text" name="' . $value['id'] . '[' . $el . ']" value="' . $val . '"  id="' . $value['id'] . '_color" class="bootstrap-colorpicker" />';
					$out .= '<span class="add-on"><i style="background-color: ' . $val . ';"></i></span>';
					$out .= '</div>';
				} elseif ( $el == 'border-style' || $el == 'border-left-style' || $el == 'border-right-style' || $el == 'border-top-style' || $el == 'border-bottom-style' ) {
					$out .= '<div class="btn-group">';
					$out .= '<select name="' .$value['id'] . '[' . $el . ']" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($style as $name => $option){
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
					$out .= '</div>';
				} elseif ( $el == 'border-width' || $el == 'border-left-width' || $el == 'border-right-width' || $el == 'border-top-width' || $el == 'border-bottom-width' ) {
					$out .= '<div class="btn-group">';
					$out .= '<select name="' .$value['id'] . '[' . $el . ']" id="' .$value['id']. '_' .$el_key. '" class="miss_select">';
					foreach($width as $name => $option){
						$option = ( $option > 0 ) ?  $option . 'px' : $option;
						$out .= '<option value="' . $option . '"';
						if ( $val == $option ) {
							$out .= ' selected="selected"';
						}
						$out .= '>' . $option . '</option>';
					}
					$out .= '</select>';
					$out .= '</div>';
				} else {
					$out .= '<input type="text" value="' . $val . '" name="' . $value['id'] . '[' . $el . ']" id="edit-' . $el . '-menu-link-' . $value['id']  . '" />';
				}
				$out .= '</div>';
				$out .= '</div>';
			}
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- typography_option_set -->';
		
		return $out;
	}

function icons($value) {
	$out = '<div class="miss_option_set icons_option_set">';

	$icon =	( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
		? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
		? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
		: ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) );
	$out .= '<div class="miss_option_header">';
	$out .= '<h5>' . __('Search Icon', MISS_ADMIN_TEXTDOMAIN ) . '</h5>';
	$out .= '<p>' . __('Start typing to find required icons.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';
	$out .= '<form class="im-filter-icons" action="#">';
	$out .= '<input autocomplete="off" size="60" placeholder="' . __('Search an icon', MISS_ADMIN_TEXTDOMAIN ) . '..." type="text" class="page-composer-icon-filter" value="" name="icon-filter-by-name" />';
	$out .= '</form>';
	$out .= '</div>';
	$out .= '<div class="miss_option">';
	$out .= '<p>' . __('Select one icon from a list and click on it.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';
	$out .= '<div class="btn-group" style="width:100%;"><a style="text-decoration: none;" href="#" class="btn im-toggle-icons">' . __('Show Icons', MISS_ADMIN_TEXTDOMAIN ) . '</a><a class="btn disabled im-icon-preview"><i class="' . $icon . '"></i></a></div>';
	$out .= '<div class="im-visual-selector im-font-icons-wrapper" style="display: none; max-width: 580px;">';

	$out .= '<div class="icons-list"></div>';

	// $icons = miss_get_all_font_icons();
	//    foreach ( $icons as $key => $option ) {
	//     if($key) {
	//    	    $out .= '<a class="im_icon_selector im_' . $key . '" href="#" title="Class: '.$key.'" rel="'.$key.'"><i class="'.$key.'" ></i><span class="hidden">' . $key .'</span></a>';
	//        } else {
	//            $out .= '<a class="im-no-icon" href="#" rel="">x</a>';
	//        }
	//    }

	$out .= '<input name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' .$value['id']. '" class="icon_field wpb_vc_param_value" type="hidden" value="'.$icon.'" />';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div><!-- icons_option_set -->';
	return $out;
}
	
	/**
	 *
	 */
	function typography($value) {
		$out = '<div class="miss_option_set typography_option_set">';
		
		$out .= $this->option_start($value);
		
		$value['options'] = $this->select_target_options($value['target']);
		
		$color = (isset($this->saved_options[$value['id']])) ? stripslashes($this->saved_options[$value['id']]['color']) : $value['default'][0];
		
		$out .= '<div class="row-fluid">';
			$out .= '<div class="color input-append">';
			$out .= '<div class="span4">';
			$out .= '<label>' . __( 'font-color', MISS_ADMIN_TEXTDOMAIN ) . '</label>';
			$out .= '</div>';
			$out .= '<div class="span7">';
			$out .= '<input type="text" value="' . $color . '" id="' .$value['id']. '_color" name="' .$value['id']. '[color]" class="bootstrap-colorpicker" />';
			$out .= '<span class="add-on"><i style="background-color: ' . $color . ';"></i></span>';
			$out .= '</div>';
			$out .= '</div>';
		$out .= '</div>';
		
		foreach($value['options'] as $key => $val) {
			$out .= '<div class="row-fluid">';
			$out .= '<div class="span4">';
			$out .= '<label>' . $key . '</label>';
			$out .= '</div>';
			$out .= '<div class="span7">';
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="miss_select">';
			foreach($val as $name => $option){
				if ( ( ( $key == 'font-size' ) && ( $option != 'inherit' ) ) || ( ( $key == 'font-size' ) && ( $option != 'default' ) ) ) {
					$option .= 'px';
					$name   .= 'px';
				};
				
				$option = ( $option == 'defaultpx' )  ?  '' : $option;
				$option = ( $option == 'inheritpx' )  ?  'inherit' : $option;

				$option = ( $option == 'default' )  ?  '' : $option;
				$option = ( $option == 'inherit' )  ?  'inherit' : $option;

				if( $option == 'Web' )
					$out .= '<optgroup label="' . $option . '">';

				if( ($option != 'Web') && ($option != 'optgroup') ) {
					if( $key == 'font-family' )
						$out .= '<option value="' . esc_attr( $name ) . '"';
					else
						$out .= '<option value="' . esc_attr( $option ) . '"';
				}
					
				$select = '';
				foreach($value['default'] as $selected){
					if( $key == 'font-family' ) {
						if ( $selected == $name )
							$select = ' selected="selected"';
							
					} else {
						if ( $selected == $option )
							$select = ' selected="selected"';
					}
				}
				
				if( ($option != 'Web') && ($option != 'optgroup') )
					$out .= $select . '>' . esc_attr( $option ) . '</option>';
				
				if($option == 'optgroup')
					$out .= '</optgroup>';
			}
			
			$out .= '</select>';
			$out .= '</div>';
			$out .= '</div>';
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- typography_option_set -->';
		
		return $out;
	}


	/**
	 *
	 */
	function font_family($value) {
		$out = '<div class="miss_option_set font_family_option_set">';
		
		$out .= $this->option_start($value);
		
		$value['options'] = miss_typography_options();
		if ( isset( $value ) && isset( $value['default'] ) && !empty( $value['default'] ) ) {
			$value['default'] = stripslashes( $value['default'] );
		}
		$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . MISS_SETTINGS . '_' . $value['id'] . '" class="miss_select">';
		$typography = miss_typography_options();
		foreach($value['options']['font-family'] as $option => $name) {
			$select = '';
			if ( $value['default'] == $option ) {
				$select = ' selected="selected"';
			}

			/* Dropdowns */
			if( $option == 'Web' || $option == 'Core' || $option == 'Google') {
				$out .= '<optgroup label="' . $name . '">';
			}
			if( ( $option != 'Web') && ( $option != 'optgroup' ) && ( $option != 'Google' ) && ( $option != 'Core' ) ) {
				$out .= '<option value=\'' . $option . '\'';
			}
			
			if( ( $option != 'Web') && ( $option != 'optgroup' ) && ( $option != 'Google' ) && ( $option != 'Core' ) ) {
				$out .= $select . '>' . esc_attr( $name ) . '</option>';
			}
			
			if($option == 'optgroup') {
				$out .= '</optgroup>';
			}
		}
	
		$out .= '</select>';
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- font_family_option_set -->';
		
		return $out;
	}


	/**
	 *
	 */
	function font_size($value) {
		$out = '<div class="miss_option_set font_size_option_set">';
		$out .= $this->option_start($value);
		$value['options'] = $this->select_target_options($value['target']);
			$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . MISS_SETTINGS . '_' . $value['id'] . '" class="miss_select">';
			$typography = miss_typography_options();
			foreach($value['options'] as $name => $option) {
				$out .= '<option value="' . esc_attr( $option ) . '"';
				$select = '';
				$out .= $select . '>' . esc_attr( $option ) . '</option>';
			}
		$out .= '</select>';
		$out .= $this->option_end($value);
		$out .= '</div><!-- font_size_option_set -->';
		return $out;
	}

	/**
	 *
	 */
	function font_weight($value) {
		$out = '<div class="miss_option_set font_weight_option_set">';
		$out .= $this->option_start($value);
		$value['options'] = $this->select_target_options($value['target']);
			$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . MISS_SETTINGS . '_' . $value['id'] . '" class="miss_select">';
			foreach($value['options'] as $name => $option) {
				$out .= '<option value="' . esc_attr( $option ) . '"';
				$select = '';
				if ( $value['default'] == $option ) {
					$select = ' selected="selected"';
				}
							
				$out .= $select . '>' . esc_attr( $option ) . '</option>';
			}
		$out .= '</select>';
		$out .= $this->option_end($value);
		$out .= '</div><!-- font_weight_option_set -->';
		return $out;
	}

	
	/**
	 *
	 */
	function background_repeat($value) {
		$out = '<div class="miss_option_set font_weight_option_set">';
		$out .= $this->option_start($value);
		$value['options'] = $this->select_target_options($value['target']);
			$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . MISS_SETTINGS . '_' . $value['id'] . '" class="miss_select">';
			$options = Array(
				'no-repeat' => __("No repeat", MISS_ADMIN_TEXTDOMAIN),
				'repeat' => __("Repeat", MISS_ADMIN_TEXTDOMAIN),
				'repeat-x' => __("Repeat Horizontaly", MISS_ADMIN_TEXTDOMAIN),
				'repeat-y' => __("Repeat Verticaly", MISS_ADMIN_TEXTDOMAIN),
			);
			foreach( $options as $option => $name ) {
				$out .= '<option value="' . esc_attr( $option ) . '"';
				$select = '';
				if ( $value['default'] == $option ) {
					$select = ' selected="selected"';
				}
							
				$out .= $select . '>' . esc_attr( $name ) . '</option>';
			}
		$out .= '</select>';
		$out .= $this->option_end($value);
		$out .= '</div><!-- font_weight_option_set -->';
		return $out;
	}


	/**
	 *
	 */
	function background_attachment($value) {
		$out = '<div class="miss_option_set font_weight_option_set">';
		$out .= $this->option_start($value);
		$value['options'] = $this->select_target_options($value['target']);
			$out .= '<select name="' . MISS_SETTINGS . '[' . $value['id'] . ']" id="' . MISS_SETTINGS . '_' . $value['id'] . '" class="miss_select">';
			$options = Array(
				'scroll' => __("Scroll", MISS_ADMIN_TEXTDOMAIN),
				'fixed' => __("Fixed", MISS_ADMIN_TEXTDOMAIN),
			);
			foreach( $options as $option => $name ) {
				$out .= '<option value="' . esc_attr( $option ) . '"';
				$select = '';
				if ( $value['default'] == $option ) {
					$select = ' selected="selected"';
				}
							
				$out .= $select . '>' . esc_attr( $name ) . '</option>';
			}
		$out .= '</select>';
		$out .= $this->option_end($value);
		$out .= '</div><!-- font_weight_option_set -->';
		return $out;
	}

	
	/**
	 *
	 */
	function link($value) {
		$out = '<div class="miss_option_set color_option_set">';
		
		$out .= $this->option_start($value);
		
		$val = (isset($this->saved_options[$value['id']])) ? stripslashes($this->saved_options[$value['id']]) : $value['default'][0];
		
		$out .= '<div class="row-fluid">';
		$out .= '<div class="span4">';
		$out .= '<label>color</label>';
		$out .= '</div>';
		$out .= '<div class="span7">';
		$out .= '<div class="color input-append">';
		$out .= '<input type="text" value="' .$val. '" id="' .$value['id']. '" name="' .$value['id']. '[color]" class="bootstrap-colorpicker" />';
		$out .= '<span class="add-on"><i style="background-color: ' . $val . ';"></i></span>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';

		$value['options'] = $this->select_target_options($value['target']);
		
		foreach($value['options'] as $key => $val) {
			$out .= '<div class="row-fluid">';
			$out .= '<div class="span4">';
			$out .= '<label>' . $key . '</label>';
			$out .= '</div>';
			$out .= '<div class="span7">';
			$out .= '<select name="' .$value['id']. '[' .$key. ']" id="' .$value['id']. '_' .$key. '" class="miss_select">';
			foreach($val as $name => $option){
				$out .= '<option value="' . $option . '"';
				
				foreach($value['default'] as $selected){
					if ( $selected == $option ) {
						$out .= ' selected="selected"';
					}
				}
				
				$out .= '>' . $option . '</option>';
			}
			
			$out .= '</select>';
			$out .= '</div>';
			$out .= '</div>';
		}
		
		$out .= $this->option_end($value);
		
		$out .= '</div><!-- color_option_set -->';
		
		return $out;
	}
	
	/**
	 * 
	 */
	function skin_generator( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? ' class="' . $value['toggle'] . '"' : '';
		
		$out = '<div class="' . $toggle_class . 'miss_option_set radio_option_set">';
		
		$out .= $this->option_start( $value );
		
		$checked_key =  $value['default'];
			
		$i = 0;
		foreach( $value['options'] as $key => $option ) {
			$i++;
			$checked = ( $key == $checked_key ) ? ' checked="checked"' : '';
			
			$out .= '<input type="radio" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '_' . $i . '"' . $toggle .' />';
			$out .= '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
		}
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .radio_option_set -->';
		
		return $out;
	}
	
	/**
	 *
	 */
	function skin_select( $value ) {
		$toggle_class = ( !empty( $value['toggle_class'] ) ) ? $value['toggle_class'] . ' ' : '';
		$toggle = ( !empty( $value['toggle'] ) ) ? $value['toggle'] . ' ' : '';
		$out = '<div class="' . $toggle_class . 'miss_option_set skin_select_option_set">';
		$out .= $this->option_start( $value );
		$out .= '<div class="btn-group input-append inline"> ';
		$out .= '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="' . $toggle . 'miss_select">';
		$value['options'] = $this->select_target_options( $value['target'] );
		
		foreach( $value['options'] as $key => $option ) {
			$out .= '<option value="' . $key . '"';
			if( isset( $this->saved_skin[$value['id']] ) ) {
				if( $this->saved_skin[$value['id']] == $key ) {
					$out .= ' selected="selected"';
				}
			}
			
			$out .= '>' . esc_attr( $option ) . '</option>';
		}
		
		$out .= '</select>';
		$out .= '&nbsp;&nbsp;<input type="submit" value="' . esc_attr__( 'Activate Skin' , MISS_ADMIN_TEXTDOMAIN ) . '" id="miss_activate_skin" class="btn btn small" name="miss_activate_skin" />';
		$out .= '<span class="ajax_feedback_activate_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
		$out .= '</div>';
		
		$out .= $this->option_end( $value );
		
		$out .= '</div><!-- .select_option_set -->';
		
		$out .='<div id="ajax_feedback_skin_loader"><img src="' . esc_url( THEME_ADMIN_ASSETS_URI . '/images/skin-loader.gif' ) . '" alt="" /></div>';
		
		return $out;
	}
	
	
	/**
	 *
	 */
	function select_target_options( $type ) {
		$options = array();
		switch( $type ) {
			
			case 'page':
				$entries = get_pages( 'title_li=&orderby=name' );
				foreach( $entries as $key => $entry ) {
					$options[$entry->ID] = $entry->post_title;
				}
				break;
			case 'cat':
				$entries = get_categories( 'orderby=name&hide_empty=0' );
				foreach( $entries as $key => $entry ) {
					$options[$entry->term_id] = $entry->name;
				}
				break;
			case 'portfolio_category':
				$entries = get_terms('portfolio_category','orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				}
				break;
			case 'custom_sidebars':
				$custom_sidebars = ( get_option( MISS_SIDEBARS ) ) ? get_option( MISS_SIDEBARS ) : array();
				foreach( $custom_sidebars as $key => $value ) {
					$options[$value] = $value;
				}
				break;
			case 'style_variations':
				$options = miss_style_option();
				break;

			case 'color_variations':
				$variation = miss_color_variations();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				break;
			case 'icon_variations':
				$variation = miss_icon_variations();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				break;
			case 'icomoon_variations':
				$variation = miss_icomoon_option();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				arsort( $options );
				break;
			case 'css_animation':
				$variation = miss_css_animation();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				arsort( $options );
				break;
			case 'all_icons':
				$variation = miss_icomoon_option();
				$option = Array();
				// List of IcoMoon
				foreach( $variation as $key => $value ) {
					$options[$key] = $value . ' (IcoMoon)';
				}
				$variation = miss_icon_variations();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value . ' (FontAwesome)';
				}
				arsort( $options );
				break;

			case 'fontsocial_variations':
				$variation = miss_sociable_option();
				foreach( $variation as $key => $value ) {
					$options[$key] = $value;
				}
				break;
			case 'link':
				$decoration = array('none', 'overline', 'line-through', 'underline');
				$options = array( 'text-decoration' => $decoration );
				break;
			case 'background':
				$repeat = array('repeat', 'repeat-x', 'repeat-y', 'no-repeat');
				$attachment = array('scroll', 'fixed');
				$position = array( 'left top', 'left center', 'left bottom', 'right top', 'right center', 'right bottom', 'center top', 'center center', 'center bottom' );
				$options = array( 'background-repeat' => $repeat, 'background-attachment' => $attachment, 'background-position' => $position );
				break;
			case 'typography':
				$options = miss_typography_options();
				break;
			case 'font_family':
				$font_family = miss_typography_options();
				$options = $font_family['font-family'];
				break;
			case 'font_size':
				$options = range(0,72);
				break;
			case 'font_weight':
				$options = array( 100, 300, 400, 600, 900 );
				break;
			case 'border':
				$size = range(0,72);
				$style = array( 'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset' );
				$options = array( '1' => $size, '2' => $style );
				break;
			
		}
		
		return $options;
	}
	
}

?>