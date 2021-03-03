<?php 


/*
	Xiuno BBS 4.0 插件实例：帖子加权限
	admin/plugin-install-king_thread_vip.htm
*/

!defined('DEBUG') AND exit('Forbidden');

# 开关表
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}vip_setting (
	`id`  int(10) NOT NULL AUTO_INCREMENT , 
	`name`  varchar(50) NOT NULL , 
	`value`  varchar(255) NOT NULL DEFAULT '1', 
	PRIMARY KEY (`id`) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;
;";
db_exec($sql);
# 密码表
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}thread_vip (
	`id`  int(10) NOT NULL AUTO_INCREMENT , 
	`tid`  int(10) NOT NULL , 
	`status`  int(2) NOT NULL DEFAULT '0', 
	`viprank` varchar(255) DEFAULT 0,
	PRIMARY KEY (`id`) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;
;";
db_exec($sql);

?>