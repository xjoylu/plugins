<?php
/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/
!defined('DEBUG') AND exit('Access Denied.');
if($method == 'GET') {
	$kv = kv_get('sg_group');
	$input = array();
	$input['group1'] = form_select('group1',array('1'=>'积分', '2'=>'积分+发帖', '3'=>'积分+发帖+回帖'), $kv['group1']);
	$input['group2'] = form_text('group2', $kv['group2']);
	$input['group3'] = form_text('group3', $kv['group3']);
	$input['group4'] = form_radio_yes_no('group4', $kv['group4']);
	$input['group5'] = form_text('group5', $kv['group5']);
	$input['group6'] = form_text('group6', $kv['group6']);

	include _include(APP_PATH.'plugin/sg_group/setting.htm');
} else {
	$kv = array();
	$kv['group1'] = param('group1', 0);
	$kv['group2'] = param('group2', 0);
	$kv['group3'] = param('group3', 0);
	$kv['group4'] = param('group4', 0);
	$kv['group5'] = param('group5', 0);
	$kv['group6'] = param('group6', 0);

	kv_set('sg_group', $kv);
	message(0, lang('save_successfully'));
}
?>