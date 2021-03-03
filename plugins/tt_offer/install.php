<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE ".$tablepre."group ADD allowOffer INT(5) NOT NULL default '0';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."forum ADD allowOffer INT(5) NOT NULL default '0';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."thread ADD offerNum INT(20) NOT NULL default '0';";
db_exec($sql);
$sql = "ALTER TABLE ".$tablepre."thread ADD offerStatus INT(20) NOT NULL default '0';";
db_exec($sql);
forum_list_cache_delete();
group_list_cache_delete();
setting_set('tt_offer',array('credits_type'=>3));
?>