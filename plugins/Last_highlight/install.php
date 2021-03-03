<?php

/*  Xiuno BBS 4.0 代码高亮 
	主题 折叠 其他
*/

!defined('DEBUG') AND exit('Forbidden');

$setting = setting_get('Last_highlight');
if(empty($setting)) {
	$setting = array('view'=>'dark', 'fold'=>'on', 'other'=>'0');
	setting_set('Last_highlight', $setting);
}

?>