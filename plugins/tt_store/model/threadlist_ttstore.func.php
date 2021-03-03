<?php
function thread__find_by_fid_buy($fid, $page = 1, $pagesize = 20, $order = 'lastpid') {
global $conf, $forumlist, $runtime;
$forum = $fid ? $forumlist[$fid] : array();
$threads = empty($forum) ? $runtime['threads'] : $forum['threads'];

// hook model__thread_find_by_fid_start.php

$cond = array();
$fid AND $cond['fid'] = $fid;
$cond['content_buy']=array('>'=>0); //加了这一步，过滤掉没有收费的主题，直接查表提升效率
$desc = TRUE;
$limitpage = 5000; // 如果需要防止 CC 攻击，可以调整为 5000
if($page > 100) {
$totalpage = ceil($threads / $pagesize);
$halfpage = ceil($totalpage / 2);
if($halfpage > $limitpage && $page < ($totalpage - $limitpage)) {
$page = $limitpage;
}
if($page > $halfpage) {
$page = max(1, $totalpage - $page + 1) ;
$threadlist = thread_find($cond, array($order=>1), $page, $pagesize);
$threadlist = array_reverse($threadlist, TRUE);
$desc = FALSE;
}
}
if($desc) {
$orderby = array($order=>-1);
$threadlist = thread_find($cond, $orderby, $page, $pagesize);
}

// hook model__thread_find_by_fid_end.php

return $threadlist;
}
?>

板块