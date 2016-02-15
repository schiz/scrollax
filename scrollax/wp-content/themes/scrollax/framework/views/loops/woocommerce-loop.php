<div class="blog-section <?php echo miss_get_setting('blog_layout'); ?>">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
<!-- Content Area -->
  <div class="loop_module featured-products span12">
    <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="loop_content products">
        <?php  miss_before_entry(); ?>
        <div class="post_excerpt">
          <?php 
            miss_woocommerce_content();
           ?>
          <div class="clearboth"></div>
          <?php //echo  miss_pagenavi(); ?>
          </div><!-- .entry -->
         <div class="clearboth"></div>
      </div><!-- .loop_content.products -->
    </div><!-- #page-## -->
  </div><!-- .loop_module.products -->
<!-- / Content Area -->
</div>
            </div>
        </div>
    </div>
</div>