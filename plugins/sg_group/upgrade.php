<?php

/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/

!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN create_credits int(11) unsigned NOT NULL DEFAULT '0'";
$r = db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN create_golds int(11) unsigned NOT NULL DEFAULT '0'";
$r = db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN post_credits int(11) unsigned NOT NULL DEFAULT '0'";
$r = db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN post_golds int(11) unsigned NOT NULL DEFAULT '0'";
$r = db_exec($sql);
forum_list_cache_delete();
$setting_ = setting_get('sg_group');
if($setting_) {
	$sg_group= array('up_group'=>$setting_['up_group'], 'isfirst'=>$setting_['isfirst'], 'creditsfrom'=>$setting_['creditsfrom'], 'creditsto'=>$setting_['creditsto'], 'goldsfrom'=>'2', 'goldsto'=>'10');
	setting_set('sg_group', $sg_group);
}
$kv = kv_get('sg_group');
if(empty($setting_) && $kv) {
	$sg_group= array('up_group'=>$kv['group1'], 'isfirst'=>$kv['group4'], 'creditsfrom'=>$kv['group5'], 'creditsto'=>$kv['group6'], 'goldsfrom'=>'2', 'goldsto'=>'10');
	setting_set('sg_group', $sg_group);
}
$kv AND kv_delete('sg_group');
?>