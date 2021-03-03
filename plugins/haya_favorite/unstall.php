<?php

/**
 * 帖子收藏插件 卸载程序
 *
 * @create 2018-1-24
 * @author deatil
 */

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE IF EXISTS {$tablepre}haya_favorite";
$r = db_exec($sql);

// 删除插件配置
kv_delete('haya_favorite'); 

?>