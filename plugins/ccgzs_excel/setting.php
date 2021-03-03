<?php

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	$path = kv_get('excel_path');
	
	$input = array();

	$input['excel_dir'] = form_text('excel_dir', $path['excel_dir']);

	
	include _include(APP_PATH.'plugin/ccgzs_excel/setting.htm');
	
} else {

	$path = array();

	$path['excel_dir'] = param('excel_dir');

	
	kv_set('excel_path', $path);
	
	message(0, '修改成功');
}
	
?>