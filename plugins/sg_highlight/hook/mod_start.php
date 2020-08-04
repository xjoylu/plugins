<?php exit;

if($action == 'sg_highlight') {
	
	$tids = param(2);
	$arr = explode('_', $tids);
	$tidarr = param_force($arr, array(0));
	empty($tidarr) AND message(-1, lang('please_choose_thread'));
	
	$sg_highlight = param('sg_highlight');
	
	$threadlist = thread_find_by_tids($tidarr);
	
	$r = thread_update($tidarr, array('highlight'=>$sg_highlight));
	$r === FALSE AND message(-1, '设置高亮失败');
	
	message(0, lang('set_completely'));
	
}

?>