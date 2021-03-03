$set_vip = setting_get('tt_vip');
if($uid && $set_vip['up_read']!='0' && vip__isvip($user['vip_end']))
    $my_p += $set_vip['up_read'];