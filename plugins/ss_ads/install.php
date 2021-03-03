<?php
!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}ss_ads (
  aid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  name char(32) NOT NULL DEFAULT '',
  mode smallint(1) NOT NULL DEFAULT '0',
  size smallint(11) NOT NULL DEFAULT '0',
  lcode longtext NOT NULL,
  rcode longtext NOT NULL,
  create_date int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (aid)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
";



$r = db_exec($sql);
$r === FALSE AND message(-1, '创建数据表结构失败');

?>