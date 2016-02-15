<?php do_action( 'bp_before_members_loop' ) ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<?php do_action( 'bp_before_directory_members_list' ) ?>

	<div id="members-list" class="item-list">
	<?php while ( bp_members() ) : bp_the_member(); ?>

		<div class="row-fluid">
			<div class="span2">
				<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar('width=200&height=200') ?></a>
			</div>

			<div class="span10">
				<div class="item-title">
					<a href="<?php bp_member_permalink() ?>"><h3><?php bp_member_name() ?></h3></a>
					<div class="activity"><small><?php bp_member_last_active() ?></small></div>
					<?php if ( bp_get_member_latest_update() ) : ?>
						<p class="update">
						<?php
							$latestud = html_entity_decode(bp_get_member_latest_update());
							//$latestud = str_replace('"', '', $latestupd);
							$latestud = substr($latestud, 3);
							$latestud = str_replace('\n', '<br />', $latestud);
							$latestud = str_replace('"<', '<br /><', $latestud);
							$latestud = str_replace('<a ', '<br /><a class="btn1" ', $latestud);
							//$latestud = str_replace('', '', $latestud);

							echo $latestud;
						?>
						</p>
					<?php endif; ?>
				</div>

				<?php do_action( 'bp_directory_members_item' ) ?>

				<?php 
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regadless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				?>

				<div class="action">
					<?php do_action( 'bp_directory_members_actions' ) ?>
				</div>

			</div>

		</div>
		<br />
		<?php // echo do_shortcode('[divider_top]'); ?>

	<?php endwhile; ?>
	</div>

	<?php do_action( 'bp_after_directory_members_list' ) ?>

	<?php echo do_shortcode('[divider_top]'); ?>

	<div class="pagination">

		<h4 class="pag-count" id="member-dir-count">
			<span><?php bp_members_pagination_count() ?></span>
		</h4>

		<div class="pagination-links" id="member-dir-pag">
			<?php bp_members_pagination_links() ?>
		</div>

	</div>

	<?php bp_member_hidden_fields() ?>

<?php else: ?>
	<?php echo do_shortcode('[alertbox1 close="true"]' .__( 'Sorry, no members were found.', 'buddypress' ) . '[/alertbox1]' ); ?>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ) ?>
