<?php  
/**
 * @package MissFramework
 */

require_once( get_template_directory() . '/framework/app.php' );

$theme_data = wp_get_theme();
IrishMiss::init(array(
        'theme_name' => $theme_data->name,
        'theme_version' => $theme_data->version
));
?>
