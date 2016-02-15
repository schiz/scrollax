<?php
class IrishMissW_Ad_Widget extends WP_Widget { 
  function IrishMissW_Ad_Widget() {
    $widget_ops = array('description' => __('Display your Sponsor Links. Recommended image width is 300px. If one of link is empty, then banner will not shown.',MISS_ADMIN_TEXTDOMAIN) );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sponsor_banners' );
    $this->WP_Widget( 'sponsor_banners', sprintf( __( '%1$s - Sponsor Banners', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
  }
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $sponsor1 = $instance['sponsor1'];
    $sponsortext1 = $instance['sponsortext1'];
    $sponsorimg1 = $instance['sponsorimg1'];
    $sponsor2 = $instance['sponsor2'];
    $sponsortext2 = $instance['sponsortext2'];
    $sponsorimg2 = $instance['sponsorimg2'];
    $sponsor3 = $instance['sponsor3'];
    $sponsortext3 = $instance['sponsortext3'];
    $sponsorimg3 = $instance['sponsorimg3'];
    $sponsor4 = $instance['sponsor4'];
    $sponsortext4 = $instance['sponsortext4'];
    $sponsorimg4 = $instance['sponsorimg4'];
    print $before_widget;
    //print $before_title . $title . $after_title;
    /*print '<div class="sponsors wide">';
      if (!empty($sponsorimg1)) { print '<a href="'.$sponsor1.'" target="_blank"><img src="'.$sponsorimg1.'" /></a>';}
      if (!empty($sponsorimg2)) { print '<a href="'.$sponsor2.'" target="_blank"><img src="'.$sponsorimg2.'" /></a>';}
      if (!empty($sponsorimg3)) { print '<a href="'.$sponsor3.'" target="_blank"><img src="'.$sponsorimg3.'" /></a>';}
      if (!empty($sponsorimg4)) { print '<a href="'.$sponsor4.'" target="_blank"><img src="'.$sponsorimg4.'" /></a>';}
    print '</div>';*/
    if (!empty($sponsorimg1)) {
        echo '<div class="module">
                    <div class="wrap">
                      <div class="contents">
                        <div class="wrap">
                          <div class="module-banner banner-blue">';
                          if(!empty($sponsortext1)) {
                            echo '<a href="'.$sponsor1.'"><div class="caption">'.$sponsortext1.'</div></a>';
                          }
        echo              '<a href="'.$sponsor1.'"><img src="'.$sponsorimg1.'" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
    }
    if (!empty($sponsorimg2)) {
        echo '<div class="module">
                    <div class="wrap">
                      <div class="contents">
                        <div class="wrap">
                          <div class="module-banner banner-blue">';
                          if(!empty($sponsortext2)) {
                            echo '<a href="'.$sponsor1.'"><div class="caption">'.$sponsortext2.'</div></a>';
                          }
                            
        echo              '<a href="'.$sponsor2.'"><img src="'.$sponsorimg2.'" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
    }
    if (!empty($sponsorimg3)) {
        
        echo '<div class="module">
                    <div class="wrap">
                      <div class="contents">
                        <div class="wrap">
                          <div class="module-banner banner-blue">';
                          if(!empty($sponsortext3)) {
                            echo '<a href="'.$sponsor1.'"><div class="caption">'.$sponsortext3.'</div></a>';
                          }
                            
        echo              '<a href="'.$sponsor3.'"><img src="'.$sponsorimg3.'" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
    }
    if (!empty($sponsorimg4)) {
        
        echo '<div class="module">
                    <div class="wrap">
                      <div class="contents">
                        <div class="wrap">
                          <div class="module-banner banner-blue">';
                          if(!empty($sponsortext4)) {
                            echo '<a href="'.$sponsor1.'"><div class="caption">'.$sponsortext4.'</div></a>';
                          }
                            
        echo              '<a href="'.$sponsor4.'"><img src="'.$sponsorimg4.'" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
    }
    print $after_widget;
  }
  /* Store */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance; 
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['sponsor1'] = strip_tags( $new_instance['sponsor1'] );
    $instance['sponsortext1'] = strip_tags( $new_instance['sponsortext1'] );
    $instance['sponsorimg1'] = strip_tags( $new_instance['sponsorimg1'] );
    $instance['sponsor2'] = strip_tags( $new_instance['sponsor2'] );
    $instance['sponsortext2'] = strip_tags( $new_instance['sponsortext2'] );
    $instance['sponsorimg2'] = strip_tags( $new_instance['sponsorimg2'] );
    $instance['sponsor3'] = strip_tags( $new_instance['sponsor3'] );
    $instance['sponsortext3'] = strip_tags( $new_instance['sponsortext3'] );
    $instance['sponsorimg3'] = strip_tags( $new_instance['sponsorimg3'] );
    $instance['sponsor4'] = strip_tags( $new_instance['sponsor4'] );
    $instance['sponsortext4'] = strip_tags( $new_instance['sponsortext4'] );
    $instance['sponsorimg4'] = strip_tags( $new_instance['sponsorimg4'] );

    return $instance;
  }
  /* Settings */
  function form($instance) {
    $default = Array(
      "1" => Array (
        "icon" => "http://irishmiss.com/shared/banners/300/ad01.png",
        "text" => "Advert Text",
        "url" => "http://themeforest.net"
      ),
      "2" => Array (
        "icon" => "http://irishmiss.com/shared/banners/300/tf_300x250_v3.gif",
        "text" => "Advert Text",
        "url" => "http://codecanyon.com"
      ),
      "3" => Array (
        "icon" => "http://irishmiss.com/shared/banners/300/ad03.png",
        "text" => "Advert Text",
        "url" => "http://mac.appstorm.net/"
      ),
      "4" => Array (
        "icon" => "http://irishmiss.com/shared/banners/300/ad04.png",
        "text" => "Advert Text",
        "url" => "http://photodune.com/"
      ),
    );
    $defaults = array( 'title' => 'Sponsor Banners Widget', 'sponsor1' => $default[1]['url'], 'sponsortext1' => $default[1]['text'], 'sponsorimg1' => $default[1]['icon'], 'sponsor2' => $default[2]['url'], 'sponsortext2' => $default[2]['text'], 'sponsorimg2' => $default[2]['icon'], 'sponsor3' => $default[3]['url'], 'sponsortext3' => $default[3]['text'], 'sponsorimg3' => $default[3]['icon'], 'sponsor4' => $default[4]['url'], 'sponsortext4' => $default[4]['text'], 'sponsorimg4' => $default[4]['icon'] );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php  print $this->get_field_id( 'title' ); ?>">Widget Title:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'title' ); ?>" name="<?php  print $this->get_field_name( 'title' ); ?>" value="<?php  print $instance['title']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsor1' ); ?>">Sponsor 1 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsor1' ); ?>" name="<?php  print $this->get_field_name( 'sponsor1' ); ?>" value="<?php  print $instance['sponsor1']; ?>" />
    </p>
    
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsortext1' ); ?>">Sponsor 1 Text:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsortext1' ); ?>" name="<?php  print $this->get_field_name( 'sponsortext1' ); ?>" value="<?php  print $instance['sponsortext1']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'sponsorimg1' ); ?>">Sponsor 1 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsorimg1' ); ?>" name="<?php  print $this->get_field_name( 'sponsorimg1' ); ?>" value="<?php  print $instance['sponsorimg1']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsor2' ); ?>">Sponsor 2 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsor2' ); ?>" name="<?php  print $this->get_field_name( 'sponsor2' ); ?>" value="<?php  print $instance['sponsor2']; ?>" />
    </p>
    
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsortext2' ); ?>">Sponsor 2 Text:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsortext2' ); ?>" name="<?php  print $this->get_field_name( 'sponsortext2' ); ?>" value="<?php  print $instance['sponsortext2']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'sponsorimg2' ); ?>">Sponsor 2 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsorimg2' ); ?>" name="<?php  print $this->get_field_name( 'sponsorimg2' ); ?>" value="<?php  print $instance['sponsorimg2']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsor3' ); ?>">Sponsor 3 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsor3' ); ?>" name="<?php  print $this->get_field_name( 'sponsor3' ); ?>" value="<?php  print $instance['sponsor3']; ?>" />
    </p>
    
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsortext3' ); ?>">Sponsor 3 Text:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsortext3' ); ?>" name="<?php  print $this->get_field_name( 'sponsortext3' ); ?>" value="<?php  print $instance['sponsortext3']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'sponsorimg3' ); ?>">Sponsor 3 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsorimg3' ); ?>" name="<?php  print $this->get_field_name( 'sponsorimg3' ); ?>" value="<?php  print $instance['sponsorimg3']; ?>" />
    </p>
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsor4' ); ?>">Sponsor 4 URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsor4' ); ?>" name="<?php  print $this->get_field_name( 'sponsor4' ); ?>" value="<?php  print $instance['sponsor4']; ?>" />
    </p>
    
    <p>
      <label for="<?php  print $this->get_field_id( 'sponsortext4' ); ?>">Sponsor 4 Text:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsortext4' ); ?>" name="<?php  print $this->get_field_name( 'sponsortext4' ); ?>" value="<?php  print $instance['sponsortext4']; ?>" />
    </p>

    <p>
      <label for="<?php  print $this->get_field_id( 'sponsorimg4' ); ?>">Sponsor 4 Image URL:</label>
      <input class="widefat" id="<?php  print $this->get_field_id( 'sponsorimg4' ); ?>" name="<?php  print $this->get_field_name( 'sponsorimg4' ); ?>" value="<?php  print $instance['sponsorimg4']; ?>" />
    </p>
    <?php  }
}
?>