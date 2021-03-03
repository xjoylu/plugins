<?php
!defined('DEBUG') AND exit('Forbidden');

setting_set('tt_seo',array('tablepre'=>$db->tablepre,'auto_site'=>'https://www.baidu.com/','auto'=>'1','auto_token'=>'','sitemap_max'=>'50000','sitemap_site'=>'https://www.baidu.com/','sitemap_auto'=>'0','xzh'=>'0','xzh_appid'=>'','xzh_token'=>'','mip_ping'=>'0','mip_xzh'=>'0'));

$tablepre = $db->tablepre;
$sql="CREATE TABLE IF NOT EXISTS `{$tablepre}seo_log` (
  `seo_id` int(20) NOT NULL AUTO_INCREMENT,
  `type` int(8) NOT NULL DEFAULT '0',
  `time` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  `status` CHAR(80) NOT NULL,
  `tid` int(20) NOT NULL,
  PRIMARY KEY (seo_id),
	KEY (seo_id),
	UNIQUE KEY (seo_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
db_exec($sql);

$sql = "ALTER TABLE ".$tablepre."group ADD allowSEO INT(10) NOT NULL default '0';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."forum ADD allowSEO INT(10) NOT NULL default '0';";
db_exec($sql);
group_list_cache_delete();
forum_list_cache_delete();
?>