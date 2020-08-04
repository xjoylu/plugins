<?php
/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/
!defined('DEBUG') AND exit('Access Denied.');
if($method == 'GET') {
	$kv = setting_get('sg_group');
	$input = array();
	$kv['create_golds'] = isset($kv['create_golds']) ? $kv['create_golds'] : '';
	$kv['post_golds'] = isset($kv['post_golds']) ? $kv['post_golds'] : '';
	$kv['goldsfrom'] = isset($kv['goldsfrom']) ? $kv['goldsfrom'] : '';
	$kv['goldsto'] = isset($kv['goldsto']) ? $kv['goldsto'] : '';
	$input['up_group'] = form_select('up_group',array('1'=>lang('sg_credits'), '2'=>lang('sg_up_group2'), '3'=>lang('sg_up_group3')), $kv['up_group']);
	$input['isfirst'] = form_radio_yes_no('isfirst', $kv['isfirst']);
	$input['goldsfrom'] = form_text('goldsfrom', $kv['goldsfrom']);
	$input['goldsto'] = form_text('goldsto', $kv['goldsto']);
	$input['creditsfrom'] = form_text('creditsfrom', $kv['creditsfrom']);
	$input['creditsto'] = form_text('creditsto', $kv['creditsto']);

	include _include(APP_PATH.'plugin/sg_group/setting.htm');
} else {
	$kv = array();
	$kv['up_group'] = param('up_group', 0);
	$fidarr = param('fid', array(0));
	$create_creditsarr = param('create_credits', array(0));
	$create_goldsarr = param('create_golds', array(0));
	$post_creditsarr = param('post_credits', array(0));
	$post_goldsarr = param('post_golds', array(0));
	
	$kv['isfirst'] = param('isfirst', 0);
	$kv['creditsfrom'] = param('creditsfrom', 0);
	$kv['creditsto'] = param('creditsto', 0);
	$kv['goldsfrom'] = param('goldsfrom', 0);
	$kv['goldsto'] = param('goldsto', 0);
	foreach($fidarr as $k=>$v) {
		$arr = array(
			'create_credits'=>array_value($create_creditsarr, $k),
			'create_golds'=>array_value($create_goldsarr, $k),
			'post_credits'=>array_value($post_creditsarr, $k),
			'post_golds'=>array_value($post_goldsarr, $k)
		);
		forum_update($k, $arr);
	}
	setting_set('sg_group', $kv);
	message(0, lang('save_successfully'));
}
?>