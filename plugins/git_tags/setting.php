<?php
/*
 * TAG setting
 * admin/plugin-setting-git_tags.htm
 */

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {	
	$kv = kv_cache_get('git_tags');
	$input = array();
	$input['lock'] = form_text('lock', $kv['lock']);
	include _include(APP_PATH.'plugin/git_tags/setting.htm');
} else {
	$kv = array();
	$kv['lock'] = param('lock');
	$kv['stop'] = param('stop');
	$kv['limit'] = param('limit');
	kv_cache_set('git_tags', $kv);
	message(0, '修改成功');
}
?>