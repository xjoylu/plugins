<?php
$arr= kv_get('wx_pay_setting');
define ('APPID',$arr['wx_appid']);
define ('MCHID',$arr['wx_seller_id']);
define ('KEY',$arr['wx_app_key']);
define ('SSLCERT_PATH','');
define ('SSLKEY_PATH','');
define ('APPSECRET',$arr['wx_appsecert']);
define ('CURL_TIMEOUT',30);
	

	
?>