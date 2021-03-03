<?php !defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)) {
    if ($method == 'GET')
        include _include(APP_PATH . 'plugin/tt_redpacket/setting.htm');
    elseif($method=='POST'){
        $update_lists=param('send_group',array(0)); $status=0;
        if(empty($update_lists))
            message(-1, '设置失败！');
        $tablepre = $db->tablepre;
        $sql = 'UPDATE '.$tablepre.'group SET allowredpacket="0";';
        foreach($update_lists as $k => $v)
            $sql .= 'UPDATE '.$tablepre.'group SET allowredpacket="1" WHERE gid="'.$k.'";';
        db_exec($sql);
        group_list_cache_delete();
        $money_type = param('money_type'); $allow_cancel=param('allow_cancel');
        setting_set('tt_redpacket',array('money_type'=>$money_type,'allow_cancel'=>$allow_cancel));
        message(0, '设置成功！');
    }
}
?>