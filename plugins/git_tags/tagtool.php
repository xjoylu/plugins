<?php

/**
 * 对标签灌水
 * 
 *



// 跳过路由
define('SKIP_ROUTE', TRUE);
include '../index.php';


$fid = 1; // 版块 id
$uid = 1; // 用户 id
$gid = 1; // 用户组 id; 1: 管理员; 101:普通用户
for($i=100; $i<930000; $i++) {

    // 范围内取tid(前提是tid必须存在)

    for($j=0; $j<6; $j++){
        // 产生随机标签(36进制3位数则产生4.6w范围的标签 )
        $s = '标签'.xn_rand(3);
        $tag = tag_add($i,$s);
    }

    if($i % 100 == 0) echo '.';
}

echo '生成数据完毕';
