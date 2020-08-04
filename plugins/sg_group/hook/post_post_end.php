 <?php exit;
		$return_html = param('return_html', 0);
		$forum = forum_read($fid);
		$credits = $forum['post_credits'];
		$golds = $forum['post_golds'];
		$uid AND user_update($uid, array('credits+'=>$credits, 'golds+'=>$golds));
		user_update_group($uid);
		$message = '';
		!empty($credits) AND $message = lang('sg_creditsplus',  array('credits'=>$credits));
		!empty($golds) AND $message = lang('sg_goldsplus',  array('golds'=>$golds));
		!empty($credits) && !empty($golds) AND $message = lang('sg_creditsplus',  array('credits'=>$credits)).'、'.lang('sg_goldsplus',  array('golds'=>$golds));
		if($return_html) {
			$filelist = array();
			ob_start();
			include _include(APP_PATH.'view/htm/post_list.inc.htm');
			$s = ob_get_clean();
			message(0, $s);
		} else {
			$message = $message ? $message : lang('create_post_sucessfully');
			message(0, $message);
		}
?>