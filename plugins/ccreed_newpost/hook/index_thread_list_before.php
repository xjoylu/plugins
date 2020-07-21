$newpost = param(2, 0);
if($newpost == 2) {
	$thread_list_from_default = 0;
	$active = 'newpost';
    $newposts = thread_digest_count($fid);
	
	$pagination = pagination(url("$route-{page}-1"), $digests, $page, $pagesize);
	
	$threadlist = array_reverse(thread_digest_find_by_fid($fid, $page, $pagesize),true);
}