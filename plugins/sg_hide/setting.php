<?php
!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	$kv = kv_get('sg_hide');
	$input = array();	
	$input['hide1'] = form_checkbox('hide1', $kv['hide1']);
	$input['hide2'] = form_checkbox('hide2', $kv['hide2']);
	$input['hide3'] = form_checkbox('hide3', $kv['hide3']);
	$input['hide4'] = form_text('hide4', $kv['hide4']);
	include _include(APP_PATH.'plugin/sg_hide/setting.htm');
	
} else {

	$kv = array();
	$kv['hide1'] = param('hide1');
	$kv['hide2'] = param('hide2');
	$kv['hide3'] = param('hide3');
	$kv['hide4'] = param('hide4');
	
	kv_set('sg_hide', $kv);
	
	message(0, '修改成功');
}
	
?>