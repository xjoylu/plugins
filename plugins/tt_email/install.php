<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE ".$tablepre."user ADD email_v CHAR(30) NOT NULL default '0';";
db_exec($sql);
?>