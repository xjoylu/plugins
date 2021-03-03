<?php

/**
 * 帖子收藏插件 安装程序
 *
 * @create 2018-1-24
 * @author deatil
 */
 
!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "
CREATE TABLE {$tablepre}haya_favorite (
	`tid` int(11) NOT NULL COMMENT '帖子ID',
	`uid` int(11) NOT NULL COMMENT '用户ID',
	`add_time` int(10) NULL DEFAULT '0' COMMENT '添加时间',
	`add_ip` varchar(25) NULL DEFAULT '' COMMENT '添加IP',
	KEY (tid, uid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$r = db_exec($sql);
$r === FALSE AND message(-1, '创建表结构失败'); // 中断，安装失败。

// 添加插件配置
$haya_favorite_config = array(
	"user_favorite" => 10,
	"user_favorite_sort" => 'desc',
	"hot_favorite" => 10,
	"show_hot_favorite" => 0,
);
kv_set('haya_favorite', $haya_favorite_config); 

?>