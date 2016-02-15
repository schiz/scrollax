<?php
  /**
   * Our Services Option
   */
  global $post;
  $services = Array(
      'enable'      => get_post_meta( get_the_ID( ), 'services_enable', true ),
      'style'       => get_post_meta( get_the_ID( ), 'services_style', true ),
      'readmore'    => Array(
        'enable'    => get_post_meta( get_the_ID( ), 'services_readmore_enable', true ),
        'label'     => get_post_meta( get_the_ID( ), 'services_readmore_text', true ),
      ),
      'excerpt'     => Array(
        'title'     => get_post_meta( get_the_ID( ), 'services_trim_title', true ),
        'content'   => get_post_meta( get_the_ID( ), 'services_trim_content', true ),
      ),
      'limit'       => get_post_meta( get_the_ID( ), 'services_limit', true ),
      'width'       => get_post_meta( get_the_ID( ), 'services_icon_width', true ),
      'height'      => get_post_meta( get_the_ID( ), 'services_icon_height', true ),
      'padding'     => get_post_meta( get_the_ID( ), 'services_icon_padding', true ),
      'style'       => get_post_meta( get_the_ID( ), 'services_icon_style', true ),
  );
  /*
   * Rendering Services Section
   */

    if($services['enable'] == true) {
        $out = "";
        $out .= '<div id="services">';
        $out .= '<div class="whatson-container">';
          $args = array( 'numberposts' => $services['limit'], 'order'=> 'DESC', 'orderby' => 'date', 'post_type' => 'service' );
          $style = "";
          $service_count = 0;
          $query = new WP_Query();
          $query->query($args);
          while ($query->have_posts()) {
            $query->the_post();
            $service_count++;
            $sid = get_the_id();
            $link = get_permalink( $sid );
            $out .= '<div class="entry service align-center" style="width: {{width}}%;"><div class="inner">';
            $style .= '.service' . get_the_id() . ' { background-image: url(' . get_post_meta( get_the_ID( ), '_service_default', true ) . '); width: ' . $services['width'] . 'px; height: ' . $services['height'] . 'px; padding: ' . $services['padding'] . 'px;}';
            $style .= '.service' . get_the_id() . ':hover { background-image: url(' . get_post_meta( get_the_ID( ), '_service_active', true ) . ');}';
            $styleInline = 'background-image: url(' . get_post_meta( get_the_ID( ), '_service_default', true ) . '); width: ' . $services['width'] . 'px; height: ' . $services['height'] . 'px; padding: ' . $services['padding'] . 'px;';
            $out .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            $out .= '<a href="' . get_permalink() . '"><div class="service-icon ' . $services['style'] . ' service' . get_the_id() . '" data-style="' . $styleInline . '"><div class="height: ' . $services['height'] . 'px; width: ' . $services['width'] . 'px;" data-src="' . get_post_meta( get_the_ID( ), '_service_default', true ) . '"></div></div></a>';
            $out .= '<p>' .miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_services_excerpt', $services['excerpt']['content'] ), apply_filters( 'miss_home_services_excerpt', THEME_ELLIPSIS ) ) . '</p>';
            if ($services["readmore"]["enable"] == true) {
            //  $out .= '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( $link ) . '">'. $spotlight['readmore']['label'] . '</a></span>';
                  $readmore_caption = ($services['readmore']['label']) ? $services['readmore']['label'] : __('Read More', MISS_TEXTDOMAIN);
                  $out .= '<p class="read_more_block"><a class="post_more_link" href="' . esc_url( $link ) . '">' . $readmore_caption  . '</a></p>';
             // $out .= miss_read_more( $services['readmore']['label'], $link );
            }
            $out .= '</div></div>';
          }
          $service_width = 100 / $service_count;
          $out = str_replace('{{width}}', $service_width, $out);
          //$out .= $out;

        $out .= '</div>';
        $out .= '</div>';
        $out .= '<div class="clearfix"></div>';
        $style = '<style>' . $style . '</style>';
        echo $style;
        echo $out;
    }
