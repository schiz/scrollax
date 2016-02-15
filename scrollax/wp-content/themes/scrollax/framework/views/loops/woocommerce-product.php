<?php
global $woocommerce;
if ( is_user_logged_in() ) {
    $linkprofile = '<a class="nav-item text small-text" href='.get_permalink( get_option('woocommerce_myaccount_page_id') ).' title="My Account">My Account</a>';
} 
else
{
    $linkprofile = '<a class="nav-item text small-text" href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="My Account">My Account</a>';
}

if (sizeof($woocommerce->cart->cart_contents)>0) {
    $linkcheck = '<a href="'.$woocommerce->cart->get_checkout_url().'" class="nav-item text small-text">Checkout</a>';
} else {
    $linkcheck = '';
}

?><div class="blog-section product-cart-page <?php echo miss_get_setting('blog_layout'); ?>">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="bread-container shop" style="border: 0;">
                    <div class="bread-wrapper">
                        <?php dimox_breadcrumbs(); ?>
                        <div class="blog-title">
                            <nav class="basket-cpanel breaking-alignment">
                                    <a class="basket" href="<?php echo $woocommerce->cart->get_cart_url() ?>">
                                      <i class="marker"></i>
                                    </a>
                    
                                    <div class="text-link-wrapper">
                                      <a class="nav-item text" href="<?php echo $woocommerce->cart->get_cart_url() ?>">Cart</a>
                                      <span class="nav-item text cost">Total: <?php echo $woocommerce->cart->get_cart_total() ?></span>
                    
                                      <div class="break"></div>
                                      <?php echo $linkprofile ?>
                                      <span class="nav-item separator">&nbsp;|&nbsp;</span>
                                      <?php echo $linkcheck ?>
                                    </div>
                                  </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                <!-- Content Area -->
                    <div class="span12">
                        
                        <?php woocommerce_content(); ?>
                    </div><!-- .loop_module.products -->
                <!-- / Content Area -->
                </div>
            </div>
        </div>
    </div>
</div>