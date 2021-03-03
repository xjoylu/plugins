<?php

function haya_post_like_create($arr) {
	$r = db_create('haya_post_like', $arr);
	return $r;
}

function haya_post_like_count($cond = array()) {
	$n = db_count('haya_post_like', $cond);
	return $n;
}

function haya_post_like_find(
	$cond = array(), 
	$orderby = array(), 
	$page = 1, 
	$pagesize = 20
) {
	$thumbups = db_find('haya_post_like', $cond, $orderby, $page, $pagesize);
	
	if (!empty($thumbups)) {
		foreach ($thumbups as & $thumbup) {
			$thumbup['post'] = post_read($thumbup['pid']);
			$thumbup['user'] = user_read($thumbup['uid']);
		}
	}	
	
	return $thumbups;
}

function haya_post_like_find_by_uid_and_pid($uid, $pid) {
	$r = db_find('haya_post_like', array('uid' => $uid, 'pid' => $pid));
	return empty($r) ? false : true;
}

function haya_post_like_find_by_pid($pid, $num = 20) {
	$haya_post_likes = haya_post_like_find(array('pid' => $pid), array('create_date' => -1), 1, $num); 
	
	return $haya_post_likes;
}

function haya_post_like_find_by_pids($pids) {
	if (!$pids) {
		return array();
	}

	$orderby = array('create_date' => -1);
	$r = db_find('haya_post_like', array('pid' => $pids), $orderby, 1, 1000, 'pid');
	return $r;
}

function haya_post_like_delete_by_tid($tid) {
	$r = db_delete('haya_post_like', array('tid' => $tid));
	return $r;
}

function haya_post_like_delete_by_pid($pid) {
	$r = db_delete('haya_post_like', array('pid' => $pid));
	return $r;
}

function haya_post_like_delete_by_pid_and_uid($pid, $uid) {
	$r = db_delete('haya_post_like', array('pid' => $pid, 'uid' => $uid));
	return $r;
}

// haya_post_likes + 1
function haya_post_like_loves($pid, $n = 1) {
	$r = db_update('post', array('pid' => $pid), array('haya_post_likes+' => $n));
	return $r;
}

function haya_post_like_find_hot_loves_by_tid($tid, $num = 5, $thumbup = 10) {
	$haya_post_likes = post_find(array('tid' => $tid, 'haya_post_likes' => array(">=" => $thumbup)), array('haya_post_likes' => -1, 'create_date' => -1), 1, $num); 
	
	return $haya_post_likes;
}


?>
