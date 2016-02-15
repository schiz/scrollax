<?php
// layout
add_action( 'save_post', 'miss_metabox_albums_layout_options_save' );
add_action( 'save_post', 'miss_metabox_albums_layout_albums_save' );

// post type
add_action( 'save_post', 'miss_gallery_posttype_options_save' );

// metabxes
add_action( 'add_meta_boxes', 'miss_gallery_boxes' );
function miss_gallery_boxes() {
/*
    add_meta_box(
        'gallery-order_options',
        _x( 'Custom gallery options', 'backend albums metabox options', MISS_ADMIN_TEXTDOMAIN ),
        'miss_gallery_posttype_options',
        'miss_gallery',
        'advanced',
		'low'
    );
*/
    add_meta_box(
        'gallery-admin',
        _x( 'Gallery Files', 'backend albums metabox uploader', MISS_ADMIN_TEXTDOMAIN ),
        'miss_gallery_admin_box',
        'miss_gallery',
        'advanced',
        'high'
    );
    add_meta_box(
        'gallery-admin',
        _x( 'Gallery Files', 'backend albums metabox uploader', MISS_ADMIN_TEXTDOMAIN ),
        'miss_gallery_admin_box',
        'portfolio',
        'advanced',
        'high'
    );
    add_meta_box(
        'gallery-admin',
        _x( 'Additional gallery for this post', 'backend albums metabox uploader', MISS_ADMIN_TEXTDOMAIN ),
        'miss_gallery_admin_box',
        'post',
        'advanced',
        'high'
    );

/*
		
	add_meta_box( 
        'miss_page_box-albums_list',
        _x( 'Display Albums:', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN ),
        'miss_metabox_albums_layout_albums',
        'page',
        'normal',
        'core'
    );

	add_meta_box(
        'miss_page_box-albums_options',
        _x( 'Albums Settings', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN ),
        'miss_metabox_albums_layout_options',
        'page',
		'normal',
		'core'
   );
*/
}

