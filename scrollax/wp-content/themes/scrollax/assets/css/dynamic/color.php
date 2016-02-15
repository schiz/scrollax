<?php  header("Content-type: text/css"); ?>
/*
 *  PHP Colour Generator (WP)
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
$color = of_get_option('theme_colorpicker');
$banner_line_1 = of_get_option('header_banner_1_color');
$banner_line_2 = of_get_option('header_banner_2_color');
$logo_margin = of_get_option('logo_margin');
$menu_margin = of_get_option('menu_margin');
$header_height = of_get_option('header_height');
$default_background = of_get_option('default_background');
$customcss = of_get_option('custom_css');
?>
body{
  background: <?php  echo $default_background['color'].' '; echo 'url('.$default_background['image'].') '; echo $default_background['repeat'].' '; echo $default_background['position'].' '; echo $default_background['attachment'];   ?>;
}

#logo {
  margin-top: <?php  echo $logo_margin; ?> !important;
}

a:hover,
.post-entry h2 a:hover {
  color:<?php  echo $color; ?>;
}

#contactform #submit:hover {
  background-color:<?php  echo $color; ?>;
}

::-moz-selection { background-color:<?php  echo $color; ?>; }
.::selection { background-color:<?php  echo $color; ?>; }

.thinline {
  background: <?php  echo $color; ?>;
}

#infobar .wrap {
  background: <?php  echo $color; ?>;
}
#infobar .open .inner {
  background-color: <?php  echo $color; ?>;
}
#infobar2 {
  background-color: <?php  echo $color; ?>;
}
#header-banner h2 {
	color: <?php echo $banner_line_1; ?>;
}
#header-banner h3 {
	color: <?php echo $banner_line_2; ?>;
}
#nav {
  margin-top: <?php print $menu_margin; ?>;
}
#nav ul li a:hover {
  color:#fff<?php // echo $color; ?>;
  background-color:<?php  echo $color; ?>;
}
#nav ul li.current_page_item a, #nav ul li.current_page_item a:hover {
  color:<?php  echo $color; ?>;
  background: transparent;
  border-color: rgba(250,250,250,0) !important;
}

#primary-nav ul li.current_page_item a,
#primary-nav ul li.current-menu-item a, 
#primary-nav ul li.current-page-ancestor a,
#primary-nav ul li.current-menu-ancestor a,
#nav ul li.current_page_item a,
#nav ul li.current-menu-item a, 
#nav ul li.current-page-ancestor a,
#nav ul li.current-menu-ancestor a {
  color:<?php  echo $color; ?>;
}

#nav ul li.current-menu-item ul li a:hover, 
#nav ul li.current-page-ancestor ul li a:hover,
#nav ul li.current-menu-ancestor ul li a:hover {
}

#nav ul.sub-menu {
  border-color:<?php echo $color; ?>;
  background-color:<?php echo $color; ?>;
}
#nav ul li:hover > a {
  background-color: <?php echo $color; ?>;
}
#nav ul.sub-menu a:hover {
  color: rgba(255,255,255,.9);
}
/*Primary Nav */
#primary-nav {
  margin-top: <?php print $menu_margin; ?>;
}
#primary-nav ul li a:hover {
  color:#fff<?php // echo $color; ?>;
  background-color:<?php  echo $color; ?>;
}
#primary-nav ul li.current_page_item a, #primary-nav ul li.current_page_item a:hover {
  color:<?php  echo $color; ?>;
  background: transparent;
  border-color: rgba(250,250,250,0) !important;
}

#primary-nav ul li.current_page_item a,
#primary-nav ul li.current-menu-item a, 
#primary-nav ul li.current-page-ancestor a,
#primary-nav ul li.current-menu-ancestor a {
  color:<?php  echo $color; ?>;
}

#primary-nav ul li.current-menu-item ul li a:hover, 
#primary-nav ul li.current-page-ancestor ul li a:hover,
#primary-nav ul li.current-menu-ancestor ul li a:hover {
}

#primary-nav ul.sub-menu {
  border-color:<?php echo $color; ?>;
  background-color:<?php echo $color; ?>;
}
#primary-nav ul li:hover > a {
  background-color: <?php echo $color; ?>;
}
#primary-nav ul.sub-menu a:hover {
  color: rgba(255,255,255,.9);
}


