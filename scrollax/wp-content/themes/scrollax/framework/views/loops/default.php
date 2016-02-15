<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
?>
<!-- Content Area -->
  <div class="loop_module default">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="loop_content default">
        <?php miss_before_post( array( 'post_id' => get_the_ID() ) ); ?>
        <?php miss_before_entry(); ?>
        <div class="post_excerpt">
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
      </div><!-- .loop_content.default -->
    </div><!-- #post-## -->
  </div><!-- .loop_module.default -->
  <?php comments_template( '', true ); ?>
<!-- / Content Area -->
<?php endwhile; ?>