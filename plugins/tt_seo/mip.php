<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(1);
$tid = param(1, 0);
$page = param(2, 1);
$keyword = param(3);
$pagesize = $conf['postlist_pagesize'];
//$pagesize = 10;
//$page == 1 AND $pagesize++;

// hook thread_info_start.php

$thread = thread_read($tid);
empty($thread) AND message(-1, lang('thread_not_exists'));

$fid = $thread['fid'];
$forum = forum_read($fid);
empty($forum) AND message(3, lang('forum_not_exists'));

$postlist = post_find_by_tid($tid, $page, $pagesize);
empty($postlist) AND message(4, lang('post_not_exists'));

if($page == 1) {
    empty($postlist[$thread['firstpid']]) AND message(-1, lang('data_malformation'));
    $first = $postlist[$thread['firstpid']];
    unset($postlist[$thread['firstpid']]);
    $attachlist = $imagelist = $filelist = array();

    // 如果是大站，可以用单独的点击服务，减少 db 压力
    // if request is huge, separate it from mysql server
    thread_inc_views($tid);
} else {
    $first = post_read($thread['firstpid']);
}
$keywordurl = '';
if($keyword) {
    $thread['subject'] = post_highlight_keyword($thread['subject'], $keyword);
    //$first['message'] = post_highlight_keyword($first['subject']);
    $keywordurl = "-$keyword";
}
$allowpost = forum_access_user($fid, $gid, 'allowpost') ? 1 : 0;
$allowupdate = forum_access_mod($fid, $gid, 'allowupdate') ? 1 : 0;
$allowdelete = forum_access_mod($fid, $gid, 'allowdelete') ? 1 : 0;

forum_access_user($fid, $gid, 'allowread') OR message(-1, lang('user_group_insufficient_privilege'));

$pagination = pagination(url("thread-$tid-{page}$keywordurl"), $thread['posts'] + 1, $page, $pagesize);

$header['title'] = $thread['subject'].'-'.$forum['name'].'-'.$conf['sitename'];
//$header['mobile_title'] = lang('thread_detail');
$header['mobile_title'] = $forum['name'];;
$header['mobile_link'] = url("forum-$fid");
$header['keywords'] = '';
$header['description'] = $thread['subject'];
$_SESSION['fid'] = $fid;
// hook thread_info_end.php

include _include(APP_PATH.'plugin/tt_seo/view/htm/mip.htm');