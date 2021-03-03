<?php
//新建标签表
$sql="CREATE TABLE IF NOT EXISTS `bbs_fq_tag` (
  `tagid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `id` (`tagid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63;";

db_exec($sql);


//新建标签主题关联表
$sql="CREATE TABLE IF NOT EXISTS `bbs_fq_tag_thread` (
  `tagid` int(11) unsigned NOT NULL,
  `tid` int(11) unsigned NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);
?>