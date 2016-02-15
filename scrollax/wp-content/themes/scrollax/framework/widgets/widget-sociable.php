<?php
class IrishMissW_Social_Icons_Widget extends WP_Widget { 
  function IrishMissW_Social_Icons_Widget() {
    $widget_ops = array('description' => __('Display social icons from Theme Options &rarr; Sociable.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'social_icons' );
    $this->WP_Widget( 'social_icons', sprintf( __('%1$s - Social Icons', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    extract($args);
    $defaults = array( 'title' => '', 'skin' => 'default', 'description' => 'Website powered by Irish Miss theme');
    $instance = wp_parse_args( (array) $instance, $defaults );

    $title = apply_filters('widget_title', (isset( $instance['title'] ) && !empty($instance['title'] ) ) ? $instance['title'] : '', $instance, $this->id_base);
//    $title .= apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

    $skin = $instance['skin'];
    $description = $instance['description'];

    $sociable = miss_get_setting( 'sociable' );
    if( $sociable['keys'] != '#' ) {
        $sociables = "";
        $sociable_keys = explode( ',', $sociable['keys'] );
        foreach ( $sociable_keys as $key ) {
            if( $key != '#' ) {
              $sociable_link = ( !empty( $sociable[$key]['link'] ) ) ? $sociable[$key]['link'] : '#';
              $sociables .= '<div class="social_icon ' . $skin . '">';
              $sociables .= '<a href="' . esc_url( $sociable_link ) . '"><i class="fs-icon-' . $sociable[$key]['icon'] . '"></i></a>';
              $sociables .= '</div>';
            }
        }
    }
    if ( !empty($description) ) {
      $description = '<p>' . $description . '</p>';
    }
    if ( $title == '' ) {
      $before_title = '';
      $after_title = '';
    }
    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo '<div>';
    echo $sociables;
    echo '<div class="clearboth"></div>';
    echo '</div>';
    echo $description;
    echo $after_widget;
  }
  /* Store */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance; 
    $instance['title'] = strip_tags( $new_instance['title'] );
//    $instance['skin'] = strip_tags( $new_instance['skin'] );
    $instance['description'] = strip_tags( $new_instance['description'] );

    return $instance;
  }
  /* Settings */
  function form($instance) {
    $defaults = array( 'title' => 'Social Networks', 'color' => '#0000FF', 'description' => 'Website powered by Irish Miss theme');
    // $defaults = array( 'title' => 'Footer Logo Widget', 'footer_logo' => miss_get_setting('retina_footer_logo_url') );
    $instance = wp_parse_args( (array) $instance, $defaults );
/*
      $out = '<select id="' . $this->get_field_id( 'skin' ) . '" class="widefat" name="' . $this->get_field_name( 'skin' ) . '">';
      
      $skins = miss_sociable_option();
      foreach ( $skins as $key => $val ) {
        
        $selected = ( $instance['skin'] == $key ) ? ' selected="selected"' : '' ;
        $out .= '<option' . $selected. ' value="' . $key . '">' . $val . '</option>';
      }
      $out .= '</select>';
*/
?>
    <p>
      <label for="<?php  print $this->get_field_id( 'title' ); ?>">Widget Title:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'title' ); ?>" name="<?php  print $this->get_field_name( 'title' ); ?>" value="<?php  print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'title' ); ?>">Custom Text:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'description' ); ?>" name="<?php  print $this->get_field_name( 'description' ); ?>" value="<?php  print $instance['description']; ?>" />
    </p>

<?php
        $sociable = miss_get_setting( 'sociable' );
        $sociables = "";

        if( $sociable['keys'] != '#' ) {
                $sociable_keys = explode( ',', $sociable['keys'] );

                foreach ( $sociable_keys as $key ) {
                        if( $key != '#' ) {

                                if( !empty( $sociable[$key]['custom'] ) ) {
                                        $sociable_icon = $sociable[$key]['custom'];
                                }

                                $sociable_link = ( !empty( $sociable[$key]['link'] ) ) ? $sociable[$key]['link'] : '#';
                                $sociables .= '<div class="social_icon" style="display: inline; padding-right: 4px;">';
                                $sociables .= '<a href="' . esc_url( $sociable_link ) . '"><i class="fs-icon-' . $sociable[$key]['icon'] . '"></i></a>';
                                $sociables .= '</div>';
                        }
                }
        }
        echo $sociables;

    }
}
?>