<?php

/**
 * Gingerbbs 收藏帖子插件 安装程序
 */

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "create table {$tablepre}gg_favorite_thread
(
   favid bigint(11) unsigned NOT NULL AUTO_INCREMENT,
   tid INT(11) NOT NULL,
   uid INT(11) NOT NULL,
   PRIMARY KEY (favid),
   KEY tid(tid, uid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$r = db_exec($sql);
$r === FALSE AND message(-1, '创建表结构失败'); // 中断，安装失败。

?>