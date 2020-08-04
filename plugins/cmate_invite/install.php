<?php



!defined('DEBUG') AND exit('Forbidden');


$tablepre = $db->tablepre;

$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}invite (
	uid int(11) NOT NULL DEFAULT '0',
	ip int(32) NOT NULL DEFAULT '0',
	regtime int(32) NOT NULL DEFAULT '0',
	PRIMARY KEY (uid)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
$db->exec($sql);

$sql = "ALTER TABLE {$tablepre}user ADD COLUMN invitenums smallint(10) unsigned NOT NULL DEFAULT '0';";
$db->exec($sql);