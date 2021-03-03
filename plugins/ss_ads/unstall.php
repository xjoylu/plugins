<?php
!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}ss_ads;";

$r = db_exec($sql);
$r === FALSE AND message(-1, '卸载失败');

?>