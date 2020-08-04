<?php

/**
 * Gingerbbs 收藏帖子 函数文件
 */


function gg_check_favorite($uid, $tid){
	$r = db_find_one('gg_favorite_thread',array('uid'=>$uid,'tid'=>$tid));
	return empty($r) ? false : true;
}


function gg_favorite_find_by_tid($tid, $page = 1, $pagesize = 4){
	return db_find('gg_favorite_thread', array('tid'=>$tid), array(), $page, $pagesize);
}


function gg_favorite_find_by_uid($uid, $page = 1, $pagesize = 4){
	return db_find('gg_favorite_thread', array('uid'=>$uid), array(), $page, $pagesize);
}


?>