// layout
/*
function miss_metabox_albums_layout_options( $post = null ) {
	$box_name = 'miss_albums_layout_options';
	
    $defaults = array(
        'layout'			=> '2_col-list',
        'thumb_height'		=> '',
		'ppp'       		=> '',
		'orderby'   		=> 'date',
        'order'     		=> 'DESC',
		// advanced
		'show_title'		=> 'on',
		'show_grid_text'	=> 'on',
        'show_excerpt'      => 'on',
		'show_all_pages'	=> 'off',
		'show_cat_filter'	=> 'on',
		'show_layout_swtch'	=> 'on',
		'show_category'		=> 'on'
    );
	
	// if no post
	if ( empty( $post ) ) { return $defaults; }
	
    $opts = get_post_meta( $post->ID, '_' . $box_name, true );
    $opts = wp_parse_args( maybe_unserialize( $opts ), $defaults );
    
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), $box_name. '_nonce' );
	
	$layout = array(
		'2_col-list'	=> array(
			'desc'	=> _x('Two cols list', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
			'img'	=> array('list-2cols.png', 72, 49)
		),
		'2_col-grid'	=> array(
			'desc'	=> _x('Two cols grid', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
			'img'	=> array('grid-2cols.png', 72, 49)
		),
		'3_col-list'	=> array(
			'desc'	=> _x('Three cols list', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
			'img'	=> array('list-3cols.png', 72, 49)
		),
		'3_col-grid'	=> array(
			'desc'	=> _x('Three cols grid', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
			'img'	=> array('grid-3cols.png', 72, 49)
		)
	);
	
	$radio_on_off = array(
		'on'	=> array( 'desc' => _x('on', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) ),
		'off'	=> array( 'desc' => _x('off', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) )
	);
	
	$adv_opts = array(
		'show_title'		=> array(
			'desc'	=> _x( 'Show projects titles', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_excerpt'		=> array(
			'desc'	=> _x( 'Show projects excerpts', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_category'		=> array(
			'desc'	=> _x( 'Show projects categories', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_grid_text'	=> array(
			'desc'	=> _x( 'Show text areas in grid layout', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_all_pages'	=> array(
			'desc'	=> _x( 'Show all pages in paginator', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_cat_filter'	=> array(
			'desc'	=> _x( 'Show categories filter', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		),
		'show_layout_swtch'	=> array(
			'desc'	=> _x( 'Show layout switcher', 'backend portfolio layout', MISS_ADMIN_TEXTDOMAIN ),
			'ptrn'	=> $radio_on_off
		)
	);
	
	echo '<p><strong>' . _x('Albums layout', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) . '</strong></p>';
	echo '<div class="miss_radio-img">';
	
	foreach( $layout as $val=>$data ) {
		$image = '';
		if( isset($data['img']) ) {
			$image = sprintf(
				'<img src="%1$s/%3$s" class="hide-if-no-js" width="%4$s" height="%5$s" style="background-image:url(%1$s/%2$s)" /><br />',
				esc_url(get_template_directory_uri() . '/production/images/admin'), esc_attr($data['img'][0]), 'blank.gif', $data['img'][1], $data['img'][2] 
			);
		}
		echo miss_melement( 'radio', array(
			'name'			=> $box_name . '_layout',
			'description'	=> $data['desc'],
			'checked'		=> $val == $opts['layout']?true:false,
			'value'			=> $val,
			'wrap'			=> '<label>'.$image.'%1$s %2$s</label>'
		) );
	}
	
	echo '</div>';
	
	echo '<div class="miss_hr"></div>';
	
	echo '<p><strong>' . _x( 'Thumbnail height', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN ) . '</strong></p>';
	echo miss_melement( 'text', array(
		'name'			=> $box_name . '_thumb_height',
		'description'	=> _x('(in pixels). If not specified, default value will be taken.', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
		'value'			=> $opts['thumb_height'],
		'wrap'			=> '<p>%1$s <em>%2$s</em></p>'
	) );
	
	echo '<div class="miss_hr"></div>';
	
	echo miss_melement( 'text', array(
		'name'			=> $box_name . '_ppp',
		'description'	=> _x('Number of photo albums to display on one page', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
		'value'			=> $opts['ppp'],
		'wrap'			=> '<p><strong>%2$s</strong></p><p>%1$s</p>'
	) );
	
	echo '<div class="miss_hr"></div>';
	echo '<p><strong>' . _x('Ordering settings', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) . '</strong></p>';
	miss_core_mb_draw_order_options( array( 'box_name' => $box_name, 'order_current' => $opts['order'], 'orderby_current' => $opts['orderby'] ) );
	
	printf( '<div class="hide-if-no-js"><div class="miss_hr"></div><p><a href="#advanced-options" class="miss_advanced">
			<input type="hidden" name="%1$s" data-name="%1$s" value="hide" />
			<span class="miss_advanced-show">%2$s</span>
			<span class="miss_advanced-hide">%3$s</span> 
			%4$s
		</a></p></div>',
		'miss_albums-advanced',
		_x('+ Show', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
		_x('- Hide', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN),
		_x('advanced settings', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) );
	
	echo '<div class="miss_albums-advanced miss_container hide-if-js"><div class="miss_hr"></div>';

		$last_opt = end( array_keys( $adv_opts ) );
		foreach ( $adv_opts as $name=>$data ) {
			echo '<p class="miss_switcher-box"><strong>' . $data['desc'] . '</strong>';
			miss_core_mb_draw_radio_switcher( "{$box_name}_{$name}", $opts[ $name ], $data['ptrn'] );
			echo '</p>';
			
			if( $last_opt == $name ) continue;
			
			echo '<div class="miss_hr"></div>';
		}
	
	echo '</div>';
}
*/

