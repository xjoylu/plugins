<?php
exit;

	$_user = user_read_cache($uid);
	$t_url = url("thread-$tid");
	$subject = "<a href='".$t_url."'>".$subject."</a>";
	$message = "通知管理员：".$_user['username']."发布了《".$subject."》主题";
	notice_send($uid, 1, $message, 99); // 99:其他通知

?>