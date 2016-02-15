<?php
class IrishMissW_Accordion_Widget extends WP_Widget { 
  function IrishMissW_Accordion_Widget() {
    $widget_ops = array('description' => __('Create toggle boxes. Recommended image width is 300px. Empty elements will not shown.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 250, 'height' => 250, 'id_base' => 'accordion' );
    $this->WP_Widget( 'accordion', sprintf( __( '%1$s - Accordion', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    extract($instance);
    $title = apply_filters('widget_title', $title);

    $accordion = array();
    if ( !empty($accordion_content1) ) { $accordion['1'] = array('content' => $accordion_content1, 'title' => $accordion1); }
    if ( !empty($accordion_content2) ) { $accordion['2'] = array('content' => $accordion_content2, 'title' => $accordion2); }
    if ( !empty($accordion_content3) ) { $accordion['3'] = array('content' => $accordion_content3, 'title' => $accordion3); }
    if ( !empty($accordion_content4) ) { $accordion['4'] = array('content' => $accordion_content4, 'title' => $accordion4); }
    if ( !empty($accordion_content5) ) { $accordion['5'] = array('content' => $accordion_content5, 'title' => $accordion5); }
    if ( !empty($accordion_content6) ) { $accordion['6'] = array('content' => $accordion_content6, 'title' => $accordion6); }

    $total = count($accordion);
    $style = '';

    echo $before_widget;
    echo '<div class="module"><div class="wrap">';
    echo $before_title . '<div class="header turquoise-tpl ribbon-style ribbon-light-style">' . $title . '</div>' . $after_title;
    echo '<div class="contents"><div class="module-advantages module-offset">';

    $columns = 3;

    if ( $total == 1 ) {
	$columns = 1;
    }

    if ( $total == 2 || $total == 4 ) {
	$columns = 2;
    }

    $i = 0;

    foreach( $accordion as $key => $el ) {
      $i++;
      if($i == 1) $class = 'open';
      
      echo '<div class="advantage '.$class.'">
              <a href="#" class="heading">' . $el['title'] . '</a>
              <div class="text"><div class="inner-wrap">' . $el['content'] . '</div></div>
            </div>';
      $class = '';
    }


    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo $after_widget;
  }
  /* Store */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance; 
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['accordion1'] = strip_tags( $new_instance['accordion1'] );
    $instance['accordion_content1'] = strip_tags( $new_instance['accordion_content1'] );
    $instance['accordion2'] = strip_tags( $new_instance['accordion2'] );
    $instance['accordion_content2'] = strip_tags( $new_instance['accordion_content2'] );
    $instance['accordion3'] = strip_tags( $new_instance['accordion3'] );
    $instance['accordion_content3'] = strip_tags( $new_instance['accordion_content3'] );
    $instance['accordion4'] = strip_tags( $new_instance['accordion4'] );
    $instance['accordion_content4'] = strip_tags( $new_instance['accordion_content4'] );
    $instance['accordion5'] = strip_tags( $new_instance['accordion5'] );
    $instance['accordion_content5'] = strip_tags( $new_instance['accordion_content5'] );
    $instance['accordion6'] = strip_tags( $new_instance['accordion6'] );
    $instance['accordion_content6'] = strip_tags( $new_instance['accordion_content6'] );

    return $instance;
  }
  /* Settings */
  function form($instance) {
    $default = Array(
      "1" => Array (
        "title" => "",
        "content" => ""
      ),
      "2" => Array (
        "title" => "",
        "content" => ""
      ),
      "3" => Array (
      ),
      "4" => Array (
        "title" => "",
        "content" => ""
      ),
      "5" => Array (
        "title" => "",
        "content" => ""
      ),
      "6" => Array (
        "title" => "",
        "content" => ""
      ),
    );
    $defaults = array( 'title' => 'Images Grid',
                       'accordion1' => $default[1]['title'],
                       'accordion_content1' => $default[1]['content'],
                       'accordion2' => $default[2]['title'],
                       'accordion_content2' => $default[2]['content'],
                       'accordion3' => $default[3]['title'],
                       'accordion_content3' => $default[3]['content'],
                       'accordion4' => $default[4]['title'],
                       'accordion_content4' => $default[4]['content'],
                       'accordion5' => $default[5]['title'],
                       'accordion_content5' => $default[5]['content'],
                       'accordion6' => $default[6]['title'],
                       'accordion_content6' => $default[6]['content'] );
                       
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php  print $this->get_field_id( 'title' ); ?>">Widget Title:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'title' ); ?>" name="<?php  print $this->get_field_name( 'title' ); ?>" value="<?php  print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'accordion1' ); ?>">Accordion Caption  1:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion1' ); ?>" name="<?php  print $this->get_field_name( 'accordion1' ); ?>" value="<?php  print $instance['accordion1']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content1' ); ?>">Accordion Content  1:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content1' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content1' ); ?>" value="<?php  print $instance['accordion_content1']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'accordion2' ); ?>">Accordion Caption  2:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion2' ); ?>" name="<?php  print $this->get_field_name( 'accordion2' ); ?>" value="<?php  print $instance['accordion2']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content2' ); ?>">Accordion Content  2:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content2' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content2' ); ?>" value="<?php  print $instance['accordion_content2']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'accordion3' ); ?>">Accordion Caption  3:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion3' ); ?>" name="<?php  print $this->get_field_name( 'accordion3' ); ?>" value="<?php  print $instance['accordion3']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content3' ); ?>">Accordion Content  3:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content3' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content3' ); ?>" value="<?php  print $instance['accordion_content3']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'accordion4' ); ?>">Accordion Caption  4:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion4' ); ?>" name="<?php  print $this->get_field_name( 'accordion4' ); ?>" value="<?php  print $instance['accordion4']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content4' ); ?>">Accordion Content  4:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content4' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content4' ); ?>" value="<?php  print $instance['accordion_content4']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion5' ); ?>">Accordion Caption  5:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion5' ); ?>" name="<?php  print $this->get_field_name( 'accordion5' ); ?>" value="<?php  print $instance['accordion5']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content5' ); ?>">Accordion Content  5:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content5' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content5' ); ?>" value="<?php  print $instance['accordion_content5']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion6' ); ?>">Accordion Caption  6:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion6' ); ?>" name="<?php  print $this->get_field_name( 'accordion6' ); ?>" value="<?php  print $instance['accordion6']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'accordion_content6' ); ?>">Accordion Content  6:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'accordion_content6' ); ?>" name="<?php  print $this->get_field_name( 'accordion_content6' ); ?>" value="<?php  print $instance['accordion_content6']; ?>" />
    </p>
    <?php  }
}
?>