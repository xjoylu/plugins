<?php 
	$rechargeid = param('id');
	$arr = db_find_one('recharge_log', array('rechargeid'=>$rechargeid));
	if($arr){
		echo $arr['status'];
	}
?>