<?php
/**
 *
 */

class IrishMissW_Twitter_Widget extends WP_Widget {
    
    /**
     *
     */
    function IrishMissW_Twitter_Widget() {
        $widget_ops = array( 'classname' => 'miss_twitter_widget', 'description' => __( 'Pulls in your most recent tweet from Twitter', MISS_ADMIN_TEXTDOMAIN ) );
        $control_ops = array( 'width' => 250, 'height' => 200 );
        $this->WP_Widget( 'irishmiss_twitter', sprintf( __( '%1$s - Twitter', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
    }
    /**
     *
     */
    function widget($args, $instance) {
        global $shortname;
        
        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets', MISS_TEXTDOMAIN) : $instance['title'], $instance, $this->id_base);
        $tagline = apply_filters('widget_tagline', empty($instance['tagline']) ? __('Recent Tweets', MISS_TEXTDOMAIN) : $instance['tagline'], $instance, $this->id_base);
        $id = $instance['id'];
        
        if ( !$number = (int) $instance['number'] ) {
            $number = 5;
        } else if ( $number < 1 ) {
            $number = 1;
        } else if ( $number > 40 ) {
            $number = 40;
        }
        
        $username = isset($instance['id']) ? trim( $instance['id'] ) : miss_get_setting( 'twitter_id' );
        $type = 'widget';

        $miss_get_user_timeline = new miss_timeline_store(
          $oauth_access_token = ( !empty($instance['oauth_access_token'] ) ) ? $instance['oauth_access_token'] : miss_get_setting( 'oauth_access_token' ),
          $oauth_access_token_secret = ( !empty( $instance['oauth_access_token_secret'] ) ) ? $instance['oauth_access_token_secret'] : miss_get_setting( 'oauth_access_token_secret' ),
          $consumer_key = ( !empty( $instance['consumer_key'] ) ) ? $instance['consumer_key'] : miss_get_setting( 'consumer_key' ),
          $consumer_secret = ( !empty( $instance['consumer_secret'] ) ) ? $instance['consumer_secret'] : miss_get_setting( 'consumer_secret' ),
          $screen_name = $username,
          $count = $number
        );

        $results = $miss_get_user_timeline->returnTweet();

        ?>
            <?php echo $before_widget; ?>
                <?php echo $before_title . $title . $after_title . '<h6>' . $tagline . '</h6>';
                ?><ul><?php
                    if ( isset( $results ) && is_array( $results ) && !empty( $results ) ) {
                      foreach ( $results as $key => $tweet ) {
                        if ( $key == "errors" ) {
                            echo '';
/*
                            echo '<li>';
                            echo $tweet[0]['message'];
                            echo '</li>';
*/
                        } else {
                            echo '<li>';
                            echo '<a class="target_blank" target="_BLANK" href="http://twitter.com/1/status/' . $tweet['id_str'] . '" title="' . sprintf( esc_attr__( '%1$s&nbsp;ago', MISS_TEXTDOMAIN ), miss_relative_time(strtotime( $tweet['created_at'] ) ) ) . '">' .
                            '<i class="im-icon-twitter pull-left"></i>' .
                            miss_filter_tweet( $tweet['text'] ) . '</a>';
                            echo '</li>';
                        }
                      }
                    } else {
                        echo '<li>' . __('Tweets not found.', MISS_TEXTDOMAIN ) . '</li>';
                    }
                ?></ul><?php
                echo $after_widget;
    }

    /**
     *
     */
    function update($new_instance, $old_instance) {    
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['tagline'] = strip_tags($new_instance['tagline']);
        $instance['id'] = strip_tags($new_instance['id']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['oauth_access_token'] = strip_tags($new_instance['oauth_access_token']);
        $instance['oauth_access_token_secret'] = strip_tags($new_instance['oauth_access_token_secret']);
        $instance['consumer_key'] = strip_tags($new_instance['consumer_key']);
        $instance['consumer_secret'] = strip_tags($new_instance['consumer_secret']);
        return $instance;
    }

    /**
     *
     */
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $tagline = isset($instance['tagline']) ? esc_attr($instance['tagline']) : '';
        $id = isset($instance['id']) ? esc_attr($instance['id']) : '';
        $oauth_access_token = isset($instance['oauth_access_token']) ? esc_attr($instance['oauth_access_token']) : '';
        $oauth_access_token_secret = isset($instance['oauth_access_token_secret']) ? esc_attr($instance['oauth_access_token_secret']) : '';
        $consumer_key = isset($instance['consumer_key']) ? esc_attr($instance['consumer_key']) : '';
        $consumer_secret = isset($instance['consumer_secret']) ? esc_attr($instance['consumer_secret']) : '';
        $number = isset($instance['number']) ? esc_attr($instance['number']) : '5';
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('tagline'); ?>"><?php _e( 'Tagline:', MISS_ADMIN_TEXTDOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('tagline'); ?>" name="<?php echo $this->get_field_name('tagline'); ?>" type="text" value="<?php echo $tagline; ?>" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>">
                <?php _e( 'Twitter username:', MISS_ADMIN_TEXTDOMAIN ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
            <?php _e( "Please enter twitter username.", MISS_ADMIN_TEXTDOMAIN ); ?>
        </p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( "Enter the number of tweets you'd like to display:", MISS_ADMIN_TEXTDOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo $number; ?>" /></p>

        <h3><?php _e( 'Twitter Authentication', MISS_ADMIN_TEXTDOMAIN ); ?></h3>
        <div class="block" id="oauth-tool">
            <?php _e('Before using the OAuth tool, please double check you have registered at least one <a href="https://dev.twitter.com/apps" target="_BLANK">Twitter Application</a>.', MISS_ADMIN_TEXTDOMAIN ); ?>
        </div>

        <p>
            <label for="<?php echo $this->get_field_id('consumer_key'); ?>">
                <?php _e( 'Consumer key:', MISS_ADMIN_TEXTDOMAIN ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo $consumer_key; ?>" />
            <?php _e( "Please enter API consumer key.", MISS_ADMIN_TEXTDOMAIN ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('consumer_secret'); ?>">
                <?php _e( 'Consumer secret:', MISS_ADMIN_TEXTDOMAIN ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
            <?php _e( "Please enter API consumer secret.", MISS_ADMIN_TEXTDOMAIN ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('oauth_access_token'); ?>">
                <?php _e( 'Access token:', MISS_ADMIN_TEXTDOMAIN ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('oauth_access_token'); ?>" name="<?php echo $this->get_field_name('oauth_access_token'); ?>" type="text" value="<?php echo $oauth_access_token; ?>" />
            <?php _e( "Please enter API access token.", MISS_ADMIN_TEXTDOMAIN ); ?>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('oauth_access_token_secret'); ?>">
                <?php _e( 'Access secret:', MISS_ADMIN_TEXTDOMAIN ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('oauth_access_token_secret'); ?>" name="<?php echo $this->get_field_name('oauth_access_token_secret'); ?>" type="text" value="<?php echo $oauth_access_token_secret; ?>" />
            <?php _e( "Please enter API access secret.", MISS_ADMIN_TEXTDOMAIN ); ?>
        </p>
        <?php
    }
}
?>
