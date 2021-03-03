$store = param(2, 0);
if($store == 2) {
	$thread_list_from_default = 0;
	$active = 'Store';
	$stores = thread_digest_count($fid);
	$fid=setting_get('tt_store')['fid'];
	$pagination = pagination(url("$route-{page}-2"), $stores, $page, $pagesize);
	$threadlist = thread__find_by_fid_buy($fid, $page, $pagesize);
}