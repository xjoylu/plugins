<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;

$sql = "ALTER TABLE ".$tablepre."forum ADD structure VARCHAR(500) NOT NULL default '0';";
db_exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}thread_structure` (
  `tid` int(10) NOT NULL,
  `c1` CHAR(200) NOT NULL DEFAULT '-',
  `c2` CHAR(200) NOT NULL DEFAULT '-',
  `c3` CHAR(200) NOT NULL DEFAULT '-',
  `c4` CHAR(200) NOT NULL DEFAULT '-',
  `c5` CHAR(200) NOT NULL DEFAULT '-',
  `c6` CHAR(200) NOT NULL DEFAULT '-',
  `c7` CHAR(200) NOT NULL DEFAULT '-',
  `c8` CHAR(200) NOT NULL DEFAULT '-',
  `c9` CHAR(200) NOT NULL DEFAULT '-',
  `c10` CHAR(200) NOT NULL DEFAULT '-',
  `c11` CHAR(200) NOT NULL DEFAULT '-',
  `c12` CHAR(200) NOT NULL DEFAULT '-',
  `c13` CHAR(200) NOT NULL DEFAULT '-',
  `c14` CHAR(200) NOT NULL DEFAULT '-',
  `c15` CHAR(200) NOT NULL DEFAULT '-',
  `c16` CHAR(200) NOT NULL DEFAULT '-',
  `c17` CHAR(200) NOT NULL DEFAULT '-',
  `c18` CHAR(200) NOT NULL DEFAULT '-',
  `c19` CHAR(200) NOT NULL DEFAULT '-',
  `c20` CHAR(200) NOT NULL DEFAULT '-',
  PRIMARY KEY (tid),					# 
	KEY (tid),						# 
	UNIQUE KEY (tid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);

?>