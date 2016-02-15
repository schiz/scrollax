<?php  header("Content-type: text/css"); ?>
/*
 *  PHP CSS Generator (WP)
 *  Created by Mike Myles, based on ResponsiveBlank Framework
 */

<?php 
/* Loading configuration and libraries */
if(file_exists('../../../../wp-load.php')) :
  include '../../../../wp-load.php';
else:
  include '../../../../../wp-load.php';
endif;
/* Variables */
$banner1 = of_get_option('header_banner_1_size');
$banner2 = of_get_option('header_banner_2_size');
?>
#header-banner h2 {
    <?php if ($banner1): ?>
	font-size: <?php echo $banner1; ?>;
    <?php endif; ?>
}
#header-banner h3 {
    <?php if ($banner2): ?>
	font-size: <?php echo $banner2; ?>;
    <?php endif; ?>
}
