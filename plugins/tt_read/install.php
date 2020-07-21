<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE ".$tablepre."group ADD readp int(5) NOT NULL default '1';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."thread ADD readp int(5) NOT NULL default '0';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."group ADD allowPostRead int(5) NOT NULL default '1';";
db_exec($sql);
group_list_cache_delete();
setting_set('tt_read',array('old'=>'0'));
?>