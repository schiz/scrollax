<?php
class IrishMissW_SubPages_Widget extends WP_Widget { 
  function IrishMissW_SubPages_Widget() {
    $widget_ops = array('description' => __('Display page parents.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'SubPages' );
    $this->WP_Widget( 'SubPages', sprintf( __('%1$s - Sub Pages', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    global $post, $page_exclusions;
    $title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
			/*
			 * List subpages even if on a subpage 
			 */
			if( $post->post_parent ) {
				$children = wp_list_pages( 'sort_column=menu_order&exclude=$page_exclusions&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1&link_after=<span></span>' );
			} else {
				$children = wp_list_pages( 'sort_column=menu_order&exclude=$page_exclusions&title_li=&child_of=' . $post->ID . '&echo=0&depth=1&link_after=<span></span>' );
			}
			if ( $children ) :
			//echo '<div class="featured_tabs_container">';
			echo '<div class="featured_tabs_frame">';
			echo '<ul class="featured_tabs">' . $children .'</ul>';
			echo '</div>';
			//</div><!-- .featured_tabs_container -->
			echo '<div class="clearboth"></div>';
			endif;

    //echo '<a href="' . home_url() . '" title="' . get_bloginfo('name') . '"><img src="' . $SubPages . '" alt="' . get_bloginfo('name') . '" class="image-resize w" /></a>';
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
        $defaults = array( 'title' => 'Footer Logo Widget', 'SubPages' => miss_get_setting('retina_SubPages_url') );
        $instance = wp_parse_args( (array) $instance, $defaults );

        $SubPages = miss_get_setting('retina_SubPages_url');
        if ( empty( $SubPages ) ) {
        //  $SubPages = "http://cdn.irishmiss.com/i/bm/footerlogo.png";
        }
    }
}
?>