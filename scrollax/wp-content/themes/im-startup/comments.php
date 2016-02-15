<?php
/**
 * Comments Template
 *
 * @package IrishMiss
 * @package Radiostation
 */
	if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die( __( 'Please do not load this page directly.', MISS_TEXTDOMAIN ) );
	if ( !post_type_supports( get_post_type(), 'comments' ) || ( !have_comments() && !comments_open() && !pings_open() ) )
		return;
	if ( post_password_required() ) : ?>
		<h3 class="comments-header"><?php _e( 'Password Protected', MISS_TEXTDOMAIN ); ?></h3>
		<p class="alert password-protected">
			<?php _e( 'Enter the password to view comments.', MISS_TEXTDOMAIN ); ?>
		</p><!-- .alert .password-protected -->
		<?php return; ?>
	<?php endif; ?>
    <div class="span8 post-comments">
    <?php if ( have_comments() ) : ?>
			<?php miss_comment_list(); ?>
    <?php endif; ?>
    <div class="form">
    <?php
    $fields =  array(  
        'author' => '<div class="inputs"><div class="text-field-wrapper input">' . '<div class="field-label required">' . __( 'Name' ) . '</div> ' .  
                    '<input id="author" class="text-field placeholder" name="author" type="text" pattern="^[A-Za-zÀ-ßà-ÿ¨¸\s]+$" required  data-val="" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',  
        'email'  => '<div class="text-field-wrapper input"><div class="field-label required">' . __( 'Email' ) . '</div> ' .  
                    '<input id="email" class="text-field placeholder" data-val="" name="email" type="email" pattern="[^ @]*@[^ @]*" required value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',  
        'url'    => '<div class="text-field-wrapper input"><div class="field-label required">' . __( 'Website' ) . '</div>' .  
                    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" class="text-field placeholder" data-val="" /></div></div>'
    );
    
    ?>
    <?php comment_form(array('fields' => apply_filters( 'comment_form_default_fields', $fields ), 'comment_field' => '<div class="text-field-wrapper textarea">' .
		'<div class="field-label">Your Message...</div>' .
		'<textarea id="comment" name="comment" aria-required="true" required class="text-field placeholder" data-val=""></textarea>' .
		'</div><!-- #form-section-comment .form-section -->',
        'comment_notes_after' => '<div class="aside"><i class="marker required">*</i> Please fill in all required fields</div>',
        'id_submit' => 'submit-article-comment' )); ?>
    </div>
    </div><!-- #comments -->
<?php miss_after_comments(); ?>