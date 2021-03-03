<?php !defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)) {
    if ($method == 'GET') {
        include _include(APP_PATH . 'plugin/tt_vip/setting.htm');
    } elseif ($method == "POST") {
        $op=param('op');
        if($op==0) {
            $set = setting_get('tt_vip');
            $update_list = array();
            foreach ($set as $k => $v)
                $update_list[$k] = param($k);
            setting_set('tt_vip', $update_list);
            message(0, '设置成功!');
        } elseif($op==1){//inquire
            $_username = param('_username');
            if(empty($_username)) message(-1,'ERROR');
            $__user = user_read_by_username($_username);
            if(empty($__user)) message(-1,'ERROR');
            $r = db_find_one('user_vip',array('uid'=>$__user['uid']));
            if($r) message(0,xn_json_encode(array('grow'=>$r['grow'],'expire'=>$r['end'])));
            else message(0,xn_json_encode(array('grow'=>0,'expire'=>0)));
        } elseif($op==2){//update
            $_username = param('_username');
            if(empty($_username)) message(-1,'ERROR');
            $__user = user_read_by_username($_username);
            if(empty($__user)) message(-1,'ERROR');
            $expire = param('vip_expire');
            $grow = param('vip_grow');
            $r = db_count('user_vip',array('uid'=>$__user['uid']));
            if($r>=1) db_update('user_vip',array('uid'=>$__user['uid']),array('grow'=>$grow,'end'=>$expire));
            else db_insert('user_vip',array('uid'=>$__user['uid'],'grow'=>$grow,'end'=>$expire,'level'=>1));
            db_update('user',array('uid'=>$__user['uid']),array('vip_end'=>$expire));
            vip_update_level($__user['uid']);
            $r = db_find_one('user_vip',array('uid'=>$__user['uid']));
            message(0,xn_json_encode(array('grow'=>$r['grow'],'expire'=>$r['end'])));
        }
    }
}
?>