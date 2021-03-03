<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;

$sql = "ALTER TABLE ".$tablepre."user ADD v CHAR(200) NOT NULL default '0';";
db_exec($sql);

?>