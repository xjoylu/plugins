<?php

!defined('DEBUG') and exit('Access Denied.');

$header['title'] = '编辑日志设置';

if ($method == 'POST') {
	
	$config['edit_log_is_ip'] = param('edit_log_is_ip', 0);
	$config['edit_log_position'] = param('edit_log_position');
	kv_set('haya_edit_log', $config); 
	
	message(0, jump('配置修改成功', url('plugin-setting-haya_edit_log')));
} else {
	
	$config = kv_get('haya_edit_log');
	$sign_count = user_count();
	
	include _include(APP_PATH.'plugin/haya_edit_log/htm/setting.htm');
}



?>