<?php
/**
 *
 */
function miss_short_url( $id, $format = 'txt', $history = 1 ) {
	$enable_bitly = miss_get_setting( 'url_shortening' );
	$bitly_login = miss_get_setting( 'bitly_login' );
	$bitly_api = miss_get_setting( 'bitly_api' );
	
	$url = get_post_meta( $id, '_bitly_trim', true );
	
	$post_url = get_permalink( $id );
	
	if( !$enable_bitly ){
		
		if( $url )
			return $url;
		
		$url = sprintf( '%s?p=%s', home_url() . '/', $id );
		add_post_meta( $id, '_bitly_trim', $url );
		return $url;
	}
	
	if( ( !empty( $enable_bitly ) ) && ( !empty( $bitly_login ) ) && ( !empty( $bitly_api ) ) ) {
		
		if ( !stristr( $url, 'bit.ly' )) {
			
			$bitly = 'http://api.bit.ly/v3/shorten?login=' . $bitly_login . '&apiKey=' . $bitly_api . '&uri='.urlencode( $post_url ) .
			'&format=' . $format . '&history=' . $history;
	
			$response = wp_remote_retrieve_body(wp_remote_get( $bitly ));
	
			if(is_wp_error($response)){
				$url = sprintf( '%s?p=%s', home_url() . '/', $id );
				add_post_meta( $id, '_bitly_trim', $url );
				return $url;
			}
	
			$url = trim( $response) ;
		
			delete_post_meta( $id, '_bitly_trim' );
			add_post_meta( $id, '_bitly_trim', $url );
			
			return $url;
		}
		
		return $url;
		
	}
	
	if( $url )
		return $url;
	
	$url = sprintf( '%s?p=%s', home_url() . '/', $id );
	add_post_meta( $id, '_bitly_trim', $url );
	return $url;
}

/**
 *
 */
function miss_sociable_bookmarks() {
	global $wp_query, $post;
	
	$sociable_sites = array(

		array( "name" => "Twitter",
			'svg' => '<i class="fs-icon-twitter-alt"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/twitter.png',
			'class' => 'twitter_icon fade_hover',
			'url' => 'http://twitter.com/home?status=TITLE%20-%20PERMALINK',
		),

	    array( "name" => "StumbleUpon",
			'svg' => '<i class="fs-icon-su"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/stumbleupon.png',
			'class' => 'stumbleupon_icon',
		    'url' => 'http://www.stumbleupon.com/submit?url=PERMALINK&amp;title=TITLE',
		),
		array( "name" => "Digg",
			'svg' => '<i class="fs-icon-digg"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/digg.png',
			'class' => 'digg_icon',
			'url' => 'http://digg.com/submit?phase=2&amp;url=PERMALINK&amp;title=TITLE&amp;bodytext=EXCERPT',
		),

		array( "name" => "del.icio.us",
			'svg' => '<i class="fs-icon-delicious"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/delicious.png',
			'class' => 'delicious_icon',
			'url' => 'http://delicious.com/post?url=PERMALINK&amp;title=TITLE&amp;notes=EXCERPT',
		),
		
		array( "name" => "Facebook",
			'svg' => '<i class="fs-icon-facebook"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/facebook.png',
			'class' => 'facebook_icon',
			'url' => 'http://www.facebook.com/share.php?u=PERMALINK&amp;t=TITLE',
		),
		
		array( "name" => "LinkedIn",
			'svg' => '<i class="fs-icon-linkedin"></i>',
			'icon' => THEME_IMAGES . '/posts/sociables/linkedin.png',
			'class' => 'linkedin_icon',
			'url' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url=PERMALINK&amp;title=TITLE&amp;source=BLOGNAME&amp;summary=EXCERPT',
		)
	);
	
	# Load the post's and blog's data
	$blogname = urlencode( get_bloginfo( 'name' ) . ' ' . get_bloginfo( 'description' ) );
	$post = $wp_query->post;
	
	
	# Grab the excerpt, if there is no excerpt, create one
	$excerpt = urlencode(strip_tags(strip_shortcodes( $post->post_excerpt )));
	if ($excerpt == '') {
		$excerpt = urlencode(substr(strip_tags(strip_shortcodes( $post->post_content )), 0, 250 ));
	}
	
	# Clean the excerpt for use with links
	$excerpt = str_replace( '+','%20',$excerpt );
	$excerpt = str_replace( '%0D%0A','',$excerpt );
	
	$permalink = miss_short_url( $post->ID );
	
	$title = str_replace( '+', '%20', urlencode( $post->post_title ));
	
	$output = '';
	$width = ( 100/( count( $sociable_sites ) ) );
	foreach( $sociable_sites as $bookmark ) {
		$url = $bookmark['url'];
		$url = str_replace( 'TITLE', $title, $url );
		$url = str_replace( 'BLOGNAME', $blogname, $url );
		$url = str_replace( 'EXCERPT', $excerpt, $url );
		$url = str_replace( 'PERMALINK', $permalink, $url );
		$output .= '<li style="width: ' . $width . '%"><a href="' . $url . '" class="socialBookmark">';
		$output .= $bookmark['svg'];
		$output .= '</a></li>';
	}
	$out = '<ul class="share_this_list">' . $output . '</ul>';
	return $out;
}

?>