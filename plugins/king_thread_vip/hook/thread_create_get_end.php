<?php exit;

$allow = db_find_one('vip_setting',array('name' => 'user_group'));
if(!empty($allow['value'])){
	$group_arr = explode('|', $allow['value']);
	if(in_array($gid, $group_arr)){
		$allow_status = 1;
	}else{
		$allow_status = 0;
	}
	$input['is_vip'] = form_radio_yes_no('is_vip', 0);
}else{
	$allow_status = 0;
}

?>