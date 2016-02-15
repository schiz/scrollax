<?php  /* This template is only used on multisite installations */ ?>

<?php  get_header(); ?>

<div class="page-wrap">
  <div id="page" class="clearfix">			
			<?php  do_action( 'bp_before_activation_page' ) ?>
	
			<div class="clearfix" id="activate-page">
	
				<?php  do_action( 'template_notices' ) ?>
	
				<?php  if ( bp_account_was_activated() ) : ?>
	
					<h2 class="widgettitle"><?php  _e( 'Account Activated', 'buddypress' ) ?></h2>
					<div class="thinline"></div>
	
					<?php  do_action( 'bp_before_activate_content' ) ?>
	
					<?php  if ( isset( $_GET['e'] ) ) : ?>
						<p><?php  _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ) ?></p>
					<?php  else : ?>
						<p><?php  _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'buddypress' ) ?></p>
					<?php  endif; ?>
	
				<?php  else : ?>
	
					<h2><?php  _e( 'Activate your Account', 'buddypress' ) ?></h2>
					<div class="thinline"></div>
	
					<?php  do_action( 'bp_before_activate_content' ) ?>
	
					<div class="bbp-template-notice"><p><?php  _e( 'To activate your account you should provide a valid activation key.', 'buddypress' ) ?></p></div>
	
					<form action="" method="get" class="standard-form" id="activation-form">
	
						<label for="key"><?php  _e( 'Activation Key:', 'buddypress' ) ?></label>
						<input type="text" name="key" class="input-wrap" id="key" value="" />
	
						<p class="submit">
							<input type="submit" name="submit" class="button light" value="<?php  _e( 'Activate', 'buddypress' ) ?> &rarr;" />
						</p>
	
					</form>
	
				<?php  endif; ?>
	
				<?php  do_action( 'bp_after_activate_content' ) ?>
	
			</div><!-- .page -->
	
			<?php  do_action( 'bp_after_activation_page' ) ?>
	
			</div><!-- #content -->
		</div><!-- #container -->
<?php  get_footer(); ?>
