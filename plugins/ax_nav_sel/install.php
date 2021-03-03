<?php



!defined('DEBUG') AND exit('Forbidden');



//使用kv -> setting存储
$setting = setting_get('ax_nav_sel');

if(empty($setting)) {
	$setting = array('icon_io'=>1,'link_index_headernav'=>1,'link_index_friendlink'=>1);
	setting_set('ax_nav_sel', $setting);
}

//创建自定义链接数据库
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}ax_nav_sel (
  linkid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  type smallint(11) NOT NULL DEFAULT '0',
  rank smallint(11) NOT NULL DEFAULT '0',
  create_date int(11) unsigned NOT NULL DEFAULT '0',
  icon int(11) unsigned NOT NULL DEFAULT '0',
  name char(32) NOT NULL DEFAULT '',
  note int(11) NOT NULL DEFAULT '0',
  url char(64) NOT NULL DEFAULT '',
  target int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (linkid),
  KEY type (type)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

$r = db_exec($sql);
$r === FALSE AND message(-1, '创建自定义链接表结构失败');








?>