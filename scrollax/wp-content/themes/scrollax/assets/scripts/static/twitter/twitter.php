<?php
if(file_exists('../../../../../../wp-load.php')) {
	include '../../../../../../wp-load.php';
} else {
	include '../../../../../../../wp-load.php';
}

//if ( !headers_sent() ) {
//    header("Content-type: application/x-javascript");
//}
?>
/*
 * Twitter Application
 */
<?php

function miss_validate_twitter_keyword( $username ) {
    $regexp = '/^([\x09-\x0D\x20\x85\xA0]|\xe1\x9a\x80|\xe1\xa0\x8e|\xe2\x80[\x80-\x8a,\xa8,\xa9,\xaf\xdf]|\xe3\x80\x80)*[#@＠]([a-zA-Z0-9_]{1,20})/';
    return preg_match($regexp, $username);
}
$twitter = miss_get_setting('twitter_url');
if ( !isset( $twitter ) || $twitter == "" || miss_validate_twitter_keyword( $twitter ) == 0 ) {
    $twitter = "#envato";
}

        $miss_get_user_timeline = new miss_timeline_store(
          $oauth_access_token = miss_get_setting( 'oauth_access_token' ),
          $oauth_access_token_secret = miss_get_setting( 'oauth_access_token_secret' ),
          $consumer_key = miss_get_setting( 'consumer_key' ),
          $consumer_secret =  miss_get_setting( 'consumer_secret' ),
          $screen_name = str_replace(array("@","#"), array("",""), $twitter),
          $count = "10",
          $json = true
        );
?>

Application = {};
Application.Tweets = {
			    init: function () {
			        var a = {
			            q: "<?php echo $twitter; ?>",
			            rpp: 10
			        	},
			        	c = <?php echo $miss_get_user_timeline->returnTweet(); ?>;

			        jQuery("#lasttweet #status").append("<li>Loading tweets for <?php print $twitter; ?>...</li>").find(".loading").remove();

			        //jQuery.get("http://search.twitter.com/search.json", a, function (c) {
			            if (c.length > 0) {
			                var b = "";
			                jQuery("#lasttweet #status").remove();
			                jQuery.each(c, function (d, e) {
			                	e.user.name = e.user.name.replace(/([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
			                		return '<a href="http://twitter.com/'+url+'">'+url+'</a>';
			                	});
			                //	if (e.text.length > 150) {
			                		e.text = e.text.substring(0,100) + '...';
			                //	}
						e.text = e.text.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
							return '<a href="'+url+'" target="_blank">'+url+'</a>';
						}).
						replace(/B@([_a-z0-9]+)/ig, function(reply) {
							return  reply.charAt(0)+'<a href="<?php print MISS_URL_TW_REPLY; ?>" dat="http://twitter.com/%27+reply.substring%281%29+%27">'+reply.substring(1)+'</a>';
						});
			                    b += "<li><p><cite>@" + e.user.name + "</cite> &rarr; " + e.text + "</p></li>"
			                });
			                jQuery("#lasttweet .page-inner").append(b).find(".loading").remove();
			                jQuery("#lasttweet .page-inner").cycle({
			                    fx: "scrollUp",
			                    easing: "easeInOutCirc",
					    prev:   '.twitter-prev',
					    next:   '.twitter-next'
			                })
			            } else {
			                jQuery("#lasttweet .page-inner").append("<li>No tweets for <?php  print $twitter; ?> account found.</li>").find(".loading").remove()
			            }
			        //}, "jsonp")
			    }
		    };
