<?php
exit;

$haya_sign_type = param('type', '');
if (!empty($haya_sign_type)) {
	if ($haya_sign_type == 'onlyhost') {
		$thread['posts'] = post_count(array(
			'tid' => $thread['tid'], 
			'isfirst' => 0, 
			'uid' => $thread['uid'], 
		));
	}

	$pagination = pagination(url("thread-$tid-{page}$keywordurl", array('type' => $haya_sign_type)), $thread['posts'] + 1, $page, $pagesize);
}

$haya_sign_see_user = param('user', '');
if (!empty($haya_sign_see_user)) {
	$haya_sign_see_user_id = intval($haya_sign_see_user);
	
	if ($postlist) {
		foreach ($postlist as $haya_post_type_post_key => & $haya_post_type_post) {
			if ($haya_post_type_post['uid'] != $haya_sign_see_user_id) {
				unset($postlist[$haya_post_type_post_key]);
			}
		}
	}

	$pagination = pagination(url("thread-$tid-{page}$keywordurl", array('user' => $haya_sign_see_user_id)), $thread['posts'] + 1, $page, $pagesize);
}

