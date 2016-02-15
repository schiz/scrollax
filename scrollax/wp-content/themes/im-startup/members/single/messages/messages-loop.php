<?php  do_action( 'bp_before_member_messages_loop' ) ?>

<?php  if ( bp_has_message_threads() ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<h4 class="pag-count" id="messages-dir-count"><span>
			<?php  bp_messages_pagination_count() ?>
		</span></h4>

		<div class="pagination-links" id="messages-dir-pag">
			<?php  bp_messages_pagination() ?>
		</div>

	</div><!-- .pagination -->

	<?php  do_action( 'bp_after_member_messages_pagination' ) ?>
	<?php  do_action( 'bp_before_member_messages_threads' ) ?>

	<table id="message-threads" class="forum">
		<?php  while ( bp_message_threads() ) : bp_message_thread(); ?>

			<tr id="m-<?php  bp_message_thread_id() ?>"<?php  if ( bp_message_thread_has_unread() ) : ?> class="unread"<?php  else: ?> class="read"<?php  endif; ?>>
				<td width="1%" class="thread-count">
					<span class="unread-count"><?php  bp_message_thread_unread_count() ?></span>
				</td>
				<td class="thread-avatar"><?php  bp_message_thread_avatar() ?></td>

				<?php  if ( 'sentbox' != bp_current_action() ) : ?>
					<td class="thread-from">
						<?php  //_e( 'From:', 'buddypress' ); ?> <?php  bp_message_thread_from() ?>

					</td>
				<?php  else: ?>
					<td class="thread-from">
						<?php  //_e( 'To:', 'buddypress' ); ?> <?php  bp_message_thread_to() ?><br />
					</td>
				<?php  endif; ?>

				<td width="50%" class="thread-info">
					<p><a href="<?php  bp_message_thread_view_link() ?>" title="<?php  _e( "View Message", "buddypress" ); ?>"><?php  bp_message_thread_subject() ?></a><br />
					<span class="activity item_meta"><?php  bp_message_thread_last_post_date() ?></span><br />
					<?php  //bp_message_thread_excerpt() ?></p>
				</td>

				<?php  do_action( 'bp_messages_inbox_list_item' ) ?>

				<td width="13%" class="thread-options">
					<input type="checkbox" name="message_ids[]" value="<?php  bp_message_thread_id() ?>" />
					<a class="confirm" href="<?php  bp_message_thread_delete_link() ?>" title="<?php  _e( "Delete Message", "buddypress" ); ?>"></a> &nbsp;
				</td>
			</tr>

		<?php  endwhile; ?>
	</table><!-- #message-threads -->

	<div class="messages-options-nav">
		<?php  bp_messages_options() ?>
	</div><!-- .messages-options-nav -->

	<?php  do_action( 'bp_after_member_messages_threads' ) ?>

	<?php  do_action( 'bp_after_member_messages_options' ) ?>

<?php  else: ?>

<?php echo do_shortcode('[alertbox1 caption="' . __( 'No messages.', 'buddypress' ) . '" close="true"]' . __( 'Sorry, no messages were found.', 'buddypress' ) . '[/alertbox1]' ); ?>

<?php  endif;?>

<?php  do_action( 'bp_after_member_messages_loop' ) ?>
