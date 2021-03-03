<?php

/*
	这里是选择主题时的处理文件..
	虽然只是记录一个数值..
*/

!defined('DEBUG') AND exit('Access Denied.');

$setting = setting_get('Last_top_setting');

if($method == 'GET') {
	
	$input = array();
	$input['body_start'] = form_textarea('body_start', $setting['body_start'], '100%', '100px');
	
	include _include(APP_PATH.'plugin/Last_Top/setting.htm');
	
} else {

	$setting['body_start'] = param('body_start', '', FALSE);
	
	setting_set('Last_top_setting', $setting);
	
	message(0, '修改成功');
}
	
?>