<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET'){//设置页面
        include _include(APP_PATH.'plugin/tt_pay/setting.htm');
    }
    else if($method=="POST")
    {
        $wx = param('wx');$ali = param('ali');$min = param('min');
        $set = array('wx'=>$wx=='wx'?'1':'0','ali'=>$ali=='ali'?'1':'0','min'=>$min);
        setting_set('tt_pay',$set);
        message(0, '设置成功！');
    }
}
?>