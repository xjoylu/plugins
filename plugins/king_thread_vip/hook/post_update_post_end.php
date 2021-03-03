<?php exit; 

$exist = db_find_one('thread_vip', array('tid' => $tid));
if($status){
	if($exist){
		db_update('thread_vip', array('tid' => $tid), array('viprank' => $viprank));
	}else{
		db_insert('thread_vip', array('tid' => $tid, 'status' => $status, 'viprank' => $viprank));
	}
	
}else{
	if($exist){
		db_delete('thread_vip', array('tid' => $tid));
	}	
}
?>