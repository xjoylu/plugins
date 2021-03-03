<?php
$g_red_type_name=array('','普通红包','拼手气红包','口令红包');
function red_get_packet($uid,$tid) {
    $__thread = db_find_one('thread',array('tid'=>$tid));
    if(empty($__thread))return -1;
    if(empty($uid)) return -2;
    if($__thread['red_num']<=0) return -3;
    if(red_check_got($tid,$uid)) return -4;
    $user = user_read($uid);
    if(empty($user)) return -5;
    $red_packet = db_find_one('thread_red',array('tid'=>$tid));
    $red_packet_type = $red_packet['type'];
    $each=0;
    if($red_packet_type==1) {
        $each=$red_packet['total_money']/$red_packet['total'];
        red_update_sql($tid,$uid,$each,'1');
    } elseif ($red_packet_type==2) {
        if($red_packet['rest']=='1') $each = $red_packet['rest_money'];
        else $each = red_packet_random($red_packet);
        red_update_sql($tid,$uid,$each,'2');
    } elseif ($red_packet_type==3) {
        $command = $red_packet['command'];
        $post = array(
            'tid'=>$tid, 'uid'=>$uid, 'create_date'=>time(), 'userip'=>$user['login_ip'], 'isfirst'=>0, 'doctype'=>0, 'quotepid'=>0, 'message'=>$command,
        );
        $pid = post_create($post, $__thread['fid'], $user['gid']);
        if(empty($pid)){return -6;die();}
        if($red_packet['rest']=='1') $each = $red_packet['rest_money'];
        else $each = red_packet_random($red_packet);
        red_update_sql($tid,$uid,$each,'3');
    }
    return $each;
}
function red_packet_random($red_packet){
    $half = $red_packet['total']>=20? 10 : ($red_packet['total']%2==1) ? (($red_packet['total']+1)/2): ($red_packet['total']/2);
    $min=1;
    if($red_packet['rest']>=$half) {
        $max = (int)($red_packet['rest_money']/$red_packet['rest'] *1.2);
        $min = (int)($red_packet['rest_money']/$red_packet['rest'] *0.1);
        if($max>$red_packet['rest_money']) $max=$red_packet['rest_money'];
        if($min>$red_packet['rest_money']) $min=$red_packet['rest_money'];
    }
    else $max = $red_packet['rest_money'] - $red_packet['rest'] + 1;
    return $max == 1 ? 1 : mt_rand($min, $max);
}
function red_check_got($tid,$uid){
    $red_history = db_count('red_packet',array('uid'=>$uid,'tid'=>$tid));
    if($red_history>0) return true;
    else false;
}
function red_update_sql($tid,$uid,$money,$type){
    $set_red=setting_get('tt_redpacket');
    db_update('thread_red',array('tid'=>$tid),array('rest-'=>1,'rest_money-'=>$money));
    db_update('thread',array('tid'=>$tid),array('red_num-'=>1));
    db_update('user',array('uid'=>$uid),array(get_credits_name_by_type($set_red['money_type']).'+'=>$money));
    db_insert('red_packet',array('uid'=>$uid,'tid'=>$tid,'get'=>$money,'time'=>time()));
    db_insert('user_pay',array('uid'=>$uid,'status'=>1,'num'=>$money,'type'=>9,'credit_type'=>$set_red['money_type'],'time'=>time(),'code'=>red_get_type_by_id($type)));
}
function red_get_type_by_id($type){
    switch($type){
        default:return '普通红包';break;
        case '1':return '普通红包';break;
        case '2':return '拼手气红包';break;
        case '3':return '口令红包';break;
    }
}
?>