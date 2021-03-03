<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_seo/setting.htm');
    elseif($method=='POST'){
        $op=param('op');
        if($op==0) {
            $set = setting_get('tt_seo');
            $update_list = array();
            foreach ($set as $k => $v)
                $update_list[$k] = param($k);
            if($update_list['sitemap_max']<=0||$update_list['sitemap_max']>=50000 )
                $update_list['sitemap_max']='50000';
            setting_set('tt_seo', $update_list);
            $tablepre=$db->tablepre;
            $update_lists=param('SEO_forum',array(0));
            $sql = 'UPDATE '.$tablepre.'forum SET allowSEO="0";';
            foreach($update_lists as $k => $v)
                $sql .= 'UPDATE '.$tablepre.'forum SET allowSEO="1" WHERE fid="'.$k.'";';
            $status=db_exec($sql);
            forum_list_cache_delete();
            $update_lists2=param('SEO_group',array(0));
            $sql = 'UPDATE '.$tablepre.'group SET allowSEO="0";';
            foreach($update_lists2 as $k => $v)
                $sql .= 'UPDATE '.$tablepre.'group SET allowSEO="1" WHERE gid="'.$k.'";';
            $status=db_exec($sql);
            group_list_cache_delete();
            message(0, '设置成功!');
        } elseif($op==1){
            db_truncate('seo_log');
            message(0,'清空成功！');
        } elseif($op==2){
            if(seo_update_sitemap()) message(0,'生成成功！');
            else message(-1,'生成失败！');
        }
    }
}
?>