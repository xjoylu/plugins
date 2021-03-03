<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET'){//设置页面
        include _include(APP_PATH.'plugin/tt_deposit/setting.htm');
    }
    else if($method=="POST") {
        $op = param('op');
        if($op==0) {
            $cid=param('cid'); $opt = param('opt');
            if(empty($cid)){message(-1, 'ERROR');die();}
            if($opt==1)//OK
                db_update('user_pay',array('cid'=>$cid),array('status'=>'1'));
            elseif($opt==-1)
                db_update('user_pay',array('cid'=>$cid),array('status'=>'-1'));
            elseif($opt==-2) {
                db_update('user_pay',array('cid'=>$cid),array('status'=>'-1'));
                $_sql = db_find_one('user_pay',array('cid'=>$cid));
                user_update($_sql['uid'],array('rmbs+'=>$_sql['num']));
            }
            message(0, '设置成功！');
        } elseif($op==1) {
            $update_arr = array('min'=>param('min'),'mail_notify'=>(param('open_email')==1?'1':'0'),'mail_to'=>param('admin_email'));
            setting_set('tt_deposit',$update_arr);
            message(0, '设置成功！');
        } elseif($op==2){
            $cid=param('cid'); $opt = param('opt');
            if(empty($cid)){message(-1, 'ERROR');die();}
            $_sql = db_find_one('user_pay',array('cid'=>$cid));
            if($opt==1) {
                db_update('user_pay', array('cid' => $cid), array('status' => '1'));
                user_update($_sql['uid'],array('rmbs+'=>$_sql['num']));
            }
            elseif($opt==-1)
                db_update('user_pay',array('cid'=>$cid),array('status'=>'-1'));
            message(0, '设置成功！');
        }
    }
}
?>