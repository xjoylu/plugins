<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS `{$tablepre}ax_friends` (
  `friendsid` int(10)  NOT NULL AUTO_INCREMENT ,
  `fid` int(10)  NOT NULL DEFAULT '0',
  `uid` int(10)  NOT NULL DEFAULT '0',
  `create_date` int(10) NOT NULL DEFAULT '0',
  `message` text(0) NOT NULL DEFAULT '',
  `fs1` text(0) NOT NULL DEFAULT '',
  `fs2` text(0) NOT NULL DEFAULT '',
  `fs3` text(0) NOT NULL DEFAULT '',
  PRIMARY KEY(friendsid),
  KEY uid_friendsid(uid, friendsid),
  KEY (uid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);


$sql2 = "CREATE TABLE IF NOT EXISTS `{$tablepre}ax_likes` (
  `likeid` int(10)  NOT NULL AUTO_INCREMENT ,
  `uid` int(10)  NOT NULL DEFAULT '0',
  `uid_like` int(10) NOT NULL DEFAULT '0',
  `friendsid` int(10) NOT NULL DEFAULT '0',
  `create_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY(likeid),
  KEY uid_friendsid(uid, likeid),
  KEY (uid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql2);

$sql3 = "ALTER TABLE {$tablepre}user ADD COLUMN friends_num INT(10) DEFAULT '0'";
db_exec($sql3);

$sql4 = "ALTER TABLE {$tablepre}attach ADD COLUMN friendsid INT(10) DEFAULT '0'";
db_exec($sql4);
?>