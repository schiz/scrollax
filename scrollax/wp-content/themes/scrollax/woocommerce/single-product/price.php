<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

#Step 1: Get product varations
$available_variations = $product->get_available_variations();

#Step 2: Get product variation id
$variation_id=$available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.

#Step 3: Create the variable product object
$variable_product1= new WC_Product_Variation( $variation_id );

#Step 4: You have the data. Have fun :)
$regular_price = $variable_product1 ->regular_price;
$sales_price = $variable_product1 ->sale_price;

?>
<div class="offers_container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<div class="price">
        <span class="single_variation"><?php echo get_woocommerce_currency_symbol(); ?> <span itemprop="price"><?php echo $regular_price; ?></span></span>
		<del><?php echo get_woocommerce_currency_symbol(); ?> <?php echo $sales_price; ?></del>
	</div>

	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
</div>