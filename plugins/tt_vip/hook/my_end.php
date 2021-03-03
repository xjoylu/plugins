elseif($action == 'tt_vip_open') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_vip/view/htm/open.htm');
    elseif($method == 'POST') {
        if(empty($uid)) {message(-1,'拉取用户信息失败!');die();}
        $buy_type=param('buy_type','month');
        $buy_num = param('buy_num','0');
        if($buy_num=='0') {message(-1,'ERROR');die();}
        $r = vip_add($uid,$buy_num,$buy_type);
        if($r==-1){message(-1,'您的余额不足!请充值.');die();}
        message(0,'充值成功!感谢您的支持!');
    }
}