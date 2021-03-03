<?php
!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;


$sql = "DROP TABLE {$tablepre}recharge_log";
db_exec($sql);

?>