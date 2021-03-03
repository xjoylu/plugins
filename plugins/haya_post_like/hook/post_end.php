<?php
exit;

elseif ($action == 'post_like') {

	$header['title'] = "帖子点赞 - " . $conf['sitename'];
	
	if (!$uid) {
		message(0, '只有登录后才能够点赞！');
	}

	$haya_post_like_config = setting_get('haya_post_like');
	
	if ($method == 'POST') {

		$pid = param('pid');

		$post = post_read($pid);
		empty($post) AND message(0, lang('post_not_exists'));

		if ($post['isfirst'] == 1) {
			if (isset($haya_post_like_config['open_thread'])
				&& $haya_post_like_config['open_thread'] != 1
			) {
				message(0, '对帖子点赞功能没有启用！');
			}
		} else {
			if (isset($haya_post_like_config['open_post'])
				&& $haya_post_like_config['open_post'] != 1
			) {
				message(0, '对回帖点赞功能没有启用！');
			}
		}
		
		$haya_post_like_check = haya_post_like_find_by_uid_and_pid($uid, $pid);
		
		$action2 = param(2, 'create');
		if ($action2 == 'create') {
			if (!empty($haya_post_like_check)) {
				message(0, '你已经点赞过该回帖！');
			}
			
			haya_post_like_create(array(
				'tid' => $post['tid'], 
				'pid' => $pid, 
				'uid' => $user['uid'],
				'create_date' => time(),
				'create_ip' => $longip,
			));
			
			haya_post_like_loves($pid, 1);
			
			if (function_exists("notice_send")) {
				notice_send($post['uid'], '<a href="'.url('user-'.$user['uid']).'" target="_blank">'.$user['username'].'</a> 点赞了你的回帖 <a target="_blank" href="'.url('thread-'.$post['tid']).'">'.$post['subject'].'</a>', 4);
			}
			
			$haya_post_like_count = haya_post_like_count(array('pid' => $pid));
			$haya_post_like_msg = array(
				'count' => intval($haya_post_like_count),
				'msg' => '点赞回帖成功！',
			);
			
			message(1, $haya_post_like_msg);
		} elseif ($action2 == 'delete') {
			if (empty($haya_post_like_check)) {
				message(0, '你还没有点赞过该回帖！');
			}
			
			haya_post_like_delete_by_pid_and_uid($pid, $user['uid']);
			
			haya_post_like_loves($pid, -1);
			
			$haya_post_like_count = haya_post_like_count(array('pid' => $pid));
			$haya_post_like_msg = array(
				'count' => intval($haya_post_like_count),
				'msg' => '取消点赞成功！',
			);
			
			message(1, $haya_post_like_msg);
		}
		
		message(1, '访问错误！');	
	}
	
	message(1, '访问错误！');

}


?>