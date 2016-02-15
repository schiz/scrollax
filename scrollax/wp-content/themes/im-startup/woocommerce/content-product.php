<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.6
 */

global $product, $woocommerce_loop;
// Ensure visibilty
if ( !$product )
	return;
$animation = ( miss_get_setting('blog_layout_animation') ) ? '  im-animate-element ' . miss_get_setting('blog_layout_animation') : '';
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
$miss_woocommerce_columns = miss_get_setting( 'store_columns' ) ? miss_get_setting( 'store_columns' ) : '3';
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $miss_woocommerce_columns );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['columns_in_row'] ) )
	$woocommerce_loop['columns_in_row'] = 1;
	
// Ensure visibilty
if ( ! $product->is_visible() )
	return;
//print_r($product);
$price = get_post_meta($product->id, '_regular_price', true); 
$price_disc = get_post_meta($product->id, '_sale_price', true); 
//echo $woocommerce_loop;
// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="span<?php echo ( 12 / $woocommerce_loop['columns'] ); ?> <?php echo $animation; ?> product_item content-item <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">
    <header class="header">
        <div class="preview-container preview-small base-preview">
            <div class="preview-image">
                <?php miss_get_post_image( array('width' => 220, 'height' => 220) ); ?>
            </div>
            <div class="preview-info-wrapper">
                <div class="controls">
                    <a href="<?php miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true) ); ?>" rel="prettyPhoto" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                </div>
            </div>
        </div>
        <div class="price">
        <?php if($price_disc): ?>
            <span class="small"><?php echo get_woocommerce_currency_symbol(); ?> <?php echo $price; ?></span>
            <span class="big"><?php echo get_woocommerce_currency_symbol(); ?> <?php echo $price_disc; ?></span>
        <?php else: ?>
            <?php if($price): ?>
            <span class="big"><?php echo get_woocommerce_currency_symbol(); ?> <?php echo $price; ?></span>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </header>
    <article class="article black-color"><p><?php the_title(); ?></p></article>
    <a href="<?php the_permalink(); ?>" class="btn ribbon-style small-ribbon"><?php echo __('Read more', MISS_TEXTDOMAIN) ?></a>
</div>

<?php
$woocommerce_loop['columns_in_row']++;
?>