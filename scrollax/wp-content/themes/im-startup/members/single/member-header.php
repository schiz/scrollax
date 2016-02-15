<?php  do_action( 'bp_before_member_header' ) ?>
<div class="row-fluid">

	<div id="item-header-avatar" class="blog_index_image_load span2">
		<a href="<?php  bp_user_link() ?>">
			<?php  bp_displayed_user_avatar( 'type=full&width=200&height=200' ) ?>
		</a>
	</div><!-- #item-header-avatar -->

	<div id="item-header-content" class="span10">
		<div id="item-nav">
			<div class="item-list-tabs no-ajax" id="object-nav">
				<ul>
					<?php  bp_get_displayed_user_nav() ?>

					<?php  do_action( 'bp_members_directory_member_types' ) ?>
				</ul>
			</div>
		</div><!-- #item-nav -->



				<div class="item-title">
					<a href="<?php bp_member_permalink() ?>"><h3><?php bp_displayed_user_fullname() ?></h3></a>
					<div class="activity"><small>
								<a href="<?php  bp_user_link() ?>">@<?php  bp_displayed_user_username() ?></a>
							<?php  bp_last_activity( bp_displayed_user_id() ) ?>
					</small></div>
					<?php if (  bp_get_activity_latest_update( bp_displayed_user_id() ) ) : ?>
						<p class="update">
						<?php
							$latestud = html_entity_decode( bp_get_activity_latest_update( bp_displayed_user_id() ));
							//$latestud = str_replace('"', '', $latestupd);
							$latestud = str_replace('\n', '<br />', $latestud);
							$latestud = str_replace('<a ', '<br /><br /><a class="btn1" ', $latestud);
							//$latestud = str_replace('', '', $latestud);

							echo $latestud;
						?>
						</p>
					<?php endif; ?>

					<?php  if ( function_exists( 'bp_add_friend_button' ) ) : ?>
						<?php  bp_add_friend_button() ?>
					<?php  endif; ?>


		<?php  do_action( 'bp_before_member_header_meta' ) ?>

		<div id="item-meta" class="item_meta">
			<div id="item-buttons">

				<?php  if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_public_message_link' ) ) : ?>
					<div class="generic-button" id="post-mention">
						<a href="<?php  bp_send_public_message_link() ?>" title="<?php  _e( 'Mention this user in a new public message, this will send the user a notification to get their attention.', 'buddypress' ) ?>"><?php  _e( 'Mention this User', 'buddypress' ) ?></a>
					</div>
				<?php  endif; ?>

				<?php  if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_private_message_link' ) ) : ?>
					<div class="generic-button" id="send-private-message">
						<a href="<?php  bp_send_private_message_link() ?>" title="<?php  _e( 'Send a private message to this user.', 'buddypress' ) ?>"><?php  _e( 'Send Private Message', 'buddypress' ) ?></a>
					</div>
				<?php  endif; ?>
			</div><!-- #item-buttons -->

			<?php 
			 /***
			  * If you'd like to show specific profile fields here use:
			  * bp_profile_field_data( 'field=About Me' ); -- Pass the name of the field
			  */
			?>

			<?php  do_action( 'bp_profile_header_meta' ) ?>

		</div><!-- #item-meta -->

	</div><!-- #item-header-content -->

</div>

<?php  do_action( 'bp_after_member_header' ) ?>

<?php  do_action( 'template_notices' ) ?>
