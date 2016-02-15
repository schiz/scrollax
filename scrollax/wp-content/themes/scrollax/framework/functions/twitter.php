<?php
/**
 *
 */
function miss_relative_time( $original, $do_more = 0 ) {
	# array of time period chunks
	$chunks = array(
		array(60 * 60 * 24 * 365 , 'year'),
		array(60 * 60 * 24 * 30 , 'month'),
		array(60 * 60 * 24 * 7, 'week'),
		array(60 * 60 * 24 , 'day'),
		array(60 * 60 , 'hour'),
		array(60 , 'minute'),
	);

	$today = time();
	$since = $today - $original;

	for ($i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];

		if (($count = floor($since / $seconds)) != 0) {
			break;
		}
	}

	$print = ($count == 1) ? '1 '.$name : "$count {$name}s";

	if ($i + 1 < $j) {
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];

		# add second item if it's greater than 0
		if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more ) {
			$print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
		}
	}
	return $print;
}


/**
 *
 */
function miss_twitter_feed( $usernames, $limit = 5, $type ) {
	$out = '';
	
	if( empty( $usernames ) ) {
		return __( 'Twitter not configured.', MISS_TEXTDOMAIN );
	}
		
	include_once(ABSPATH . WPINC . '/feed.php');
	
	$rss = @fetch_feed( 'http://twitter.com/statuses/user_timeline/' . $usernames . '.rss' );
	$tQuery = 'http://search.twitter.com/search.json?q='.$usernames.'&rpp='.$limit;

	$rss = wp_remote_get($tQuery);

	if ( !is_wp_error( $rss ) ) { 
		if ( isset( $rss['body'] ) ) {
			$rss = json_decode( $rss['body'],false);
		} else {
			$rss = (object) array(
				'results' => array(
					'0' => (object) array(
						'id_str' => 0,
						'created_at' => 1,
						'text' => __( 'Error occurred, please contact twitter ;)', MISS_TEXTDOMAIN )
					)
				)
			);
		}
		$rss_items = $rss->results;
	} else  {
		add_filter( 'wp_feed_cache_transient_lifetime', 'miss_twitter_feed_cahce_error');
		$rss = wp_remote_get($tQuery);
		$rss = json_decode($rss['body'],false);
		if ( !is_wp_error( $rss ) ) {
		}
		else {
			remove_filter( 'wp_feed_cache_transient_lifetime', 'miss_twitter_feed_cahce_error');
			return '<p>No Twitter Messages</p>';
		}
		
		remove_filter( 'wp_feed_cache_transient_lifetime', 'miss_twitter_feed_cahce_error');
	}
	
	$i = 0;
	foreach ( $rss_items as $item ) {
		if( $type == 'teaser' ) {
			$out .= '<a class="tweet target_blank" href="http://twitter.com/1/status/' . $item->id_str . '">';
			$out .= miss_filter_tweet( $item->text );
			$out .= sprintf( __( '<small> (%1$s&nbsp;ago)</small>', MISS_TEXTDOMAIN ), miss_relative_time(strtotime( $item->created_at ) ) );
			$out .= '</a>';
		}
		
		if( $type == 'widget' ) {
			$out .= '<li>';
			$out .= '<a class="twitt" target="_BLANK" href="http://twitter.com/1/status/' . $item->id_str . '" title="' . sprintf( esc_attr__( '%1$s&nbsp;ago', MISS_TEXTDOMAIN ), miss_relative_time(strtotime( $item->created_at ) ) ) . '"><i class="fa-icon-twitter pull-left"></i><div class="comment"><span class="twitter_time">' . sprintf( esc_attr__( '%1$s&nbsp;ago', MISS_TEXTDOMAIN ), miss_relative_time(strtotime( $item->created_at ) ) ) . '</span> ' . miss_filter_tweet( $item->text ) . '</div></a>';
			$out .= '</li>';
		}
		
		$i++;
		if ( $i >= $limit ) break;
	}

	return $out;

}


/**
 *
 */
function miss_filter_tweet( $tweet ) {

	return $tweet;

}

?>
