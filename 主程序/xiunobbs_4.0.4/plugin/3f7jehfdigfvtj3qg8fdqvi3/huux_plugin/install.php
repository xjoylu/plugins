<?php


!defined('DEBUG') AND exit('Forbidden');


// 设置setting存储
$setting = setting_get('huux_plugin');
if(empty($setting)) {
	$setting = array('plugin_io'=>0);
	setting_set('huux_plugin', $setting);
}


?>