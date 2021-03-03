<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;

$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}user_vip` (
  `uid` int(10) NOT NULL,
  `grow` int(10) NOT NULL DEFAULT '0',
  `end` int(12) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (uid),
	KEY (uid),						# 
	UNIQUE KEY (uid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);

setting_set('tt_vip',array('up_read'=>'0','no_credits_down'=>'0','no_credits_see'=>'0','no_reply_see'=>'0','month_fee'=>'1000','month_grow'=>10,'season_fee'=>'3000','season_grow'=>50,'half_year_fee'=>'6000','half_year_grow'=>100,'year_fee'=>'12000','year_grow'=>300,'fee_type'=>'3','grow_per_day'=>10,'decrease_per_day'=>10,'level2'=>3000,'level3'=>8000,'level4'=>20000,'level5'=>50000,'level6'=>100000));
?>