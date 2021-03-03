<?php

/*
	八彩五月网制作 QQ：312215120
	网址：http//www.8c5.cn
*/

!defined('DEBUG') AND exit('Access Denied.');

$action = param(3);

if(empty($action)) {
	
	$linklist = db_find('fontlink', array(), array('rank'=>-1), 1, 1000, 'linkid');
	$maxid = db_maxid('fontlink', 'linkid');
	
	if($method == 'GET') {
		
		include _include(APP_PATH.'plugin/a8c5_fontlist/setting.htm');
		
	} else {
		
		$rowidarr = param('rowid', array(0));
		$namearr = param('name', array(''));
		$imgurlarr = param('imgurl', array(''));
		$urlarr = param('url', array(''));
		$rankarr = param('rank', array(0));
		
		$arrlist = array();
		foreach($rowidarr as $k=>$v) {
			if(empty($namearr[$k]) && empty($imgurlarr[$k])&& empty($urlarr[$k]) && empty($rankarr[$k])) continue;
			$arr = array(
				'linkid'=>$k,
				'name'=>$namearr[$k],
				'imgurl'=>$imgurlarr[$k],
				'url'=>$urlarr[$k],
				'rank'=>$rankarr[$k],
			);
			if(!isset($linklist[$k])) {
				db_create('fontlink', $arr);
			} else {
				db_update('fontlink', array('linkid'=>$k), $arr);
			}
		}
		
		// 删除
		$deletearr = array_diff_key($linklist, $rowidarr);
		foreach($deletearr as $k=>$v) {
			db_delete('fontlink', array('linkid'=>$k));
		}
		
		message(0, '保存成功');
	}
}
?>