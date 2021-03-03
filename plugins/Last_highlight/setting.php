<?php

/*
	Xiuno BBS 4.0 插件实例：广告插件设置
	admin/plugin-setting-xn_ad.htm
*/

!defined('DEBUG') AND exit('Access Denied.');

$setting = setting_get('Last_highlight');

if($method == 'GET') {
	
	$input = array();
	$input['view'] = form_textarea('view', $setting['view'], '100%', '100px');
	$input['fold'] = form_textarea('fold', $setting['fold'], '100%', '100px');
	$input['other'] = form_textarea('other', $setting['other'], '100%', '100px');
	
	include _include(APP_PATH.'plugin/Last_highlight/setting.htm');
	
} else {

	$setting['view'] = param('view', '', FALSE);
	$setting['fold'] = param('fold', '', FALSE);
	$setting['other'] = param('other', '', FALSE);
	
	setting_set('Last_highlight', $setting);
	
	message(0, '修改成功');
}
	
?>