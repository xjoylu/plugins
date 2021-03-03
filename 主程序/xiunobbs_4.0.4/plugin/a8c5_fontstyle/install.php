<?php

/*
	八彩五月网制作 QQ：312215120
	网址：http//www.8c5.cn
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}icolink (
  linkid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  type smallint(11) NOT NULL DEFAULT '0',
  rank smallint(11) NOT NULL DEFAULT '0',
  create_date int(11) unsigned NOT NULL DEFAULT '0',
  name char(32) NOT NULL DEFAULT '',
  renqi char(32) NOT NULL DEFAULT '',
  imgurl char(128) NOT NULL DEFAULT '',
  url char(64) NOT NULL DEFAULT '',
  PRIMARY KEY (linkid),
  KEY type (type)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
";
$r = db_exec($sql);

$sql = "INSERT INTO {$tablepre}icolink SET name='八彩五月', renqi='168', url='https://www.8c5.cn/', imgurl='http://www.8c5.cn/view/img/logo.png'";
$r = db_exec($sql);
?>