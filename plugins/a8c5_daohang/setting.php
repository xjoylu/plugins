<?php

/*
    会员vip图标 1.0 由火焰驹秦腔网制作
    @火焰驹（QQ：312215120）
*/

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
  
	$setting['a8c5_theme_bbs_name_1_htm'] = setting_get('a8c5_theme_bbs_name_1_htm');
    $setting['a8c5_theme_bbs_name_2_htm'] = setting_get('a8c5_theme_bbs_name_2_htm');
	
    

	
	include _include(APP_PATH.'plugin/a8c5_daohang/setting.htm');
	
} else {

	setting_set('a8c5_theme_bbs_name_1_htm', param('a8c5_theme_bbs_name_1_htm', '', FALSE));
	setting_set('a8c5_theme_bbs_name_2_htm', param('a8c5_theme_bbs_name_2_htm', '', FALSE));
	

	message(0, '配置成功');
}
	
?>