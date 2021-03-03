<?php

!defined('DEBUG') AND exit('Access Denied.');

$act = param(1);
$ax_friends = kv_get('ax_friends');

if($method == 'GET') {

	$friends_num =  db_count('ax_friends');
	$page = param(1,1);
	if($ax_friends['friends_num']){
		$pagesize = $ax_friends['friends_num'];
	}else{
		$pagesize = 20;
	}
	$friends_list =  db_find('ax_friends',array('friendsid'=>array('!='=>0)), array('friendsid'=>-1), $page, $pagesize);	
	$pagination = pagination(url("friends-{page}"), $friends_num, $page, $pagesize);

	



	include _include(APP_PATH.'plugin/ax_friends/view/htm/friends.htm');

}else{

	//前台登录验证
	//user_login_check();

	//发布		
	if($act == 'add'){
		if(!$uid){
			message(2,'请登录！');exit;
		}
		if($gid == 0 || $gid == 7){
			message(4,'您所在的用户组禁止发布！');exit;
		}
		$message = xn_html_safe(param('message', '', FALSE));
		if($message == ''){
			message(3,'亲，请输入内容！');exit;
		}

		$time = time();

		//后台限制用户发布间隔
		$stop = db_find_one('ax_friends', array('uid'=>$uid),array('create_date'=>-1));
		$notime = $time - $stop['create_date'];
		if($ax_friends['friends_time']){
			if($notime <= $ax_friends['friends_time']){
				$notimename = "请在".$ax_friends['friends_time']."秒后再次发布！";
				message(5,$notimename);exit;
			}
		}

		//添加会员发布数量
		$_u =  db_find_one('user', array('uid'=>$uid));

		$friends_num = $_u['friends_num'] + 1 ;

		$r = db_create('ax_friends', array('uid'=>$uid,'create_date'=>$time,'message'=>$message));
		
		//上传附件图片
		$tmp_files =  _SESSION('tmp_files');
		$tid = 0;
		$pid = 0;
		$_friendsid = $r;
		$attach_dir_save_rule = array_value($conf, 'attach_dir_save_rule', 'Ym');
		if($tmp_files) {
			foreach($tmp_files as $file) {				
	
				$filename = file_name($file['url']);			
				$day = date($attach_dir_save_rule, $time);
				$path = $conf['upload_path'].'friends/'.$day;
				$url = $conf['upload_url'].'friends/'.$day;
				!is_dir($path) AND mkdir($path, 0777, TRUE);
				
				$destfile = $path.'/'.$filename;
				$desturl = $url.'/'.$filename;
				$ra = xn_copy($file['path'], $destfile);
				!$ra AND xn_log("xn_copy($file[path]), $destfile) failed, pid:$pid, tid:$tid", 'php_error');
				if(is_file($destfile) && filesize($destfile) == filesize($file['path'])) {
					@unlink($file['path']);
				}
				$arr = array(
					'tid'=>$tid,
					'pid'=>$pid,
					'uid'=>$uid,
					'filesize'=>$file['filesize'],
					'width'=>$file['width'],
					'height'=>$file['height'],
					'filename'=>"$day/$filename",
					'orgfilename'=>$file['orgfilename'],
					'filetype'=>$file['filetype'],
					'create_date'=>$time,
					'comment'=>'',
					'downloads'=>0,
					'isimage'=>$file['isimage'],
					'friendsid'=> $_friendsid
				);	
				// 插入后，进行关联
				$aid = attach_create($arr);
				$_SESSION['tmp_files'] = array();		
			}
		}


		db_update('user', array('uid'=>$uid),array('friends_num'=>$friends_num));
		message(0,'发布成功！');
				
		
				
	} elseif($act == 'del'){
		$friendsid = param('friendsid');
		$f =  db_find_one('ax_friends', array('friendsid'=>$friendsid));
		$_u =  db_find_one('user', array('uid'=>$uid));

		//删减会员发布统计输入判断
		if($_u['friends_num'] > 0){
			$friends_num = $_u['friends_num'] - 1 ;
		}else{
			$friends_num = 0 ;
		}

		$r = db_delete('ax_friends', array('friendsid'=>$friendsid));
		if($r === FALSE) {
			echo -1;exit; 
		} else {

			//删除手动上传图片
			$attachlist = db_find('attach', array('friendsid'=>$friendsid));
			if($attachlist){foreach ($attachlist as $v) {
				$path = 'upload/friends/'.$v['filename'];
				file_exists($path) AND unlink($path);
				attach__delete($v['aid']);
			}}
			

			db_update('user', array('uid'=>$f['uid']),array('friends_num'=>$friends_num));
			db_delete('ax_likes', array('friendsid'=>$friendsid));
			echo 1;exit; 
		}		
		

	} elseif($act == 'z'){
		$_uid = param('uid'); //列表uid
		$uid_like = $uid; //当前点赞用户
		if(!$uid){
			echo 2;exit;
		}
		if($gid == 0 || $gid == 7){
			echo 3;exit;
		}
		$create_date = time();
		$friendsid = param('friendsid');
		$r = db_find_one('ax_likes', array('uid'=>$_uid,'uid_like'=>$uid_like,'friendsid'=>$friendsid));
		if($r){
			echo  0;exit;
		}else{
			$arr = array(
				'uid'=>$_uid,
				'uid_like'=>$uid_like,
				'create_date'=>$create_date,
				'friendsid'=>$friendsid,
			);
			$addlike = db_create('ax_likes', $arr);
			if($addlike){
				echo  1;exit;	
			}		
		}
	} 
	








}







?>