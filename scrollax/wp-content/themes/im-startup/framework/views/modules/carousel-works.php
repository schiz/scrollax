<?php
/**
 * Works
 */
global $post;
echo get_the_ID();

$works = Array(
    'enable'   => get_post_meta( get_the_ID( ),     'carousel_portfolio_enable', true ),
    'caption'  => get_post_meta( get_the_ID( ),     'carousel_portfolio_caption', true ),
    'delay'    => get_post_meta( get_the_ID( ),     'carousel_portfolio_delay', true ),
    'autoplay' => get_post_meta( get_the_ID( ),     'carousel_portfolio_autoplay', true ),
    'more'     => get_post_meta( get_the_ID( ),     'portfolio_more', true ),
    'url'      => get_post_meta( get_the_ID( ),     'portfolio_url', true ),
);
if( $works['enable'] == true ) :
?>
  <!-- Begin Latest Works -->
  <div id="latest-work" class="clearfix">
    <h3 class="display-inline-block"><?php echo $works['caption'] ?></h3>
    <div class="wp-carousel-controls">
      <li class="wp-carousel-readmore"><a href="<?php echo $works['url']; ?>"><?php echo $works['more'] ?></a></li>
      <li class="wp-carousel-prev">&lt;</li>
      <li class="wp-carousel-next">&gt;</li>
    </div>
    <div class="wp-carousel" data-delay="<?php echo $works['delay'] ?>" data-autoplay="<?php echo $works['autoplay'][0] ?>">
          <ul>
          <?php  
            $query = new WP_Query();
                    $query->query('post_type=portfolio&posts_per_page=6');
                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                    $site= get_post_custom_values('project_Link');
                    $shortDesc = get_post_custom_values('project_Desc');
                    $project_image1 = get_post_custom_values('project_image1');
          ?>
          <li>
            <div class="entry has_preview">
              <?php
                if ( has_post_thumbnail()) {
                  $work_preview = true;
                  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
                  $thumb = miss_wp_image($thumb[0], 518, 338);
                  $image = miss_image_signature( $thumb );
                  echo miss_render_link_container( $image['link'], miss_render_image_container( $image['img'] ) );
              ?>


              <div class="work-description">
                <?php
                  $categories = strip_tags( get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', '') );
                ?>
                <h4><a href="<?php  the_permalink() ?>"><?php the_title(); ?></a><span><?php echo (!empty($categories)) ? $categories : _e('Uncategorized', MISS_TEXTDOMAIN); ?></span></h4>
                <span><?php 
                  if ( get_post_meta( get_the_ID(), 'app_description', true ) ) {
                  } else if (get_post_meta( get_the_ID( ), 'app_pagetagline', true )) {
                  } else {
                  }
                  ?></span>
              </div>
    
            <?php  } else { ?>
              <div class="work-description text-only">
                <h4><a href="<?php  the_permalink() ?>"><?php  the_title(); ?></a></h4>
                <p>
                <?php 
                  if ( get_post_meta( get_the_ID(), 'app_description', true ) ) {
	                  echo miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_spotlight_excerpt', get_the_content() ), apply_filters( 'miss_home_spotlight_excerpt', THEME_ELLIPSIS ) );
                  } else if (get_post_meta( get_the_ID( ), 'app_pagetagline', true )) {
	                  echo get_post_meta( get_the_ID( ), 'app_pagetagline', true );
                  } else {
	                  echo miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_spotlight_excerpt', get_the_content() ), apply_filters( 'miss_home_spotlight_excerpt', THEME_ELLIPSIS ) );
                  }
                  ?>
                </p>
              </div>
            <?php  } ?>
            </div>
          </li>
          <?php endwhile; endif; ?>
          </ul>
        </div>
    </div>
<?php endif; ?>