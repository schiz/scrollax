<?php
/**
 * Header Template
 *
 * @package IrishMiss
 * @package Startup
 */
?><!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <title><?php print miss_document_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <meta property="og:title" content="<?php print miss_document_title(); ?>" />
  <meta property="og:url" content="<?php if (is_home()) {print site_url();} else {print get_permalink();} ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php miss_head(); ?>
  <?php wp_head(); ?>
  <link rel='stylesheet' href='<?php echo THEME_URI; ?>/scrollax/css/template.css' type='text/css' media='all' />
  <link rel='stylesheet' href='<?php echo THEME_URI; ?>/scrollax/css/product.css' type='text/css' media='all' />
  <link rel='stylesheet' href='<?php echo THEME_URI; ?>/assets/css/extensions/packed.css' type='text/css' media='all' />
  <link rel='stylesheet' href='<?php echo THEME_URI; ?>/assets/css/generic/animation-im.css' type='text/css' media='all' />
  <script src="<?php echo THEME_URI; ?>/scrollax/js/main.js"></script>
  <script src="<?php echo THEME_URI; ?>/scrollax/js/jquery.parallax.js"></script>
  <script src="<?php echo THEME_URI; ?>/scrollax/js/home-page.js"></script>
  <script src="<?php echo THEME_URI; ?>/scrollax/js/qoopido.emerge.1.2.2.js"></script>

</head>
<body class="im-transform flexible_layout has_soft_borders has_slider <?php miss_theme_style() ?>">
  <?php //miss_before_header(); ?>
  <?php miss_header(); ?>
  <div class="page-inner">
	<?php miss_after_header(); ?>
	<?php miss_main_content_start(); ?>
<?php //miss_header_sociable(); ?>