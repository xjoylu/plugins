<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}store_rate` (
  `tid` int(10) NOT NULL,
  `rate1` int(20) DEFAULT '0',
  `rate3` int(20) DEFAULT '0',
  `rate5` int(20) DEFAULT '0',
  `ratenum` int(20) DEFAULT '0',
  `rate_avg` CHAR(20) DEFAULT '0',
  PRIMARY KEY (tid),					# 
	KEY (tid),						# 
	UNIQUE KEY (tid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);

setting_set('tt_store', array('fid'=>'1'));
?>