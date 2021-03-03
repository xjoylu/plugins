<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET'){//设置页面
        include _include(APP_PATH.'plugin/tt_store/setting.htm');
    }
    else if($method=="POST")
    {
        $post_fid = param('store_fid');
        if(!empty($post_fid))
        {setting_set('tt_store', array('fid'=>$post_fid)); message(0, '设置成功！');}
        else{ message(-1, '设置失败！');}
    }
}


?>