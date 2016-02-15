<?php
/**
 * Pager
 *
 * @package MissFramework
 * @since 1.8
 */

add_filter('next_posts_link_attributes', 'miss_pagenavi_next_class');
add_filter('previous_posts_link_attributes', 'miss_pagenavi_prev_class');
