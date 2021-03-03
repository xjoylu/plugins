<?php
!defined('DEBUG') AND exit('Forbidden');
# user_id        用户ID
# user_name      用户名
# last_sign_time 上次签到时间
# sign_time      本次签到时间
# get_credits    签到获得经验
# is_continuity  是否连续签到
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}sign (
	`id`  int(10) NOT NULL AUTO_INCREMENT , 
	`user_id`   int(10)   , 
	`user_name`  varchar(50)  , 
	`sign_time`  varchar(255) ,
	`get_credits`  int(10)  ,
	`is_continuity`  int(1) ,
	PRIMARY KEY (`id`) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
db_exec($sql);


#sign_onetime    签到一次获得积分
#sign_alltime_3  连续签到3天获得积分
#sign_alltime_7  连续签到7天获得积分
#sign_alltime_15 连续签到15天获得积分
#sign_alltime_30 连续签到30天获得积分


$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}sign_config (
	`id`  int(10) NOT NULL AUTO_INCREMENT , 
	`sign_onetime`   int(10)   , 
	`sign_alltime_3`  int(10)  , 
	`sign_alltime_7`  int(10),
	`sign_alltime_15`  int(10) ,
	`sign_alltime_30`  int(10)  ,
	PRIMARY KEY (`id`) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
db_exec($sql);

$sql = "INSERT INTO `{$tablepre}sign_config` VALUES ('1',0,0,0,0,0)";
db_exec($sql);



?>