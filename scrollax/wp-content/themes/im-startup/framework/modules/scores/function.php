<?php
if ( !function_exists( 'the_score' ) ) :
/**
 * Rating System
 * @since 1.3
 */
function the_score($post) {
	$out = '';
	$fields = '';
	$overall = 0;
	$counter = 0;
	$criteria = miss_get_setting('criteria');
	$star_image = ( miss_get_setting('star_image') ) ? miss_get_setting('star_image') : 'star';
	$star_color = miss_get_setting('star_color');

	if ( isset($criteria['keys']) && $criteria['keys'] != '#' ) {
		$criteria_keys = explode(',',$criteria['keys']);
		foreach ($criteria_keys as $ckey) {
			if ( $ckey != '#') {
				// $counter++;

				$criteria_name = ( !empty( $criteria[$ckey]['link'] ) ) ? $criteria[$ckey]['link'] : '#';

				$rating_get = get_post_meta($post, '_review_'.$ckey);
				if (isset($rating_get[0])) {
					$rating = $rating_get[0];
				} else {
					$rating = 0;
				}

				$overall += $rating;

				// if rating is 0 don't display that field
				if ($rating != 0 ) {
                                        $counter++;
					$fields .= '<li class="rating_row">';
					$fields .= '<em>'.$criteria_name.':</em><div class="rating_right">'.score_output($rating).'</div>';
					$fields .= '</li>';
				}
			}
		}
	}
	if ($fields != '') {
		$out .= '<div class="rating_box">';
		$out .= '<h4><span>'. __('Review', MISS_TEXTDOMAIN).'</span></h4>';
		$out .= '<ul class="rates">';
		$out .= $fields;
		$out .= '</ul><!-- rates -->';
		if ($counter > 1 ) {
			$out .= '<div class="overall_rating">';
			//smart overall calculations
			$overall = $overall / $counter;
			$overget = $overall - floor($overall);
			if ($overget >= 0.5) {
				$overall = floor($overall) + .5;
			} else {
				$overall = floor($overall);
			}
			$out .= '<h4><span>'. __("Total", MISS_TEXTDOMAIN) . ':</span></h4><span class="score total">'.$overall.'</span> '.score_output($overall,40);
			$out .= '<div class="clearboth"></div>';
			$out .= '</div><!-- overall -->';
		}
		$out .= '</div><!-- rating box -->';
	}

	return $out;
}
endif;

if ( !function_exists( 'score_value' ) ) :
/**
 * Rating System Score Generator
 * @since 1.3
 */
function score_value($post) {
	$criteria = miss_get_setting('criteria');
	$overall = 0; $counter = 0;
	if ( $criteria['keys'] != '#' ) {
		$criteria_keys = explode(',',$criteria['keys']);
		foreach ($criteria_keys as $ckey) {
			if ( $ckey != '#') {
				$counter++;
				$rating_get = get_post_meta($post, '_review_'.$ckey);
				if (isset($rating_get[0])) {
					$rating = $rating_get[0];
				} else {
					$rating = 0;
				}

				$overall += $rating;
			}
		}
	}

	if ($overall > 0) {
          $overall = $overall / $counter;
	  $overget = $overall - floor($overall);
	  if ($overget >= 0.5) {
		$overall = floor($overall) + .5;
	  } else {
		$overall = floor($overall);
	  }
        }
	return $overall;
}
endif;



