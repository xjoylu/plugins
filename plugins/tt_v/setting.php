<?php !defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)) {
    if ($method == 'GET') {//设置页面
        include _include(APP_PATH . 'plugin/tt_v/setting.htm');
    } elseif ($method == "POST") {
        $op=param('op'); $username=param('username');
        if(empty($username)) die();
        if($op==0) {
            $_user = db_find_one('user',array('username'=>$username));
            if($_user) message(0,$_user['v']);
            else message(-1,"NO_SUCH_USER");
        } elseif($op==1) {
            $v = param('val');
            $_user = db_find_one('user',array('username'=>$username));
            if($_user){
                db_update('user',array('username'=>$username),array('v'=>$v));
                message(0,'设置成功！');
            }
            else message(-1,"NO_SUCH_USER");
        }
    }
}
?>