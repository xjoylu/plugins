<?php

/*
	八彩五月网制作 QQ：312215120
	网址：http//www.8c5.cn
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}fontlink;";

$r = db_exec($sql);
$r === FALSE AND message(-1, '卸载友情链接表失败');

?>