<?php  do_action( 'bp_before_group_request_membership_content' ) ?>

<?php  if ( !bp_group_has_requested_membership() ) : ?>
	<p><?php  printf( __( "You are requesting to become a member of the group '%s'.", "buddypress" ), bp_group_name( false, false ) ); ?></p>

	<form action="<?php  bp_group_form_action('request-membership') ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">
		<label for="group-request-membership-comments"><?php  _e( 'Comments (optional)', 'buddypress' ); ?></label>
		<textarea name="group-request-membership-comments" id="group-request-membership-comments" class="textarea input-wrap expand"></textarea>

		<?php  do_action( 'bp_group_request_membership_content' ) ?>

		<p><input type="submit" name="group-request-send" id="group-request-send" class="button_link small_button" value="<?php  _e( 'Send Request', 'buddypress' ) ?> &rarr;" />

		<?php  wp_nonce_field( 'groups_request_membership' ) ?>
	</form>
<?php  endif; ?>

<?php  do_action( 'bp_after_group_request_membership_content' ) ?>
