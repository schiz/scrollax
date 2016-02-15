<?php

if ( !function_exists( 'miss_comment_tab' ) ) :
/**
 *
 */
function miss_comment_tab() {
	global $post;
	$get_comments = get_comments( 'post_id=' . $post->ID );
	$separate_comments = separate_comments( $get_comments );
	$comments_by_type = &$separate_comments;

?><div class="blog_tabs_container">

		<ul class="blog_tabs">
			<li><a href="#" class="current"><?php
			printf( _n( '%1$s Comment', '%1$s Comments', count( $comments_by_type['comment'] ), MISS_TEXTDOMAIN ),
			number_format_i18n( count( $comments_by_type['comment'] ) ) );
			?></a></li>
			<li><a href="#" class=""><?php
			printf( _n( '%1$s Trackback', '%1$s Trackback', count( $comments_by_type['pings'] ), MISS_TEXTDOMAIN ),
			number_format_i18n( count( $comments_by_type['pings'] ) ) );
			?></a></li>
			<div class="clearboth"></div>
		</ul><!-- .blog_tabs -->

		<div class="blog_tabs_content">
			<ol class="commentlist">
				<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'miss_comments_callback' ) ); ?>
			</ol>

			<?php if ( get_option( 'page_comments' ) ) : ?>
				<div class="comment-navigation paged-navigation">
					<?php paginate_comments_links( miss_portfolio_comment_url( $nav = true ) ); ?>
				</div><!-- .comment-navigation -->
			<?php endif; ?>

		</div><!-- .blog_tabs_content -->

		<div class="blog_tabs_content">
			<ol class="commentlist trackbacks_pingbacks">
				<!-- <?php trackback_url(); ?> -->
				<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'miss_pings_callback' ) ); ?>
			</ol>
		</div><!-- .blog_tabs_content -->

	</div><!-- .blog_tabs_container -->

<?php		
}
endif;

if ( !function_exists( 'miss_comment_list' ) ) :
/**
 *
 */
function miss_comment_list() {
//echo apply_filters( 'miss_comments_title', '<h3 id="comments-title">' . sprintf( _n( '1 Comment', '%1$s Comments', get_comments_number(), MISS_TEXTDOMAIN ), number_format_i18n( get_comments_number() ), get_the_title() ) . '</h3>', array( 'comments_number' => get_comments_number(), 'title' =>  get_the_title() ) );

?><div class="comments">
		<?php wp_list_comments( array( 'type' => 'all', 'walker' => new zipGun_walker_comment ) ); ?>
	</div>

	<?php if ( get_option( 'page_comments' ) ) : ?>
		<div class="comment-navigation paged-navigation">
			<?php paginate_comments_links( miss_portfolio_comment_url( $nav = true ) ); ?>
		</div><!-- .comment-navigation -->
	<?php endif; ?>

<?php
}
endif;

/** COMMENTS WALKER */
class zipGun_walker_comment extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>
         
        <div class="leave-title"><?php _e('COMMENTS', MISS_TEXTDOMAIN) ?>:</div>
        <div class="comments">
         
    <?php }
     
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
    <?php }
 
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
         
    <?php }
     
    /** START_EL */
    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment; 
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
         
        <div <?php comment_class( $parent_class.' level'.$depth ); ?> id="comment-<?php comment_ID() ?>">
            <div class="icon"><?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, 120 ) :'' ); ?></div>
            <div id="comment-body-<?php comment_ID() ?>" class="comment-body">
                <div class="comment-header">
                    <div class="wrapper">
                        <div class="comment-author"><?php echo get_comment_author_link(); ?></div>
                        <div class="comment-date"><?php comment_date(); ?></div>
                    </div>
                </div>
 
                <div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
                    <?php if( !$comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
                     
                    <?php else: comment_text(); ?>
                    <?php endif; ?>
                </div><!-- /.comment-content -->
 
                <div class="comment-meta comment-meta-data">
                    <?php edit_comment_link( '(Edit)' ); ?>
                </div><!-- /.comment-meta -->
 
                <div class="butt-container">
                    <?php $reply_args = array(
                        'add_below' => $add_below, 
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'] );
     
                    echo str_replace('comment-reply-link', 'btn ribbon-style smallest-ribbon',  get_comment_reply_link( array_merge( $args, $reply_args ) ));  ?>
                </div><!-- /.reply -->
            </div><!-- /.comment-body -->
            </div>
 
    <?php }
 
    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
         
         
    <?php }
     
    /** DESTRUCTOR
     * I'm just using this since we needed to use the constructor to reach the top 
     * of the comments list, just seems to balance out nicely:) */
    function __destruct() { ?>
     
    </div><!-- /#comment-list -->
 
    <?php }
}

