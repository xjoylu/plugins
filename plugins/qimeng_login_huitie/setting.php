<?php

/*
    游客引导回帖框 1.0
    @奇梦（QQ：505418324）
*/

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
  
	$setting['qimeng_login_huitie_name_htm'] = setting_get('qimeng_login_huitie_name_htm');
	$setting['qimeng_login_huitie_name_1_htm'] = setting_get('qimeng_login_huitie_name_1_htm');
    $setting['qimeng_login_huitie_name_2_htm'] = setting_get('qimeng_login_huitie_name_2_htm');
    $setting['qimeng_login_huitie_name_3_htm'] = setting_get('qimeng_login_huitie_name_3_htm');

	
	include _include(APP_PATH.'plugin/qimeng_login_huitie/setting.htm');
	
} else {

    setting_set('qimeng_login_huitie_name_htm', param('qimeng_login_huitie_name_htm', '', FALSE));
	setting_set('qimeng_login_huitie_name_1_htm', param('qimeng_login_huitie_name_1_htm', '', FALSE));
	setting_set('qimeng_login_huitie_name_2_htm', param('qimeng_login_huitie_name_2_htm', '', FALSE));
	setting_set('qimeng_login_huitie_name_3_htm', param('qimeng_login_huitie_name_3_htm', '', FALSE));

	message(0, '配置成功');
}
	
?>