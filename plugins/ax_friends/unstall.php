<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "DROP TABLE {$tablepre}ax_friends";
db_exec($sql);
//kv_delete('ax_friends');
$sql = "DROP TABLE {$tablepre}ax_likes";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}user drop column friends_num";
db_exec($sql);
$sql = "ALTER TABLE {$tablepre}attach drop column friendsid";
db_exec($sql);
?>