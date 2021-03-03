<?php 
/**
*会员签到
*/
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);

if(empty($action)){
	if($method == 'GET'){//设置页面
		$data = db_find_one('sign_config');
		$input = array();
		//风格表单
		@$input['sign_onetime'] = form_text('sign_onetime', $data?$data['sign_onetime']:'0'); 
		@$input['sign_alltime_3'] = form_text('sign_alltime_3', $data?$data['sign_alltime_3']:'0'); 
		@$input['sign_alltime_7'] = form_text('sign_alltime_7', $data?$data['sign_alltime_7']:'0');  
		@$input['sign_alltime_15'] = form_text('sign_alltime_15', $data?$data['sign_alltime_15']:'0');  
		@$input['sign_alltime_30'] = form_text('sign_alltime_30', $data?$data['sign_alltime_30']:'0'); 

		include _include(APP_PATH.'plugin/lc_sign/setting.htm');
	}else{
		//提交页面
		$array = array(
			'sign_onetime' => param('sign_onetime'),
			'sign_alltime_3' => param('sign_alltime_3'),
			'sign_alltime_7' => param('sign_alltime_7'),
			'sign_alltime_15' => param('sign_alltime_15'),
			'sign_alltime_30' => param('sign_alltime_30')
		);

		db_update('sign_config',array('id'=>1),$array);

		
		message(0, lang('confirm_success'));
	}
}
?>