function miss_metabox_albums_layout_options_save( $post_id ) {
	$box_name = 'miss_albums_layout_options';
	// verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if ( !isset( $_POST[$box_name. '_nonce'] ) || !wp_verify_nonce( $_POST[$box_name. '_nonce'], plugin_basename( __FILE__ ) ) )
        return;

  
    // Check permissions
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
    
    $mydata = null;
	
	$opts = miss_metabox_albums_layout_options();
	
	foreach ( $opts as $name=>$std ) {
		
		$post_name = "{$box_name}_{$name}";
		
		if ( 'thumb_height' == $name && isset ( $_POST[ $post_name ] ) ) {
			$mydata[ $name ] = '' == $_POST[ $post_name ] ? '' : intval( $_POST[ $post_name ] );
			continue;
		}
		
		if ( isset( $_POST[ $post_name ] ) ) {
			$mydata[ $name ] = esc_attr( $_POST[ $post_name ] );
		}
		
	}
	
    update_post_meta( $post_id, '_' . $box_name, $mydata );
}

// albums category
function miss_metabox_albums_layout_albums( $post ) {
    $box_name = 'miss_albums_layout_albums';
    $defaults = array(
        'select'        => 'all',
        'type'          => 'albums',
        'albums'        => array(),
        'albums_cats'   => array()
    );
    $opts = get_post_meta( $post->ID, '_' . $box_name, true );
    $opts = wp_parse_args( maybe_unserialize( $opts ), $defaults );

    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), $box_name. '_nonce' );
    
    $terms = get_terms(
        'miss_gallery_category',
        array(
            'hide_empty'               => true,
            'hierarchical'             => false,
            'pad_counts'               => false
        )
    );

    $select = array(
        'all'       => array( 'desc' => 'All' ),
        'only'      => array( 'desc' => 'only' ),
        'except'    => array( 'desc' => 'except' )
    );

    $type = array(
        'albums'    => array( 'desc' => 'Albums', 'class' => 'type_selector' ),
        'category'  => array( 'desc' => 'Category', 'class' => 'type_selector' )
    );

    $links = array(
        array( 'href' => get_admin_url(). 'post-new.php?post_type=miss_gallery', 'desc' => _x('Add new album', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) ),
        array( 'href' => get_admin_url(). 'edit.php?post_type=miss_gallery', 'desc' => _x('Edit albums', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) ),
        array( 'href' => get_admin_url(). 'edit-tags.php?taxonomy=miss_gallery_category&post_type=miss_gallery', 'desc' => _x('Edit albums categories', 'backend albums layout', MISS_ADMIN_TEXTDOMAIN) )
    );

    $text = array(
        'header'        => sprintf('<h2>%s</h2><p><strong>%s</strong>%s</p><p><strong>%s</strong></p>',
            _x('ALL your Photo albums are being displayed on this page!', 'backend', MISS_ADMIN_TEXTDOMAIN),
            _x('By default all your Photo albums will be displayed on this page. ', 'backend', MISS_ADMIN_TEXTDOMAIN),
            _x('But you can specify which Album(s) or Album category(s) will (or will not) be shown.', 'backend', MISS_ADMIN_TEXTDOMAIN),
            _x('In tabs above you can select from the following options:', 'backend', MISS_ADMIN_TEXTDOMAIN)
        ),
        'select_desc'   => array(
            _x(' &mdash; all Albums will be shown on this page.', 'backend', MISS_ADMIN_TEXTDOMAIN),
            _x(' &mdash; choose Album(s) or Album category(s) to be shown on this page.', 'backend', MISS_ADMIN_TEXTDOMAIN),
            _x(' &mdash; choose which Album(s) or Album category(s) will be excluded from displaying on this page.', 'backend', MISS_ADMIN_TEXTDOMAIN)
        ),
        'info_desc'     => array(
            _x('%d albums', 'backend', MISS_ADMIN_TEXTDOMAIN)
        )
    );

   	$albums = new Wp_Query( 'post_type=miss_gallery&posts_per_page=-1&post_status=publish' );
