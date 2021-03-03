<?php 
//统计点赞量
function ax_like_num($id){
	$n = db_count('ax_likes',array('friendsid'=>$id));
	return $n ;
}	

//统计用户发布总数

function ax_user_num($uid){
	$n = db_count('ax_friends',array('uid'=>$uid));
	return $n ;
}
//九宫格
function ax_img_list($id){
	$r = db_find_one('ax_friends', array('friendsid'=>$id));
	$con = $r['message'];
	$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
	preg_match_all($pattern,$con,$match);
	return $match;
}
//九宫格2号
function attch_img($friendsid){
	$r = db_find('attach', array('friendsid'=>$friendsid));
	return $r;
}
//判断等级显示图标
function ax_lvs($uid){
	$ax_friends = kv_get('ax_friends');

	if($ax_friends['friends_uid_lv1'] == ''){
		$lv1 = 10 ;
	}else{
		$lv1 = $ax_friends['friends_uid_lv1'];
	}
	if($ax_friends['friends_uid_lv2'] == ''){
		$lv2 = 20 ;
	}else{
		$lv2 = $ax_friends['friends_uid_lv2'];
	}
	if($ax_friends['friends_uid_lv3'] == ''){
		$lv3 = 30 ;
	}else{
		$lv3 = $ax_friends['friends_uid_lv3'];
	}
	if($ax_friends['friends_uid_lv4'] == ''){
		$lv4 = 40 ;
	}else{
		$lv4 = $ax_friends['friends_uid_lv4'];
	}	

	$r = db_find_one('user', array('uid'=>$uid));
	$u_num = $r['friends_num'];
	if($u_num > $lv1 && $u_num < $lv2){
		return "<img src='./plugin/ax_friends/view/img/lv1.png' title='LV1'/>";
	} elseif ($u_num > $lv2 && $u_num < $lv3){
		return "<img src='./plugin/ax_friends/view/img/lv2.png' title='LV2'/>";
	} elseif ($u_num > $lv3 && $u_num < $lv4){
		return "<img src='./plugin/ax_friends/view/img/lv3.png' title='LV3'/>";
	} elseif ($u_num > $lv4){
		return "<img src='./plugin/ax_friends/view/img/lv4.png' title='最高活跃用户'/>";
	} else {
		return "";
	}
}
//点赞的人
function z_user($friendsid){
	$z =  db_find('ax_likes',array('friendsid'=>$friendsid), array('create_date'=>-1), 1, 10);
	return $z;
}
?>