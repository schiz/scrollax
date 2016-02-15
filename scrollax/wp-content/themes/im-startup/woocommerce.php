<?php
/**
 * Page Template
 *
 * @package IrishMiss
 * @package StartUp
 */


global $irish_framework_params;
get_header();
//echo '</div>';
echo miss_slider_module();
echo '<!-- Begin: Whitespace --><div class="margin20"></div><!-- End: Whitespace -->';
//echo '<div class="container">';

/**
 * Woocommerce Banners
 */
/*$miss_woocommerce_banners_count = 4 + 1;
$miss_woocommerce_banners = array();

for($i = 1; $i < $miss_woocommerce_banners_count; $i++ ) {

	$_tmp_banner_src = miss_get_setting('store_banner_' . $i) ? miss_get_setting('store_banner_' . $i) : false;
	$_tmp_banner_uri = miss_get_setting('store_banner_' . $i . '_link') ? miss_get_setting('store_banner_' . $i . '_link') : false;

	if ( $_tmp_banner_src ) {
	  $miss_woocommerce_banners[$i] = array(
	    'src' => $_tmp_banner_src,
	    'url' => $_tmp_banner_uri,
	    'html'=> '<a href="' . $_tmp_banner_uri . '"><img src="' . $_tmp_banner_src . '" /></a>'
	  );
	}

	$_tmp_banner_src = '';
	$_tmp_banner_uri = '';

}*/


/**
 * Woocommerce Banners Filter and Output
 */
/*if ( ( function_exists( 'is_woocommerce' ) && is_woocommerce() && function_exists( 'is_shop' ) && is_shop() && miss_get_setting('store_display_banner') == "front" ) || ( function_exists( 'is_woocommerce' ) && is_woocommerce() && miss_get_setting('store_display_banner') == "all" ) ) {
	if ( count( $miss_woocommerce_banners ) > 0 ) {
		echo '<div class="row-fluid">';
		
		//1 banner
		if ( count( $miss_woocommerce_banners ) == 1 ) {
			echo '<div class="span12">' . $miss_woocommerce_banners[1]['html'] . '</div>';
		}

		//2 banners
		if ( count( $miss_woocommerce_banners ) == 2 ) {
			echo '<div class="span6">' . $miss_woocommerce_banners[1]['html'] . '</div>';
			echo '<div class="span6">' . $miss_woocommerce_banners[2]['html'] . '</div>';
		}

		//3 banners
		if ( count( $miss_woocommerce_banners ) == 3 ) {
			echo '<div class="span4">' . $miss_woocommerce_banners[1]['html'] . '</div>';
			echo '<div class="span4">' . $miss_woocommerce_banners[2]['html'] . '</div>';
			echo '<div class="span4">' . $miss_woocommerce_banners[3]['html'] . '</div>';
		}

		//4 banners
		if ( count( $miss_woocommerce_banners ) == 4 ) {
			echo '<div class="span3">' . $miss_woocommerce_banners[1]['html'] . '</div>';
			echo '<div class="span6">' . $miss_woocommerce_banners[2]['html'] . '</div>';
			echo '<div class="span3">';
			echo '<div class="row-fluid woocommerce-footer-spacer">';
			echo '<div class="span12">' . $miss_woocommerce_banners[3]['html'] . '</div>';
			echo '</div>';
			echo '<div class="row-fluid">';
			echo '<div class="span12">' . $miss_woocommerce_banners[4]['html'] . '</div>';
			echo '</div>';
			echo '</div>';
		}

		//echo '</div>';
		//echo '<p>&nbsp;</p>';
	}
}*/


/**
 * Default Layout
 */
if(is_single())
{
    $tpl = 'product';
}
else
{
    $tpl = 'loop';
}
$layout = new miss_page_layout($layout = miss_store_layout(), $location = 'views/loops', $type = 'woocommerce', $template = $tpl );
$layout->miss_render_page_layout();
get_footer();
?>
