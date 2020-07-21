<?php

/*
 * Desc:Xiuno BBS 4.0 模板实例：清新简约主题 
 * Author: sifoucn
 * Author URI: www.sifoucn.cn
 * Date: 2019-06-19
*/

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	$setting['footer_end_htm'] = setting_get('footer_end_htm');
	$setting['footer_footer_left_end_htm'] = setting_get('footer_footer_left_end_htm');
	$setting['footer_footer_right_end_htm'] = setting_get('footer_footer_right_end_htm');
	$setting['footer_start_htm'] = setting_get('footer_start_htm');
	$setting['index_main_start_htm'] = setting_get('index_main_start_htm');
	$setting['index_site_brief_after_htm'] = setting_get('index_site_brief_after_htm');
	$setting['forum_breadcrumb_before_htm'] = setting_get('forum_breadcrumb_before_htm');
	$setting['forum_mod_after_htm'] = setting_get('forum_mod_after_htm');
	$setting['thread_user_after_htm'] = setting_get('thread_user_after_htm');

	include _include(APP_PATH.'plugin/sifoucn_theme_limpid/setting.htm');
	
} else {

	setting_set('footer_end_htm', param('footer_end_htm', '', FALSE));
	setting_set('footer_footer_left_end_htm', param('footer_footer_left_end_htm', '', FALSE));
	setting_set('footer_footer_right_end_htm', param('footer_footer_right_end_htm', '', FALSE));
	setting_set('footer_start_htm', param('footer_start_htm', '', FALSE));
	setting_set('index_main_start_htm', param('index_main_start_htm', '', FALSE));
	setting_set('index_site_brief_after_htm', param('index_site_brief_after_htm', '', FALSE));
	setting_set('forum_breadcrumb_before_htm', param('forum_breadcrumb_before_htm', '', FALSE));
	setting_set('forum_mod_after_htm', param('forum_mod_after_htm', '', FALSE));
	setting_set('thread_user_after_htm', param('thread_user_after_htm', '', FALSE));
	
	message(0, '修改成功');
}
	
?>