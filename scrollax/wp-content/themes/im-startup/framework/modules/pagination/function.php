<?php
/**
 * Pager
 *
 * @package MissFramework
 * @since 1.7
 */

if( !function_exists( 'miss_pagenavi_next_class' ) ):
/**
 *
 */
function miss_pagenavi_next_class() {
   return 'class="nav"';
}
endif;


if( !function_exists( 'miss_pagenavi_prev_class' ) ):
/**
 *
 */
function miss_pagenavi_prev_class() {
   return 'class="nav"';
}
endif;


if( !function_exists( 'miss_pagenavi' ) ):
/**
 *
 */
function miss_pagenavi($before = '', $after = '', $custom_query = array() ) {
	global $wpdb, $wp_query, $irish_framework_params;
	
	$out = '';
	if (!is_single()) {
		$pagenavi_options = array();
		$pagenavi_options['pages_text'] = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%', MISS_TEXTDOMAIN );
		$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
		$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
		$pagenavi_options['first_text'] = __('&laquo; First', MISS_TEXTDOMAIN );
		$pagenavi_options['last_text'] = __('Last &raquo;', MISS_TEXTDOMAIN );
		$pagenavi_options['next_text'] = '&gt;';
		$pagenavi_options['prev_text'] = '&lt;';
		$pagenavi_options['dotright_text'] = __('...', MISS_TEXTDOMAIN );
		$pagenavi_options['dotleft_text'] = __('...', MISS_TEXTDOMAIN );
		$pagenavi_options['style'] = 1;
		$pagenavi_options['num_pages'] = 5;
		$pagenavi_options['always_show'] = 0;
		$pagenavi_options['num_larger_page_numbers'] = 3;
		$pagenavi_options['larger_page_numbers_multiple'] = 10;

		$request = $wp_query->request;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(miss_get_page_query());
		
		if( !empty( $custom_query ) ) {
			$numposts = $custom_query->found_posts;

			if( !empty( $irish_framework_params->offset ) && $irish_framework_params->offset>0 && !empty( $irish_framework_params->posts_per_page ) && $irish_framework_params->posts_per_page>0  ) {
				$max_page = $custom_query->max_num_pages = ceil(($custom_query->found_posts - $irish_framework_params->offset) / $irish_framework_params->posts_per_page);
			} else {
				$max_page = $custom_query->max_num_pages;
			}
			
		} else {
			$numposts = $wp_query->found_posts;
			$max_page = $wp_query->max_num_pages;
		}
		
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}


		// Define pagination type
		if ( $max_page > $paged ) {
			$pagniation_type = ( miss_get_setting('pagination_type') ) ? miss_get_setting('pagination_type') : 'manual';
		} else {
			$pagniation_type = 'manual';
		}

		$pages_to_show = intval($pagenavi_options['num_pages']);
		$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
		$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = (miss_n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = miss_n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = miss_n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = miss_n_round($end_page, 10) + ($larger_per_page);

		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}

		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}

		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}

		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}

		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
			$out = $before.'<div class="wp-pagenavi ' . $pagniation_type . '-more paginator offset1">'."\n";
			switch(intval($pagenavi_options['style'])) {
				case 1:
					if(!empty($pages_text)) {
						$out .= '<!--span class="pagenavi-pages">'.$pages_text.'</span-->';
					}
					if ($start_page >= 2 && $pages_to_show < $max_page) {
						$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
						$out .= '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">'.$first_page_text.'</a>';
						if(!empty($pagenavi_options['dotleft_text'])) {
							$out .= '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
						}
					}
					if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
						for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$out .= '<a href="'.esc_url(get_pagenum_link($i)).'" class="pagenavi-page" title="'.$page_text.'">'.$page_text.'</a>';
						}
					}
					$out .= get_previous_posts_link($pagenavi_options['prev_text']);
					for($i = $start_page; $i  <= $end_page; $i++) {						
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							$out .= '<span class="current">'.$current_page_text.'</span>';
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$out .= '<a href="'.esc_url(get_pagenum_link($i)).'" class="pagenavi-page" title="'.$page_text.'">'.$page_text.'</a>';
						}
					}
					if ( $pagniation_type == 'auto' && $max_page > $paged ) {
						$out .= get_next_posts_link($pagenavi_options['next_text'], $max_page);
					}
					if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
						for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$out .= '<a href="'.esc_url(get_pagenum_link($i)).'" class="pagenavi-page" title="'.$page_text.'">'.$page_text.'</a>';
						}
					}
					if ($end_page < $max_page) {
						if(!empty($pagenavi_options['dotright_text'])) {
							$out .= '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
						}
						$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
						$out .= '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$last_page_text.'</a>';
					}
					break;
				case 2;
					$out .= '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
					$out .= '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
					for($i = 1; $i  <= $max_page; $i++) {
						$page_num = $i;
						if($page_num == 1) {
							$page_num = 0;
						}
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							$out .= '<option value="'.esc_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$out .= '<option value="'.esc_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
						}
					}
					$out .= "</select>\n";
					$out .= "</form>\n";
					break;
			}
			$out .= '</div>'.$after."\n";
			if ( $pagniation_type == 'auto' && $max_page > $paged ) {
				//$out .= miss_automore_script();
				//$out .= miss_automore_print_script( $echo = false, $selector = 'section.main_content', $navSelector =  '.auto-more', $nextSelector =  'a.next-page', $itemSelector = '.loop_module', $isotope = false );
				$out .= '
				<script>
					jQuery(document).ready(function(){

						/* Likes */
					    jQuery(".miss_hearts").click(
					        function() {
					            //var permalink = jQuery(this).attr("href");
					            var post_id = jQuery(this).attr("data-id"),
					                el = jQuery(this);
					                jQuery.ajax({
					                    type: \'POST\',
					                    dataType: \'json\',
					                    data: { \'miss-like\': 1, \'post_id\': post_id },
					                    beforeSend: function(x) {
					                        if(x && x.overrideMimeType) {
					                            x.overrideMimeType(\'application/json;charset=UTF-8\');
					                        }
					                    },
					                    complete: function() {
					                    },
					                    success: function(data) {
					                        el.find(".number").text( data.response.count );
					                        if ( data.response.state === "dislike" ) {
					                            el.removeClass("active");
					                            el.find("i").attr("class", "fa-icon-heart-empty icon");
					                        } else {
					                            el.addClass("active");
					                            el.find("i").attr("class", "fa-icon-heart icon");
					                        }
					                    }
					                });
					            return false;
					        }
					    );
						/* Pretty photo */
						jQuery("a[rel^=\'prettyPhoto\'], a[rel^=\'lightbox\']").prettyPhoto({
							overlay_gallery: false,
							social_tools: \'\',
							deeplinking: false,
							\'theme\': \'light_rounded\'
						});
					});
				</script>';
			}
			// if ( $pagniation_type == 'semi' ) {
			// 	$out .= miss_automore_print_script( $echo = false, $selector = 'section.main_content', $navSelector =  '.auto-more', $nextSelector =  'a.next-page' );
			// }
		}
	}
	return $out;
}
endif;
?>