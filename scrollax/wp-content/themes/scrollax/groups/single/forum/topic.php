<?php  if ( bp_has_forum_topic_posts() ) : ?>
	<form action="<?php  bp_forum_topic_action() ?>" method="post" id="forum-topic-form" class="standard-form">
		<?php  if ( bp_group_is_admin() || bp_group_is_mod() || bp_get_the_topic_is_mine() ) : ?>
		<div class="pull-right">
			<div class="bp-admin-links">
					<div class="admin-links"><?php  bp_the_topic_admin_links() ?></div>
			</div>
		</div>
		<?php  endif; ?>

		<h3><?php  bp_the_topic_title() ?> (<?php  bp_the_topic_total_post_count() ?>)</h3>
		<div id="topic-post-list" class="item-list">
			<?php while ( bp_forum_topic_posts() ) : bp_the_forum_topic_post(); ?>

				<div id="post-<?php  bp_the_topic_post_id() ?>" class="row-fluid">
					<div class="span2 poster-meta item_meta">
						<a href="<?php  bp_the_topic_post_poster_link() ?>">
							<?php bp_the_topic_post_poster_avatar( 'width=200&height=200' ) ?>
						</a>
						<?php echo sprintf( __( '<div><span>Posted by @%s</span></div> <small>%s</small>', 'buddypress' ), bp_get_the_topic_post_poster_name(), bp_get_the_topic_post_time_since() ) ?>
					</div>

					<div class="span10 post-content">
						<?php bp_the_topic_post_content() ?>
						<div class="row-fluid">
							<div class="span3">
								<i class="fa-icon-list"></i> <a class="" href="<?php bp_forum_permalink() ?>/"><?php  _e( 'Back to Group Forum', 'buddypress' ) ?></a>
							</div>

							<div class="span3">
								<i class="fa-icon-th"></i> <a class="" href="<?php  bp_forums_directory_permalink() ?>/"><?php  _e( 'Group Forum Directory', 'buddypress') ?></a>
							</div>

							<div class="span3"></div>

							<div class="span3" style="text-align: right">
								<?php bp_the_topic_post_admin_links() ?>
								<a href="#post-<?php  bp_the_topic_post_id() ?>" title="<?php  _e( 'Permanent link to this post', 'buddypress' ) ?>"></a>
							</div>
						</div>
						<?php  if ( bp_group_is_admin() || bp_group_is_mod() || bp_get_the_topic_post_is_mine() ) : ?>

						<?php  endif; ?>

					</div>

				</div>
				<?php echo do_shortcode('[divider_top]'); ?>

			<?php endwhile; ?>
		</div>
		<div class="pagination no-ajax">

			<h4 id="post-count" class="pag-count">
			<span>
				<?php  bp_the_topic_pagination_count() ?>
			</span></h4>

			<div class="pagination-links" id="topic-pag">
				<?php bp_the_topic_pagination(); ?>
				<?php echo miss_pagenavi(); ?>
			</div>

		</div>

		<?php  if ( ( is_user_logged_in() && 'public' == bp_get_group_status() ) || bp_group_is_member() ) : ?>

			<?php  if ( bp_get_the_topic_is_last_page() ) : ?>

				<?php  if ( bp_get_the_topic_is_topic_open() ) : ?>

					<div id="post-topic-reply">
						<p id="post-reply"></p>

						<?php  if ( !bp_group_is_member() ) : ?>
							<?php echo do_shortcode('[alertbox1 close="true"]' . __( 'You will auto join this group when you reply to this topic..', 'buddypress' ) . '[/alertbox1]' ); ?>
						<?php  endif; ?>

						<?php  do_action( 'groups_forum_new_reply_before' ) ?>

						<h4><?php  _e( 'Add a reply:', 'buddypress' ) ?></h4>

						<textarea name="reply_text" id="reply_text" class="textarea input-wrap"></textarea>

						<div class="submit">
							<input type="submit" name="submit_reply" id="submit" class="button_link small_button" value="<?php  _e( 'Post Reply', 'buddypress' ) ?>" />
						</div>

						<?php  do_action( 'groups_forum_new_reply_after' ) ?>

						<?php  wp_nonce_field( 'bp_forums_new_reply' ) ?>
					</div>

				<?php  else : ?>
					<?php echo do_shortcode('[alertbox1 close="true"]' . __( 'This topic is closed, replies are no longer accepted.', 'buddypress' ) . '[/alertbox1]' ); ?>

				<?php  endif; ?>

			<?php  endif; ?>

		<?php  endif; ?>

	</form>
<?php  else: ?>
	<?php echo do_shortcode('[alertbox1 close="true"]' . __( 'There are no posts for this topic.', 'buddypress' ) . '[/alertbox1]' ); ?>


<?php  endif;?>
