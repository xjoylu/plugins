<?php exit;
foreach ($threadlist as &$v) {
 	$is_vip = db_find_one('thread_vip', array('tid' => $v['tid']));
 	$status = $is_vip['status'];
 	$v['is_vip'] = $status?1:0;
 } 
?>