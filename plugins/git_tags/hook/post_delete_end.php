<?php exit;
/**
if($isfirst) {
	$page = '1';
	$pagesize = '12';
	$data = db_find('git_tags_thread', array('tid'=>$tid), array(), $page, $pagesize);
	if($data){
		// 删关联 降计数 ( 权限主题已验证 )
		$arr = arrlist_values($data, 'tagid');
		db_delete('git_tags_thread', array('tid'=>$tid));
		db_update('git_tags', array('tagid'=>$arr), array('link-'=>1));
		db_delete('git_tags', array('tagid'=>$arr,'link'=>0));
	}
}
**/
