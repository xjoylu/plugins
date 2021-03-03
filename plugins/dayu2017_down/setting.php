<?php 
/**
*附件下载弹出
*/
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);

if(empty($action)){
	if($method == 'GET'){//设置页面

		$input = array();
		//风格表单

	

		include _include(APP_PATH.'plugin/dayu2017_down/setting.htm');
	}else{
		//提交页面
	file_put_contents(APP_PATH."plugin/dayu2017_down/hook/ad.htm", $_POST['content']);
		
		message(0, "保存成功");
	}
}
?>