<?php

/**
 * User: last
 * Date: 2018/5/13
 * Time: 下午10:06
 */

!defined('DEBUG') AND exit('Access Denied.');

$action = param(1);
$kv = kv_cache_get('git_tags');

if ($action=='add'){
	$tid = param('tid', 0);
	$tag = param('tag');
	empty($uid) AND message(-1, "未登录");
	tag_law($tag,$kv) AND message(-1, "非法字符或长度");

	tag_lock($uid,$tid,$gid,$kv['lock']) AND message(-1, "TAG锁");
	tag_rep($tag,$tid) AND message(-1, "重复标签");
	tag_max($tid) AND message(-1, "最多12个");

	$r = tag_add($tid,$tag);
	message(1, $r);

}elseif ($action=='del') {

	$tid = param('tid', 0);
	$tagid = param('tag', 0);
	empty($uid) AND message(-1, "未登录");
	tag_lock($uid,$tid,$gid,$kv['lock']) AND message(-1, "TAG锁");

	tag_del($tid,$tagid);
	message(0, '删除完毕');

}elseif (is_numeric($action)){

	$page     = param(2, 1);
	$pagesize = $conf['pagesize'];
	$order    = array('tid'=>-1);

	// lastpid 似乎会导致错误..
	// $order = $conf['order_default'];

	$tag  = tag_info($action) OR message(-1,'TAG 不存在');
	$list = tag_list($action, $page, $pagesize, $order);

	// 过滤无权访问的(或许会导致页码总数错误..?)
	// thread_list_access_filter($list, $gid);

	$header['title'] = $tag['name'];
	$header['mobile_title'] = $tag['name'];
	$header['mobile_link']= "#";


	if($ajax && !isset($_SERVER['HTTP_X_PJAX'])) message(0, $list);
	include _include(APP_PATH.'plugin/git_tags/view/htm/tag.htm');

}else{

	// hook tag_end.php
	message(-1, "error");

}
