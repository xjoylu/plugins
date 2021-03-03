<?php

!defined('DEBUG') and exit('Access Denied.');

$header['title'] = '帖子点赞设置';

if ($method == 'GET') {
	
	$config = setting_get('haya_post_like');
	
	include _include(APP_PATH.'plugin/haya_post_like/view/htm/setting.htm');
	
} else {
	
	$config = array();
	
	$config['open_thread'] = param('open_thread', 0);
	$config['open_post'] = param('open_post', 1);
	$config['hot_like_post_low_count'] = param('hot_like_post_low_count', 10);
	$config['hot_like_post_size'] = param('hot_like_post_size', 5);
	setting_set('haya_post_like', $config); 
	
	message(0, jump('设置修改成功', url('plugin-setting-haya_post_like')));
}

?>