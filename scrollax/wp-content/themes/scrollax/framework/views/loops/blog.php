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
  
  $filter_args = array( 'width' => 490, 'height' => 267, 'img_class' => '', 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => '', 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );

?>
<!-- Blog Section - Start -->
<section class="news-section">
<div class="container">
  <div class="row">
    <!-- Section Header - Start -->
    <header class="section-header span12">
      <h1 class="header">
        <span><?php single_cat_title('', 1); ?></span>
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
        $_post_feature_display_type = get_post_meta( get_the_ID(), '_post_feature_display_type', true );
        switch($_post_feature_display_type) {
            case 'default': $article_class = 'article-tpl';
            break;
            case 'quote': $article_class = 'message-tpl';
            break;
            case 'image_left': $article_class = 'post-tpl';
            break;
            default: $article_class = 'article-tpl';
            break;
        }
?>
    <div class="row short-article <?php echo $article_class.' ' .$animation; ?>">
        <div class="span1">
          <div class="date-post">
            <?php echo mb_substr(get_the_time('F'), 0, 3) ?>
            <span><?php the_time('j') ?></span>
          </div>
        </div>
        <div class="span7">
            <?php if($_post_feature_display_type == 'quote') : ?>
            <div class="article-body">
                <div class="text-container">
                    <div class="article-text"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_post_meta( get_the_ID(), '_custom_quote', true ); ?></a></div>
                        <div class="article-info">
                            <span class="item"><span>Posted</span> <?php the_author(); ?></span>
                        </div>
                        <span class="quot">“</span>
                    </div>
                </div>
            <?php else : ?>
            <div class="article-body">
                <?php if(miss_get_post_image( array('width' => 490, 'height' => 267, 'echo' => false) ) != '' || $_post_feature_display_type == 'sound_cloud' ||
                $_post_feature_display_type == 'image_left' || $_post_feature_display_type == 'additional_images' || get_post_meta( get_the_ID(), '_featured_video', true )) : ?>
                    <div class="article-image-container reduced-width">
                <?php endif; ?>
                <?php if($_post_feature_display_type == 'sound_cloud') : ?>
                    <?php echo do_shortcode('[im_soundcloud width="100%" height="80px" comments="true"]' . get_post_meta( get_the_ID(), '_sound_cloud', true ) . '[/im_soundcloud]'); ?>
                <?php elseif($_post_feature_display_type == 'image_left') : ?>
                        <?php echo miss_get_post_image( array('width' => 199, 'height' => 228, 'echo' => false) ); ?>
                <?php elseif($_post_feature_display_type == 'additional_images') : ?>
                    <div class="image-row">
                        <div class="preview-container preview-largest base-preview">
                            <div class="preview-image">
                                <?php echo miss_get_post_image( array('width' => 490, 'height' => 374, 'echo' => false) ); ?>
                            </div>
                        <div class="preview-info-wrapper">
                            <div class="controls">
                                <a href="<?php echo miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => false) ); ?>" class="control zoom" rel="prettyPhoto[<?php  echo get_post_type() . '_' . get_the_ID() ?>]"><i class="marker im-icon-zoom-in"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <?php
                            $images = new miss_gallery_attachments( $limit = 999, $order = 'ASC', $post_id = get_the_ID() );
                            //print_r($images->get_media());
                            //if ( count( $images->get_media() ) > 2 ) {
                              echo '<div class="image-row second">';
                              $this_post_media_counter = 1;
                              foreach ( $images->get_media() as $image ) {
                                if ( $this_post_media_counter > 0 ) {
                    			  $thumb = miss_get_post_image( $args = array( 'src' => $image->guid, 'img_class' => 'hover_fade_js image-resize w', 'width' => 109, 'height' => 109, 'echo' => false, 'preview_info_wrap' => false, ) );
                                  /*echo '<div class="single_post_image has_preview small-single-image"><a href="' . $image->guid . '">' . $thumb . '</a>
                                  <div class="preview_info_wrap"><a rel="prettyPhoto" href="' . $image->guid . '" title="" class="one_column_blog"></a><a class="controls img single" href="' . $image->guid . '" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="im-icon-zoom-in"></i></a> <!-- /.controls --></div>
                                  </div>';*/
                                  echo '<div class="preview-container preview-small base-preview">
                                            <div class="preview-image">
                                                '.$thumb.'
                                            </div>
                                            <div class="preview-info-wrapper">
                                                <div class="controls">
                                                    <a href="' . $image->guid . '" class="control zoom" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="marker im-icon-zoom-in"></i></a>
                                                </div>
                                            </div>
                                        </div>';
                    
                                }
                                $this_post_media_counter++;
                              }
                              echo '</div>';
                            //}
                    ?>
                <?php else : ?>
                    <?php
                        $_featured_video = get_post_meta( get_the_ID(), '_featured_video', true );
                        if($_featured_video) :
                    ?>
                    <?php echo miss_video(array('url' => $_featured_video, 'width' => 490, 'height' => 270, 'parse' => 1)); ?>
                    <?php else : ?>
                    <?php if(miss_get_post_image( array('width' => 490, 'height' => 267, 'echo' => false) ) != '') : ?>
                    <div class="image-row">
                        <div class="preview-container preview-largest base-preview" style="height: 267px; line-height: 267px;">
                            <div class="preview-image">
                              <?php echo miss_get_post_image( array('width' => 490, 'height' => 267, 'echo' => false) ); ?>
                            </div>
                            <div class="preview-info-wrapper">
                              <div class="controls">
                                <a href="<?php miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => true) ); ?>" class="control zoom" rel="prettyPhoto"><i class="marker im-icon-zoom-in"></i></a>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(miss_get_post_image( array('width' => 490, 'height' => 267, 'echo' => false) ) != '' || $_post_feature_display_type == 'sound_cloud' ||
                $_post_feature_display_type == 'image_left' || $_post_feature_display_type == 'additional_images' || get_post_meta( get_the_ID(), '_featured_video', true )) : ?>
                    </div>
                <?php endif; ?>
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
            <?php endif; ?>
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
