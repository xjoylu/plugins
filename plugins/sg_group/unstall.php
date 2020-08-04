<?php
/*
	Xiuno BBS 4.0 用户组升级增强版
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/

!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE `{$tablepre}forum` DROP `create_credits`, DROP `create_golds`, DROP `post_credits`, DROP `post_golds`;";
$r = db_exec($sql);
forum_list_cache_delete();
$r = kv_delete('sg_group');
$r = setting_delete('sg_group');
$r === FALSE AND message(-1, '卸载失败');

?>