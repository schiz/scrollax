<?php
/*
Template Name: Portfolio - Sortable
*/



$out = '';


echo '<div class="loop_module benefits ">';
  
global $irish_framework_params;
  $post_obj = $wp_query->get_queried_object();
  if ( strlen($post_obj->post_content) > 6 ) {
    echo '<div class="page_content">';
      echo $post_obj->post_content;
    echo'</div>';
  }
  
  echo '<div class="row-fluid">';
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (empty($limit)) { $limit = 16; }
        $args = array(
          'post_type' => 'benefits',
          'paged'=> $paged,
        //  'showposts' => $limit,
          'order' => 'desc',
        );
        $loop = new WP_Query();
        $loop->query( $args );

        $loop->in_the_loop = true; 
        if ( $loop->have_posts() ) {
          $column_counter = 1;
          $cycle = 1;
          while ( $loop->have_posts() ) {
            $loop->the_post();

              echo '<div class="loop_content span3 benefits">';
   /*
                miss_before_post( array( 'post_id' => get_the_ID() ) );
  */
                echo '<div class="header">';
                  echo '<i class="'. get_post_meta( get_the_ID( ), '_icon', true ) .'"></i>';
                  echo '<h5>';
                    echo '<a href="' . get_permalink() .'">' . get_the_title() . '</a>';
                  echo '</h5>';
                echo'</div>';
                echo '<p class="post_excerpt">';
                  echo miss_excerpt( get_the_excerpt(), 110, THEME_ELLIPSIS );
                  echo '<div class="clearboth"></div>';
                echo '</p><!-- .post_excerpt -->';
                echo '<div class="clearboth"></div>';
                miss_post_meta_row();
              echo '</div><!-- /loop_content -->';

            if ( $column_counter == 4*$cycle ) {
              echo '</div><!-- /.row-fluid --> <div class="row-fluid">';
            } else {
              echo '';
            }
            if ( $column_counter == 4*$cycle ) {
              $cycle++;
            }
            $column_counter++;
          } //while
        }
  echo '</div><!-- /row-fluid -->';
echo '</div><!-- /loop_module -->';

?>