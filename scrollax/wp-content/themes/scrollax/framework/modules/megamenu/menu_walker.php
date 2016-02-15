<?php
/**
 * @package nav-mega-menu
 * @version 0.1.0
 */

/*
 * Saves new field to postmeta for navigation
*/
add_action('wp_update_nav_menu_item', 'miss_nav_update',10, 3);
function miss_nav_update($menu_id, $menu_item_db_id, $args ) {
    $options_array = array(
        'parent-id',
        'disable_text',
        'disable_link',
        'disable_icon',
        'disable_teaser',
        'menu_item_icon',
        'submenu_disable_left_floating',
        'submenu_disable_icons',
        'submenu_enable_full_width',
        'submenu_type',
        'submenu_columns',
        'submenu_custom_content',
    );    
    foreach ( $options_array as $value ) {
        if ( isset ($_REQUEST['menu-item-' . $value][$menu_item_db_id] ) && is_array($_REQUEST['menu-item-' . $value]) ) {
            $variable = $_REQUEST['menu-item-' . $value][$menu_item_db_id];
            if ( $_REQUEST['menu-item-parent-id'][$menu_item_db_id] != '0' && substr_count( $value, 'submenu' ) ) {
                $variable = '';
            }
            update_post_meta( $menu_item_db_id, '_miss_' . $value, $variable );
        } else {
            update_post_meta( $menu_item_db_id, '_miss_' . $value, '' );
        }
    }
}
add_filter( 'wp_setup_nav_menu_item','miss_nav_item' );
function miss_nav_item($item) {
    $options_array = array(
        'disable_text',
        'disable_link',
        'disable_icon',
        'disable_teaser',
        'menu_item_icon',
        'submenu_disable_left_floating',
        'submenu_disable_icons',
        'submenu_enable_full_width',
        'submenu_type',
        'submenu_columns',
        'submenu_custom_content',
    );    
    foreach ( $options_array as $value ) {
        if ( get_post_meta( $item->ID, '_miss_' . $value, true ) != false && get_post_meta( $item->ID, '_miss_' . $value, true ) != '' ) {
            $item->$value = get_post_meta( $item->ID, '_miss_' . $value, true );
        }
    }
    return $item;
}

add_filter( 'wp_edit_nav_menu_walker', 'miss_walker_nav_menu_edit',10,2 );
function miss_walker_nav_menu_edit($walker,$menu_id) {
    return 'Miss_Walker_Nav_Menu_Edit';
}


