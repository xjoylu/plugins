<?php !defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;

$sql = "ALTER TABLE ".$tablepre."thread ADD red_num INT(10) NOT NULL default '-1';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."group ADD allowredpacket INT(5) NOT NULL default '0';";
db_exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}red_packet` (
  `packet_id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0',
  `get` int(20) NOT NULL DEFAULT '0',
  `tid` int(10) NOT NULL DEFAULT '0',
  `time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (packet_id),
	KEY (tid),
	UNIQUE KEY (packet_id, uid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}thread_red` (
  `tid` int(10) NOT NULL ,
  `type` int(10) NOT NULL DEFAULT '1',
  `command` CHAR(100) NOT NULL DEFAULT '0',
  `total` int(10) NOT NULL DEFAULT '0',
  `rest` int(10) NOT NULL DEFAULT '0',
  `total_money` int(10) NOT NULL DEFAULT '0',
  `rest_money` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (tid),
	KEY (tid),
	UNIQUE KEY (tid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);
group_list_cache_delete();
setting_set('tt_redpacket',array('money_type'=>3,'allow_cancel'=>1));
?>