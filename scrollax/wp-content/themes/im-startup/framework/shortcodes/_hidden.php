<?php
/**
 *
 */
class missHidden {
	
	/**
	 *
	 */
	function raw( $atts = null, $content = null ) {
		return do_shortcode( $content );
	//	return $content;
	}

	/**
	 *
	 */
	 function row_static( $atts = null, $content = null ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	 function row( $atts = null, $content = null ) {
		return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	 function row_fluid( $atts = null, $content = null ) {
		return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span1( $atts = null, $content = null ) {
		return '<div class="span1">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span2( $atts = null, $content = null ) {
		return '<div class="span2">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span3( $atts = null, $content = null ) {
		return '<div class="span3">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span4( $atts = null, $content = null ) {
		return '<div class="span4">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span5( $atts = null, $content = null ) {
		return '<div class="span5">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span6( $atts = null, $content = null ) {
		return '<div class="span6">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span7( $atts = null, $content = null ) {
		return '<div class="span7">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span8( $atts = null, $content = null ) {
		return '<div class="span8">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span9( $atts = null, $content = null ) {
		return '<div class="span9">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span10( $atts = null, $content = null ) {
		return '<div class="span10">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span11( $atts = null, $content = null ) {
		return '<div class="span11">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function span12( $atts = null, $content = null ) {
		return '<div class="span12">' . do_shortcode( $content ) . '</div>';
	}


	/**
	 *
	 */
	function one_half( $atts = null, $content = null ) {
		return '<div class="row-fluid"><div class="span6">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function one_half_last( $atts = null, $content = null ) {
		return '<div class="span6">' . do_shortcode( $content ) . '</div></div>';
	}



	/**
	 *
	 */
	function one_third_first( $atts = null, $content = null ) {
		return '<div class="row-fluid"><div class="span4">' . do_shortcode( $content ) . '</div>';
	}


	/**
	 *
	 */
	function one_third( $atts = null, $content = null ) {
		return '<div class="span4">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function one_third_last( $atts = null, $content = null ) {
		return '<div class="span4">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 *
	 */
	function one_fourth_first( $atts = null, $content = null ) {
		return '<div class="row-fluid"><div class="span3">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function one_fourth( $atts = null, $content = null ) {
		return '<div class="span3">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function one_fourth_last( $atts = null, $content = null ) {
		return '<div class="span3">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 *
	 */
	function one_sixth_first( $atts = null, $content = null ) {
		return '<div class="row-fluid"><div class="span2">' . do_shortcode( $content ) . '</div>';
	}
	/**
	 *
	 */
	function one_sixth( $atts = null, $content = null ) {
		return '<div class="span2">' . do_shortcode( $content ) . '</div>';
	}
	/**
	 *
	 */
	function one_sixth_last( $atts = null, $content = null ) {
		return '<div class="span2">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 *
	 */
	function three_fourth( $atts = null, $content = null ) {
		return '<div class="row-fluid"><div class="span9">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 *
	 */
	function three_fourth_last( $atts = null, $content = null ) {
		return '<div class="span9">' . do_shortcode( $content ) . '</div></div>';
	}


	/**
	 *
	 */
	function auto_column( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'columns'	=> '',
			'responsive'	=> false
		), $atts));
		$style = 'col';
		if ($responsive == true) {
			$style .= $columns . ' responsive';
		} else {
			$style .= $columns;
		}
		return '<div class="auto_column '.$style.'">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
	}


	/**
	 *
	 */
	function divider_padding( $atts = null, $content = null ) {
		return '<div class="divider_padding"></div>';
	}

	
	/**
	 *
	 */
	function styled_header( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' class="' . trim( $variation ) . '"' : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;

	   	return '<h6 class="styled_header"><span' . $variation . $style . '>' . miss_content_group( $content ) . '</span></h6>';
	}
	
	/**
	 *
	 */
	function dropcap( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> ''
	    ), $atts));
		
		$variation = ( $variation ) ? ' ' . $variation . '_sprite' : '';
			
		return '<span class="dropcap' . $variation . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function pullquote( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'variation'	=> '',
			'textcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $textcolor ) ) )
			$class[] = ' ' . $variation . '_text';
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
	
		return '<span class="pullquote' . $class . '"' . $style . '>' . miss_content_group( $content ) . $cite . '</span>';
	}
	
	/**
	 *
	 */
	function highlight( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));
	
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . trim( $variation ) : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
			
		return '<span class="highlight' . $variation . '"' . $style . '>' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	static function post_author( $attr ) {
		$attr = shortcode_atts(array(
			'before' => '',
			'after' => '',
			'text' => __( '<em>Posted by:</em>', MISS_TEXTDOMAIN )
		), $attr);

			$icon = '<i class="im-icon-user"></i>';
		$author = '<span class="meta_author">' . $attr['before'] . $icon . $attr['text'] . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>' . $attr['after'] . '</span>';

		return $author;
		
	}

	/**
	 *
	 */
	static function post_date_box( $attr ) {
		$attr = shortcode_atts(array(
			'before' => '',
			'after' => '',
			'text' => '',
			'format' => 'm-j-Y'
		), $attr);
		$published = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '" class="month pull-left"><span class="day">' . get_the_time( 'd' ) . '</div>' . get_the_time( 'M' ) . '</a>';

		//$published = '<div class="meta_date_box"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '"><span class="month">' . get_the_time( __('M'), MISS_TEXTDOMAIN ) . '</span><span class="day">' . get_the_time( __('j', MISS_TEXTDOMAIN) ) . '</span></div>';
		return $published;
	}
	
	/**
	 *
	 */
	static function post_date( $attr ) {
		$attr = shortcode_atts(array(
			'before' => '',
			'after' => '',
			'text' => 'on: ',
			'format' => 'm-j-Y'
		), $attr);

			$icon = '<i class="im-icon-calendar-4"></i>';
		$published = '<span class="meta_date">' . $attr['before'] . $icon . $attr['text'] . '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '">' . sprintf( get_the_time( $attr['format'] ) ) . '</a>' . $attr['after'] . '</span>';
		//$published = '<div class="meta_date">' . $attr['before'] . $attr['text'] . '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '">' . sprintf( get_the_time( $attr['format'] ) ) . '</a>' . $attr['after'] . '</div>';
		return $published;
		
	}
	
	/**
	 *
	 */
	static function post_comments( $attr ) {
		$number = get_comments_number();
		$attr = shortcode_atts(array(
			'zero' => __( '0', MISS_TEXTDOMAIN ),
			'one' => __( '1', MISS_TEXTDOMAIN ),
			'more' => __( '%1$s', MISS_TEXTDOMAIN ),
			'css_class' => 'comments-link',
			'none' => '', 
			'text' => '',
			'before' => ' ',
			'after' => ''
		), $attr);

		if ( 0 == $number && !comments_open() && !pings_open() ) {
			if ( $attr['none'] )
				$comments_link = '<span class="' . esc_attr( $attr['css_class'] ) . '">' . $attr['none'] . '</span>';
		}
		elseif ( $number == 0 )
			$comments_link = '<a href="' . get_permalink() . '#respond" title="' . sprintf( __( 'Comment on %1$s', MISS_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . $attr['zero'] . '</a>';
		elseif ( $number == 1 )
			$comments_link = '<a href="' . get_comments_link() . '" title="' . sprintf( __( 'Comment on %1$s', MISS_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . $attr['one'] . '</a>';
		elseif ( $number > 1 )
			$comments_link = '<a href="' . get_comments_link() . '" title="' . sprintf( __( 'Comment on %1$s', MISS_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['more'], $number ) . '</a>';

			$icon = '<i class="im-icon-bubble-4"></i>';
		if ( isset( $comments_link ) ) {
			return '<span class="meta_comments">' . $attr['before'] . $icon . $attr['text'] . $comments_link . $attr['after'] . '</span>';
		}
	}
	
	/**
	 *
	 */
	static function post_terms( $attr ) {
		global $post;

		$attr = shortcode_atts(array(
			'id' => $post->ID,
			'taxonomy' => 'post_tag',
			'separator' => ' ',
			'before' => ' ',
			'after' => '',
			'text' => __( '<em>Posted in: </em>', MISS_TEXTDOMAIN )
		), $attr );

		if( $attr['taxonomy'] == 'category' ){
			$icon = '<i class="im-icon-folder-open"></i> ';
		} else {
			$icon = '<i class="im-icon-tag-5"></i> ';
		}
			$attr['before'] = '<span class="meta_' . $attr['taxonomy'] . '">' . $attr['before'] . $icon . $attr['text'] . ' ';
			$attr['after'] = $attr['after'] . '</span>';

		return get_the_term_list( $attr['id'], $attr['taxonomy'], $attr['before'], $attr['separator'], $attr['after'] );
	}
	
	/**
	 *
	 */
	function teaser_small( $atts = null, $content = null ) {
		return '<p class="teaser_small">' . miss_content_group( $content ) . '</p>';
	}
	
	/**
	 *
	 */
	function theme_name() {
		return THEME_NAME;
	}
	
	
	/**
	 * Legacy Shortcodes
	 */
	
	/**
	 *
	 */
	function frame_left( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="left" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function frame_right( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="right" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function frame_center( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="center" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function simple_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[colored_box variation="white"]' . $content . '[/colored_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function color_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'title'      => '',
	        'align'      => '',
			'variation'  => ''
		), $atts));
	
		$out = do_shortcode( '[titled_box title="' . $title . '" align="' . $align . '" variation="' . $variation . '"]' . $content . '[/titled_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function styled_titled_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'title'      => ''
		), $atts));
	
		$out = do_shortcode( '[styled_box title="' . $title . '"]' . $content . '[/styled_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function arrow_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[list variation="' . $variation . '" type="arrow_list"]' . $content . '[/list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function bullet_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[list variation="' . $variation . '" type="bullet_list"]' . $content . '[/list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function check_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[list variation="' . $variation . '" type="check_list"]' . $content . '[/list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function star_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[list variation="' . $variation . '" type="star_list"]' . $content . '[/list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function pullquote_left( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[pullquote align="left"]' . $content . '[/pullquote]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function pullquote_right( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[pullquote align="right"]' . $content . '[/pullquote]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function minimal_tabs( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
		
		$out = '';
		
		$i=0;
		foreach( $atts as $tab ) {
			$tabs[$i] = $tab; $i++;
		}
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= ' [tab title="' . $tabs[$i] . '"]' . $matches[5][$i] . '[/tab] ';
			}
		}
		
		return do_shortcode( '[tabs] ' . $out . ' [/tabs]' );
	}
	
	/**
	 *
	 */
	function framed_tabs( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
		
		$out = '';
		
		$i=0;
		foreach( $atts as $tab ) {
			$tabs[$i] = $tab; $i++;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= ' [tab title="' . $tabs[$i] . '"]' . $matches[5][$i] . '[/tab] ';
			}
		}
		
		return do_shortcode( '[tabs_framed] ' . $out . ' [/tabs_framed]' );
	}

	/**
	 *
	 */
	function track( $atts = null, $content = null ) {
		$def = array(
			'title'	=> '',
			'artist' => '',
			'contant' => '',
			'oga' => '',
			'image'	=> '',
			'buy'	=> '',
			'price'		=> '',
			'duration'	=> '',
			'score'	=> ''
	    );
		extract(shortcode_atts($def, $atts));
	
		$class = array();

		$out = "{
	        mp3:'{$content}',
	        oga:'{$oga}',
	        title:'{$title}',
	        artist:'{$artist}',
	        rating:'{$score}',
	        buy:'{$buy}',
	        price:'{$price}',
	        duration:'{$duration}',
	        cover:'{$image}'
		},";		
	
		return $out;
	}


	/**
	 *
	 */
	function office_unit( $atts = null, $content = null ) {
		$def = array(
			'name'	=> '',
			'title' => '',
			'image' => '',
			'content' => ''
	    );
		extract(shortcode_atts($def, $atts));
	
		$class = array();

		$out = "shortcode";		
	
		return $out;
	}
	/**
	 *
	 */
	// function me_track( $atts = null, $content = null ) {
	// 	$def = array(
	// 		'title'	=> '',
	// 		'artist' => '',
	// 		'contant' => '',
	// 		'oga' => '',
	// 		'image'	=> '',
	// 		'buy'	=> '',
	// 		'price'		=> '',
	// 		'duration'	=> '',
	// 		'score'	=> ''
	//     );
	// 	extract(shortcode_atts($def, $atts));
	
	// 	$class = array();

	// 	$out = "<li class='me-track'>
	//         <span class='title'>{$title}</span>
	//         <span class='duration'>{$duration}</span>
	//         <span class='rating'>{$score}</span>
	//         mp3:'{$content}',
	//         oga:'{$oga}',
	//         title:'{$title}',
	//         artist:'{$artist}',
	//         rating:'{$score}',
	//         buy:'{$buy}',
	//         price:'{$price}',
	//         duration:'{$duration}',
	//         cover:'{$image}'
	// 	},";
	
	// 	return $out;
	// }

}


?>
