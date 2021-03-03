<?php
/**
 * 一些相关的设置
 */
!defined('DEBUG') and exit('Access Denied.');

$action = param(3);
empty($action) and $action = 'set';

$SX_tieba_settings = kv_get('SX_tieba_settings');

$settings = array(
    'show_upimgonly'       => array(
        'title'   => '只显示上传的图片',
        'note'    => '决定是否显示引用的图片还是只显示上传的图片',
        'type'    => 'radio_yes_no',
        'default' => true
    ),
);
$keys = array();
if ($method == 'GET') {
    $keys = array(
        'show_upimgonly'
    );
    $inputs = array();
    if ($keys) {
        foreach ($keys as $key) {
            $input = $settings[$key];
            $func = 'form_' . $input['type'];
            unset($input['type']);
            $input['html'] = call_user_func_array($func, array(
                $key,
                isset($SX_tieba_settings[$key])?$SX_tieba_settings[$key]:$settings[$key]['default']
            ));
            $inputs[] = $input;
        }
        unset($input);
    }
    include _include(APP_PATH . 'plugin/sx_tieba/htm/setting.htm');
} else {
    $data = $_POST;
    foreach ($data as $key => $val) {
        if (isset($settings[$key])) {
            $SX_tieba_settings[$key] = param($key);
        }
    }
    kv_set('SX_tieba_settings', $SX_tieba_settings);
    message(0, '修改成功');
}