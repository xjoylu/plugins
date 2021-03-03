<?php 

!defined('DEBUG') AND exit('Access Denied.');

$action = param(3);

$open = param('open');
$forum_name = param('forum_name');
$banner = param('banner');
$banner1 = param('banner1');
$banner2 = param('banner2');
$banner3 = param('banner3');
$paihang = param('paihang');
$_fid =  param('fid');
$piclist = param('piclist');
$fid_index = param('fid_index');

if($method == 'GET') {	
//初始化设置	
$ax_index_forum = kv_get('ax_index_forum');
if(empty($ax_index_forum)) {
	
	$ax_index_forum = array(
	'open'=>$open,
	'forum_name'=>$forum_name,
	'banner'=>$banner,
	'banner1'=>$banner1,
	'banner2'=>$banner2,
	'banner3'=>$banner3,
	'paihang'=>$paihang,
	'fid'=>$_fid,
	'piclist'=>$piclist,
	'fid_index'=>$fid_index,
);
  kv_set('ax_index_forum', $ax_index_forum);
}	
//初始化结束

	$input =  form_radio_yes_no('open', $ax_index_forum['open']); 
	$input1 = form_text('forum_name',$ax_index_forum['forum_name'],'100%','板块名称');
	$input2 = form_radio_yes_no('banner', $ax_index_forum['banner']); 

	$input3 = form_text('banner1',$ax_index_forum['banner1'],'100%','图片1');
	$input4 = form_text('banner2',$ax_index_forum['banner2'],'100%','图片2');
	$input5 = form_text('banner3',$ax_index_forum['banner3'],'100%','图片3');

	$paihang = form_radio_yes_no('paihang', $ax_index_forum['paihang']);

	$input6 = form_radio_yes_no('piclist', $ax_index_forum['piclist']); 

	include _include(APP_PATH.'plugin/ax_index_forum/setting.htm');		
} 
else
{

	$ax_index_forum['open'] = $open;
	$ax_index_forum['forum_name'] = $forum_name;
	$ax_index_forum['banner'] = $banner;
	$ax_index_forum['banner1'] = $banner1;
	$ax_index_forum['banner2'] = $banner2;
	$ax_index_forum['banner3'] = $banner3;
	$ax_index_forum['paihang'] = $paihang;
	$ax_index_forum['fid'] = $_fid;
	$ax_index_forum['piclist'] = $piclist;
	$ax_index_forum['fid_index'] = $fid_index;
	kv_set('ax_index_forum', $ax_index_forum);		
	message(0, '修改成功');
}
	



?>
