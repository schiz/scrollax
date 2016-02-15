<?php
/*
Plugin Name: Social Counter Widget
Plugin URI: http://www.webdev3000.com/
Description: This widget will display your RSS subscribers, Twitter followers and Facebook fans in one nice looking box.
Author: Csaba Kissi
Modified By: Helga Konly
Version: 1.0.6
Author URI: http://www.webdev3000.com/
Fork Author URI: http://irishmiss.com/
*/

require "scw_stats.class.php";
class IrishMissW_SC_widget extends WP_Widget {
    /** constructor -- name this the same as the class above */
    function IrishMissW_SC_widget() {
        parent::WP_Widget(false, $name = 'Social Counter Widget');
        $this->cacheFileName = WP_CONTENT_DIR."/sc_cache.txt";
    }
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title = ( isset( $instance['title'] ) ) ? apply_filters('widget_title', $instance['title']) : '';
        $facebook_id	= ( isset( $instance['facebook_id'] ) ) ? $instance['facebook_id'] : '';
        $twitter_id	= ( isset( $instance['twitter_id'] ) ) ? $instance['twitter_id'] : '';
        $delicious_id = ( isset( $instance['delicious_id'] ) ) ? $instance['delicious_id'] : '';
        $feedburner_id = ( isset( $instance['feedburner_id'] ) ) ? $instance['feedburner_id'] : '';
        $pinterest_id = ( isset ( $instance['pinterest_id'] ) ) ? $instance['pinterest_id'] : '';

        // $twitter_link = esc_attr($instance['twitter_link']);
        // $facebook_link = esc_attr($instance['facebook_link']);
        // $feedburner_link = esc_attr($instance['feedburner_link']);

        $cacheFileName = $this->cacheFileName;
        $resources = get_option( MISS_SCW_CACHE );
        $cache_lifetime = get_option( MISS_SCW_TIME );
        //if($resources && time() - $cache_lifetime < 8*60*60)
        $scwNow = false;
        if(file_exists($cacheFileName) && time() - filemtime($cacheFileName) < 8*60*60)
        {
          $stats = unserialize(file_get_contents($cacheFileName));
          $scwNow = true;
        //    $stats = unserialize($resources);
        }
        if(!isset ( $stats ) ) {
            //                if( $scwNow == false )
            // If no cache was found, fetch the subscriber stats and create a new cache:
            $stats = new SubscriberStats(array(
                'facebookFanPageURL'	=> $facebook_id,
                'feedBurnerURL'		=> $feedburner_id,
                'pinterestURL'   => $pinterest_id,
                'deliciousId'   => $delicious_id,
                'twitterName'		=> $twitter_id
            ));
            file_put_contents($cacheFileName,serialize($stats));
            /*
            if ( !get_option(MISS_SCW_CACHE) ) {
              add_option( MISS_SCW_CACHE, serialize($stats) );
            } else {
              update_option( MISS_SCW_CACHE, serialize($stats) );
            }
            if (!get_option(MISS_SCW_TIME) ) {
              add_option( MISS_SCW_TIME, time() );
            } else {
              update_option( MISS_SCW_TIME, time() );
            }
            */

        /*
        if ( !get_option(MISS_SCW_CACHE) && !get_option(MISS_SCW_TIME) ) {
              add_option( MISS_SCW_CACHE, serialize($stats) );
              add_option( MISS_SCW_TIME, time() );
            } else {
              update_option( MISS_SCW_CACHE, serialize($stats) );
              update_option( MISS_SCW_TIME, time() );
            }*/
        }
        //	You can access the individual stats like this:
        //	$stats->twitter;
        //	$stats->facebook;
        //	$stats->rss;
        //	Output the markup for the stats:
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                        <?php $stats->generate(); ?>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
        if($new_instance != $old_instance) unlink($this->cacheFileName);
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['twitter_id'] = strip_tags($new_instance['twitter_id']);

        $instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
        $instance['delicious_id'] = strip_tags($new_instance['delicious_id']);
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
        $instance['pinterest_id'] = strip_tags($new_instance['pinterest_id']);
        return $instance;
    }


    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {
        if (!isset($instance)) {
          $instance['title'] = '';
          $instance['twitter_id'] = 'britishmiss';
          $instance['facebook_id'] = 'envato';
          $instance['delicious_id'] = 'www.envato.com';
          $instance['feedburner_id'] = 'psdtuts';
          $instance['pinterest_id'] = 'http://pinterest.com';

        }
        $title = ( isset( $instance['title'] ) ) ? esc_attr($instance['title']) : '';
        $twitter_id    = ( isset( $instance['twitter_id']  ) ) ? esc_attr($instance['twitter_id']) : '';
        $facebook_id   = ( isset( $instance['facebook_id'] ) ) ? esc_attr($instance['facebook_id']) : '';
        $delicious_id   = ( isset( $instance['delicious_id'] ) ) ? esc_attr($instance['delicious_id']) : '';
        $feedburner_id = ( isset( $instance['feedburner_id'] ) ) ? esc_attr($instance['feedburner_id']) : '';
        $pinterest_id  = ( isset( $instance['pinterest_id'] ) ) ? esc_attr($instance['pinterest_id']) : '';

        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />
          <em>Example: britishmiss</em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook URL:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo $facebook_id; ?>" />
          <em>Example: http://www.facebook.com/pages/IrishMiss</em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('delicious_id'); ?>"><?php _e('delicious URL:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('delicious_id'); ?>" name="<?php echo $this->get_field_name('delicious_id'); ?>" type="text" value="<?php echo $delicious_id; ?>" />
          <em>Example: www.envato.com</em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('pinterest_id'); ?>"><?php _e('Pinterest URL:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('pinterest_id'); ?>" name="<?php echo $this->get_field_name('pinterest_id'); ?>" type="text" value="<?php echo $pinterest_id; ?>" />
          <em>Example: http://www.envato.com</em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('feedburner_id'); ?>" style="color: #ddd"><?php _e('Feedburner URL:', MISS_ADMIN_TEXTDOMAIN); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" style="color:#444" />
          <em><span style="color: #aaa; font-weight: 300;">Displaying only link. Feedburner API has been deprecated by developer. https://developers.google.com/feedburner/</span><br />Example: http://feeds.feedburner.com/psdtuts</em>
        </p>
         <?php
    }


} // end class example_widget

function sc_stylesheet() {
    $myStyleUrl = plugins_url('css/social-counter.css', __FILE__); // Respects SSL, Style.css is relative to the current file
    $myStyleFile = WP_PLUGIN_DIR . '/social-counter-widget/css/social-counter.css';
    if ( file_exists($myStyleFile) ) {
        wp_register_style('myStyleSheets', $myStyleUrl);
        wp_enqueue_style( 'myStyleSheets');
    }
}
add_action('widgets_init', create_function('', 'return register_widget("SC_widget");'));
add_action('wp_print_styles', 'sc_stylesheet');
?>