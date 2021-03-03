elseif($action == 'payperson') {
    if($method == 'GET')
    include _include(APP_PATH.'plugin/tt_payperson/view/htm/my_payperson.htm');
    elseif($method == 'POST') {
        $_rmb = param('d_rmb'); $_code=param('d_code'); $min=setting_get('tt_payperson')['min'];$method=param('paymethod');
        if($_rmb<$min) {message(-1, '最低充值金额：¥'.($min/100.0).'，您充值的金额不足。');die();}
        $now_rmb = $user['rmbs'];
        if(empty($uid)||empty($_rmb)){message(-1, "ERROR,1");die();}
        if($_rmb<=0){message(-1, "ERROR,2");die();}
        $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'3'),array('time'=>-1));
        $now_time = time();
    if($now_time-$recent_query['time']<=600)
        {message(-1, "每10分钟只能充值一次，您充值过于频繁！");die();}
    $_code=$method.','.$_code;
    db_insert('user_pay',array('uid'=>$uid,'status'=>0,'num'=>$_rmb,'type'=>'3','credit_type'=>'3','code'=>$_code,'time'=>time()));
    message(0, "充值提交成功!请等待管理员审核后即可到账.");
    }
}