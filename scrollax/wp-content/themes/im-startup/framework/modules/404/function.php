<?php
/**
 * Not Found
 *
 * @package MissFramework
 * @since 1.7
 */


if ( !function_exists( 'miss_404' ) ) :
/**
 *
 */
function miss_404( $post = false ) {
?><div id="post-0" class="page error404 not_found">
	
	<?php
	//$intro_options = miss_get_setting( 'intro_options' );
	if( !is_search() ) :
	?><h1 class="post_title"><?php _e( 'Error 404 - Not Found', MISS_TEXTDOMAIN ); ?></h1>
	<?php endif; ?>
	
	<div class="entry">
		<?php if( !$post ) :
		?><p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', MISS_TEXTDOMAIN ); ?></p>
		<?php elseif( is_search() ) :
		?><?php _e( 'Apologies, but no post could be found matching your criteria.', MISS_TEXTDOMAIN ); ?></p>
		<?php else :
		?><?php _e( 'Apologies, but no post could be found matching your criteria. Perhaps searching will help.', MISS_TEXTDOMAIN ); ?></p>
		<?php endif; ?>
		<?php // get_search_form(); ?>
	</div><!-- .entry-content -->
</div><!-- #post-0 -->

<script type="text/javascript">
/* <![CDATA[ */
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
/* ]]> */
</script>

<?php	
}
endif;
?>