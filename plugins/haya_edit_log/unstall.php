<?php

defined('DEBUG') OR exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "
ALTER TABLE {$tablepre}post DROP COLUMN haya_edit_uid;
ALTER TABLE {$tablepre}post DROP COLUMN haya_edit_time;
ALTER TABLE {$tablepre}post DROP COLUMN haya_edit_ip;
";
$r = db_exec($sql);

// 删除配置
kv_delete('haya_edit_log');

$r === FALSE AND message(-1, '卸载插件表失败');
