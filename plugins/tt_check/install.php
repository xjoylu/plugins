<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;

$sql = "ALTER TABLE {$tablepre}post ADD COLUMN OK INT(3) DEFAULT '1'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}thread ADD COLUMN OK INT(3) DEFAULT '1'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}user ADD COLUMN OK INT(3) DEFAULT '1'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}group ADD COLUMN see_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}group ADD COLUMN post_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}group ADD COLUMN thread_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}group ADD COLUMN edit_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN post_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN thread_check INT(3) DEFAULT '0'";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}forum ADD COLUMN edit_check INT(3) DEFAULT '0'";
db_exec($sql);
forum_list_cache_delete();
group_list_cache_delete();
setting_set('tt_check',array('user_check'=>0,'recycle'=>0));
?>