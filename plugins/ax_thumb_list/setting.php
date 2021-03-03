<?php 

!defined('DEBUG') AND exit('Access Denied.');

$action = param(3);
$_gid = param('post_gid', array());
$_gid2 = param('post_gid2', array());

if($method == 'GET') {	
//初始化设置	
$from_sell_allow = kv_get('from_sell_allow');
if(empty($from_sell_allow)) 
{
	
	$from_sell_allow = array(
	'gid'=>$_gid,
	'gid2'=>$_gid2
);
  kv_set('from_sell_allow', $from_sell_allow);
}	
//初始化结束

	include _include(APP_PATH.'plugin/ax_thumb_list/setting.htm');		
} 
else
{
	$from_sell_allow['gid'] = $_gid;
	$from_sell_allow['gid2'] = $_gid2;
	kv_set('from_sell_allow', $from_sell_allow);		
	message(0, '修改成功');
}
	



?>
