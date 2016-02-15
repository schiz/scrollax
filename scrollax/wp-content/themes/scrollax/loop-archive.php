<?php
/**
 * The loop that displays posts.
 *
 * @package IrishMiss
 * @package businessmaker
 */
global $irish_framework_params;
$more_clases = '';

switch( miss_blog_layout() ) {
  case "blog_layout1":
    $excerpt_length = 500;
    $more_clases .= 'span12';
    $spans_in_row = 1;
   break;
  case "blog_layout2":
    $excerpt_length = 700;
    $more_clases .= 'span12';
    $spans_in_row = 1;
    break;
  case "blog_layout3":
    $excerpt_length = 160;
    $more_clases .= 'span6';
    $spans_in_row = 2;
    break;
  case "blog_layout4":
    $excerpt_length = 80;
    $more_clases .= 'span4';
     $spans_in_row = 3;
   break;
  case "blog_layout5":
    $excerpt_length = 145;
    $more_clases .= 'span3';
    $spans_in_row = 4;
    break;
}

  $setings = ( miss_get_setting('disable_meta_options') ) ? miss_get_setting('disable_meta_options') : array();
  $without_date = ( in_array('date_meta', $setings) ) ? ' without_date' : '';
  $more_clases .= $without_date;
  echo '<div class="loop_module blog ' . miss_blog_layout() . '">';
    echo '<div class="row-fluid">';
//    if ( have_posts() ) {
      $span_walk = 1;
      $row_walk = 1;
      while ( have_posts() ) {
        the_post();
?>
  <div class="<?php echo $more_clases; ?>">
     <!-- Content Area -->
     <div class="loop_content blog">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php miss_before_post( array( 'post_id' => get_the_ID() ) ); ?>
          <div class="post_excerpt">
            <?php
            if (miss_get_setting('review') == 'enable') {
              echo the_score($post->ID);  
            }
            miss_post_content( array('excerpt_length' => $excerpt_length) );
            /*
            if (miss_get_setting('display_full') == 'true') {
              echo the_content();
            } else {
              echo miss_excerpt( get_the_excerpt(), $excerpt_length, THEME_ELLIPSIS );
              miss_full_read_more(true);
            }
            */
            ?>
            <div class="clearboth"></div>
          </div><!-- .post_excerpt -->
          <div class="clearboth"></div>
         <?php miss_post_meta_row(); ?>
        </div><!-- #post-## -->
      </div><!-- .loop_content.blog -->
    <!-- / Content Area -->
  </div><!-- .span# -->
<?php 
          if ( ($spans_in_row * $row_walk) == $span_walk ) {
            $out = '</div><!-- /.row-fluid --> <div class="row-fluid">';
          } else {
            $out = '';
          }

          if ( ($spans_in_row * $row_walk) == $span_walk ) {
            $row_walk++;
          }
          $span_walk++;
          echo $out;
      }//endwhile;
    //}//endif;
    echo '</div><!-- / .row-fluid -->';
  echo '</div><!-- /.loop_module blog ' . $more_clases . '-->';
  miss_after_post();
?>