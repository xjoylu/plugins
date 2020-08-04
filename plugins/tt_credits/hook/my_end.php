elseif($action == 'credits') {
    if($method == 'GET'){user_update_group($uid);
        include _include(APP_PATH.'plugin/tt_credits/view/htm/my_credits.htm');
}
}elseif($action == 'trade') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_credits/view/htm/my_trade.htm');
    elseif($method=='POST'){
        $op = param('op');
        if($op=='n'){
            $set=setting_get('tt_credits');$e_rmb = param('e_rmb'); $my_rmbs=$user['rmbs'];$my_golds=$user['golds'];$min=$set['min'];$e_rmb_raw=$e_rmb;
            $e_rmb *= $set['exchange_n'];
            if($e_rmb<$min) {message(-1, '最低兑换金额：¥'.($min/100.0).'，您兑换的金额不足。');die();}
            if($e_rmb<=0 ) {message(-1, lang('ERROR'));die();}
            preg_replace('/[^0-9-]+/','',$e_rmb);
            if($my_rmbs<$e_rmb) {message(-1, lang('credit_no_enough'));die();}
            if(empty($uid)||empty($e_rmb)){message(-1, "ERROR");die();}
            $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'6'),array('time'=>-1));
            $now_time = time();
            if($now_time-$recent_query['time']<=600) {message(-1, "每10分钟只能兑换一次，您兑换过于频繁！");die();}
            $my_golds+= $e_rmb_raw;
            $my_rmbs -= $e_rmb;
            db_insert('user_pay',array('uid'=>$uid,'status'=>1,'num'=>$e_rmb,'type'=>'6','credit_type'=>'3','code'=>'','time'=>time()));
            user_update($user['uid'],array('rmbs'=>$my_rmbs,'golds'=>$my_golds));
            user_update_group($user['uid']);
            message(0, lang('update_successfully'));
        }elseif($op=='c'){
            $set=setting_get('tt_credits');$e_golds=param('e_golds_c'); $my_golds = $user['golds'];$my_rmbs=$user['rmbs'];$min=$set['min'];$e_golds_raw=$e_golds;
            $e_golds*= $set['exchange_c'];
            if(empty($uid)||empty($e_golds)){message(-1, "ERROR");die();}
            if($e_golds<$min) {message(-1, '最低兑换金币：'.$min.'，您兑换的金额不足。');die();}
            if($e_golds<=0 ){message(-1, lang('ERROR'));die();}
            preg_replace('/[^0-9-]+/','',$e_golds);
            if($my_golds<$e_golds){message(-1, lang('credit_no_enough'));die();}
            $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'6'),array('time'=>-1));
            $now_time = time();
            if($now_time-$recent_query['time']<=600) {message(-1, "每10分钟只能兑换一次，您兑换过于频繁！");die();}
            $my_golds-=$e_golds;
            $my_rmbs+=$e_golds_raw;
            db_insert('user_pay',array('uid'=>$uid,'status'=>1,'num'=>$e_golds,'type'=>'6','credit_type'=>'2','code'=>'','time'=>time()));
            user_update($user['uid'],array('rmbs'=>$my_rmbs,'golds'=>$my_golds));
            user_update_group($user['uid']);
            message(0, lang('update_successfully'));
        }
    }
}
elseif($action == 'record') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_credits/view/htm/my_record.htm');
}