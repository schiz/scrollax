<?php
/**
 * Portfolio Template
 *
 * @package IrishMiss
 * @package Radiostation
 */
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="single_post_module">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php miss_before_post(); ?>
			<div class="single_post_content">
			<?php miss_before_entry(); ?>
			<div class="entry">
				<?php the_content(); ?>
				<div class="clearboth"></div>
				<?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MISS_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', MISS_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
			</div><!-- .entry -->
			<?php miss_after_entry(); ?>
			</div><!-- .single_post_content -->
		</div><!-- #post-## -->
	</div><!-- .single_post_module -->
	<?php miss_after_post(); ?>
	<?php comments_template( '', true ); ?>
<?php endwhile; # end of the loop. ?>
<?php miss_after_page_content(); ?>
		<div class="clearboth"></div>
	</div><!-- #main_inner -->
</div><!-- #main -->
<?php get_footer(); ?>