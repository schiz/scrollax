<?php  do_action( 'bp_before_profile_loop_content' ); ?>

<?php  if ( bp_has_profile() ) : ?>

	<?php  while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php  if ( bp_profile_group_has_fields() ) : ?>

			<?php  do_action( 'bp_before_profile_field_content' ); ?>

			<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">
			
				<div class="entry-content">

					<table class="forum">
						<tr>
							<td>Registered date</td>
							<td><?php  echo date("M Y", strtotime(get_userdata(bp_displayed_user_id())->user_registered)); ?>
</td>
						</tr>
						<tr>
							<td>Profile</td>
							<td><?php  bp_the_profile_group_name(); ?></td>
						</tr>
						<?php  while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

							<?php  if ( bp_field_has_data() ) : ?>

								<tr>

									<td><?php  bp_the_profile_field_name(); ?></td>

									<td><?php  bp_the_profile_field_value(); ?></td>

								</tr>

							<?php  endif; ?>

							<?php  do_action( 'bp_profile_field_item' ); ?>

						<?php  endwhile; ?>

					</table>
					
				</div><!-- .entry-content -->
				
			</div>

			<?php  do_action( 'bp_after_profile_field_content' ); ?>

		<?php  endif; ?>

	<?php  endwhile; ?>

	<?php  do_action( 'bp_profile_field_buttons' ); ?>

<?php  endif; ?>

<?php  do_action( 'bp_after_profile_loop_content' ); ?>
