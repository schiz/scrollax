<div class="blog-section <?php echo miss_get_setting('blog_layout'); ?>">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="bread-container">
                    <div class="bread-wrapper">
                        <div class="blog-title"><?php the_title() ?></div>
                        <?php dimox_breadcrumbs(); ?>
                    </div>
                </div>
                <div class="row"><div class="span12">
<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
?>
<!-- Content Area -->
  <div class="single_module page-type <?php echo get_post_type(); ?>">
    <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="single_content">
        <?php miss_before_entry(); ?>
        <div class="page_content">
          <?php
          if (miss_get_setting('review') == 'enable') {
            echo the_score($post->ID); 
          }
          ?>
          <?php the_content(); ?>
          <div class="clearboth"></div>
          <?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MISS_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>
          <?php edit_post_link( __( 'Edit entry', MISS_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
          </div><!-- .entry -->
         <div class="clearboth"></div>
       <?php miss_after_entry(); ?>
      </div><!-- .single_page_content -->
    </div><!-- #page-## -->
  </div><!-- .single_page_module -->
<!-- / Content Area -->
  <?php endwhile; ?>
</div></div>
            </div>
        </div>
    </div>
</div>