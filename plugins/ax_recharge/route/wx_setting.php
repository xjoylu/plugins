<?php 
!defined('DEBUG') AND exit('Access Denied.');
$wx_appid = param('wx_appid');
$appsecert = param('appsecert');
$seller_id = param('seller_id');
$app_key = param('app_key');
if($method == 'GET'){	
//初始化设置	
$wx_pay_setting = kv_get('wx_pay_setting');
if(empty($wx_pay_setting)) 
{
	$wx_pay_setting = array(
	'wx_appid'=>$wx_appid,
	'wx_appsecert'=>$appsecert,
	'wx_seller_id'=>$seller_id,
	'wx_app_key'=>$app_key
);
  kv_set('wx_pay_setting', $wx_pay_setting);
}	
//初始化结束
	$input = form_text('wx_appid', $wx_pay_setting['wx_appid'], '100%');
	$input2 = form_text('wx_appsecert', $wx_pay_setting['wx_appsecert'], '100%');
	$input3 = form_text('wx_seller_id', $wx_pay_setting['wx_seller_id'], '100%');
	$input4 = form_text('wx_app_key', $wx_pay_setting['wx_app_key'], '100%');
	include _include(APP_PATH.'plugin/ax_recharge/view/htm/wx_setting.htm');		
} 
else
{
	$wx_pay_setting = array(
	'wx_appid'=>param('wx_appid'),
	'wx_appsecert'=>param('wx_appsecert'),
	'wx_seller_id'=>param('wx_seller_id'),
	'wx_app_key'=>param('wx_app_key')
);
	kv_set('wx_pay_setting', $wx_pay_setting);		
	message(0, '修改成功');
}
?>