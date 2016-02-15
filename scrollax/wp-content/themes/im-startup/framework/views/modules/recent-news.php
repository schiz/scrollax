<?php
/**
 * News Options
 */
global $post;
$news = Array(
    'enable'     => get_post_meta( get_the_ID( ), 'news_enable', true ),
    'caption'    => get_post_meta( get_the_ID( ), 'news_caption', true ),
    'readmore'   => Array(
      'enable'   => get_post_meta( get_the_ID( ), 'news_readmore_enable', true ),
      'label'    => get_post_meta( get_the_ID( ), 'news_readmore_text', true ),
    ),
    'excerpt'    => Array(
      'title'    => get_post_meta( get_the_ID( ), 'news_trim_title', true ),
      'content'  => get_post_meta( get_the_ID( ), 'news_trim_content', true ),
    ),
    'limit'      => get_post_meta( get_the_ID( ), 'news_limit', true ),
    'date_style' => get_post_meta( get_the_ID( ), 'news_date_style', true ),
    'subblock'   => get_post_meta( get_the_ID( ), 'news_subblock', true ),
    'layout'     => get_post_meta( get_the_ID( ), 'news_layout', true ),
    'custom'     => get_post_meta( get_the_ID( ), 'news_custom_block', true ),
    'more'       => get_post_meta( get_the_ID( ), 'news_more', true ),
    'url'        => get_post_meta( get_the_ID( ), 'news_url', true ),
);
echo miss_region_news($news);
?>