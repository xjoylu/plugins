else if($action=='favorite'){

	include _include(APP_PATH.'plugin/GG_thread_favorite/model/user.favorite.func.php');

	if($method=='POST'){

		$action = param('action','add');
		$tid = param('tid');
		if(!$user || empty($user)) message(0,'请先登录');
		$thread = thread_read($tid);
		empty($thread) AND message(0, lang('thread_not_exists'));
		if($action=='add'){
			if(gg_check_favorite($uid, $tid)) message(0,'您已经收藏过了');
			db_insert('gg_favorite_thread',array('tid'=>$tid,'uid'=>$user['uid']));
			message(1,'添加成功！');
		}else if($action=='del'){
			db_delete('gg_favorite_thread',array('tid'=>$tid,'uid'=>$user['uid']));
			message(1,'删除成功！');
		}

	}else{
		
		$page = param(2, 1);
		$pagesize = $conf['pagesize'];
		$threads = gg_favorite_find_by_uid($uid);
		$threadlist = array();
		if(!empty($threads)){
			foreach($threads as $thread){
				$threadlist[] = thread_read($thread['tid']);
			}
		}
		$pagination = pagination(url("my-favorite-{page}"), db_count('gg_favorite_thread',array('uid'=>$uid)), $page, $pagesize);
		include _include(APP_PATH.'plugin/GG_thread_favorite/view/htm/my_favorite.htm');
	
	}

}