<?php 
!defined('DEBUG') AND exit('Access Denied.');
$action = param(1);
if($action <> "delete")
{	
$recharge_num = db_count('recharge_log',array("status"=>1));
$page = param(1,1);
$rechargelist = db_find("recharge_log",array("status"=>1),array("rechargeid"=>"-1"),$page, $pagesize = 20);
$pagination = pagination("golds_recharge_log-{page}.htm", $recharge_num, $page, $pagesize);
include _include(APP_PATH.'plugin/ax_recharge/view/htm/golds_recharge_log.htm');
}

	if ($action=="delete")
	{
		$r = db_delete("recharge_log",array("rechargeid"=>param('rechargeid')));	
		
		if($r === FALSE) 
		{
			echo "删除失败!";
		} 
		else 
		{
			echo json_encode(array("code"=>"200","message"=>"记录已删除"));
		}		
	}
	

?>