<?php

defined('DEBUG') OR exit('Forbidden');

$header['title'] = '查看附件';

$id = param(2);

if (empty($id)) {
	message(1, jump('id不能为空', url('attachlite-attachs')));
}

// 设置高亮类型
$action = 'attachs';

$attach = attach_read($id);
if (empty($attach)) {
	message(1, jump('文件不能存在', url('attachlite-attachs')));
}

$thread = thread_read($attach['tid']);
$post = post_read($attach['pid']);
$user = user_read($attach['uid']);

$config = setting_get('haya_attach_lite');

include _include(HAYA_FILE_HTML.'read.htm');	


