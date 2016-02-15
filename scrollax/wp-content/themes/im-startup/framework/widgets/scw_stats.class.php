<?php
class SubscriberStats{
	public	$delicious,$twitter,$rss,$facebook,$pinterest;
	public	$services = array();
	public function __construct($arr){
		$this->services = $arr;
		// Building an array with queries:
        //Feedburner
	if(trim($arr['feedBurnerURL'])) {
	/*
            if (strpos($this->services['feedBurnerURL'], 'http') == false || strpos($this->services['feedBurnerURL'], 'http') == false) {
               $this->services['feedBurnerURL'] = "http://".$this->services['feedBurnerURL'];
            }
            $query = $arr['feedBurnerURL'] . "?format=xml";
            $query = 'http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.$arr['feedBurnerURL'];
            $profile = feedReader($query, "xml");
            $this->rss = 1; //(string) $profile->feed->entry['circulation'];
	*/
        }
        //Twitter
	    if( isset($arr['twitterName']) && trim($arr['twitterName']) ) {
            $miss_get_user_timeline = new miss_timeline_store(
              $oauth_access_token = miss_get_setting( 'oauth_access_token' ),
              $oauth_access_token_secret = miss_get_setting( 'oauth_access_token_secret' ),
              $consumer_key = miss_get_setting( 'consumer_key' ),
              $consumer_secret = miss_get_setting( 'consumer_secret' ),
              $screen_name = $arr['twitterName'],
              $count = 1
            );
            $results = $miss_get_user_timeline->returnTweet();
            $this->twitter = $results[0]['user']['followers_count'];
        }
        //Facebook
		if( isset($arr['facebookFanPageURL']) && trim($arr['facebookFanPageURL'])) {
            $fb_id = basename($arr['facebookFanPageURL']);
			$query = 'http://graph.facebook.com/'.$fb_id;
            $data = wp_remote_get($query);
            $data = str_replace("({", "{" , $data['body']);
            $data = str_replace("})", "}", $data);
			//print_r($result);
            $result = json_decode($data,true); 
            
	        //$result = feedReader($query, "json");
            $this->facebook = ( isset ( $result["likes"] ) ) ? $result["likes"] : ( ( isset( $result['followers_count'] ) ) ? $result['followers_count'] : 0 ) ;
        }
        //Pinterest
        if( isset($arr['pinterestURL']) && trim($arr['pinterestURL'])) {
            $pinterest_id = basename($arr['pinterestURL']);
            $query = 'http://api.pinterest.com/v1/urls/count.json?callback=&url='.$arr['pinterestURL'];
            $data = wp_remote_get($query);
            $data = str_replace("({", "{" , $data['body']);
            $data = str_replace("})", "}", $data);
            $result = json_decode($data,true); 
            $this->pinterest = $result["count"];
        }
       //Delicious
        $url = 'envato.com';
        if( isset($arr['deliciousId']) && trim($arr['deliciousId'])) {
            $url = str_replace("http://", "", $arr['deliciousId']);
            $url = str_replace("https://", "", $url);
            $url = str_replace("feed://", "", $url);
            $url = str_replace("http//", "", $url);
            $url = str_replace("http:/", "", $url);
            $api_page = 'http://feeds.delicious.com/v2/json/urlinfo/data?url='.$url;
            $json = wp_remote_get ( $api_page );
            //$json_output = json_decode($json, true);
            $result = json_decode($json['body'],true); 
            $this->delicious = $result[0]['total_posts'];
        }
        if (!$this->delicious) {
            $this->delicious = "0";
        }
        if (!$this->rss) {
            $this->rss = "0";
        }
        if (!$this->twitter) {
            $this->twitter = "0";
        }
        if (!$this->pinterest) {
            $this->pinterest = "0";
        }

        if (!$this->facebook) {
            $this->facebook = "0";
        }
	}
	public function generate(){
		$total = number_format($this->delicious + $this->twitter + $this->facebook);
        ?>
        <div id="socialCounterWidget" class="socialCounterWidget">
            <?php
                $scw_items = Array(
                    'rss'       =>  Array( 'count' => $this->rss, 'name' => __('Feeds',MISS_TEXTDOMAIN), 'descr' => __('subscribe',MISS_TEXTDOMAIN), 'value' => $this->services['feedBurnerURL'], 'icon' => 'im-icon-feed-2', 'color' => '#FF6600' ),
                    'pinterest' =>  Array( 'count' => $this->pinterest, 'name' => __('Pinterest',MISS_TEXTDOMAIN), 'descr' => __('pins',MISS_TEXTDOMAIN), 'value' => $this->services['pinterestURL'], 'icon' => 'im-icon-pinterest', 'color' => '#cb2027' ),
                    'delicious' =>  Array( 'count' => $this->delicious, 'name' => __('Delicious',MISS_TEXTDOMAIN), 'descr' => __('saves',MISS_TEXTDOMAIN), 'value' => $this->services['deliciousId'], 'icon' => 'im-icon-delicious', 'color' => '#3274d1' ),
                    'twitter'   =>  Array( 'count' => $this->twitter, 'name' => __('Twitter',MISS_TEXTDOMAIN), 'descr' => __('followers',MISS_TEXTDOMAIN), 'value' => 'https://twitter.com/' . $this->services['twitterName'], 'icon' => 'im-icon-twitter', 'color' => '#00aced' ),
                    'facebook'  =>  Array( 'count' => $this->facebook, 'name' => __('Facebook',MISS_TEXTDOMAIN), 'descr' => __('page likes',MISS_TEXTDOMAIN), 'value' => $this->services['facebookFanPageURL'], 'icon' => 'im-icon-facebook', 'color' => '#3b5998' ),
                );
                
                $scw_total = Array();
                foreach( $scw_items as $key => $value ) {
                    if ( $value['value'] ) {
                        $scw_total[] = $value['value'];
                    }
                }
                $width = 100 / ( count( $scw_total ) );
                foreach( $scw_items as $key => $value ) {
                    if ( $value['value'] ) {
                        echo '<!-- Begin ' . $value['name'] . ' -->';
                        echo '<div class="socialCounterContainer" style="width: ' . $width . '%;">';
                        echo '<a class="socialCounterBox" href="' . $value['value'] . '" target="_blank" title="' . number_format( $value['count']) . ' ' . $value['descr'] . '"">';
                        echo '<span class="icon"><i class="' . $value['icon'] . '" style="background-color:' . $value['color'] . ';"></i></span>';
                        echo '<span class="count">';
                        if ( $value['count'] && $value['count'] > 0 ) {
                            echo number_format( $value['count'] );
                        } else {
                            echo $value['name'];
                        }
                        echo '</span>';
                        echo '<span class="title">' . $value['descr'] . '</span>';
                        echo '</a>';
                        echo '</div>';
                        echo '<!-- End ' . $value['name'] . ' -->';
                    }
                }
            ?>
        </div>
       <?php
	}
}
?>