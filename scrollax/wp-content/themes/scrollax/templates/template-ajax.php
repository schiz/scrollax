<?php
/*
Template Name: Clean Ajax
*/
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php $_content = get_the_content(); ?>
	<?php if ( !empty( $_content ) ): ?>
	  <?php echo $_content; ?>
	<?php endif; ?>
<?php endwhile; ?>