/*
    miss_core_mb_draw_modern_selector( array(
        'box_name'      => $box_name,
        'albums_name'   => $box_name . '_albums[%d]',
        'cats_name'     => $box_name . '_albums_cats[%d]',
        'links'         => $links,
        'posts'         => $albums->posts,
        'terms'         => $terms,
        'albums'        => $opts['albums'],
        'albums_cats'   => $opts['albums_cats'],
        'cur_type'      => $opts['type'],
        'cur_select'    => $opts['select'],
        'taxonomy'      => 'miss_gallery_category',
        'text'          => $text,
		'maintab_class' => 'miss_all_albums'
    ) );
    */
}

function miss_metabox_albums_layout_albums_save( $post_id ) {
    $box_name = 'miss_albums_layout_albums';
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if ( !isset( $_POST[$box_name. '_nonce'] ) || !wp_verify_nonce( $_POST[$box_name. '_nonce'], plugin_basename( __FILE__ ) ) )
        return;

  
    // Check permissions
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;

    $mydata = null;

    if( !empty($_POST[$box_name. '_select']) ) {
        $mydata['select'] = esc_attr($_POST[$box_name. '_select']);
   	 
        if( isset($_POST[$box_name. '_type']) ) {
            $mydata['type'] = esc_attr($_POST[$box_name . '_type']);
        }

   	    if( isset($_POST[$box_name. '_albums_cats']) ) {
	        $mydata['albums_cats'] = $_POST[$box_name. '_albums_cats'];
	    }
        
        if( isset($_POST[$box_name. '_albums']) ) {
	        $mydata['albums'] = $_POST[$box_name. '_albums'];
	    }
    }

    update_post_meta( $post_id, '_'.$box_name, $mydata );
}

// post type
/*
function miss_gallery_posttype_options( $post ) {
    $box_name = 'miss_gal_p_options';
    $defaults = array(
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'hide_thumbnail'    => false
    );
    $opts = get_post_meta( $post->ID, '_'.$box_name, true );
    $opts = wp_parse_args( maybe_unserialize( $opts ), $defaults );
    
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), $box_name. '_nonce' );
    
    miss_m_optset_hide_thumb( array(
        'hide_thumbnail'    => $opts['hide_thumbnail'],
        'box_name'          => $box_name
    ) );
    miss_m_optset_orderby( array('current' => $opts['orderby'], 'box_name' => $box_name) );
    miss_m_optset_order( array('current' => $opts['order'], 'box_name' => $box_name) );
    
}

*/
function miss_gallery_posttype_options_save( $post_id ) {
    $box_name = 'miss_gal_p_options';
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if ( !isset( $_POST[$box_name. '_nonce'] ) || !wp_verify_nonce( $_POST[$box_name. '_nonce'], plugin_basename( __FILE__ ) ) )
        return;

  
    // Check permissions
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
    
    $mydata = null;

    if( isset($_POST[$box_name. '_orderby']) ) {
        $mydata['orderby'] = $_POST[$box_name. '_orderby'];
    }
    
    if( isset($_POST[$box_name. '_order']) ) {
        $mydata['order'] = $_POST[$box_name. '_order'];
    }
    
    $mydata['hide_thumbnail'] = isset( $_POST[$box_name . '_hide_thumb'] );
    
    update_post_meta( $post_id, '_'.$box_name, $mydata );
}


/**
 * Adding Media Uploader Tab
 *
 * @since 1.7
 */
function miss_gallery_admin_box( $post ) {

    $tab = 'type';
    $args = array(
        'post_type'			=>'attachment',
        'post_status'		=>'inherit',
        'post_parent'		=>$post->ID,
        'posts_per_page'	=>1
    );
    $attachments = new Wp_Query( $args );

    if( !empty($attachments->posts) ) {
        $tab = 'miss_gallery_media';
    }
    
    $u_href = get_admin_url();
    $u_href .= '/media-upload.php?post_id='. $post->ID;
    $u_href .= '&width=670&height=400&miss_custom=1&tab='.$tab;
?>
    <iframe id="st-albums-uploader" src="<?php echo esc_url($u_href); ?>" width="100%" height="560">The Error!!!</iframe>
	<?php //miss_uploader_style_script( 'miss-albums-uploader' ); ?>	
<?php
}

