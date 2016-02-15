<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$alt = 1;
$attributes = $product->get_attributes();

$num_attributes = ceil(count($attributes)/2);

if ( empty( $attributes ) && ( ! $product->enable_dimensions_display() || ( ! $product->has_dimensions() && ! $product->has_weight() ) ) ) return;
?>
<div class="shop_attributes">
<div class="ttl">DETAILS:</div>
<ul>

	<?php if ( $product->enable_dimensions_display() ) : ?>

		<?php if ( $product->has_weight() ) : $alt = $alt * -1; ?>

			<li class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option('woocommerce_weight_unit') ); ?></li>

		<?php endif; ?>

		<?php if ($product->has_dimensions()) : $alt = $alt * -1; ?>

            <li class="product_dimensions"><?php echo $product->get_dimensions(); ?></li>

		<?php endif; ?>

	<?php endif; ?>
    <?php $i = 0; ?>
	<?php foreach ($attributes as $attribute) :

		if ( ! isset( $attribute['is_visible'] ) || ! $attribute['is_visible'] ) continue;
		if ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) continue;

		$alt = $alt * -1;
        
        if($num_attributes == $i)
        {
            echo '</ul><ul>';
        }
		?>

		<li class="<?php if ( $alt == 1 ) echo 'alt'; ?>"><?php
				if ( $attribute['is_taxonomy'] ) {

					$values = woocommerce_get_product_terms( $product->id, $attribute['name'], 'names' );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				} else {

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( '|', $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				}
			?>
		</li>
    <?php $i++; ?>
	<?php endforeach; ?>

</ul>
</div>