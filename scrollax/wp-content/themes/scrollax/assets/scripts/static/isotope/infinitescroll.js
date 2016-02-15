var infinite_scroll = {
        loading: {
            img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
            msgText: "<?php _e( 'Loading the next set of posts...', 'custom' ); ?>",
            finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
        },
        "nextSelector":".auto-more a",
        "navSelector":".auto-more",
        "itemSelector":".container-isotope",
        "contentSelector":"#l1"
};

// jQuery('#l1').infinitescroll({
//                 navSelector     : ".auto-more",
//                 nextSelector    : ".auto-more a",
//                 itemSelector    : ".container-isotope"
//                 //              prefill                 : true,
//                 //              path: ["http://nuvique/infinite-scroll/test/index", ".html"]
//                 //path: function(index) {
//                 //        return "index" + index + ".html";
//                 //}
//                 // behavior             : 'twitter',
//                 // appendCallback       : false, // USE FOR PREPENDING
//                 // pathParse            : function( pathStr, nextPage ){ return pathStr.replace('2', nextPage ); }
// });
/*
    , function(newElements, data, url){
        //USE FOR PREPENDING
        // $(newElements).css('background-color','#ffef00');
        // $(this).prepend(newElements);
        //
        //END OF PREPENDING

//      window.console && console.log('context: ',this);
//      window.console && console.log('returned: ', newElements);

    });
*/