if ( !function_exists( 'score_output' ) ) :
function score_output( $rating, $size = false, $star_color = false, $star_color2 = false, $star_image = false ) {

	if ($star_image == false) {
		$star_image = miss_get_setting('star_image');
	}

	if ($size == false) {
		$size = miss_get_setting('star_size');
	}

	if ($star_color == false) {
		$star_color = miss_get_setting('star_color');
	}

	if ($star_color2 == false) {
		$star_color2 = miss_get_setting('star_color2');
	}

	$steam_style  = ' style="';
	$steam_style .= 'font-size: ' . $size . 'px;';
	$steam_style .= 'width: ' . $size . 'px;';
	$steam_style .= 'color: ' . $star_color . ';';
	$steam_style .= 'height: ' . $size . 'px;';
	$steam_style .= 'line-height: ' . $size . 'px;';
	$steam_style .= '"';

	$csingle_style = ' style="';
	$csingle_style .= 'color: ' . $star_color . ';';
	$csingle_style .= 'width: ' . $size . 'px;';
	$csingle_style .= 'height: ' . $size . 'px;';
	$csingle_style .= '"';

	$csingle2_style = ' style="';
	$csingle2_style .= 'color: ' . $star_color2 . ';';
	$csingle2_style .= 'width: ' . $size . 'px;';
	$csingle2_style .= 'height: ' . $size . 'px;';
	$csingle2_style .= '"';

	$cone_style = ' style="';
	$cone_style .= 'width: ' . (floor( $size / 2 ) ) . 'px;';
	$cone_style .= 'height: ' . $size . 'px;';
	$cone_style .= '"';

	$ctwo_style = ' style="';
	$ctwo_style .= 'width: ' . (floor( $size / 2 ) ) . 'px;';
	$ctwo_style .= 'height: ' . $size . 'px;';
	$ctwo_style .= '"';

	$cone_i_style = ' style="';
	$cone_i_style .= 'color: ' . $star_color . ';';
	$cone_i_style .= 'margin-top: 0;';
	$cone_i_style .= 'margin-bottom: 0;';
	$cone_i_style .= 'height: ' . $size . 'px;';
	$cone_i_style .= 'font-size: ' . $size . 'px;';
	$cone_i_style .= 'line-height: ' . $size . 'px;';
	$cone_i_style .= '"';

	$ctwo_i_style = ' style="';
	$ctwo_i_style .= 'color: ' . $star_color2 . ';';
	$ctwo_i_style .= 'margin-top: 0;';
	$ctwo_i_style .= 'margin-bottom: 0;';
	$ctwo_i_style .= 'margin-left: -' . (floor( $size / 2 ) ) . 'px;';
	$ctwo_i_style .= 'height: ' . $size . 'px;';
	$ctwo_i_style .= 'font-size: ' . $size . 'px;';
	$ctwo_i_style .= 'line-height: ' . $size . 'px;';
	$ctwo_i_style .= '"';



	$rank_steam_full = '<div class="rank_steam active"' . $steam_style . '><div class="csingle"' . $csingle_style . '><i class="' . $star_image . '" style="line-height: ' . $size . 'px;height: ' . $size . 'px;font-size: ' . $size . 'px"></i></div></div>';
	$rank_steam_empty= '<div class="rank_steam inactive"' . $steam_style . '><div class="csingle"><i class="' . $star_image . '" style="color: ' . $star_color2 . '; line-height: ' . $size . 'px; height: ' . $size . 'px;font-size: ' . $size . 'px"></i></div></div>';
	$rank_steam_half = '<div class="rank_steam half"' . $steam_style . '><div class="cone"' . $cone_style . '><i class="' . $star_image . '"' . $cone_i_style . '></i></div><div class="ctwo"' . $ctwo_style . '><i class="' . $star_image . '"' . $ctwo_i_style . '></i></div></div>';
	if ($rating == 0) {
		$stars  = $rank_steam_empty . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty;
	} elseif ($rating == 0.5) {
		$stars  = $rank_steam_half . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 1) {
		$stars  = $rank_steam_full . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 1.5) {
		$stars  = $rank_steam_full . $rank_steam_half . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 2) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_empty . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 2.5) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_half . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 3) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_empty . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 3.5) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_half . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 4) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_empty;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 4.5) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_half;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
		// ';
	} elseif ($rating == 5) {
		$stars  = $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_full . $rank_steam_full;
		// $stars = '
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// 	<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
		// ';
	}






	// } elseif ($rating == 0.5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 1) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 1.5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 2) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 2.5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 3) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 3.5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 4) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-4 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 4.5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-5 '.$size.' '.$star_color.'"></i>
	// 	';
	// } elseif ($rating == 5) {
	// 	$stars = '
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 		<i class="im-icon-'.$star_image.'-6 '.$size.' '.$star_color.'"></i>
	// 	';
	// }
	$stars = str_replace("\n", "", $stars);
	$stars = str_replace("\r", "", $stars);
	$stars = str_replace("\t", "", $stars);
	return $stars;
}
endif;
?>