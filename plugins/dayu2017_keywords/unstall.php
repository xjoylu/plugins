<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "alter table {$tablepre}thread drop column keywords   ";
db_exec($sql);
?>