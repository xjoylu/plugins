<?php 
	exit;
	$ax_friends = kv_get('ax_friends');
	if($ax_friends['friends_index'] == 1){
		include _include(APP_PATH.'plugin/ax_friends/route/friends.php');
	}else{
		include _include(APP_PATH.'view/htm/index.htm');
	}
	exit;
?>

