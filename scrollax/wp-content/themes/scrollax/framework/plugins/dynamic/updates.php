<?php
$tgm_args = array(
    'plugin_name' => 'LayerSlider',
    'plugin_slug' => 'LayerSlider',
    'plugin_path' => THEME_PLUGINS . '/dynamic/store/layersliderwp-4.5.5.installable.zip',
    'plugin_url'  => THEME_PLUGINS_URI . '/dynamic/store/layersliderwp-4.5.5.installable.zip',
    'version'     => '4.5.5',
//    'remote_url'  => 'http://soliloquywp.com/',
    'time'        => 42300
);
$tgm_config            = new TGM_Updater_Config( $tgm_args );
$tgm_namespace_updater = new TGM_Updater( $tgm_config );
$tgm_namespace_updater->update_plugins();
?>