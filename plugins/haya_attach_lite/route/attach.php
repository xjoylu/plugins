<?php

defined('DEBUG') OR exit('Forbidden');

// 定义插件根目录
define('HAYA_FILE_ROOT', APP_PATH.'plugin/haya_attach_lite/');

// 定义插件视图根目录
define('HAYA_FILE_HTML', HAYA_FILE_ROOT.'html/');

// 定义插件动作根目录
define('HAYA_FILE_INC', HAYA_FILE_ROOT.'inc/');

// 定义导航
$menuTab = array(
	'setting' => array(
		'url' => url('attachlite-setting'),
		'text' => '插件设置',
	),
	'attachs' => array(
		'url' => url('attachlite-attachs'),
		'text' => '附件管理',
	),
);

// 统一请求
$method = strtolower($method);

$action = param(1);
empty($action) and $action = 'setting';

$actions = array(
	'setting',
	'attachs',
	'read',
	'delete',
);

// 引入动作
if (!in_array($action, $actions)) {
	message(1, jump('访问错误', 'back'));
} 

// 判断文件
$hayaFile = HAYA_FILE_INC.$action.'.php';
if (!file_exists($hayaFile)) {
	message(1, jump($action . '动作不存在', 'back'));
}

include _include(HAYA_FILE_ROOT.'model/attach.func.php');

// 具体文件
include _include($hayaFile);	


