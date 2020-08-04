<?php

defined('DEBUG') OR exit('Forbidden');

// 添加插件配置
$haya_attach_lite_config = array(
	"show_pic" => 0,
	"list_type" => 0,
);
setting_set('haya_attach_lite', $haya_attach_lite_config); 

?>