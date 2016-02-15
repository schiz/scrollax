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

?>
<!-- Content Area -->
<div class="span8">
    <div class="row">
        <div class="span8 full-article">
                            <div class="article-body">
                                <div class="article-image-container">
                                    <?php echo miss_get_post_image( $filter_args ); ?>
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