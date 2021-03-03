<?php
exit;

$haya_post_sort_see_type = param('type', '');
if (!empty($haya_post_sort_see_type)) {
	if ($haya_post_sort_see_type == 'onlyhost') {
		$thread['posts'] = post_count(array(
			'tid' => $thread['tid'], 
			'isfirst' => 0, 
			'uid' => $thread['uid'], 
		));
	}

	$pagination = pagination(url("thread-$tid-{page}$keywordurl", array('type' => $haya_post_sort_see_type)), $thread['posts'] + 1, $page, $pagesize);
}

$haya_post_sort_see_user = param('user', '');
if (!empty($haya_post_sort_see_user)) {
	$haya_post_sort_see_user_id = intval($haya_post_sort_see_user);
	
	if (!empty($postlist)) {
		foreach ($postlist as $haya_post_sort_post_key => & $haya_post_sort_post) {
			if ($haya_post_sort_post['uid'] != $haya_post_sort_see_user_id) {
				unset($postlist[$haya_post_sort_post_key]);
			}
		}
	}

	$pagination = pagination(url("thread-$tid-{page}$keywordurl", array('user' => $haya_post_sort_see_user_id)), $thread['posts'] + 1, $page, $pagesize);
}

