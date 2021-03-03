<?php
$action = param(1);

if($action=='uniqid') {
    user_login_check();
    $uniqid = param(2);
    empty($uniqid) AND message(-1,'错误的请求');
    $qr_sid=cache_get($uniqid);
    if($qr_sid){
        db_update('session',array('sid'=>$qr_sid),array('uid'=>$uid));
        cache_delete($uniqid);
        message(0,jump('扫码登陆成功','./',2));
    }else{
        message(-1,'二维码已过期,请重新扫码');
    }

}elseif($action=='pc'){

    $header['title']='会员登录';
    $callback = param("callback");
    if ($callback) {
        $uniqid=!empty($_COOKIE['bbs_uniqid']) ? $_COOKIE['bbs_uniqid']:'';
        if($uniqid){
            $uid=_SESSION('uid');
            if($uid){
                $user=user_read($uid);
                user_token_set($uid);
                $_SESSION['uid']=$uid;
                $uniqid=0;
            }else{
                $uniqid=1;
            }
        }else{
            $uniqid=get_uniqid();
            cache_set($uniqid,$sid,600);
            setcookie('bbs_uniqid', $uniqid, $time + 600, '');
        }
        $result = xn_json_encode($uniqid);
        echo $callback . "($result)";
        exit;
    }else{
        !empty( $user ) AND http_location( './' );
        $uniqid=get_uniqid();
        setcookie('bbs_uniqid', $sid, $time + 600, '');
        cache_set($uniqid,$sid,600);
        include _include(APP_PATH.'plugin/xn_wechat_public/view/htm/wxlogin.htm');
    }
}else{

    include _include(APP_PATH.'plugin/xn_wechat_public/model/wechat.func.php');
    $code = param('code');
    $auto = param(1, '');
    $auto=  $auto=='auto' ? 1:0;
    $state = param('state');
    if ( $code ) {
        wechat_get_token($code, $state);
    } else {
        wechat_login_link($auto);
    }
}
?>