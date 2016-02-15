<?php
/**
 * Twitter TimeLine 1.1 Builder
 * package miss
 *
 * @since 1.7
 */
class miss_timeline_store {
	protected $oauth_access_token;
	protected $oauth_access_token_secret;
	protected $consumer_key;
	protected $consumer_secret;
	protected $screen_name;
	protected $count;
	protected $encryption = 'HMAC-SHA1';
	protected $oauth_version = '1.0';
	protected $timeline_store = 'user_timeline';
	protected $method = 'GET';

	function __construct( $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $screen_name, $count ) {
		$this->oauth_access_token = $oauth_access_token;
		$this->oauth_access_token_secret = $oauth_access_token_secret;
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
		$this->screen_name = $screen_name;
		$this->count = $count;
	}


	function buildBaseString($baseURI, $params) {
		$r = array();
		ksort($params);
		foreach($params as $key=>$value){
				$r[] = "$key=" . rawurlencode($value);
		}
		return $this->method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}

	function oauthHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
				$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}

	function returnTweet(){

		$timeline_store = "user_timeline";	//	mentions_timeline / user_timeline / home_timeline / retweets_of_me

		$query = array(
				'screen_name' => $this->screen_name,
				'count' => $this->count
		);

		$oauth = array(
				'oauth_consumer_key' => $this->consumer_key,
				'oauth_nonce' => time(),
				'oauth_signature_method' => $this->encryption,
				'oauth_token' => $this->oauth_access_token,
				'oauth_timestamp' => time(),
				'oauth_version' => $this->oauth_version
		);
		$oauth = array_merge($oauth, $query);

		$base_info = $this->buildBaseString("https://api.twitter.com/1.1/statuses/$timeline_store.json", $oauth);
		$composite_key = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;

		$query_header = array( $this->oauthHeader($oauth), 'Expect:');
		$params = array(
			CURLOPT_HTTPHEADER => $query_header,
			CURLOPT_HEADER => false,
			CURLOPT_URL => "https://api.twitter.com/1.1/statuses/" . $this->timeline_store . ".json?". http_build_query($query),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
		);

		$feed = curl_init();
		curl_setopt_array($feed, $params);
		$json = curl_exec($feed);
		curl_close($feed);

		return json_decode($json, true);
	}

}
?>
