<?php exit;
if($action == 'seo') {
	if($method == 'GET')
		include _include(APP_PATH.'plugin/tt_seo/view/htm/mod_seo.htm');
	 else {
         if($gid!=1) die('无权操作');
         $auto_push = param('auto','0');
         $xzh_push = param('xzh','0');
         $auto_push_mip = param('auto_mip','0');
         $xzh_push_mip = param('xzh_mip','0');
         $tid = param('tidarr',array(0));
         if($tid=='0')die('ERROR');
         if($auto_push=='auto')
             seo_auto_push($tid,$uid,setting_get('tt_seo'));
         if($xzh_push=='xzh')
             seo_xzh_push($tid,$uid,setting_get('tt_seo'),'batch');
         if($auto_push_mip=='auto_mip')
             seo_auto_push_mip($tid,$uid,setting_get('tt_seo'));
         if($xzh_push_mip=='xzh_mip')
             seo_xzh_push_mip($tid,$uid,setting_get('tt_seo'),'batch');
         message(0, '更新成功!');
	}
}

?>