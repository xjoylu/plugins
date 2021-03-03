<?php

/*
	插件配置文件 (无配置则不需要此文件)
*/

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	include _include(APP_PATH.'plugin/huux_plugin/setting.htm'); // 这里包含一个插件配置界面文件
	
} else {


}
	
?>