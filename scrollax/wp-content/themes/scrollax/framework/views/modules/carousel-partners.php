<?php
/**
 * Partners
 */
global $post;
$partners = Array(
    'enable'    => get_post_meta( get_the_ID( ),     'carousel_partners_enable', true ),
    'caption'   => get_post_meta( get_the_ID( ),     'carousel_partners_caption', true ),
    'delay'     => get_post_meta( get_the_ID( ),     'carousel_partners_delay', true ),
    'autoplay'  => get_post_meta( get_the_ID( ),     'carousel_partners_autoplay', true ),
    'more'      => get_post_meta( get_the_ID( ),     'carousel_partners_more', true ),
    'url'      => get_post_meta( get_the_ID( ),      'carousel_partners_url', true ),
);
echo miss_carousel_partners($partners);
?>