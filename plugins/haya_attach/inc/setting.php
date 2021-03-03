<?php

defined('DEBUG') OR exit('Forbidden');

if ($method == 'post') {
	$config = $_REQUEST['config'];
	
	if (empty($config)) {
		message(1, jump('配置不能为空', url('attach')));
	}
	
	foreach ($config as $key => $value) {
		$file = haya_attach_read_by_key($key);
		if (!empty($file)) {
			haya_attach_update($file['id'], array('value' => $value));
		} else {
			haya_attach_create(array(
				'key' => $key,
				'value' => $value,
			));
		}
	}
	
	message(1, jump('配置更改成功', url('attach')));
}

else {
	$header['title'] = '附件管理设置';
	
	$config = haya_attach_find_key();
	$attach_count = attach_count();
	
	include _include(HAYA_FILE_HTML.'setting.htm');	
}
