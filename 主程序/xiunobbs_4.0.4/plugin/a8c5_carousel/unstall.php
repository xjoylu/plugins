<?php

/*
    八彩五月网制作 www.8c5.cn
	QQ:312215120
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}slide;";

$r = db_exec($sql);
$r === FALSE AND message(-1, '卸载幻灯片表失败');

?>