<?php  do_action( 'bp_before_notices_loop' ) ?>

<?php  if ( bp_has_message_threads() ) : ?>

	<div class="pagination" id="user-pag">

		<h4 class="pag-count" id="messages-dir-count"><span>
			<?php  bp_messages_pagination_count() ?>
		</span></h4>

		<div class="pagination-links" id="messages-dir-pag">
			<?php  bp_messages_pagination() ?>
		</div>

	</div><!-- .pagination -->

	<?php  do_action( 'bp_after_notices_pagination' ) ?>
	<?php  do_action( 'bp_before_notices' ) ?>

	<table id="message-threads" class="forum">
		<?php  while ( bp_message_threads() ) : bp_message_thread(); ?>
			<tr>
				<td width="1%">
				</td>
				<td width="38%">
					<strong><?php  bp_message_notice_subject() ?></strong>
					<?php  bp_message_notice_text() ?>
				</td>
				<td width="21%">
					<strong><?php  bp_message_is_active_notice() ?></strong>
					<span class="activity"><?php  _e("Sent:", "buddypress"); ?> <?php  bp_message_notice_post_date() ?></span>
				</td>

				<?php  do_action( 'bp_notices_list_item' ) ?>

				<td width="10%">
					<a class="button" href="<?php  bp_message_activate_deactivate_link() ?>" class="confirm"><?php  bp_message_activate_deactivate_text() ?></a>
					<a class="button" href="<?php  bp_message_notice_delete_link() ?>" class="confirm" title="<?php  _e( "Delete Message", "buddypress" ); ?>">x</a>
				</td>
			</tr>
		<?php  endwhile; ?>
	</table><!-- #message-threads -->

	<?php  do_action( 'bp_after_notices' ) ?>

<?php  else: ?>

<?php echo do_shortcode('[alertbox1 close="true"]' . __( 'No niteces were found for you.', 'buddypress' ) . '[/alertbox1]' ); ?>

<?php  endif;?>

<?php  do_action( 'bp_after_notices_loop' ) ?>
