vova
<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
?>
<!-- Content Area -->
  <div class="pricetable_module">
    <div id="pricetable-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="pricetable_content">
        <?php miss_before_post( array( 'post_id' => get_the_ID() ) ); ?>
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
      </div><!-- .default_post_content -->
    </div><!-- #post-## -->
  </div><!-- .default_post_module -->
  <?php comments_template( '', true ); ?>
<!-- / Content Area -->
<?php endwhile; ?>