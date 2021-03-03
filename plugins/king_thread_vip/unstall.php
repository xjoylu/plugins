<?php

/*
	Xiuno BBS 4.0 插件实例：帖子加权限卸载
	admin/plugin-unstall-king_thread_viprank.htm
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE {$tablepre}vip_setting";
db_exec($sql);

$sql = "DROP TABLE {$tablepre}thread_vip";
db_exec($sql);
?>