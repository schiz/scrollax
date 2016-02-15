<?php
  /**
   * Recent Articles Options
   */
  global $post;
  $articles = Array(
      'enable'     => get_post_meta( get_the_ID( ), 'articles_enable', true ),
      'caption'    => get_post_meta( get_the_ID( ), 'articles_caption', true ),
      'readmore'   => Array(
        'enable'   => get_post_meta( get_the_ID( ), 'articles_readmore_enable', true ),
        'label'    => get_post_meta( get_the_ID( ), 'articles_readmore_text', true ),
      ),
      'excerpt'    => Array(
        'title'    => get_post_meta( get_the_ID( ), 'articles_trim_title', true ),
        'content'  => get_post_meta( get_the_ID( ), 'articles_trim_content', true ),
      ),
      'categories' => get_post_meta( get_the_ID( ), 'articles_categories', true ),
      //'limit'      => get_post_meta( get_the_ID( ), 'articles_limit', true ),
      'terms'      => get_post_meta( get_the_ID( ), 'articles_term', true ),
      'subblock'   => get_post_meta( get_the_ID( ), 'articles_subblock', true ),
      'layout'     => get_post_meta( get_the_ID( ), 'articles_layout', true ),
      'custom'     => get_post_meta( get_the_ID( ), 'articles_custom_block', true ),
);
if (!is_array( $articles['terms'] ) ) {  $articles['terms'] = array ( $articles['terms'] ); }

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
/*
 * Rendering Articles Sections
 */
if($articles['enable'] == true) {
        if ( $articles['layout'] == "fullwidth" ) {
          $columns = 4;
        } else {
          $columns = 3;
        }
        $opt['custom'] = $articles['custom'];
        echo '<!-- Begin Recent Articles -->';
        echo '<div id="recent-articles-x" class="post-region-block ' . $articles['layout'] . '">';
        if ($articles['layout'] == 'left_sidebar') {
          echo '<div class="span3">';
          echo miss_render_subblock($opt, $articles['subblock'], 'left');
          echo '</div>';
        }
        echo '<h3>' . $articles['caption'] . '</h3>';
          $args = array( 'numberposts' => $columns, 'order'=> 'DESC', 'orderby' => 'date', 'category' => implode(",", $articles['terms'] ) );

        $query = new WP_Query();
        $query->query($args);
        $column_count = 0;
        while ( $query->have_posts() ) {
          $query->the_post();

          //$postslist = get_posts( $args );
            $column_count ++;
            $column_class  = 'span3';
            $column_class .= ( $column_count == 4 || $column_count == 3 && $articles['layout'] == 'left_sidebar' ) ? ' last' : '';
            $sid = get_the_id();
            $link = get_permalink( $sid );
            echo '<div class="' . $column_class . '">';
              echo '<div class="entry has_preview">';
              if ( has_post_thumbnail()) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
                $thumb = miss_wp_image($thumb[0], 518, 338);
                echo '<div class="post-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="pic"><img src="' . $thumb . '" class="image-resize w" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
              }
              echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
              echo '<div class="date">' . get_the_time('l, M j Y') . '</div>';
              echo '<p>' .miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_articles_excerpt', $articles['excerpt']['content'] ), apply_filters( 'miss_home_articles_excerpt', THEME_ELLIPSIS ) ) . '</p>';
              if ($articles["readmore"]["enable"] == true) {
                $readmore_caption = ($articles['readmore']['label']) ? $articles['readmore']['label'] : __('Read More', MISS_TEXTDOMAIN);
                echo '<p class="read_more_block"><a class="post_more_link" href="' . esc_url( $link ) . '">' . $readmore_caption  . '</a></p>';
                //echo miss_read_more( $title = $articles['readmore']['label'], $link = get_permalink() );
              }
              echo '</div>';
            echo '</div>';
          }
        if ($articles['layout'] == 'right_sidebar') {
          echo '<div class="span3 last">';
          echo miss_render_subblock($opt, $articles['subblock'], 'right');
          echo '</div>';
        }

        echo '</div>';
        echo '<div class="clearfix"></div>';
}
?>