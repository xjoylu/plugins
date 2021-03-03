<?php 
/**
*标题高亮风格
*/
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);

if(empty($action)){
	if($method == 'GET'){//设置页面
		//风格表单
		$user_group = db_find_one('vip_setting',array('id'=>1));
		include _include(APP_PATH.'plugin/king_thread_vip/setting.htm');
	}else{//提交页面
		$user_group = param('user_group');
		db_truncate('vip_setting');

		db_insert('vip_setting',array('name' => 'user_group', 'value' => $user_group));
		message(0, lang('confirm_success'));
	}
}
?>