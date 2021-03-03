
	if(!$post['isfirst']) {
		$kv = kv_get('sg_group');
		$uid AND user__update($uid, array('credits-'=>$kv['group3']));
	}
