<?php
/**
 *
 */
class IrishMissW_CurrencyRatesGraph_Widget extends WP_Widget {
	/**
	 *
	 */
    function IrishMissW_CurrencyRatesGraph_Widget() {
		$widget_ops = array('classname' => 'miss_CurrencyRatesGraph_Widget', 'description' => __( 'Display currency rate graph in your widget area.', MISS_ADMIN_TEXTDOMAIN ) );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget( 'currency_rate_graph', sprintf( __( '%1$s - Currency Rate Graph', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }
	/**
	 *
	 */
    function widget($args, $instance) {	
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Currency Rates', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
		$currency_symbol_1 = $instance['currency_symbol_1'];
		$currency_symbol_2 = $instance['currency_symbol_2'];
		$description = $instance['description'];
		?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<?php if (!empty($description)) : ?>
			    <p><?php echo $description; ?></p>
			<?php endif; ?>
			<div class="currency_rates_graph_wrap">
				<img src="https://www.google.com/finance/chart?q=CURRENCY:<?php echo $currency_symbol_1 . $currency_symbol_2 ; ?>&&tkr=1&p=5Y&chst=cob" alt="<?php echo $currency_symbol_1 . "/" . $currency_symbol_2 ; ?>" />
			</div>
		<?php echo $after_widget; ?>
		<?php
    }
	/**
	 *
	 */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['currency_symbol_1'] = strip_tags($new_instance['currency_symbol_1']);
		$instance['currency_symbol_2'] = strip_tags($new_instance['currency_symbol_2']);
		$instance['description'] = strip_tags($new_instance['description']);
		return $instance;
    }
	/**
	 *
	 */
    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		$currency_symbol_1 = isset($instance['currency_symbol_1']) ? $instance['USD'] : 'USD';
		$currency_symbol_2 = isset($instance['currency_symbol_2']) ? $instance['EUR'] : 'EUR';
		$description = isset($instance['description']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('description'); ?>"><?php _e( 'Description:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('currency_symbol_1'); ?>"><?php _e( 'Currency #1 Symbol:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('currency_symbol_1'); ?>" id="<?php echo $this->get_field_id('currency_symbol_1'); ?>" class="widefat">
			<option value="ALL" <?php selected($currency_symbol_1,'ALL');?>>Albania Lek</option>
			<option value="AFN" <?php selected($currency_symbol_1,'AFN');?>>Afghanistan Afghani</option>
			<option value="ARS" <?php selected($currency_symbol_1,'ARS');?>>Argentina Peso</option>
			<option value="AWG" <?php selected($currency_symbol_1,'AWG');?>>Aruba Guilder</option>
			<option value="AUD" <?php selected($currency_symbol_1,'AUD');?>>Australia Dollar</option>
			<option value="AZN" <?php selected($currency_symbol_1,'AZN');?>>Azerbaijan New Manat</option>
			<option value="BSD" <?php selected($currency_symbol_1,'BSD');?>>Bahamas Dollar</option>
			<option value="BBD" <?php selected($currency_symbol_1,'BBD');?>>Barbados Dollar</option>
			<option value="BYR" <?php selected($currency_symbol_1,'BYR');?>>Belarus Ruble</option>
			<option value="BZD" <?php selected($currency_symbol_1,'BZD');?>>Belize Dollar</option>
			<option value="BMD" <?php selected($currency_symbol_1,'BMD');?>>Bermuda Dollar</option>
			<option value="BOB" <?php selected($currency_symbol_1,'BOB');?>>Bolivia Boliviano</option>
			<option value="BAM" <?php selected($currency_symbol_1,'BAM');?>>Bosnia and Herzegovina Convertible Marka</option>
			<option value="BWP" <?php selected($currency_symbol_1,'BWP');?>>Botswana Pula</option>
			<option value="BGN" <?php selected($currency_symbol_1,'BGN');?>>Bulgaria Lev</option>
			<option value="BRL" <?php selected($currency_symbol_1,'BRL');?>>Brazil Real</option>
			<option value="BND" <?php selected($currency_symbol_1,'BND');?>>Brunei Darussalam Dollar</option>
			<option value="KHR" <?php selected($currency_symbol_1,'KHR');?>>Cambodia Riel</option>
			<option value="CAD" <?php selected($currency_symbol_1,'CAD');?>>Canada Dollar</option>
			<option value="KYD" <?php selected($currency_symbol_1,'KYD');?>>Cayman Islands Dollar</option>
			<option value="CLP" <?php selected($currency_symbol_1,'CLP');?>>Chile Peso</option>
			<option value="CNY" <?php selected($currency_symbol_1,'CNY');?>>China Yuan Renminbi</option>
			<option value="COP" <?php selected($currency_symbol_1,'COP');?>>Colombia Peso</option>
			<option value="CRC" <?php selected($currency_symbol_1,'CRC');?>>Costa Rica Colon</option>
			<option value="HRK" <?php selected($currency_symbol_1,'HRK');?>>Croatia Kuna</option>
			<option value="CUP" <?php selected($currency_symbol_1,'CUP');?>>Cuba Peso</option>
			<option value="CZK" <?php selected($currency_symbol_1,'CZK');?>>Czech Republic Koruna</option>
			<option value="DKK" <?php selected($currency_symbol_1,'DKK');?>>Denmark Krone</option>
			<option value="DOP" <?php selected($currency_symbol_1,'DOP');?>>Dominican Republic Peso</option>
			<option value="XCD" <?php selected($currency_symbol_1,'XCD');?>>East Caribbean Dollar</option>
			<option value="EGP" <?php selected($currency_symbol_1,'EGP');?>>Egypt Pound</option>
			<option value="SVC" <?php selected($currency_symbol_1,'SVC');?>>El Salvador Colon</option>
			<option value="EEK" <?php selected($currency_symbol_1,'EEK');?>>Estonia Kroon</option>
			<option value="EUR" <?php selected($currency_symbol_1,'EUR');?>>Euro Member Countries</option>
			<option value="FKP" <?php selected($currency_symbol_1,'FKP');?>>Falkland Islands (Malvinas) Pound</option>
			<option value="FJD" <?php selected($currency_symbol_1,'FJD');?>>Fiji Dollar</option>
			<option value="GHC" <?php selected($currency_symbol_1,'GHC');?>>Ghana Cedis</option>
			<option value="GIP" <?php selected($currency_symbol_1,'GIP');?>>Gibraltar Pound</option>
			<option value="GTQ" <?php selected($currency_symbol_1,'GTQ');?>>Guatemala Quetzal</option>
			<option value="GGP" <?php selected($currency_symbol_1,'GGP');?>>Guernsey Pound</option>
			<option value="GYD" <?php selected($currency_symbol_1,'GYD');?>>Guyana Dollar</option>
			<option value="HNL" <?php selected($currency_symbol_1,'HNL');?>>Honduras Lempira</option>
			<option value="HKD" <?php selected($currency_symbol_1,'HKD');?>>Hong Kong Dollar</option>
			<option value="HUF" <?php selected($currency_symbol_1,'HUF');?>>Hungary Forint</option>
			<option value="ISK" <?php selected($currency_symbol_1,'ISK');?>>Iceland Krona</option>
			<option value="INR" <?php selected($currency_symbol_1,'INR');?>>India Rupee</option>
			<option value="IDR" <?php selected($currency_symbol_1,'IDR');?>>Indonesia Rupiah</option>
			<option value="IRR" <?php selected($currency_symbol_1,'IRR');?>>Iran Rial</option>
			<option value="IMP" <?php selected($currency_symbol_1,'IMP');?>>Isle of Man Pound</option>
			<option value="ILS" <?php selected($currency_symbol_1,'ILS');?>>Israel Shekel</option>
			<option value="JMD" <?php selected($currency_symbol_1,'JMD');?>>Jamaica Dollar</option>
			<option value="JPY" <?php selected($currency_symbol_1,'JPY');?>>Japan Yen</option>
			<option value="JEP" <?php selected($currency_symbol_1,'JEP');?>>Jersey Pound</option>
			<option value="KZT" <?php selected($currency_symbol_1,'KZT');?>>Kazakhstan Tenge</option>
			<option value="KPW" <?php selected($currency_symbol_1,'KPW');?>>Korea (North) Won</option>
			<option value="KRW" <?php selected($currency_symbol_1,'KRW');?>>Korea (South) Won</option>
			<option value="KGS" <?php selected($currency_symbol_1,'KGS');?>>Kyrgyzstan Som</option>
			<option value="LAK" <?php selected($currency_symbol_1,'LAK');?>>Laos Kip</option>
			<option value="LVL" <?php selected($currency_symbol_1,'LVL');?>>Latvia Lat</option>
			<option value="LBP" <?php selected($currency_symbol_1,'LBP');?>>Lebanon Pound</option>
			<option value="LRD" <?php selected($currency_symbol_1,'LRD');?>>Liberia Dollar</option>
			<option value="LTL" <?php selected($currency_symbol_1,'LTL');?>>Lithuania Litas</option>
			<option value="MKD" <?php selected($currency_symbol_1,'MKD');?>>Macedonia Denar</option>
			<option value="MYR" <?php selected($currency_symbol_1,'MYR');?>>Malaysia Ringgit</option>
			<option value="MUR" <?php selected($currency_symbol_1,'MUR');?>>Mauritius Rupee</option>
			<option value="MXN" <?php selected($currency_symbol_1,'MXN');?>>Mexico Peso</option>
			<option value="MNT" <?php selected($currency_symbol_1,'MNT');?>>Mongolia Tughrik</option>
			<option value="MZN" <?php selected($currency_symbol_1,'MZN');?>>Mozambique Metical</option>
			<option value="NAD" <?php selected($currency_symbol_1,'NAD');?>>Namibia Dollar</option>
			<option value="NPR" <?php selected($currency_symbol_1,'NPR');?>>Nepal Rupee</option>
			<option value="ANG" <?php selected($currency_symbol_1,'ANG');?>>Netherlands Antilles Guilder</option>
			<option value="NZD" <?php selected($currency_symbol_1,'NZD');?>>New Zealand Dollar</option>
			<option value="NIO" <?php selected($currency_symbol_1,'NIO');?>>Nicaragua Cordoba</option>
			<option value="NGN" <?php selected($currency_symbol_1,'NGN');?>>Nigeria Naira</option>
			<option value="KPW" <?php selected($currency_symbol_1,'KPW');?>>Korea (North) Won</option>
			<option value="NOK" <?php selected($currency_symbol_1,'NOK');?>>Norway Krone</option>
			<option value="OMR" <?php selected($currency_symbol_1,'OMR');?>>Oman Rial</option>
			<option value="PKR" <?php selected($currency_symbol_1,'PKR');?>>Pakistan Rupee</option>
			<option value="PAB" <?php selected($currency_symbol_1,'PAB');?>>Panama Balboa</option>
			<option value="PYG" <?php selected($currency_symbol_1,'PYG');?>>Paraguay Guarani</option>
			<option value="PEN" <?php selected($currency_symbol_1,'PEN');?>>Peru Nuevo Sol</option>
			<option value="PHP" <?php selected($currency_symbol_1,'PHP');?>>Philippines Peso</option>
			<option value="PLN" <?php selected($currency_symbol_1,'PLN');?>>Poland Zloty</option>
			<option value="QAR" <?php selected($currency_symbol_1,'QAR');?>>Qatar Riyal</option>
			<option value="RON" <?php selected($currency_symbol_1,'RON');?>>Romania New Leu</option>
			<option value="RUB" <?php selected($currency_symbol_1,'RUB');?>>Russia Ruble</option>
			<option value="SHP" <?php selected($currency_symbol_1,'SHP');?>>Saint Helena Pound</option>
			<option value="SAR" <?php selected($currency_symbol_1,'SAR');?>>Saudi Arabia Riyal</option>
			<option value="RSD" <?php selected($currency_symbol_1,'RSD');?>>Serbia Dinar</option>
			<option value="SCR" <?php selected($currency_symbol_1,'SCR');?>>Seychelles Rupee</option>
			<option value="SGD" <?php selected($currency_symbol_1,'SGD');?>>Singapore Dollar</option>
			<option value="SBD" <?php selected($currency_symbol_1,'SBD');?>>Solomon Islands Dollar</option>
			<option value="SOS" <?php selected($currency_symbol_1,'SOS');?>>Somalia Shilling</option>
			<option value="ZAR" <?php selected($currency_symbol_1,'ZAR');?>>South Africa Rand</option>
			<option value="KRW" <?php selected($currency_symbol_1,'KRW');?>>Korea (South) Won</option>
			<option value="LKR" <?php selected($currency_symbol_1,'LKR');?>>Sri Lanka Rupee</option>
			<option value="SEK" <?php selected($currency_symbol_1,'SEK');?>>Sweden Krona</option>
			<option value="CHF" <?php selected($currency_symbol_1,'CHF');?>>Switzerland Franc</option>
			<option value="SRD" <?php selected($currency_symbol_1,'SRD');?>>Suriname Dollar</option>
			<option value="SYP" <?php selected($currency_symbol_1,'SYP');?>>Syria Pound</option>
			<option value="TWD" <?php selected($currency_symbol_1,'TWD');?>>Taiwan New Dollar</option>
			<option value="THB" <?php selected($currency_symbol_1,'THB');?>>Thailand Baht</option>
			<option value="TTD" <?php selected($currency_symbol_1,'TTD');?>>Trinidad and Tobago Dollar</option>
			<option value="TRY" <?php selected($currency_symbol_1,'TRY');?>>Turkey Lira</option>
			<option value="TRL" <?php selected($currency_symbol_1,'TRL');?>>Turkey Lira</option>
			<option value="TVD" <?php selected($currency_symbol_1,'TVD');?>>Tuvalu Dollar</option>
			<option value="UAH" <?php selected($currency_symbol_1,'UAH');?>>Ukraine Hryvna</option>
			<option value="GBP" <?php selected($currency_symbol_1,'GBP');?>>United Kingdom Pound</option>
			<option value="USD" <?php selected($currency_symbol_1,'USD');?>>United States Dollar</option>
			<option value="UYU" <?php selected($currency_symbol_1,'UYU');?>>Uruguay Peso</option>
			<option value="UZS" <?php selected($currency_symbol_1,'UZS');?>>Uzbekistan Som</option>
			<option value="VEF" <?php selected($currency_symbol_1,'VEF');?>>Venezuela Bolivar</option>
			<option value="VND" <?php selected($currency_symbol_1,'VND');?>>Viet Nam Dong</option>
			<option value="YER" <?php selected($currency_symbol_1,'YER');?>>Yemen Rial</option>
			<option value="ZWD" <?php selected($currency_symbol_1,'ZWD');?>>Zimbabwe Dollar</option>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('currency_symbol_2'); ?>"><?php _e( 'Currency #2 Symbol:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
		<select name="<?php echo $this->get_field_name('currency_symbol_2'); ?>" id="<?php echo $this->get_field_id('currency_symbol_2'); ?>" class="widefat">
			<option value="ALL" <?php selected($currency_symbol_2,'ALL');?>>Albania Lek</option>
			<option value="AFN" <?php selected($currency_symbol_2,'AFN');?>>Afghanistan Afghani</option>
			<option value="ARS" <?php selected($currency_symbol_2,'ARS');?>>Argentina Peso</option>
			<option value="AWG" <?php selected($currency_symbol_2,'AWG');?>>Aruba Guilder</option>
			<option value="AUD" <?php selected($currency_symbol_2,'AUD');?>>Australia Dollar</option>
			<option value="AZN" <?php selected($currency_symbol_2,'AZN');?>>Azerbaijan New Manat</option>
			<option value="BSD" <?php selected($currency_symbol_2,'BSD');?>>Bahamas Dollar</option>
			<option value="BBD" <?php selected($currency_symbol_2,'BBD');?>>Barbados Dollar</option>
			<option value="BYR" <?php selected($currency_symbol_2,'BYR');?>>Belarus Ruble</option>
			<option value="BZD" <?php selected($currency_symbol_2,'BZD');?>>Belize Dollar</option>
			<option value="BMD" <?php selected($currency_symbol_2,'BMD');?>>Bermuda Dollar</option>
			<option value="BOB" <?php selected($currency_symbol_2,'BOB');?>>Bolivia Boliviano</option>
			<option value="BAM" <?php selected($currency_symbol_2,'BAM');?>>Bosnia and Herzegovina Convertible Marka</option>
			<option value="BWP" <?php selected($currency_symbol_2,'BWP');?>>Botswana Pula</option>
			<option value="BGN" <?php selected($currency_symbol_2,'BGN');?>>Bulgaria Lev</option>
			<option value="BRL" <?php selected($currency_symbol_2,'BRL');?>>Brazil Real</option>
			<option value="BND" <?php selected($currency_symbol_2,'BND');?>>Brunei Darussalam Dollar</option>
			<option value="KHR" <?php selected($currency_symbol_2,'KHR');?>>Cambodia Riel</option>
			<option value="CAD" <?php selected($currency_symbol_2,'CAD');?>>Canada Dollar</option>
			<option value="KYD" <?php selected($currency_symbol_2,'KYD');?>>Cayman Islands Dollar</option>
			<option value="CLP" <?php selected($currency_symbol_2,'CLP');?>>Chile Peso</option>
			<option value="CNY" <?php selected($currency_symbol_2,'CNY');?>>China Yuan Renminbi</option>
			<option value="COP" <?php selected($currency_symbol_2,'COP');?>>Colombia Peso</option>
			<option value="CRC" <?php selected($currency_symbol_2,'CRC');?>>Costa Rica Colon</option>
			<option value="HRK" <?php selected($currency_symbol_2,'HRK');?>>Croatia Kuna</option>
			<option value="CUP" <?php selected($currency_symbol_2,'CUP');?>>Cuba Peso</option>
			<option value="CZK" <?php selected($currency_symbol_2,'CZK');?>>Czech Republic Koruna</option>
			<option value="DKK" <?php selected($currency_symbol_2,'DKK');?>>Denmark Krone</option>
			<option value="DOP" <?php selected($currency_symbol_2,'DOP');?>>Dominican Republic Peso</option>
			<option value="XCD" <?php selected($currency_symbol_2,'XCD');?>>East Caribbean Dollar</option>
			<option value="EGP" <?php selected($currency_symbol_2,'EGP');?>>Egypt Pound</option>
			<option value="SVC" <?php selected($currency_symbol_2,'SVC');?>>El Salvador Colon</option>
			<option value="EEK" <?php selected($currency_symbol_2,'EEK');?>>Estonia Kroon</option>
			<option value="EUR" <?php selected($currency_symbol_2,'EUR');?>>Euro Member Countries</option>
			<option value="FKP" <?php selected($currency_symbol_2,'FKP');?>>Falkland Islands (Malvinas) Pound</option>
			<option value="FJD" <?php selected($currency_symbol_2,'FJD');?>>Fiji Dollar</option>
			<option value="GHC" <?php selected($currency_symbol_2,'GHC');?>>Ghana Cedis</option>
			<option value="GIP" <?php selected($currency_symbol_2,'GIP');?>>Gibraltar Pound</option>
			<option value="GTQ" <?php selected($currency_symbol_2,'GTQ');?>>Guatemala Quetzal</option>
			<option value="GGP" <?php selected($currency_symbol_2,'GGP');?>>Guernsey Pound</option>
			<option value="GYD" <?php selected($currency_symbol_2,'GYD');?>>Guyana Dollar</option>
			<option value="HNL" <?php selected($currency_symbol_2,'HNL');?>>Honduras Lempira</option>
			<option value="HKD" <?php selected($currency_symbol_2,'HKD');?>>Hong Kong Dollar</option>
			<option value="HUF" <?php selected($currency_symbol_2,'HUF');?>>Hungary Forint</option>
			<option value="ISK" <?php selected($currency_symbol_2,'ISK');?>>Iceland Krona</option>
			<option value="INR" <?php selected($currency_symbol_2,'INR');?>>India Rupee</option>
			<option value="IDR" <?php selected($currency_symbol_2,'IDR');?>>Indonesia Rupiah</option>
			<option value="IRR" <?php selected($currency_symbol_2,'IRR');?>>Iran Rial</option>
			<option value="IMP" <?php selected($currency_symbol_2,'IMP');?>>Isle of Man Pound</option>
			<option value="ILS" <?php selected($currency_symbol_2,'ILS');?>>Israel Shekel</option>
			<option value="JMD" <?php selected($currency_symbol_2,'JMD');?>>Jamaica Dollar</option>
			<option value="JPY" <?php selected($currency_symbol_2,'JPY');?>>Japan Yen</option>
			<option value="JEP" <?php selected($currency_symbol_2,'JEP');?>>Jersey Pound</option>
			<option value="KZT" <?php selected($currency_symbol_2,'KZT');?>>Kazakhstan Tenge</option>
			<option value="KPW" <?php selected($currency_symbol_2,'KPW');?>>Korea (North) Won</option>
			<option value="KRW" <?php selected($currency_symbol_2,'KRW');?>>Korea (South) Won</option>
			<option value="KGS" <?php selected($currency_symbol_2,'KGS');?>>Kyrgyzstan Som</option>
			<option value="LAK" <?php selected($currency_symbol_2,'LAK');?>>Laos Kip</option>
			<option value="LVL" <?php selected($currency_symbol_2,'LVL');?>>Latvia Lat</option>
			<option value="LBP" <?php selected($currency_symbol_2,'LBP');?>>Lebanon Pound</option>
			<option value="LRD" <?php selected($currency_symbol_2,'LRD');?>>Liberia Dollar</option>
			<option value="LTL" <?php selected($currency_symbol_2,'LTL');?>>Lithuania Litas</option>
			<option value="MKD" <?php selected($currency_symbol_2,'MKD');?>>Macedonia Denar</option>
			<option value="MYR" <?php selected($currency_symbol_2,'MYR');?>>Malaysia Ringgit</option>
			<option value="MUR" <?php selected($currency_symbol_2,'MUR');?>>Mauritius Rupee</option>
			<option value="MXN" <?php selected($currency_symbol_2,'MXN');?>>Mexico Peso</option>
			<option value="MNT" <?php selected($currency_symbol_2,'MNT');?>>Mongolia Tughrik</option>
			<option value="MZN" <?php selected($currency_symbol_2,'MZN');?>>Mozambique Metical</option>
			<option value="NAD" <?php selected($currency_symbol_2,'NAD');?>>Namibia Dollar</option>
			<option value="NPR" <?php selected($currency_symbol_2,'NPR');?>>Nepal Rupee</option>
			<option value="ANG" <?php selected($currency_symbol_2,'ANG');?>>Netherlands Antilles Guilder</option>
			<option value="NZD" <?php selected($currency_symbol_2,'NZD');?>>New Zealand Dollar</option>
			<option value="NIO" <?php selected($currency_symbol_2,'NIO');?>>Nicaragua Cordoba</option>
			<option value="NGN" <?php selected($currency_symbol_2,'NGN');?>>Nigeria Naira</option>
			<option value="KPW" <?php selected($currency_symbol_2,'KPW');?>>Korea (North) Won</option>
			<option value="NOK" <?php selected($currency_symbol_2,'NOK');?>>Norway Krone</option>
			<option value="OMR" <?php selected($currency_symbol_2,'OMR');?>>Oman Rial</option>
			<option value="PKR" <?php selected($currency_symbol_2,'PKR');?>>Pakistan Rupee</option>
			<option value="PAB" <?php selected($currency_symbol_2,'PAB');?>>Panama Balboa</option>
			<option value="PYG" <?php selected($currency_symbol_2,'PYG');?>>Paraguay Guarani</option>
			<option value="PEN" <?php selected($currency_symbol_2,'PEN');?>>Peru Nuevo Sol</option>
			<option value="PHP" <?php selected($currency_symbol_2,'PHP');?>>Philippines Peso</option>
			<option value="PLN" <?php selected($currency_symbol_2,'PLN');?>>Poland Zloty</option>
			<option value="QAR" <?php selected($currency_symbol_2,'QAR');?>>Qatar Riyal</option>
			<option value="RON" <?php selected($currency_symbol_2,'RON');?>>Romania New Leu</option>
			<option value="RUB" <?php selected($currency_symbol_2,'RUB');?>>Russia Ruble</option>
			<option value="SHP" <?php selected($currency_symbol_2,'SHP');?>>Saint Helena Pound</option>
			<option value="SAR" <?php selected($currency_symbol_2,'SAR');?>>Saudi Arabia Riyal</option>
			<option value="RSD" <?php selected($currency_symbol_2,'RSD');?>>Serbia Dinar</option>
			<option value="SCR" <?php selected($currency_symbol_2,'SCR');?>>Seychelles Rupee</option>
			<option value="SGD" <?php selected($currency_symbol_2,'SGD');?>>Singapore Dollar</option>
			<option value="SBD" <?php selected($currency_symbol_2,'SBD');?>>Solomon Islands Dollar</option>
			<option value="SOS" <?php selected($currency_symbol_2,'SOS');?>>Somalia Shilling</option>
			<option value="ZAR" <?php selected($currency_symbol_2,'ZAR');?>>South Africa Rand</option>
			<option value="KRW" <?php selected($currency_symbol_2,'KRW');?>>Korea (South) Won</option>
			<option value="LKR" <?php selected($currency_symbol_2,'LKR');?>>Sri Lanka Rupee</option>
			<option value="SEK" <?php selected($currency_symbol_2,'SEK');?>>Sweden Krona</option>
			<option value="CHF" <?php selected($currency_symbol_2,'CHF');?>>Switzerland Franc</option>
			<option value="SRD" <?php selected($currency_symbol_2,'SRD');?>>Suriname Dollar</option>
			<option value="SYP" <?php selected($currency_symbol_2,'SYP');?>>Syria Pound</option>
			<option value="TWD" <?php selected($currency_symbol_2,'TWD');?>>Taiwan New Dollar</option>
			<option value="THB" <?php selected($currency_symbol_2,'THB');?>>Thailand Baht</option>
			<option value="TTD" <?php selected($currency_symbol_2,'TTD');?>>Trinidad and Tobago Dollar</option>
			<option value="TRY" <?php selected($currency_symbol_2,'TRY');?>>Turkey Lira</option>
			<option value="TRL" <?php selected($currency_symbol_2,'TRL');?>>Turkey Lira</option>
			<option value="TVD" <?php selected($currency_symbol_2,'TVD');?>>Tuvalu Dollar</option>
			<option value="UAH" <?php selected($currency_symbol_2,'UAH');?>>Ukraine Hryvna</option>
			<option value="GBP" <?php selected($currency_symbol_2,'GBP');?>>United Kingdom Pound</option>
			<option value="USD" <?php selected($currency_symbol_2,'USD');?>>United States Dollar</option>
			<option value="UYU" <?php selected($currency_symbol_2,'UYU');?>>Uruguay Peso</option>
			<option value="UZS" <?php selected($currency_symbol_2,'UZS');?>>Uzbekistan Som</option>
			<option value="VEF" <?php selected($currency_symbol_2,'VEF');?>>Venezuela Bolivar</option>
			<option value="VND" <?php selected($currency_symbol_2,'VND');?>>Viet Nam Dong</option>
			<option value="YER" <?php selected($currency_symbol_2,'YER');?>>Yemen Rial</option>
			<option value="ZWD" <?php selected($currency_symbol_2,'ZWD');?>>Zimbabwe Dollar</option>
		</select></p>
	<?php
    }
}
?>