<?php

/*
	插件配置文件 (无配置则不需要此文件)
*/

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
    $forums = forum__find();

    array_unshift($forums, array('fid'=>0, 'name'=>'首页'));
    $kv = kv_get('sky_thumb_list_forum_ids');
    $input = array();

    $sky_thumb_list_fid = isset($kv['sky_thumb_list_fid']) ? explode(',', $kv['sky_thumb_list_fid']) : array();
    $sky_thumb_list_fid_checked = array();
    foreach ($sky_thumb_list_fid as $val) {
        $sky_thumb_list_fid_checked[$val] = $val;
    }
    $sky_txt_thumb_list_fid = isset($kv['sky_txt_thumb_list_fid']) ? explode(',', $kv['sky_txt_thumb_list_fid']) : array();
    $sky_txt_thumb_list_fid_checked = array();
    foreach ($sky_txt_thumb_list_fid as $val) {
        $sky_txt_thumb_list_fid_checked[$val] = $val;
    }
    $thumb_w = isset($kv['thumb_w']) ? $kv['thumb_w'] : 250;
    $thumb_h = isset($kv['thumb_h']) ? $kv['thumb_h'] : 130;

    include _include(APP_PATH.'plugin/sky_thumb_list/setting.htm');

} else {
    $data = $_POST;
    $kv = array();
    $sky_txt_thumb_list_fid = -1;
    $sky_thumb_list_fid = -1;
    if(isset($data['sky_txt_thumb_list_fid'])) {
        $sky_txt_thumb_list_fid = implode(',', $data['sky_txt_thumb_list_fid']);
    }
    if(isset($data['sky_thumb_list_fid'])) {
        $sky_thumb_list_fid = implode(',', $data['sky_thumb_list_fid']);
    }
    $kv['thumb_w'] = $data['thumb_w'];
    $kv['thumb_h'] = $data['thumb_h'];
    $kv['sky_thumb_list_fid'] = $sky_thumb_list_fid;
    $kv['sky_txt_thumb_list_fid'] = $sky_txt_thumb_list_fid;
    kv_set('sky_thumb_list_forum_ids', $kv);
    message(0, '修改成功');
}



?>