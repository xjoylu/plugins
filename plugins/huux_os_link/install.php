<?php

/*
	Xiuno BBS 4.0 大白链接
*/

!defined('DEBUG') AND exit('Forbidden');



//使用kv -> setting存储
$setting = setting_get('huux_os_link');

if(empty($setting)) {
	$setting = array('icon_io'=>1,'link_index_headernav'=>1,'link_index_friendlink'=>1);
	setting_set('huux_os_link', $setting);
}

//创建自定义链接数据库
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}huux_os_link (
  linkid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  type smallint(11) NOT NULL DEFAULT '0',
  rank smallint(11) NOT NULL DEFAULT '0',
  create_date int(11) unsigned NOT NULL DEFAULT '0',
  icon int(11) unsigned NOT NULL DEFAULT '0',
  name char(32) NOT NULL DEFAULT '',
  note char(200) NOT NULL DEFAULT '',
  str mediumtext NOT NULL ,
  url char(64) NOT NULL DEFAULT '',
  target int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (linkid),
  KEY type (type)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

$r = db_exec($sql);
$r === FALSE AND message(-1, '创建自定义链接表结构失败');




// 初始化KV方案  ## 请勿删除 ##
$kv = kv_get('dabai_plugin');
if(!$kv) {
	$kv = array('huux_os_link' =>'{"id":"huux_os_link","name":"大白链接","type":"插件","set":1}' );
	kv_set('dabai_plugin', $kv);
}else{
	if (!in_array("huux_os_link", $kv)){
		$kv = $kv+array('huux_os_link' =>'{"id":"huux_os_link","name":"大白链接","type":"插件","set":1}' );
	}
	kv_set('dabai_plugin', $kv);
}





?>