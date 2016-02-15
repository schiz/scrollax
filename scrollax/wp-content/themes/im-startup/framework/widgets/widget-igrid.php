<?php
class IrishMissW_Igrid_Widget extends WP_Widget { 
  function IrishMissW_Igrid_Widget() {
    $widget_ops = array('description' => __('Display custom images grid. Recommended image width is 300px. Empty elements will not shown.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 250, 'height' => 250, 'id_base' => 'igrid' );
    $this->WP_Widget( 'igrid', sprintf( __( '%1$s - Images Grid', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    extract($instance);
    $title = apply_filters('widget_title', $title);

    $grid = array();
    if ( !empty($grid_img1) ) { $grid['1'] = array('img' => $grid_img1, 'href' => $grid1); }
    if ( !empty($grid_img2) ) { $grid['2'] = array('img' => $grid_img2, 'href' => $grid2); }
    if ( !empty($grid_img3) ) { $grid['3'] = array('img' => $grid_img3, 'href' => $grid3); }
    if ( !empty($grid_img4) ) { $grid['4'] = array('img' => $grid_img4, 'href' => $grid4); }
    if ( !empty($grid_img5) ) { $grid['5'] = array('img' => $grid_img5, 'href' => $grid5); }
    if ( !empty($grid_img6) ) { $grid['6'] = array('img' => $grid_img6, 'href' => $grid6); }
    $total = count($grid);
    $style = '';

    echo $before_widget;
    echo '<div class="module"><div class="wrap">';
    echo $before_title . '<div class="header turquoise-tpl ribbon-style ribbon-light-style">' . $title . '</div>' . $after_title;
    echo '<div class="contents"><div class="module-clients module-offset">';

    $columns = 3;

    if ( $total == 1 ) {
	$columns = 1;
    }

    if ( $total == 2 || $total == 4 ) {
	$columns = 2;
    }


    foreach( $grid as $key => $img ) {
	$image = '<img src="' . $img['img'] . '" alt="" style="width: 100%; height: auto;" />';
	if ( !empty($img['href']) ) {
	    $tpl = '<div class="client"><a href="' . $img['href'] . '"' . $style . ' title="">{{image}}</a></div>';
	} else {
	    $tpl = '<a>{{image}}</a>';
	}
	echo str_replace('{{image}}',$image, $tpl);
    }

    echo '</div></div>';
    echo '</div>';
    echo '</div>';
    echo $after_widget;
  }
  /* Store */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance; 
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['grid1'] = strip_tags( $new_instance['grid1'] );
    $instance['grid_img1'] = strip_tags( $new_instance['grid_img1'] );
    $instance['grid2'] = strip_tags( $new_instance['grid2'] );
    $instance['grid_img2'] = strip_tags( $new_instance['grid_img2'] );
    $instance['grid3'] = strip_tags( $new_instance['grid3'] );
    $instance['grid_img3'] = strip_tags( $new_instance['grid_img3'] );
    $instance['grid4'] = strip_tags( $new_instance['grid4'] );
    $instance['grid_img4'] = strip_tags( $new_instance['grid_img4'] );
    $instance['grid5'] = strip_tags( $new_instance['grid5'] );
    $instance['grid_img5'] = strip_tags( $new_instance['grid_img5'] );
    $instance['grid6'] = strip_tags( $new_instance['grid6'] );
    $instance['grid_img6'] = strip_tags( $new_instance['grid_img6'] );

    return $instance;
  }
  /* Settings */
  function form($instance) {
    $default = Array(
      "1" => Array (
        "icon" => "",
        "url" => ""
      ),
      "2" => Array (
        "icon" => "",
        "url" => ""
      ),
      "3" => Array (
      ),
      "4" => Array (
        "icon" => "",
        "url" => ""
      ),
      "5" => Array (
        "icon" => "",
        "url" => ""
      ),
      "6" => Array (
        "icon" => "",
        "url" => ""
      ),
    );
    $defaults = array( 'title' => 'Images Grid',
                       'grid1' => $default[1]['url'],
                       'grid_img1' => $default[1]['icon'],
                       'grid2' => $default[2]['url'],
                       'grid_img2' => $default[2]['icon'],
                       'grid3' => $default[3]['url'],
                       'grid_img3' => $default[3]['icon'],
                       'grid4' => $default[4]['url'],
                       'grid_img4' => $default[4]['icon'],
                       'grid5' => $default[5]['url'],
                       'grid_img5' => $default[5]['icon'],
                       'grid6' => $default[6]['url'],
                       'grid_img6' => $default[6]['icon'] );
                       
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php  print $this->get_field_id( 'title' ); ?>">Widget Title:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'title' ); ?>" name="<?php  print $this->get_field_name( 'title' ); ?>" value="<?php  print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'grid1' ); ?>">Grid 1 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid1' ); ?>" name="<?php  print $this->get_field_name( 'grid1' ); ?>" value="<?php  print $instance['grid1']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img1' ); ?>">Grid 1 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img1' ); ?>" name="<?php  print $this->get_field_name( 'grid_img1' ); ?>" value="<?php  print $instance['grid_img1']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'grid2' ); ?>">Grid 2 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid2' ); ?>" name="<?php  print $this->get_field_name( 'grid2' ); ?>" value="<?php  print $instance['grid2']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img2' ); ?>">Grid 2 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img2' ); ?>" name="<?php  print $this->get_field_name( 'grid_img2' ); ?>" value="<?php  print $instance['grid_img2']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'grid3' ); ?>">Grid 3 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid3' ); ?>" name="<?php  print $this->get_field_name( 'grid3' ); ?>" value="<?php  print $instance['grid3']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img3' ); ?>">Grid 3 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img3' ); ?>" name="<?php  print $this->get_field_name( 'grid_img3' ); ?>" value="<?php  print $instance['grid_img3']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'grid4' ); ?>">Grid 4 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid4' ); ?>" name="<?php  print $this->get_field_name( 'grid4' ); ?>" value="<?php  print $instance['grid4']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img4' ); ?>">Grid 4 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img4' ); ?>" name="<?php  print $this->get_field_name( 'grid_img4' ); ?>" value="<?php  print $instance['grid_img4']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid5' ); ?>">Grid 5 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid5' ); ?>" name="<?php  print $this->get_field_name( 'grid5' ); ?>" value="<?php  print $instance['grid5']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img5' ); ?>">Grid 5 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img5' ); ?>" name="<?php  print $this->get_field_name( 'grid_img5' ); ?>" value="<?php  print $instance['grid_img5']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid6' ); ?>">Grid 6 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid6' ); ?>" name="<?php  print $this->get_field_name( 'grid6' ); ?>" value="<?php  print $instance['grid6']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'grid_img6' ); ?>">Grid 6 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'grid_img6' ); ?>" name="<?php  print $this->get_field_name( 'grid_img6' ); ?>" value="<?php  print $instance['grid_img6']; ?>" />
    </p>
    <?php  }
}
?>