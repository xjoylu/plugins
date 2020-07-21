<?php
/**
 * @author 于磊 <86683712@qq.com>
*/
!defined('DEBUG') AND exit('Access Denied.');

// 定义插件根目录
define('DJ_ROOT', APP_PATH.'plugin/dj_hide_content/');

if($method === 'POST'){
    $gids = _POST('gid');
    // 管理员组永远可见
    array_push($gids, 1);
    $gids_str = implode('-', $gids);
    setting_set('dj_gids', $gids_str);
	$msg = true;
}
$grouplist = cache_get('grouplist');
$gids = setting_get('dj_gids');
if($gids){
    $gids = explode('-', $gids);
}
include _include(DJ_ROOT.'setting.htm');