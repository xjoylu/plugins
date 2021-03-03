<?php 


!defined('DEBUG') AND exit('Access Denied.');

$action = param(3);
$partner = param('partner');
$seller_email = param('seller_email');
$app_key = param('app_key');
if($method == 'GET'){	
//初始化设置	
$pay_setting = kv_get('pay_setting');
if(empty($pay_setting)) 
{
	$pay_setting = array(
	'partner'=>$partner,
	'seller_email'=>$seller_email,
	'app_key'=>$app_key
	);
  kv_set('pay_setting', $pay_setting);
}	
//初始化结束
	$input = form_text('partner', $pay_setting['partner'], '100%');
	$input2 = form_text('seller_email', $pay_setting['seller_email'], '100%');
	$input3 = form_text('app_key', $pay_setting['app_key'], '100%');
	include _include(APP_PATH.'plugin/ax_recharge/view/htm/setting.htm');		
} 
else
{
	$pay_setting = array(
	'partner'=>param('partner'),
	'seller_email'=>param('seller_email'),
	'app_key'=>param('app_key')
);
	kv_set('pay_setting', $pay_setting);		
	message(0, '修改成功');
}
	


?>