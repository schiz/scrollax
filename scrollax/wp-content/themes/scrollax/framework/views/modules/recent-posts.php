<?php
/**
 * Spotlight Options
 */
global $post;
$spotlight = Array(
      'enable' => get_post_meta( get_the_ID( ), 'spotlight_enable', true ),
      'caption' => get_post_meta( get_the_ID( ), 'spotlight_caption', true ),
      'readmore' => Array(
        'enable' => get_post_meta( get_the_ID( ), 'spotlight_readmore_enable', true ),
        'label'  => get_post_meta( get_the_ID( ), 'spotlight_readmore_text', true ),
      ),
      'excerpt' => Array(
        'title' => get_post_meta( get_the_ID( ), 'spotlight_trim_title', true ),
        'content'  => get_post_meta( get_the_ID( ), 'spotlight_trim_content', true ),
      ),
      'terms' => get_post_meta( get_the_ID( ), 'spotlight_term', true ),
      //'limit' => get_post_meta( get_the_ID( ), 'spotlight_limit', true ),
      'subblock' => get_post_meta( get_the_ID( ), 'spotlight_subblock', true ),
      'layout' => get_post_meta( get_the_ID( ), 'spotlight_layout', true ),
      'custom' => get_post_meta( get_the_ID( ), 'spotlight_custom_block', true ),
);

  /* 
   * What's On Options
   */
$opt = Array(
  'whatson' => Array(
      'id' => get_the_ID(),
      'enable' => get_post_meta( get_the_ID( ), 'whatson_enable', true ),
      'caption' => get_post_meta( get_the_ID( ), 'whatson_caption', true ),
      'readmore' => Array(
        'enable' => get_post_meta( get_the_ID( ), 'whatson_readmore_enable', true ),
        'label'  => get_post_meta( get_the_ID( ), 'whatson_readmore_text', true ),
      ),
      'excerpt' => Array(
        'title' => get_post_meta( get_the_ID( ), 'whatson_trim_title', true ),
        'content'  => get_post_meta( get_the_ID( ), 'whatson_trim_content', true ),  
      ),
      'categories' => get_post_meta( get_the_ID( ), 'whatson_categories', true ),
      'position' => get_post_meta( get_the_ID( ), 'whatson_position', true ),
      'type' => get_post_meta( get_the_ID( ), 'whatson_content_type', true ),
      'content' => get_post_meta( get_the_ID( ), 'whatson_content', true ),
      'limit' => 1 //get_post_meta( get_the_ID( ), 'whatson_limit', true ),
  ),

  /* 
   * Testimonials Options
   */
  'testimonials' => Array(
      'id' => get_the_ID(),
      'enable' => get_post_meta( get_the_ID( ), 'testimonials_enable', true ),
      'caption' => get_post_meta( get_the_ID( ), 'testimonials_caption', true ),
      'readmore' => Array(
        'enable' => get_post_meta( get_the_ID( ), 'testimonials_readmore_enable', true ),
        'label'  => get_post_meta( get_the_ID( ), 'testimonials_readmore_text', true ),
      ),
      'limit' => get_post_meta( get_the_ID( ), 'testimonials_limit', true ),
      'excerpt' => Array(
        'title' => get_post_meta( get_the_ID( ), 'testimonials_trim_title', true ),
        'content'  => get_post_meta( get_the_ID( ), 'testimonials_trim_content', true ),
      ),
      'categories' => get_post_meta( get_the_ID( ), 'testimonials_categories', true ),
      'position' => get_post_meta( get_the_ID( ), 'testimonials_position', true ),
      'delay' => get_post_meta( get_the_ID( ), 'testimonials_delay', true ),
  )
);
$opt['testimony'] = $opt['testimonials'];

/**
 * Rendering What's On and Spotlight Sections
 */
    if($spotlight['enable'] == true) {
        $opt['custom'] = $spotlight['custom'];
        if ( $spotlight['layout'] == "fullwidth" ) {
          $columns = 4;
        } else {
          $columns = 3;
        }

        echo '<!-- Begin Whats On Posts -->';
        echo '<div class="post-region-block clearfix ' . $spotlight['layout'] . '">';

        if ($spotlight['layout'] == 'left_sidebar') {
          echo '<div class="span3 hide767"><h3>' . $opt['whatson']['caption'] . '</h3></div>';
          echo '<div class="three_fourth last hide767"><h3>' . $spotlight['caption'] . '</h3></div>';
          echo '<div class="clearfix hide767"></div><div class="span3">';
          echo miss_render_subblock($opt, $spotlight['subblock']);
          echo '</div>';
        } else {
          if ( $spotlight['layout'] == 'right_sidebar' ) {
            echo '<div class="span3 hide767"><h3>' . $spotlight['caption'] . '</h3></div>';
            echo '<div class="three_fourth last hide767"><h3>' . $opt['whatson']['caption'] . '</h3></div>';
          } else {
            echo '<div><h3>' . $spotlight['caption'] . '</h3></div>';
          }
        }
        $column_count = 0;
          if (!is_array( $spotlight['terms'] ) ) {  $spotlight['terms'] = array ( $spotlight['terms'] ); }
          $args = array( 'numberposts' => $columns, 'order'=> 'DESC', 'orderby' => 'date', 'category' => implode(",", $spotlight['terms'] ) );
          $query = new WP_Query();
          $query->query($args);
          $count = 1;
          echo '<h3 class="show767">' . $spotlight['caption'] . '</h3>';
          while ($query->have_posts()) {
            $query->the_post();
            $sid = get_the_id();
            $link = get_permalink( $sid );

            $column_count ++;
            $column_class  = 'span3';
            $column_class .= ( $column_count == 4 || $column_count == 3 && $spotlight['layout'] == 'left_sidebar' ) ? ' last' : '';
            echo '<div class="' . $column_class . '">';
              echo '<div class="entry has_preview">';
              if ( has_post_thumbnail()) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
                $thumb = miss_wp_image($thumb[0], 518, 338);
                echo '<div class="post-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="pic"><img src="' . $thumb . '" class="image-resize w" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
              }
              echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
              echo '<div class="date">' . get_the_time('l, M j Y') . '</div>';
              echo '<p>' . miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_spotlight_excerpt', $spotlight['excerpt']['content'] ), apply_filters( 'miss_home_spotlight_excerpt', THEME_ELLIPSIS ) ) . '</p>';
              if ($spotlight["readmore"]["enable"] == true) {
                  $readmore_caption = ($spotlight['readmore']['label']) ? $spotlight['readmore']['label'] : __('Read More', MISS_TEXTDOMAIN);
                  echo '<p class="read_more_block"><a class="post_more_link" href="' . esc_url( $link ) . '">' . $readmore_caption  . '</a></p>';
              }
              echo '</div>';
            echo '</div>';
          }

        if ($spotlight['layout'] == 'right_sidebar') {
          echo '<div class="span3 last">';
          echo miss_render_subblock($opt, $spotlight['subblock']);
          echo '</div>';
        }

        echo '</div>';
        echo '<div class="clearfix"></div>';
    }
?>