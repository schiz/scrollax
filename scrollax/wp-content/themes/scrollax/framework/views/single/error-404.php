<!-- Content Area -->
<main>
<div class="blog-section">
<div class="container">
  <div class="error404_page_module">
      <div class="row-fluid">
        <?php miss_before_entry(); ?>
        <div class="span6">
          <?php miss_404(); ?>
	      <div class="e404-caption" style="font-size: 2000%; line-height:100%; font-weight: 600;font-family: 'PT Sans';">
			<?php _e('404', MISS_TEXTDOMAIN); ?>
	      </div>
		  <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('error404_1') ); ?>
       <?php miss_after_entry(); ?>
      </div><!-- .span6 -->
      <div class="span6 sidebar">
	      <h2><?php _e('Try to Find', MISS_TEXTDOMAIN); ?></h2>
	      <?php get_search_form(); ?>
		  <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('error404_2') ); ?>
		  <div class="row-fluid">
			  <div class="span6">
				  <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('error404_3') ); ?>
			  </div>
			  <div class="span6">
				  <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('error404_4') ); ?>
			  </div>
		  </div>
      </div>
    </div><!-- #page-## -->
  </div><!-- .single_page_module -->
</div>
</div>
</main>
<!-- / Content Area -->