if ( !function_exists( 'miss_comments_callback' ) ) :
/**
 *
 */
function miss_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$comment_type = get_comment_type( $comment->comment_ID );
	$author = esc_html( get_comment_author( $comment->comment_ID ) );
	$url = esc_url( get_comment_author_url( $comment->comment_ID ) );
	$default_avatar = ( 'pingback' == $comment_type || 'trackback' == $comment_type )
	? THEME_IMAGES_ASSETS . "/avatars/default-avatar03.png"
	: THEME_IMAGES_ASSETS . '/avatars/default-avatar.png';

	?>
		<div id="div-comment-<?php comment_ID() ?>"><?php

		/* Display gravatar */
		$avatar = get_avatar( get_comment_author_email( $comment->comment_ID ), apply_filters( "miss_avatar_size", '80' ), $default_avatar, $author );

		if ( $url )
			$avatar = '<a href="' . esc_url( $url ) . '" rel="external nofollow" title="' . esc_attr( $author ) . '">' . $avatar . '</a>';

		echo $avatar;

		?><div class="comment-text"><?php

		/* Display link and cite if URL is set. */
		if ( $url )
			echo '<cite class="fn" title="' . esc_url( $url ) . '"><a href="' . esc_url( $url ) . '" title="' . esc_attr( $author ) . '" class="url" rel="external nofollow">' . $author . '</a></cite>';
		else
			echo '<cite class="fn">' . $author . '</cite>';

		/* Display comment date */
		?><span class="date"><?php printf( __('%1$s', MISS_TEXTDOMAIN ), get_comment_date( __( apply_filters( "miss_comment_date_format", 'm-d-Y' ) ) ) ); ?></span>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p class="alert moderation"><?php _e( 'Your comment is awaiting moderation.', MISS_TEXTDOMAIN ); ?></p>
				<?php endif; ?>

				<?php comment_text() ?>

				<div class="comment-meta commentmetadata"><?php
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					edit_comment_link( __( 'Edit', MISS_TEXTDOMAIN ), ' ' );
				?></div>

			</div><!-- .comment-text -->

		</div><!-- #div-comment-## -->
<?php
}
endif;

if ( !function_exists( 'miss_pings_callback' ) ) :
/**
 *
 */
function miss_pings_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?><li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<cite><?php comment_author_link() ?></cite><span class="date"><?php comment_date('m-d-y'); ?></span><br />
<?php	
}
endif;

if ( !function_exists( 'miss_comment_form_args' ) ) :
/**
 *
 */
function miss_comment_form_args( $args ) {
	global $user_identity;

	$commenter = wp_get_current_commenter();
	$req = ( ( get_option( 'require_name_email' ) ) ? ' <span class="required">' . __( '*', MISS_TEXTDOMAIN ) . '</span> ' : '' );
		
	$fields = array(
		'redirect_to' => ( is_singular( 'portfolio' ) ? '<input type="hidden" name="redirect_to" value="' . miss_portfolio_comment_url() . '" />' : '' ),
		'author' => '<div class="row-fluid"><div class="span4 form-author"><input type="text" class="span12" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="auto" tabindex="1" placeholder="' . __( 'Name *', MISS_TEXTDOMAIN ) . '" /></div>',
		'email' => '<div class="span4 form-email"><input type="text" class="span12" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="auto" tabindex="2" placeholder="' . __( 'Email *', MISS_TEXTDOMAIN ) . '"/></div>',
		'url' => '<div class="span4 form-url"><input type="text" class="span12" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="auto" tabindex="3" placeholder="' . __( 'Website', MISS_TEXTDOMAIN ) . '"/></div></div>'
	);

	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<div class="form-textarea row-fluid"><textarea name="comment" class="span12" id="comment" cols="60" rows="10" tabindex="4"></textarea></div>',
		'must_log_in' => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', MISS_TEXTDOMAIN ), wp_login_url( get_permalink() ) ) . '</p><!-- .alert -->',
		'logged_in_as' => '<p class="log-in-out">' . sprintf( __( 'Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', MISS_TEXTDOMAIN ), admin_url( 'profile.php' ), $user_identity ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . __( 'Log out of this account', MISS_TEXTDOMAIN ) . '">' . __( 'Log out &rarr;', MISS_TEXTDOMAIN ) . '</a></p><!-- .log-in-out -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Reply', MISS_TEXTDOMAIN ),
		'title_reply_to' => __( 'Leave a Reply to %s', MISS_TEXTDOMAIN ),
		'cancel_reply_link' => __( 'Click here to cancel reply.', MISS_TEXTDOMAIN ),
		'label_submit' => __( 'SUBMIT', MISS_TEXTDOMAIN ),
	);

	return $args;
}
endif;


?>