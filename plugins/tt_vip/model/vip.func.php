<?php
function vip__isvip($end_time)
{
    return time()<$end_time?1:0;
}
function vip_isvip($uid){
    $now_time = time();
    $end_time = db_find_one('user',array('uid'=>$uid))['vip_end'];
    return $now_time<$end_time?1:0;
}
function vip_getlevel($uid)
{
    $r = db_count('user_vip',array('uid'=>$uid));
    if($r>0)
        return db_find_one('user_vip',array('uid'=>$uid))['level'];
    else
        return 0;
}
function vip_get_credits_name($type)
{
    switch($type) {
        default: return 'credits';break;
        case '1': return 'credits';break;
        case '2':return 'golds';break;
        case '3':return 'rmbs';break;
    }
}
function vip_read($uid)
{
    return db_find_one('user_vip',array('uid'=>$uid));
}
function vip_add($uid,$num,$T)
{
    switch($T)
    {   default: $day= $num*31;$day_text='month';break;
        case 'm': $day= $num*31;$day_text='month';break;
        case 's': $day=$num*93;$day_text='season';break;
        case 'hy': $day=$num*186;$day_text='half_year';break;
        case 'y':$day = $num*372;$day_text='year';break; }
    $set = setting_get('tt_vip');
    $T_cost = $set[$day_text.'_fee']*$num;$T_grow = $set[$day_text.'_grow']*$num; $type_money = $set['fee_type'];
    $r = db_find_one('user',array('uid'=>$uid));
    if(empty($r)) return false;
    $now_money = $r[vip_get_credits_name($type_money)] ;
    if($now_money<$T_cost) return -1;
    db_update('user',array('uid'=>$uid),array(vip_get_credits_name($type_money).'-'=>$T_cost));
    db_insert('user_pay',array('uid'=>$uid,'status'=>1,'num'=>$T_cost,'type'=>7,'credit_type'=>$type_money,'time'=>time(),'code'=>$day.'天'));
    if(vip_isvip($uid)) {
        db_update('user', array('uid' => $uid), array('vip_end+' => $day * 86400));
        db_update('user_vip', array('uid' => $uid), array('end+' => $day * 86400));
    } else {
        db_update('user', array('uid' => $uid), array('vip_end' => (time() + $day * 86400)));
        $exist = db_count('user_vip',array('uid'=>$uid));
        if($exist) db_update('user_vip', array('uid' => $uid), array('end' => (time() + $day * 86400),'grow+'=>$T_grow));
        else db_insert('user_vip', array('uid' => $uid,'end' => (time() + $day * 86400),'grow'=>$T_grow));
    }
    vip_update_level($uid);
    return 1;
}
function vip_update_level($uid)
{
    $r = db_count('user_vip',array('uid'=>$uid));
    if($r>0) {
        $now_grow = db_find_one('user_vip', array('uid' => $uid))['grow'];
        $set = setting_get('tt_vip');
        $level = 1;
        $set['level1'] = 0;
        $set['level7'] = 99999999;
        for ($i = 1; $i <= 6; $i++)
            if ($now_grow >= $set['level' . $i] && $now_grow < $set['level' . ($i + 1)]) {
                $level = $i; break; }
        db_update('user_vip', array('uid' => $uid), array('level' => $level));
    }
}
function vip_get_maxgrow($grow)
{
    $set= setting_get('tt_vip');$max_grow = 0;
    $set['level1']=0;$set['level7']=99999999;
    for($i=1;$i<=6;$i++)
        if($grow>=$set['level'.$i]&&$grow<$set['level'.($i+1)])
            { $max_grow = $set['level'.($i+1)];break;}
    return $max_grow;
}
?>