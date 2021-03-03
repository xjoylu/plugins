<?php

/**
 * 帖子点赞 卸载程序
 *
 * @create 2018-1-31
 * @author deatil
 */

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "
DROP TABLE IF EXISTS {$tablepre}haya_post_like;
";
$r = db_exec($sql);

$sql = "
ALTER TABLE {$tablepre}post DROP COLUMN haya_post_likes;
";
$r = db_exec($sql);

// 删除插件配置
setting_delete('haya_post_like'); 

?>