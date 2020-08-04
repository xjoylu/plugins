<?php
/* new table - git_tags
 * new table - git_tags_thread
 * new cache - git_tags
 */

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;


$sql="CREATE TABLE IF NOT EXISTS {$tablepre}git_tags (
  tagid int(11) unsigned NOT NULL AUTO_INCREMENT,            # 标签id
  name char(32) NOT NULL DEFAULT '',                         # 标签名
  link int(11) NOT NULL DEFAULT '0',                         # 关联数量
  PRIMARY KEY (tagid),
  KEY (name)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

db_exec($sql);


$sql="CREATE TABLE IF NOT EXISTS {$tablepre}git_tags_thread (
  tagid int(11) unsigned NOT NULL DEFAULT '0',
  tid int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (tagid,tid),
  KEY (tid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";

db_exec($sql);


$kv = kv_cache_get('git_tags');
if(!$kv) {
	$kv = array('lock'=>'1', 'stop'=>'商女不知亡国恨 隔江犹唱双截棍', 'limit'=>'24');
	kv_cache_set('git_tags', $kv);
}

?>
