$set_vip = setting_get('tt_vip');
$check_result = (!empty($user)) && $set_vip['no_credits_down']!='0' && vip__isvip($user['vip_end']) && vip_getlevel($uid)>=$set_vip['no_credits_down'];
if($check_result) {}
else{