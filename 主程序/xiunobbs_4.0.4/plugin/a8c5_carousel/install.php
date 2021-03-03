<?php

/*
	八彩五月网制作 www.8c5.cn
	QQ:312215120
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}slide (
  slideid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  rank smallint(11) NOT NULL DEFAULT '0',
  name char(32) NOT NULL DEFAULT '',
  url char(64) NOT NULL DEFAULT '',
  slidepic varchar(255) NOT NULL DEFAULT '',
  picheight varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (slideid)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
";
$r = db_exec($sql);
$sql = "INSERT INTO {$tablepre}slide SET rank='0', name='八彩五月网制作 www.8c5.cn', url='http://www.8c5.cn/', slidepic='/plugin/a8c5_carousel/img/a.jpg',  picheight='300'";
$r = db_exec($sql);
$sql = "INSERT INTO {$tablepre}slide SET rank='1', name='八彩五月网制作 www.8c5.cn', url='http://www.8c5.cn/', slidepic='/plugin/a8c5_carousel/img/b.jpg',  picheight='300'";
$r = db_exec($sql);
$sql = "INSERT INTO {$tablepre}slide SET rank='2', name='八彩五月网制作 www.8c5.cn', url='http://www.8c5.cn/', slidepic='/plugin/a8c5_carousel/img/c.jpg',  picheight='300'";
$r = db_exec($sql);
?>