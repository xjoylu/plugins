<?php
/*
	Xiuno BBS 4.0 主题高亮
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/
!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	$kv = kv_get('sg_highlight');
	$input = array();
	include _include(APP_PATH.'plugin/sg_highlight/setting.htm');
} else {

	$kv = array();
	$kv['highlight1'] = param('highlight1');
	$kv['highlight2'] = param('highlight2');
	$kv['highlight3'] = param('highlight3');
	$kv['highlight4'] = param('highlight4');
	$kv['highlight5'] = param('highlight5');
	$kv['highlight6'] = param('highlight6');
	$kv['highlight7'] = param('highlight7');
	$kv['highlight8'] = param('highlight8');
	$kv['highlight9'] = param('highlight9');
	$kv['highlight10'] = param('highlight10');
	kv_set('sg_highlight', $kv);
	message(0, lang('save_successfully'));

}

?>