<?php exit;
elseif($action == 'pay') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_pay/view/htm/my_pay.htm');
}elseif($action=='payali'&&$method=='POST'){
    $price=param('num','0');
    if(empty($price))die("ERROR");
    $allow_val = array(10,20,50,100,200,500);
    $allow_flag = 0;
    foreach($allow_val as $k)
        if($k==$price){
            $allow_flag=1; break;
        }
    if(!$allow_flag) return message(-1,"金额不合法！");
    $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'0','status'=>0),array('time'=>-1));
    $now_time = time();
    if($now_time-$recent_query['time']<=600) return message(-1,"每10分钟只能用支付宝充值一次，您充值过于频繁！");
    list($t1, $t2) = explode(' ', microtime());
    $c_code = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    db_insert('user_pay',array('code'=>$c_code,'uid'=>$uid,'type'=>0,'status'=>2,'num'=>$price*100.0,'credit_type'=>'3','time'=>time()));
    message(0,'plugin/tt_pay/codepay/codepay.php?price='.$price.'&user='.$c_code.'&type=1');
}elseif($action=='paywechat'&&$method=='POST'){
    $price=param('num','0');
    if(empty($price))die("ERROR");
    $allow_val = array(10,20,50,100,200,500);
    $allow_flag = 0;
    foreach($allow_val as $k)
        if($k==$price){
            $allow_flag=1; break;
        }
    if(!$allow_flag) return message(-1,"金额不合法！");
    $recent_query = db_find_one('user_pay',array('uid'=>$uid,'type'=>'1','status'=>0),array('time'=>-1));
    $now_time = time();
    if($now_time-$recent_query['time']<=600) return message(-1,"每10分钟只能用微信充值一次，您充值过于频繁！");
    list($t1, $t2) = explode(' ', microtime());
    $c_code = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    db_insert('user_pay',array('code'=>$c_code,'uid'=>$uid,'type'=>0,'status'=>2,'num'=>$price*100.0,'credit_type'=>'3','time'=>time()));
    message(0,'plugin/tt_pay/codepay/codepay.php?price='.$price.'&user='.$c_code.'&type=3');
}
?>