/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Miss_Walker_Nav_Menu_Edit extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl( &$output, $depth = 0, $args = array() ) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl( &$output, $depth = 0, $args = array() ) {
}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
        if ( is_wp_error( $original_title ) )
            $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = $original_object->post_title;
    }

    $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        $title = sprintf( __( '%s (Invalid)', MISS_ADMIN_TEXTDOMAIN ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        $title = sprintf( __('%s (Pending)', MISS_ADMIN_TEXTDOMAIN ), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', MISS_ADMIN_TEXTDOMAIN); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', MISS_ADMIN_TEXTDOMAIN); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', MISS_ADMIN_TEXTDOMAIN); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php _e( 'Edit Menu Item', MISS_ADMIN_TEXTDOMAIN ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation label', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e( 'Alternative title teaser attribute', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php _e( 'Open link in a new window/tab', MISS_ADMIN_TEXTDOMAIN ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e( 'CSS class (optional)', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e( 'Link relationship (XFN)', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>

            <p class="field-disable_text description description-wide">
                <label for="edit-menu-item-disable_text-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-disable_text-<?php echo $item_id; ?>" class="code edit-menu-item-disable_text" name="menu-item-disable_text[<?php echo $item_id; ?>]" value="1" <?php checked( $item->disable_text, '1' ); ?> />
                    <?php _e( 'Disable text', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-disable_link description description-wide">
                <label for="edit-menu-item-disable_link-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-disable_link-<?php echo $item_id; ?>" class="code edit-menu-item-disable_link" name="menu-item-disable_link[<?php echo $item_id; ?>]" value="1" <?php checked( $item->disable_link, '1' ); ?> />
                    <?php _e( 'Disable link', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-disable_icon description description-wide">
                <label for="edit-menu-item-disable_icon-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-disable_icon-<?php echo $item_id; ?>" class="code edit-menu-item-disable_icon" name="menu-item-disable_icon[<?php echo $item_id; ?>]" value="1" <?php checked( $item->disable_icon, '1' ); ?> />
                    <?php _e( 'Disable icon', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-disable_teaser description description-wide">
                <label for="edit-menu-item-disable_teaser-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-disable_teaser-<?php echo $item_id; ?>" class="code edit-menu-item-disable_teaser" name="menu-item-disable_teaser[<?php echo $item_id; ?>]" value="1" <?php checked( $item->disable_teaser, '1' ); ?> />
                    <?php _e( 'Disable teaser', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-menu_item_icon description description-wide">

<?php
    $out = '<div class="miss_option_set icons_option_set">';

    $icon = $item->menu_item_icon;
    // $icon = ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlentities'] )
    //     ? stripslashes(htmlentities( $this->saved_options[$value['id']] ) ) : ( isset( $this->saved_options[$value['id']] ) && isset( $value['htmlspecialchars'] )
    //     ? stripslashes(htmlspecialchars( $this->saved_options[$value['id']] ) )
    //     : ( isset( $this->saved_options[$value['id']] ) ? stripslashes( $this->saved_options[$value['id']] ) : ( isset( $value['default'] ) ? $value['default'] : '' ) ) ) );
    $out .= '<div class="miss_option_header">';
    $out .= '<h3 class="description description-wide">' . __('Override Icon', MISS_ADMIN_TEXTDOMAIN ) . '</h3>';
    $out .= '<p>' . __('Start typing to find required icons.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';
    $out .= '<form class="im-filter-icons" action="#">';
    $out .= '<input autocomplete="off" style="width: 97%" size="60" placeholder="' . __('Search an icon', MISS_ADMIN_TEXTDOMAIN ) . '..." type="text" class="page-composer-icon-filter" value="" name="icon-filter-by-name" />';
    $out .= '</form>';
    $out .= '</div>';
    $out .= '<div class="miss_option">';
    $out .= '<p>' . __('Select one icon from a list.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';
    $out .= '<div class="btn-group" style="width:97%;"><a style="text-decoration: none;" href="#" class="btn im-toggle-icons">' . __('Show Icons', MISS_ADMIN_TEXTDOMAIN ) . '</a><a class="btn disabled im-icon-preview"><i class="' . $icon . '">&nbsp;</i></a></div>';
    $out .= '<div class="im-visual-selector im-font-icons-wrapper" style="display: none; max-width: 580px;">';
    $out .= '<div class="icons-list"></div>';

    // $icons = miss_get_all_font_icons();
    //    foreach ( $icons as $key => $option ) {
    //     if($key) {
    //          $out .= '<a class="im_icon_selector im_' . $key . '" href="#" title="Class: '.$key.'" rel="'.$key.'"><i class="'.$key.'" ></i><span class="hidden">' . $key .'</span></a>';
    //        } else {
    //            $out .= '<a class="im-no-icon" href="#" rel="">x</a>';
    //        }
    //    }

    $out .= '<input name="menu-item-menu_item_icon[' . $item_id . ']" class="icon_field wpb_vc_param_value" type="hidden" value="'.$icon.'" />';
    $out .= '</div>';
    $out .= '</div>';
    $out .= '</div><!-- icons_option_set -->';
echo $out;
?>

<!--                 <label for="edit-menu-item-menu_item_icon-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-menu_item_icon-<?php echo $item_id; ?>" class="code edit-menu-item-menu_item_icon" name="menu-item-menu_item_icon[<?php echo $item_id; ?>]" value="1" <?php checked( $item->menu_item_icon, '1' ); ?> />
                    <?php _e( 'Icon', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
 --> 
            </p>

        <div class="submenu_variables">
            <h3 class="field-submenu_settings submenu_settings description description-wide" style="text-align: left;">
                <?php _e( 'Submenu elements options', MISS_ADMIN_TEXTDOMAIN ); ?><br />
            </h3>

            <p class="field-submenu_disable_left_floating submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_disable_left_floating-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-submenu_disable_left_floating-<?php echo $item_id; ?>" class="code edit-menu-item-submenu_disable_left_floating" name="menu-item-submenu_disable_left_floating[<?php echo $item_id; ?>]" value="1" <?php checked( $item->submenu_disable_left_floating, '1' ); ?> />
                    <?php _e( 'Align submenu element to right edge', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-submenu_disable_icons submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_disable_icons-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-submenu_disable_icons-<?php echo $item_id; ?>" class="code edit-menu-item-submenu_disable_icons" name="menu-item-submenu_disable_icons[<?php echo $item_id; ?>]" value="1" <?php checked( $item->submenu_disable_icons, '1' ); ?> />
                    <?php _e( 'Disable submenu icons', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

            <p class="field-submenu_enable_full_width submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_enable_full_width-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-submenu_enable_full_width-<?php echo $item_id; ?>" class="code edit-menu-item-submenu_enable_full_width" name="menu-item-submenu_enable_full_width[<?php echo $item_id; ?>]" value="1" <?php checked( $item->submenu_enable_full_width, '1' ); ?> />
                    <?php _e( 'Enable full width submenu', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                </label>
            </p>

           <p class="field-submenu_type submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_type-<?php echo $item_id; ?>">
                    <?php _e( 'Submenu layout type', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <select id="edit-menu-item-submenu_type-<?php echo $item_id; ?>" class="widefat code edit-menu-item-submenu_type" name="menu-item-submenu_type[<?php echo $item_id; ?>]">
                        <option value="std_dropdown" <?php selected( $item->submenu_type, 'std_dropdown' ); ?>><?php _e( 'Single column (default)', MISS_ADMIN_TEXTDOMAIN  ); ?></option>
                        <option value="multicolumn_dropdown" <?php selected( $item->submenu_type, 'multicolumn_dropdown' ); ?>><?php _e( 'Multi column', MISS_ADMIN_TEXTDOMAIN ); ?></option>
                        <option value="static_dropdown" <?php selected( $item->submenu_type, 'static_dropdown' ); ?>><?php _e( 'Custom text', MISS_ADMIN_TEXTDOMAIN ); ?></option>
                        <option value="recent_posts_dropdown" <?php selected( $item->submenu_type, 'recent_posts_dropdown' ); ?>><?php _e( 'Recent posts grid', MISS_ADMIN_TEXTDOMAIN ); ?></option>
                        <option value="pages_gallery_dropdown" <?php selected( $item->submenu_type, 'pages_gallery_dropdown' ); ?>><?php _e( 'Pages gallery grid (sub-pages required)', MISS_ADMIN_TEXTDOMAIN ); ?></option>
                    </select>
                </label>
            </p>

            <p class="field-submenu_columns submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_columns-<?php echo $item_id; ?>">
                    <?php _e( 'Submenu columns (only full with submenu)', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <select id="edit-menu-item-submenu_columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-submenu_columns" name="menu-item-submenu_columns[<?php echo $item_id; ?>]">
                        <option value="2" <?php selected( $item->submenu_columns, '2' ); ?>>2</option>
                        <option value="3" <?php selected( $item->submenu_columns, '3' ); ?>>3</option>
                        <option value="4" <?php selected( $item->submenu_columns, '4' ); ?>>4</option>
                        <option value="6" <?php selected( $item->submenu_columns, '6' ); ?>>6</option>
                        <option value="8" <?php selected( $item->submenu_columns, '8' ); ?>>8</option>
                        <option value="10" <?php selected( $item->submenu_columns, '10' ); ?>>10</option>
                        <option value="12" <?php selected( $item->submenu_columns, '12' ); ?>>12</option>
                    </select>
                </label>
            </p>

            <p class="field-submenu_custom_content submenu_settings description description-wide">
                <label for="edit-menu-item-submenu_custom_content-<?php echo $item_id; ?>">
                    <?php _e( 'Custom content (shorcodes supported ONLY FOR flexible and full width submenu)', MISS_ADMIN_TEXTDOMAIN ); ?><br />
                    <textarea id="edit-menu-item-submenu_custom_content-<?php echo $item_id; ?>" class="widefat code edit-menu-item-submenu_custom_content" name="menu-item-submenu_custom_content[<?php echo $item_id; ?>]"><?php echo esc_attr( $item->submenu_custom_content ); ?></textarea>
                </label>
            </p>

        </div><!-- /.submenu_variables -->

            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s', MISS_ADMIN_TEXTDOMAIN), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php _e('Remove', MISS_ADMIN_TEXTDOMAIN); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', MISS_ADMIN_TEXTDOMAIN); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- /.menu-item-settings-->
        <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
    }
}

?>