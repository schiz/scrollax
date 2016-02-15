<?php
    if ( !get_post_type() ) {
        $_post_type = 'page';
    } else {
        $_post_type = get_post_type();
    }
    get_template_part( 'framework/views/single/single', $_post_type );
?>