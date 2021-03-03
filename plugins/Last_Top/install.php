<?php

/*
	使用setting加速缓存存储设置项,似乎安装时要先创建一个setting?
	默认值设置为2吧..
	lalala...
*/

!defined('DEBUG') AND exit('Forbidden');

$setting = setting_get('Last_top_setting');
if(empty($setting)) {
	$setting = array('body_start'=>'Flandre');
	setting_set('Last_top_setting', $setting);
}

?>