function miss_album_media_form( $errors ) {
    global $redir_tab, $type;

    $redir_tab = 'miss_gallery_media';
    media_upload_header();
    
    $post_id = intval($_REQUEST['post_id']);
    $form_action_url = admin_url("media-upload.php?type=$type&tab=miss_gallery_media&post_id=$post_id");
    $form_action_url = apply_filters('media_upload_form_url', $form_action_url, $type);
    $form_class = 'media-upload-form validate';
    
    if ( get_user_setting('uploader') )
        $form_class .= ' html-uploader';
?>	
    <script type="text/javascript">
    <!--
    jQuery(function($){
        var preloaded = $(".media-item.preloaded");
        if ( preloaded.length > 0 ) {
            preloaded.each(function(){prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');});
            updateMediaForm();
        }
    });
    -->
    </script>
    <div id="sort-buttons" class="hide-if-no-js">
    <span>
    <?php _ex( 'All Tabs:', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?>
    <a href="#" id="showall"><?php _ex( 'Show', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></a>
    <a href="#" id="hideall" style="display:none;"><?php _ex( 'Hide', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></a>
    </span>
    <?php _ex( 'Sort Order:', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?>
    <a href="#" id="asc"><?php _ex( 'Ascending', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></a> |
    <a href="#" id="desc"><?php _ex( 'Descending', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></a> |
    <a href="#" id="clear"><?php _ex( 'Clear', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></a>
    </div>
    <form enctype="multipart/form-data" method="post" action="<?php echo esc_attr($form_action_url); ?>" class="<?php echo $form_class; ?>" id="gallery-form">
    <?php wp_nonce_field('media-form'); ?>
    <?php //media_upload_form( $errors ); ?>
    <table class="widefat" cellspacing="0" style="width: 720px;">
    <thead><tr>
    <th><?php _ex( 'Media', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></th>
    <th class="order-head"><?php _ex( 'Order', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></th>
    <th class="actions-head"><?php _ex( 'Actions', 'backend albums', MISS_ADMIN_TEXTDOMAIN ); ?></th>
    </tr></thead>
    </table>
    <div id="media-items" style="width: 718px">
    <?php add_filter('attachment_fields_to_edit', 'media_post_single_attachment_fields_to_edit', 10, 2); ?>
    <?php $_REQUEST['tab'] = 'gallery'; ?>
    <?php echo get_media_items($post_id, $errors); ?>
    <?php $_REQUEST['tab'] = 'miss_gallery_media';?>
    </div>

    <p class="ml-submit">
    <?php submit_button( _x( 'Save all changes', 'backend albums', MISS_ADMIN_TEXTDOMAIN ), 'button savebutton', 'save', false, array( 'id' => 'save-all', 'style' => 'display: none;' ) ); ?>
    <input type="hidden" name="post_id" id="post_id" value="<?php echo (int) $post_id; ?>" />
    <input type="hidden" name="type" value="<?php echo esc_attr( $GLOBALS['type'] ); ?>" />
    <input type="hidden" name="tab" value="<?php echo esc_attr( $GLOBALS['tab'] ); ?>" />
    </p>
    </form>

	<div style="display: none;">
    <input type="radio" name="linkto" id="linkto-file" value="file" />
    <input type="radio" checked="checked" name="linkto" id="linkto-post" value="post" />
    <select id="orderby" name="orderby">
    	<option value="menu_order" selected="selected"></option>
        <option value="title"></option>
        <option value="post_date"></option>
        <option value="rand"></option>
    </select>
    <input type="radio" checked="checked" name="order" id="order-asc" value="asc" />
    <input type="radio" name="order" id="order-desc" value="desc" />
    <select id="columns" name="columns">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected="selected">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
   	</select>
	</div>
<?php
}

?>
