<?php

!defined('DEBUG') and exit('Access Denied.');

$header['title'] = '帖子收藏设置';

if ($method == 'POST') {
	
	$config['user_favorite'] = param('user_favorite', 10);
	$config['user_favorite_sort'] = param('user_favorite_sort', 'desc');
	$config['hot_favorite'] = param('hot_favorite', 10);
	$config['show_hot_favorite'] = param('show_hot_favorite', 0);
	kv_set('haya_favorite', $config); 
	
	message(0, jump('设置修改成功', url('plugin-setting-haya_favorite')));
} else {
	
	$config = kv_get('haya_favorite');
	
	include _include(APP_PATH.'plugin/haya_favorite/view/htm/setting.htm');
}

?>