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
                <div class="row">

<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
  $setings = (miss_get_setting('disable_meta_options')) ? miss_get_setting('disable_meta_options') : array();
  $without_date = ( in_array('date_meta', $setings) ) ? ' without_date' : '';
  $more_clases = $without_date;
  $filter_args = array( 'width' => 570, 'height' => '', 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );
  $_post_feature_display_type = get_post_meta( get_the_ID(), '_post_feature_display_type', true );
?>
<!-- Content Area -->
<div class="span8">
    <div class="row">
        <div class="span8 full-article">
            <div class="article-body">
                <div class="article-image-container reduced-width">
                <?php if($_post_feature_display_type == 'quote') : ?>
                <div class="text-container">
                    <div class="article-text"><?php echo get_post_meta( get_the_ID(), '_custom_quote', true ); ?></div>
                    <span class="quot">“</span>
                </div>
                <?php elseif($_post_feature_display_type == 'sound_cloud') : ?>
                    <?php echo do_shortcode('[im_soundcloud width="100%" height="166px" comments="true"]' . get_post_meta( get_the_ID(), '_sound_cloud', true ) . '[/im_soundcloud]'); ?>
                <?php elseif($_post_feature_display_type == 'additional_images') : ?>
                    <div class="image-row">
                        <div class="preview-container preview-largest base-preview" style="width: 100%;">
                            <div class="preview-image">
                                <?php echo miss_get_post_image( array('width' => 570, 'height' => 374, 'echo' => false) ); ?>
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
                    <?php echo miss_video(array('url' => $_featured_video, 'width' => 570, 'height' => 300, 'parse' => 1)); ?>
                    <?php else : ?>
                    <?php if(miss_get_post_image( array('width' => 490, 'height' => 267, 'echo' => false) ) != '') : ?>
                    <div class="image-row">
                        <div class="preview-container preview-largest base-preview" style="width: 570px; height: 267px; line-height: 267px;">
                            <div class="preview-image">
                              <?php echo miss_get_post_image( array('width' => 570, 'height' => 267, 'echo' => false) ); ?>
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
                </div>
                <div class="text-container">
                    <div class="article-info">
                        <time><?php the_date('F j, Y') ?></time>
                        <span class="item"><span>Posted</span> <?php the_author(); ?></span>
                        <span class="item"><span>Comments</span> (<?php comments_number('0', '1', '%'); ?>)</span>
                    </div>
                    <div class="article-text"><?php the_content(); ?></div>
                    <?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                    ?>
                    <div class="article-tags">
                        <span>Tags:</span>
                        <?php
                            foreach($posttags as $tag) {
                                echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
                            }
                        ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php miss_post_nav(); ?>
    <?php comments_template(); ?>
    </div>
</div>
  <?php endwhile; ?>
    <div class="span4 right-column">
        <?php get_sidebar(); ?>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>