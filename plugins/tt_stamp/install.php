<?php

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}thread_stamp (
	fid int(6) NOT NULL default '0',			# 版块id
	tid int(10) unsigned NOT NULL default '0',		# 主题id
	uid int(10) unsigned NOT NULL default '0',		# uid
	stamp_type tinyint(3) unsigned NOT NULL default '0',	#图章类别
	PRIMARY KEY (tid),					# 
	KEY (uid),						# 
	UNIQUE KEY (fid, tid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
db_exec($sql);

$sql = "ALTER TABLE {$tablepre}thread ADD COLUMN stamp int(10) unsigned NOT NULL default '0';";
db_exec($sql);


?>