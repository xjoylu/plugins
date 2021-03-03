<?php exit;

if($status){
	db_insert('thread_vip', array('tid' => $tid, 'status' => $status, 'viprank' => $viprank));
}
?>