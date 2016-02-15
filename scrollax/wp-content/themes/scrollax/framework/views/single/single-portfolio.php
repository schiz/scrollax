<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
  $_page_content = get_the_content();
  $filter_args = array( 'width' => 890, 'height' => 556, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );
  $out = '';
?>
      <!-- Article Section - Start -->
      <section class="article-section inner-pages">
        <div class="container">
          <div class="row">
            <!-- Breadcrumbs - Start -->
            <div class="span12">
            <div class="bread-container">
                <div class="bread-wrapper">
                <div class="blog-title"><?php the_title() ?></div>
                <?php dimox_breadcrumbs(); ?>
                </div>
            </div>
            </div>
            <!-- Breadcrumbs - End -->

            <div class="span12">
              <div class="row">
                <div class="span12">
                    <!-- Full Article - Start -->
                    <div class="row">
                        <div class="span12 full-article">
                            <div class="article-body">
                                <div class="article-image-container full-width">
                                    <div class="image-row">
                                        <div class="preview-container preview-largest base-preview">
                                            <div class="preview-image">
                                              <?php echo miss_get_post_image( $filter_args ); ?>
                                            </div>
                                            <div class="preview-info-wrapper">
                                              <div class="controls">
                                                <a href="<?php echo miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => false) ); ?>" rel="prettyPhoto[<?php echo get_post_type() . '_' . get_the_ID() ?>]" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $images = new miss_gallery_attachments( $limit = 999, $order = 'ASC', $post_id = get_the_ID() );
            if ( count( $images->get_media() ) > 1 ) {
              echo '<div class="image-row second media-images ' . get_post_type() . '">';
              foreach ( $images->get_media() as $image ) {
                $double_resolution = (miss_get_setting('hires') == 'enabled') ? true : false;
                if ( $double_resolution == true ) {
                  $width = 340;
                  $height = 244;
                } else {
                  $width = 209;
                  $height = 209;
                }
                $thumb = miss_wp_image( $image->guid, $width, $height );
                echo '<div class="preview-container preview-small base-preview">
                                            <div class="preview-image">
                                                <img src="' . $thumb . '">
                                            </div>
                                            <div class="preview-info-wrapper">
                                                <div class="controls">
                                                    <a rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']" href="' . $image->guid . '" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                                </div>
                                            </div>
                                        </div>';
                /*echo '<div class="single_post_image has_preview small-single-image"><a href="' . $image->guid . '"><img src="' . $thumb . '" /></a>
                <div class="preview_info_wrap"><a rel="prettyPhoto" href="' . $image->guid . '" title="" class="one_column_blog"></a><a class="controls img single" href="' . $image->guid . '" rel="prettyPhoto[portfolio]"><i class="im-icon-zoom-in"></i></a> <!-- /.controls --></div>
                </div>';*/
              }
              echo '</div>';
            }
                                    ?>
                                </div>

                                <div class="text-container">
                                    <div class="article-text">
                                        <?php the_content(); ?>
                                    </div>
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
                    </div>
                    <!-- Full Article - End -->
                </div>
              </div>
            </div>
          </div>


        </div>
      </section>
      <!-- Article Section - End -->
  <?php miss_after_post(); ?>
<?php endwhile; ?>
