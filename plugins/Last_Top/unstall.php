<?php
/*
	清除安装插件时创建的setting记录
	⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄.
*/
!defined('DEBUG') AND exit('Forbidden');
 setting_delete('Last_top_setting');
?>