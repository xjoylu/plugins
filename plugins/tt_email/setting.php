<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_email/setting.htm');
}
?>