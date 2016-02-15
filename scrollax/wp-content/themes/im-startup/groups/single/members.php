<?php  if ( bp_group_has_members( 'exclude_admins_mods=0' ) ) : ?>

	<?php  do_action( 'bp_before_group_members_content' ) ?>

	<div class="pagination no-ajax">
		<h4 id="member-count" class="pag-count"><span>
			<?php  bp_group_member_pagination_count() ?>
		</span></h4>

		<div id="member-pagination" class="pagination-links">
			<?php  bp_group_member_pagination() ?>
		</div>

	</div>

	<?php  do_action( 'bp_before_group_members_list' ) ?>
	<div class="divider"></div>

	<ul id="member-list" class="item-list">
		<?php  while ( bp_group_members() ) : bp_group_the_member(); ?>

			<li class="row-fluid">
				<div class="span1">
					<a href="<?php  bp_group_member_domain() ?>">
						<?php  bp_group_member_avatar_thumb() ?>
					</a>
				</div>
				<div class="span4">
					<h4><span><?php  bp_group_member_link() ?></span></h4>
					<span class="activity"><?php  bp_group_member_joined_since() ?></span>
					<?php  do_action( 'bp_group_members_list_item' ) ?>
				</div>
				<div class="span7">
				<?php if ( function_exists( 'friends_install' ) ) : ?>
					<div class="action">
						<?php bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ) ?>
						<?php do_action( 'bp_group_members_list_item_action' ) ?>
					</div>
				<?php endif; ?>
				</div>
			</li>

		<?php  endwhile; ?>

	</ul>

	<?php  do_action( 'bp_after_group_members_content' ) ?>

<?php  else: ?>

	<div id="message" class="info">
		<p><?php  _e( 'This group has no members.', 'buddypress' ); ?></p>
	</div>

<?php  endif; ?>
