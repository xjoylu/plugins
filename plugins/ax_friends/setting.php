<?php 
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);

$friends_nav = param('friends_nav');
$friends_index = param('friends_index');
$friends_num = param('friends_num');
$friends_uid_lv1 = param('friends_uid_lv1');
$friends_uid_lv2 = param('friends_uid_lv2');
$friends_uid_lv3 = param('friends_uid_lv3');
$friends_uid_lv4 = param('friends_uid_lv4');
$friends_time = param('friends_time');
$friends_bg = param('friends_bg');

$ax_friends = kv_get('ax_friends');
if($method == 'GET') {
if(empty($ax_friends)) {
	$ax_friends = array(
		'friends_nav'=>$friends_nav, 
		'friends_index'=>$friends_index, 
		'friends_num'=>$friends_num, 
		'friends_uid_lv1'=>$friends_uid_lv1, 
		'friends_uid_lv2'=>$friends_uid_lv2, 
		'friends_uid_lv3'=>$friends_uid_lv3, 
		'friends_uid_lv4'=>$friends_uid_lv4, 
		'friends_time'=>$friends_time,
		'friends_bg'=>$friends_bg
	);
	kv_set('ax_friends', $ax_friends);
}			
	

	$friends_nav = form_radio_yes_no('friends_nav',$ax_friends['friends_nav']);
	$friends_index = form_radio_yes_no('friends_index',$ax_friends['friends_index']);
	$friends_num = form_text('friends_num',$ax_friends['friends_num'],'100%','设置显示说说数量，默认显示20条说说');
	$friends_uid_lv1 = form_text('friends_uid_lv1',$ax_friends['friends_uid_lv1'],'100%','当用户发布累计超过(默认10条)时获得lv1图标');
	$friends_uid_lv2 = form_text('friends_uid_lv2',$ax_friends['friends_uid_lv2'],'100%','当用户发布累计超过(默认20条)时获得lv2图标');
	$friends_uid_lv3 = form_text('friends_uid_lv3',$ax_friends['friends_uid_lv3'],'100%','当用户发布累计超过(默认30条)时获得lv3图标');
	$friends_uid_lv4 = form_text('friends_uid_lv4',$ax_friends['friends_uid_lv4'],'100%','当用户发布累计超过(默认40条)时获得lv4图标');
	$friends_time = form_text('friends_time',$ax_friends['friends_time'],'100%','设置发布间隔时间，默认不限制（输入纯数字，单位秒）');
	$friends_bg = form_text('friends_bg',$ax_friends['friends_bg'],'100%','自定义大背景可以是颜色代码(如：#000)可以是图片路径');

	include _include(APP_PATH.'plugin/ax_friends/setting.htm');		
	} else {
		
		$ax_friends['friends_nav'] = param('friends_nav');
		$ax_friends['friends_index'] = param('friends_index');
		$ax_friends['friends_num'] = param('friends_num');
		$ax_friends['friends_uid_lv1'] = param('friends_uid_lv1');
		$ax_friends['friends_uid_lv2'] = param('friends_uid_lv2');
		$ax_friends['friends_uid_lv3'] = param('friends_uid_lv3');
		$ax_friends['friends_uid_lv4'] = param('friends_uid_lv4');
		$ax_friends['friends_time'] = param('friends_time');
		$ax_friends['friends_bg'] = param('friends_bg');
		kv_set('ax_friends', $ax_friends);	
		message(0, '修改成功');
}
	



?>
