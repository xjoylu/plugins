<?php

/*
	Xiuno BBS 4.0 大白插件市场
*/

!defined('DEBUG') AND exit('Access Denied.'); 
$setting = setting_get('huux_plugin');
$action = param(3);
$dabaiurl = 'www.huux.cc';
function _replace($a,$b,$c){
	$content = file_get_contents($a);
	$content = str_replace($b,$c,$content);
	file_put_contents($a,$content);
}
if($method == 'GET') {
		 $input = array(); 
		 $input['plugin_io'] = form_radio('plugin_io', array(0=>'官方插件', 1=>'大白精选插件'), $setting['plugin_io']);
		 include _include(APP_PATH.'plugin/huux_plugin/setting.htm');
} else{
	    $setting['plugin_io'] = param('plugin_io', 0);

	    //我要修改文件了
	    if($setting['plugin_io']==1){
	    	$viewpage = ADMIN_PATH.'view/htm/plugin_list.htm';
            $str = file_get_contents($viewpage);
	    	preg_match("/bbs.xiuno.com/", $str, $match);
	    	if($match) {
	    		$oldplugin = APP_PATH.'model/plugin.func.php';
	    		$tabname = APP_PATH.'lang/zh-cn/bbs_admin.php';
		    	_replace($oldplugin,'plugin.xiuno.com',$dabaiurl);
		    	_replace($tabname,'官方插件','大白精选插件');
		    	_replace($viewpage,'bbs.xiuno.com',$dabaiurl);
			}else{
				message(-1, array('文件已经修改过，无须修改'));
			}

	    }else{
	    	$viewpage = ADMIN_PATH.'view/htm/plugin_list.htm';
            $str = file_get_contents($viewpage);
	    	preg_match("/www.huux.cc/", $str, $match);
	    	if($match) {
	    		$oldplugin = APP_PATH.'model/plugin.func.php';
	    		$tabname = APP_PATH.'lang/zh-cn/bbs_admin.php';
		    	_replace($oldplugin,$dabaiurl,'plugin.xiuno.com');
		    	_replace($tabname,'大白精选插件','官方插件');
		    	_replace($viewpage,$dabaiurl,'bbs.xiuno.com');
			}else{
				message(-1, array('文件已经修改过，无须修改'));
			}

	    }

	    // 引入双清
	    cache_truncate();
		$runtime = NULL; 
		rmdir_recusive($conf['tmp_path'], 1);
	    setting_set('huux_plugin', $setting);
		message(0, array('切换成功'));

}

?>