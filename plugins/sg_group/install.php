<?php

/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/
!defined('DEBUG') AND exit('Forbidden');
// 初始化
$kv = kv_get('sg_group');
if(!$kv) {
	$kv = array('group1'=>'3', 'group2'=>'2', 'group3'=>'1', 'group4'=>'1', 'group5'=>'2', 'group6'=>'10');
	kv_set('sg_group', $kv);
}
?>