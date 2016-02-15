<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" name="basket_form">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="row">
<div class="span12">
    <!-- Shipping Cart - Start -->
    <div class="row">
        <div class="span12 woocommerce-cart">
          <div class="table-wrap">
            <div class="table">
              <div class="table-row header">
                <div class="table-col name">
                  Product name:
                </div>
                <div class="table-col color">
                  Quantity:
                </div>
                <div class="table-col price">
                  Price:
                </div>
              </div>

              <div class="table-body cart-items">
		      <?php do_action( 'woocommerce_before_cart_contents' ); ?>
              <?php
        		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
        			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
        				$_product = $values['data'];
        				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
                <div class="table-row cart-item">
                  <div class="table-col name">
                    <div class="image">
                        <?php
							$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

							if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
								echo $thumbnail;
							else
								printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
						?>
                    </div>
                    <div class="description">
                        <?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<h3 class="header"><a href="%s">%s</a></h3>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>

                     </div>
                  </div>
                  <div class="table-col color product-quantity">
                    <?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {

									$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
									$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
									$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

									$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
                  </div>
                  <div class="table-col price">
                    <span class="price-val">
                        <?php
							$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

							echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
						?>
                    </span>
                  </div>
                  <div class="table-col control">
                    <?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<div class="button delete-item flat-red-style"><a href="%s" class="remove" title="%s"><i class="img-close"></i></a></div>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
					?>
                  </div>
                </div>
                <?php
				}
			}
            ?>
            <div class="row-fluid shipping">
                <div class="span7 item1">
                    <span class="icon"></span> free shipping on orders over $300
                </div>
                <div class="span3 item2">U.S. Standart Shipping:</div>
                <div class="span2 item3">Free</div>
            </div>
            
            <?php
            
            do_action('woocommerce_proceed_to_checkout');
            $woocommerce->nonce_field('cart');
		}
		do_action( 'woocommerce_cart_contents' );
		?>
              </div>
            </div>
          </div>
          
          <div class="results-wrap">
            <input type="hidden" id="action_cart" name="" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
            <div class="button update-total flat-red-style" onclick="jQuery('#action_cart').attr('name', 'update_cart'); document.basket_form.submit();"><i class="img-update"></i><span>UPDATE TOTAL</span></div>

            <div class="subtotal">
              <div class="title"><span>Subtotal:</span></div>
              <div class="costs"><span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></div>
            </div>
          </div>

          <div class="submit-wrap">
            <a href="./?post_type=product" class="continue-shopping">Continue shopping</a>
            <input type="submit" name="proceed" value="Proceed to Checkout" class="submit ribbon-style ribbon-light-style">
          </div>
        </div>
    </div>
    <!-- Shipping Cart - End -->
</div>

</div>

<?php do_action( 'woocommerce_after_cart_contents' ); ?>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>


<?php do_action( 'woocommerce_after_cart' ); ?>