<?php exit;
elseif($action == 'recharge') {    
    if($method == 'GET') {       
        // hook my_avatar_get_start.php       
        include _include(APP_PATH.'plugin/ax_recharge/view/htm/my_recharge.htm');    
    } else {        
        // hook my_avatar_post_start.php      
        $pay_type = param('pay_type');
        $money = abs(param('ax_pay_num',0));
        $is_touch = is_phone();       
        if($pay_type == 'alipay'){
            if($is_touch == 1)
            {
                message(1, url("alipay_touch-".$money));exit;
            }else{
                message(1, url("alipay-".$money));exit;
            }            
        }elseif($pay_type == 'wechat'){
            if($is_touch == 1)
            {
                message(1, url("wx_pay-".$money."-".$uid));exit;
            }else{
                message(2,url("wx_paypc-".$money));exit;
            } 
        }else{
            message(-1, "充值失败，请刷新页面！");exit;
        }       
    }
}




?>