<?php

defined('DEBUG') OR exit('Forbidden');

if ($method == 'get') {
	
	$header['title'] = '附件管理设置';
	
	$config = setting_get('haya_attach_lite');
	$attach_count = attach_count();
	
	include _include(HAYA_FILE_HTML.'setting.htm');	
	
} else {
	
	$config['show_pic'] = param('show_pic', 0);
	$config['list_type'] = param('list_type', 0);
	setting_set('haya_attach_lite', $config); 
	
	message(1, jump('配置保存成功', url('attachlite')));
	
}
