<?php exit;
elseif($action == 'deposit') {
    if($method == 'GET') {
        include _include(APP_PATH.'plugin/tt_deposit/view/htm/my_exchange.htm');
    }
    elseif($method == 'POST') {
        $_rmb = param('d_rmb'); $_code=param('d_code');$set_deposit=setting_get('tt_deposit');
        $min=$set_deposit['min'];
        if($_rmb<$min) {message(-1, '最低提现金额：¥'.($min/100.0).'，您提现的金额不足。');die();}
        $now_rmb = $user['rmbs'];
        if(empty($uid)||empty($_rmb)){message(-1, "ERROR");die();}
        if($_rmb<=0){message(-1, "ERROR");die();}
        if($now_rmb-$_rmb<0){message(-1, "ERROR");die();}
        $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'2'),array('time'=>-1));
        $now_time = time();
        if($now_time-$recent_query['time']<=600)
        {message(-1, "每10分钟只能提现一次，您提现过于频繁！");die();}
        user_update($uid,array('rmbs'=>($now_rmb-$_rmb)));
        db_insert('user_pay',array('uid'=>$uid,'status'=>0,'num'=>$_rmb,'type'=>'2','credit_type'=>'3','code'=>$_code,'time'=>time()));
        if($set_deposit['mail_notify']){
            $subject = '有人提现了,请审核!';
            $message = '用户:'.user_read($uid)['username'].' , ¥'.($_rmb/100.0).' , 附加信息:'.$_code.' , 请前往后台审核';
            include _include(XIUNOPHP_PATH.'xn_send_mail.func.php');
            $email=$set_deposit['mail_to'];
            $smtplist = include _include(APP_PATH.'conf/smtp.conf.php');
            $n = array_rand($smtplist);
            $smtp = $smtplist[$n];
            $r = xn_send_mail($smtp, $conf['sitename'], $email, $subject, $message);
        }
        message(0, lang('get_success'));
    }
}elseif($action == 'payperson') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_deposit/view/htm/my_payperson.htm');
    elseif($method == 'POST') {
        $_rmb = param('d_rmb'); $_code=param('d_code'); $set_deposit=setting_get('tt_deposit');
        $min=$set_deposit['min'];
        $method=param('paymethod');
        if($_rmb<$min) {message(-1, '最低充值金额：¥'.($min/100.0).'，您充值的金额不足。');die();}
        $now_rmb = $user['rmbs'];
        if(empty($uid)||empty($_rmb)){message(-1, "ERROR,1");die();}
        if($_rmb<=0){message(-1, "ERROR,2");die();}
        $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'3'),array('time'=>-1));
        $now_time = time();
        if($now_time-$recent_query['time']<=600){message(-1, "每10分钟只能充值一次，您充值过于频繁！");die();}
        $_code=$method .','.$_code;
        db_insert('user_pay',array('uid'=>$uid,'status'=>0,'num'=>$_rmb,'type'=>'3','credit_type'=>'3','code'=>$_code,'time'=>time()));
        if($set_deposit['mail_notify']){
            $subject = '有人充值了,请审核!';
            $message = '用户:'.user_read($uid)['username'].' , ¥'.($_rmb/100.0).' , 附加信息:'.$_code.' , 请前往后台审核';
            include _include(XIUNOPHP_PATH.'xn_send_mail.func.php');
            $email=$set_deposit['mail_to'];
            $smtplist = include _include(APP_PATH.'conf/smtp.conf.php');
            $n = array_rand($smtplist);
            $smtp = $smtplist[$n];
            $r = xn_send_mail($smtp, $conf['sitename'], $email, $subject, $message);
        }
        message(0, "充值提交成功!请等待管理员审核后即可到账.");
    }
}
?>