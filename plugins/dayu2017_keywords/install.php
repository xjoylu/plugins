<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE {$tablepre}thread ADD column keywords varchar(100) NULL AFTER `subject` ";
db_exec($sql);

?>