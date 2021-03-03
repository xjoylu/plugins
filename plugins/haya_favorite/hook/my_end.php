<?php
exit;

else if($action == 'favorite') {
	
	include _include(APP_PATH.'plugin/haya_favorite/model/haya_favorite.func.php');

	if ($method == 'POST') {

		$action = param('action', 'add');
		$tid = param('tid');
		if (!$user) {
			message(0, '只有登录后才能够收藏！');
		}

		$thread = thread_read($tid);
		empty($thread) AND message(0, lang('thread_not_exists'));
		$haya_check_favorite = haya_favorite_find_by_uid_and_tid($uid, $tid);
		
		if ($action == 'add') {
			if (!empty($haya_check_favorite)) {
				message(0, '你已经收藏过该帖子了！');
			}
			
			haya_favorite_create(array(
				'tid' => $tid, 
				'uid' => $user['uid'],
				'add_time' => time(),
				'add_ip' => $longip,
			));
			message(1, '收藏成功！');
		} elseif ($action == 'del') {
			if (empty($haya_check_favorite)) {
				message(0, '你还没有收藏过该帖子！');
			}
			
			haya_favorite_delete(array('tid' => $tid, 'uid' => $user['uid']));
			message(1, '取消收藏帖子成功！');
		}

	} else {
		$haya_favorite_config = kv_get('haya_favorite');
		
		if (strtolower($haya_favorite_config['user_favorite_sort']) == 'desc') {
			$user_favorite_sort = 'desc';
		} else {
			$user_favorite_sort = 'asc';
		}
		
		$orderby = param('orderby', $user_favorite_sort);
		if (strtolower($orderby) == 'desc') {
			$orderby_config = array('add_time' => -1);
		} else {
			$orderby_config = array('add_time' => 1);
		}
		
		$pagesize = intval($haya_favorite_config['user_favorite']);
		$page = param(2, 1);
		$cond['uid'] = $uid; 
		
		$haya_favorite_count = haya_favorite_count($cond);
		$threadlist = haya_favorite_find($cond, $orderby_config, $page, $pagesize);
		$pagination = pagination(url("my-favorite-{page}", array("orderby" => $orderby)), $haya_favorite_count, $page, $pagesize);
		
		include _include(APP_PATH.'plugin/haya_favorite/view/htm/my_favorite.htm');
	}

}

?>