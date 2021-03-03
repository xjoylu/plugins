<?php
!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE {$tablepre}sign";
db_exec($sql);


$sql = "DROP TABLE {$tablepre}sign_config";
db_exec($sql);

?>