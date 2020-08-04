<?php

/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/
!defined('DEBUG') AND exit('Forbidden');
// 初始化
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
$kv = setting_get('sg_group');
if(!$kv) {
	$kv = array('up_group'=>'1', 'create_credits'=>'2', 'create_golds'=>'2', 'post_credits'=>'1', 'post_golds'=>'1', 'isfirst'=>'1', 'creditsfrom'=>'2', 'creditsto'=>'10', 'goldsfrom'=>'2', 'goldsto'=>'10');
	setting_set('sg_group', $kv);
}
?>