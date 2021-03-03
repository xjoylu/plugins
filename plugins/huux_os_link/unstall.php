<?php

/*
	Xiuno BBS 4.0 大白链接
*/

!defined('DEBUG') AND exit('Forbidden');


// 删除数据就没有了
setting_delete('huux_os_link');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}huux_os_link;";
$r = db_exec($sql);
$r === FALSE AND message(-1, '卸载大白链接表失败');

// 从菜单中移除
$kv = kv_get('dabai_plugin');
if ($kv){
	unset($kv['huux_os_link']);
	kv_set('dabai_plugin', $kv);
}else{
	message(-1, '安装时出错,已经删除。');
}

?>