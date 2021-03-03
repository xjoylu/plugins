<?php exit;
 $is_vip = db_find_one('thread_vip',array('tid'=>$tid));
 if($is_vip){
	
 	
	  
 	$status = cache_get("thread_vip_".$tid."_".$uid);
 	//判断是不是自己的帖子，以及权限
 	$thread = db_find_one('thread', array('tid' => $tid));
	//分割获取viprank
	
	$allow = db_find_one('thread_vip', array('tid' => $tid));
	
	
	if(!$status&&$thread['uid']!=$uid){//判断是否为自己的帖子
		 
		if(!empty($allow['viprank'])){ //
		$group_arr = explode('|', $allow['viprank']);
		if(!in_array($gid, $group_arr)){
			include _include(APP_PATH.'plugin/king_thread_vip/hook/vip_login.htm');exit;
		}
		 	
	
	}
	else{
 	include _include(APP_PATH.'plugin/king_thread_vip/hook/vip_login.htm');exit;
}
 	
	
	 }
	
	
	

	
	
	
 }
?>