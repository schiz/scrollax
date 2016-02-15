<?php
/* Template Name Features */
function miss_core_get_template_name() {
    global $post;
    if( isset($_GET['post']) ) {
        $post_id = $_GET['post'];
    }elseif( isset($_POST['post_ID']) ) {
        $post_id = $_POST['post_ID'];
    }elseif( isset($post->ID) ) {
        $post_id = $post->ID;
    }else
        return false;
    
    return get_post_meta($post_id, '_wp_page_template', true);
}

function miss_get_admin_thumbnail ( $post_id, $max_w = 100, $max_h = 100, $noimage = 'production/images/noimage_small.jpg' ) {
        if ( has_post_thumbnail( $post_id ) ) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
        } else {
                $att_query = new WP_Query( array(
                        'post_type'             => 'attachment',
                        'post_status'           => 'inherit',
                        'post_parent'           => $post_id,
                        'posts_per_page'        => 1,
                        'post_mime_type'        => 'image',
                        'order'                         => 'DESC',
                        'orderby'                       => 'menu_order'
                ) );

                if ( count( $att_query->posts ) ) {
                        $thumb = wp_get_attachment_image_src( $att_query->posts[0]->ID, 'thumbnail' );
                } else {
                    $thumb = array( THEME_IMAGES_ASSETS . '/general/no-thumbnail.png', 50, 50 );
                }
        }

        if ( ! $thumb ) {
                if ( ! $noimage ) { return false; }

                //$thumb = 'na'; //trailingslashit( get_template_directory_uri() ) . $noimage;
                $thumb = THEME_IMAGES_ASSETS . '/general/no-thumbnail.png';
                $w = $max_w;
                $h = $max_h;
        } else {
                $sizes = wp_constrain_dimensions( $thumb[1], $thumb[2], $max_w, $max_h );
                $w = $sizes[0];
                $h = $sizes[1];
                $thumb = $thumb[0];
        }

        return array( esc_url( $thumb ), $w, $h );
}

function miss_admin_thumbnail ( $post_id ) {
        $thumbnail = miss_get_admin_thumbnail( $post_id );

        if ( $thumbnail ) {
                printf(
                        '<a style="width: 100%%; text-align: center; display: block;" href="post.php?post=%d&action=edit" title=""><img src="%s" width="%d" height="%d" alt=""/></a>',
                        $post_id, $thumbnail[0], $thumbnail[1], $thumbnail[2]
                );
        }
}
