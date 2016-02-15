<?php  /* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter() */ ?>

<?php  do_action( 'bp_before_groups_loop' ) ?>

<?php  if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

<!--
	<div class="pagination">

		<h4 class="pag-count" id="group-dir-count"><span>
			<?php  bp_groups_pagination_count() ?>
		</span></h4>

		<div class="pagination-links" id="group-dir-pag">
			<?php  bp_groups_pagination_links() ?>
		</div>

	</div>
-->

	<div id="groups-list" class="item-list">
	<?php  while ( bp_groups() ) : bp_the_group(); ?>
		<div class="row-fluid">
			<div class="item-avatar span2">
				<a href="<?php bp_group_permalink() ?>"><?php  bp_group_avatar( 'type=full&width=200&height=200' ) ?></a>
			</div>

			<div class="item span10">
				<h3><span><a href="<?php  bp_group_permalink() ?>"><?php  bp_group_name() ?></a></span></h3>
				<div class=""><span class="activity"><?php  printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span></div>

				<div class="item-desc"><?php  bp_group_description_excerpt() ?></div>

				<?php  do_action( 'bp_directory_groups_item' ) ?>

				<div class="">
					<?php  bp_group_join_button() ?>

					<div>
						<?php  bp_group_type() ?> / <?php  bp_group_member_count() ?>
					</div>

					<?php  do_action( 'bp_directory_groups_actions' ) ?>
				</div>

			</div>

			<div class="clear"></div>
			<div class="divider"></div>
		</div>
	<?php  endwhile; ?>
	</div>

	<?php  do_action( 'bp_after_groups_loop' ) ?>

<?php  else: ?>

	<div id="message" class="info info_box">
		<p><?php echo do_shortcode ( '[alertbox4 close="true"]' . __( 'There were no groups found.', 'buddypress' ) . '[/alertbox4]' ); ?></p>
	</div>

<?php  endif; ?>
