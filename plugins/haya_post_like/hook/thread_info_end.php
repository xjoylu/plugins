<?php
exit;
$haya_post_like_config = setting_get('haya_post_like');

if (isset($haya_post_like_config['open_post'])
	&& $haya_post_like_config['open_post'] == 1
) {
	$hot_like_post_size = intval($haya_post_like_config['hot_like_post_size']);
	$hot_like_post_low_count = intval($haya_post_like_config['hot_like_post_low_count']);
	$haya_post_like_hot_posts = haya_post_like_find_hot_loves_by_tid($thread['tid'], $hot_like_post_size, $hot_like_post_low_count);
	
	$haya_post_like_post_ids = array();
	if (!empty($postlist)) {
		foreach ($postlist as $haya_post_like_post) {
			$haya_post_like_post_ids[] = $haya_post_like_post['pid'];
		}
	}
	
	if (!empty($haya_post_like_hot_posts)) {
		foreach ($haya_post_like_hot_posts as $haya_post_like_hot_post) {
			$haya_post_like_post_ids[] = $haya_post_like_hot_post['pid'];
		}
	}
	
	$haya_post_like_pids = haya_post_like_find_by_pids($haya_post_like_post_ids);
}

?>