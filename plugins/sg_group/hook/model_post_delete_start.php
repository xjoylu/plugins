 <?php exit;
	if(!$post['isfirst']) {
		$forum = forum_read($fid);
		$uid AND user_update($uid, array('credits-'=>$forum['post_credits'], 'golds-'=>$forum['post_golds']));
		user_update_group($uid);
	}
?>