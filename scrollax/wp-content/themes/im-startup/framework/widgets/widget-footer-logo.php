<?php
class IrishMissW_Footer_Logo_Widget extends WP_Widget { 
  function IrishMissW_Footer_Logo_Widget() {
    $widget_ops = array('description' => __('Display your footer logo. Only if tou have defined custom footer logo in Theme Options.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'footer_logo' );
    $this->WP_Widget( 'footer_logo', sprintf( __('%1$s - Footer Logo', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $footer_logo = miss_get_setting('retina_footer_logo_url');
    if ( empty( $footer_logo ) ) {
      $footer_logo = "http://cdn.irishmiss.com/i/bm/footerlogo.png";
    }
    echo $before_widget;
    echo '<a href="' . home_url() . '" title="' . get_bloginfo('name') . '"><img src="' . $footer_logo . '" alt="' . get_bloginfo('name') . '" class="image-resize w" /></a>';
    echo $after_widget;
  }
  /* Store */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance; 
    $instance['title'] = strip_tags( $new_instance['title'] );

    return $instance;
  }
  /* Settings */
  function form($instance) {
    $default = Array();
    $defaults = array( 'title' => 'Footer Logo Widget', 'footer_logo' => miss_get_setting('retina_footer_logo_url') );
    $instance = wp_parse_args( (array) $instance, $defaults );

    $footer_logo = miss_get_setting('retina_footer_logo_url');
    if ( empty( $footer_logo ) ) {
      $footer_logo = "http://cdn.irishmiss.com/i/bm/footerlogo.png";
    }
    echo '<a href="' . home_url() . '" title="' . get_bloginfo('name') . '"><img src="' . $footer_logo . '" alt="' . get_bloginfo('name') . '" class="image-resize w" style="width: 300px; height: auto;" /></a>';
    echo '<p><a href="' . home_url() . '/wp-admin/themes.php?page=miss-options">Change logo</a> &rarr; Branding &rarr; upload "Custom Footer Logo"</p>';
    }
}
?>