<?php

/*
	插件配置文件 (无配置则不需要此文件)
*/

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
    $kv = kv_get('sky_content_insert_code_data');
    $input = array();
    $sky_content_insert_code_content = isset($kv['sky_content_insert_code_content']) ? $kv['sky_content_insert_code_content'] : '';
    $input['sky_content_insert_code_content'] = form_textarea('sky_content_insert_code_content', $sky_content_insert_code_content, '', 150);

    include _include(APP_PATH.'plugin/sky_content_insert_code/setting.htm');
} else {
    $kv = array();
    $sky_content_insert_code_content = param('sky_content_insert_code_content');

    $kv['sky_content_insert_code_content'] = $sky_content_insert_code_content;

    kv_set('sky_content_insert_code_data', $kv);
    message(0, '修改成功');
}



?>