.flex-caption {
  background: <?php  echo $color; ?>;
}
#latest-posts .entry a.more {
}
.table-column li:hover {
  background: <?php  echo $color; ?>;
  color: rgba(255,255,255,.8);
}
.table-column .price {
  background-color: <?php echo $color; ?>;
}
.table-column.featured {
  border-color: <?php echo $color; ?>;
  border-width: 1px;
}
.table-column.featured h3 {
  -webkit-border-radius: 10px 10px 0px 0;
  -moz-border-radius: 10px 10px 0px 0;
  border-radius: 10px 10px 0px 0;
  -o-border-radius: 10px 10px 0px 0;
}
.table-column.featured .price {
  background: rgba(0,0,0,.8);
}
.table-head h3 {
  background-color: <?php echo $color; ?> !important;
}

#latest-work .entry:hover {
	background-color: <?php echo $color; ?>;
	border-color: <?php echo $color; ?>;
}
#latest-work .entry:hover h4 a {
	color: <?php echo $color; ?>;
}
#latest-work .entry:hover, #latest-work .entry:hover h4 a, #latest-work .entry:hover h4 {
	color: rgb(255,255,255) !important;
}
#latest-work .entry:hover img {
  border-color:<?php  echo $color; ?>;
}


.post-thumb a:hover {
  border-color: <?php  echo $color; ?>;
}

.big-post-thumb img {
  border-color: <?php  echo $color; ?>;
}

.post-entry a.more:hover {
  color:<?php  echo $color; ?>;
}

.meta a:hover {
  color:<?php  echo $color; ?>;
}

.navigation a:hover {
  color:<?php  echo $color; ?>;
}

a#cancel-comment-reply-link {
  color:<?php  echo $color; ?>;
}

#commentform #submit:hover {
  background-color:<?php  echo $color; ?>;
}

#categories li a:hover {
  color:<?php  echo $color; ?>;
}

.work-item:hover {
  background-color: #ffffff;
  border-color:<?php  echo $color; ?>;
}
.work-item:hover h3 a {
  color:<?php  echo $color; ?>;
}

.work-item:hover img {
  border-color:<?php  echo $color; ?>;
}
#sidebar .widget_nav_menu li.current-menu-item a {
  background-color:<?php  echo $color; ?> !important;
  color: #fff !important;
}
#sidebar .widget_nav_menu li.current-menu-item li a {
  background: transparent !important;
  color: #646464 !important;
}
#sidebar .widget_nav_menu li.current-menu-item li a:hover {
  color:<?php  echo $color; ?> !important;
}
#sidebar a:hover {
  color:<?php  echo $color; ?> !important;
}

#breadcrumb a:hover {
  color:<?php  echo $color; ?>;
}

#lasttweet {
  background-color:<?php  echo $color; ?>;
}

.table-column .featured {
  border-color: <?php  echo $color; ?>;
}
.pricing-table .table-column .featured:last-child {
  border-color:<?php  echo $color; ?>;
}

.table-column .featured h3 {
  background-color: <?php  echo $color; ?>;
}

.table-column .featured .price {
  background-color: <?php  echo $color; ?>;
}

.toggle .title:hover {
  color:<?php  echo $color; ?>;
}
.toggle .title.active {
  color:<?php  echo $color; ?>;
}

ul.tabNavigation li a.active {
    color:<?php  echo $color; ?>;
}

ul.tabNavigation li a:hover {
  color:<?php  echo $color; ?>;
}

.button {
  background-color: <?php  echo $color; ?>;
}
#home-slider .loader, .home-slider .loader {
	border-bottom-color: <?php  echo $color; ?>;
}
#home-slider {
  /* background-color:<?php  echo $color; ?>; */
}
#home-slider .flex-control-nav li a:hover {
  background: <?php  echo $color; ?>;
}
#home-slider .flex-control-nav li a.active {
  background: <?php  echo $color; ?>;
}

.accordion .title.active a {
  color:<?php  echo $color; ?> !important;
}

#latest-posts .entry a.more:hover {
  color:<?php echo $color; ?>;
}
.navigation a:hover {
	background-color: <?php echo $color; ?> !important;
	color: rgb(255,255,255) !important;
}


.post-entry h2 a:hover,
.search-result h2 a:hover,
.work-detail-description a:hover {
  color: <?php  echo $color; ?>;
}

#footer .widget li:hover {
  color: #888 !important;
}
#footer .widget li:hover > a {
}

<?php  echo $customcss; ?>
/* Media Queries */
@media only screen and (max-width: 767px) {
  #header {
    border-top:6px solid <?php  echo $color; ?>;
  }
}
