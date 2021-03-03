$huux_os_set = setting_get('huux_os_set');	
if($huux_os_set['user_create_io']){
message(0, jump('对不起, 已经关闭注册', http_referer(), 1));


}