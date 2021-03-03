if($last_login_date<$today0){
    $set_vip = setting_get('tt_vip');
    if(vip__isvip($user['vip_end']))  db_update('user_vip',array('uid'=>$uid),array('grow+'=>$set_vip['grow_per_day']));
    else { $r = db_count('user_vip',array('uid'=>$uid));
        if($r>0){
            $now_grow = db_find_one('user_vip',array('uid'=>$uid))['grow'];
            if($now_grow-$set_vip['decrease_per_day'] >0)
            db_update('user_vip',array('uid'=>$uid),array('grow-'=>$set_vip['decrease_per_day']));
        }
    }
}