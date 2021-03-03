<?php



!defined('DEBUG') AND exit('Forbidden');


// 删除数据就没有了
setting_delete('ax_nav_sel');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}ax_nav_sel;";
$r = db_exec($sql);
$r === FALSE AND message(-1, '卸载表失败');



?>