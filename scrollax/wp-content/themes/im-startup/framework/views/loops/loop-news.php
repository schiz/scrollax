<?php
$more_clases = '';
miss_query_posts();
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
  $animation = ( miss_get_setting('blog_layout_animation') ) ? '  im-animate-element ' . miss_get_setting('blog_layout_animation') : '';
  $setings = (miss_get_setting('disable_meta_options')) ? miss_get_setting('disable_meta_options') : array();
  $without_date = ( in_array('date_meta', $setings) ) ? ' without_date' : '';
  $more_clases .= $without_date;
  
  $filter_args = array( 'width' => 200, 'height' => 228, 'img_class' => '', 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => '', 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );

?>
<!-- Blog Section - Start -->
<section class="news-section">
<div class="container">
  <div class="row">
    <!-- Section Header - Start -->
    <header class="section-header span12">
      <h1 class="header">
        <span><?php post_type_archive_title('', true); ?></span>
      </h1>
    </header>
    <!-- Section Header - End -->

    <div class="span12">
      <div class="row">
        <!-- Blog Items - Start -->
        <div class="span8 article-items">

<?php
    if ( have_posts() ) {
      $span_walk = 1;
      $row_walk = 1;
      while ( have_posts() ) {
        the_post();
?>

    <div class="row short-article post-tpl <?php echo $animation; ?>">
        <div class="span1">
            <div class="date-post">
                <?php echo mb_substr(get_the_time('F'), 0, 3) ?>
                <span><?php the_time('j') ?></span>
            </div>
        </div>
        <div class="span7">
          <div class="article-body">
                <div class="article-image-container">
                    <?php echo miss_get_post_image( $filter_args ); ?>
                </div>
                <div class="text-container">
                    <div class="article-name"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo miss_post_title( $filter_args ); ?></a></div>
                    <div class="article-info">
                        <span class="item"><span>Posted</span> <?php the_author(); ?></span>
                        <span class="item"><span>Comments</span> (<?php comments_number('0', '1', '%'); ?>)</span>
                    </div>
                    <div class="article-text"><?php echo miss_excerpt( get_the_excerpt(), 2000, THEME_ELLIPSIS ); ?></div>
                    <?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                    ?>
                    <div class="article-tags">
                        <span>Tags:</span>
                        <?php
                            foreach($posttags as $tag) {
                                echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>,';
                            }
                        ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php 

          echo $out;
      }//endwhile;
    }//endif;
    miss_after_post(); 
    ?>
        </div>
        <div class="span4 right-column">
            <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>


</div>
</section>
    <?php
  //
?>
