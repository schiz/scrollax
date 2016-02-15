<?php do_action( 'bp_before_group_header' ) ?>
<div id="item-actions">
	<?php if ( bp_group_is_visible() ) : ?>

		<?php bp_group_list_admins() ?>

		<?php do_action( 'bp_after_group_menu_admins' ) ?>

		<?php if ( bp_group_has_moderators() ) : ?>
			<?php do_action( 'bp_before_group_menu_mods' ) ?>

			<h3><?php _e( 'Group Mods' , 'buddypress' ) ?></h3>
			<?php bp_group_list_mods() ?>

			<?php do_action( 'bp_after_group_menu_mods' ) ?>
		<?php endif; ?>

	<?php endif; ?>
</div><!-- #item-actions -->
<div class="row-fluid">
	<div id="item-header-avatar" class="span2">
		<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>">
			<?php bp_group_avatar('type=full&width=300&height=300') ?>
		</a>
	</div><!-- #item-header-avatar -->
	<div id="item-header-content" class="span10">
<div id="item-nav">
<div class="item-list-tabs no-ajax" id="object-nav">
<ul>
<?php bp_get_options_nav() ?>
<?php do_action( 'bp_group_options_nav' ) ?>
</ul>
</div>
</div>
<h3><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h3>

		<div class="group-meta">
			<span class="label label-success normal-style"><?php bp_group_type() ?></span> <span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span>
			<?php do_action( 'bp_before_group_header_meta' ) ?>
		</div>
		<div id="item-meta">
		<?php bp_group_description() ?>
		<?php bp_group_join_button() ?>
		<?php do_action( 'bp_group_header_meta' ) ?>
		</div>


	</div><!-- #item-header-content /.span10 -->
</div>
<?php do_action( 'bp_after_group_header' ) ?>
<?php do_action( 'template_notices' ) ?>
