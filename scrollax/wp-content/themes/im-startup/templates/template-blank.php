<?php 
/**
 * Template Name: Blank
 *
 * @package IrishMiss
 * @package Startup
 */
?><!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php print miss_document_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta property="og:title" content="<?php print miss_document_title(); ?>" />
    <meta property="og:url" content="<?php if (is_home()) {print site_url();} else {print get_permalink();} ?>" />
    <?php miss_head(); ?>
    <?php wp_head(); ?>
  </head>
  <body class="<?php miss_body_class(); ?>">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
    <?php wp_footer(); ?>
  </body>
</html>