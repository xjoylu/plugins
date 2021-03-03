<?php
$g_seo_type=array('Ping','熊掌号','PingMIP','熊掌号MIP');
function seo_update_sitemap(){
    include _include(APP_PATH . 'plugin/tt_seo/sitemap.class.php');
    $setting = setting_get('tt_seo');
    $sitemap = new Sitemap($setting['sitemap_site'], $setting['sitemap_max']);
    $forumlist = forum_list_cache();
    $forumlist_show = forum_list_access_filter($forumlist, 0);
    $fids = arrlist_values($forumlist_show, 'fid');
    $threadlist = db_sql_find('SELECT `fid`,`tid`,`top` FROM `' . $setting['tablepre'] . 'thread` WHERE `fid` IN (' . implode(',', $fids) . ') ORDER BY `tid` DESC LIMIT ' . $setting['sitemap_max']);
    thread_list_access_filter($threadlist, 0);
    foreach ($threadlist as &$_thread)
        $sitemap->addItem($setting['sitemap_site'] . url('thread-' . $_thread['tid']));
    return $sitemap->store('xml', 'sitemap');
}
function seo_auto_push($tid_arr,$uid,$set_seo){
    $urls = array();
    foreach($tid_arr as $_tid)
        $urls[]= $set_seo['auto_site'].url('thread-' . $_tid);
    if(count($urls)>0) {
        $api = 'http://data.zz.baidu.com/urls?site=' . $set_seo['auto_site'] . '&token=' . $set_seo['auto_token'];
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result_json = curl_exec($ch);
        try {
            $result = xn_json_decode($result_json);
            if (isset($result['success'])) $status = '成功';
            else $status = $result['message'];
            foreach($tid_arr as $_tid)
                db_insert('seo_log', array('time' => time(), 'type' => 0, 'uid' => $uid, 'status' => $status, 'tid' => $_tid));
            return $status;
        } catch (Exception $e) {return '推送错误';}
    }
}
function seo_xzh_push($tid_arr,$uid,$set_seo,$type='realtime'){
    $urls = array();
    foreach($tid_arr as $_tid)
        $urls[]= $set_seo['auto_site'].url('thread-' . $_tid);
    $api = 'http://data.zz.baidu.com/urls?appid=' . $set_seo['xzh_appid'] . '&token=' . $set_seo['xzh_token'].'&type='.$type;
    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => implode("\n", $urls),
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
    $result_json = curl_exec($ch);
    try {
        $result = xn_json_decode($result_json);
        if (isset($result['success_'.$type])) $status = '成功';
        else $status = $result['message'];
        foreach($tid_arr as $_tid)
            db_insert('seo_log', array('time' => time(), 'type' => 1, 'uid' => $uid, 'status' => $status, 'tid' => $_tid));
        return $status;
    } catch (Exception $e) {return '推送错误';}
}

function seo_auto_push_mip($tid_arr,$uid,$set_seo){
    $urls = array();
    foreach($tid_arr as $_tid)
        $urls[]= $set_seo['auto_site'].url('mip-' . $_tid);
    if(count($urls)>0) {
        $api = 'http://data.zz.baidu.com/urls?site=' . $set_seo['auto_site'] . '&token=' . $set_seo['auto_token'].'&type=mip';
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result_json = curl_exec($ch);
        try {
            $result = xn_json_decode($result_json);
            if (isset($result['success_mip'])) $status = '成功';
            else $status = $result['message'];
            foreach($tid_arr as $_tid)
                db_insert('seo_log', array('time' => time(), 'type' => 2, 'uid' => $uid, 'status' => $status, 'tid' => $_tid));
            return $status;
        } catch (Exception $e) {return '推送错误';}
    }
}
function seo_xzh_push_mip($tid_arr,$uid,$set_seo,$type='realtime'){
    $urls = array();
    foreach($tid_arr as $_tid)
        $urls[]= $set_seo['auto_site'].url('mip-' . $_tid);
    $api = 'http://data.zz.baidu.com/urls?appid=' . $set_seo['xzh_appid'] . '&token=' . $set_seo['xzh_token'].'&type='.$type;
    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => implode("\n", $urls),
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
    $result_json = curl_exec($ch);
    try {
        $result = xn_json_decode($result_json);
        if (isset($result['success_'.$type])) $status = '成功';
        else $status = $result['message'];
        foreach($tid_arr as $_tid)
            db_insert('seo_log', array('time' => time(), 'type' => 3, 'uid' => $uid, 'status' => $status, 'tid' => $_tid));
        return $status;
    } catch (Exception $e) {return '推送错误';}
}
function MipFormat($content){
    preg_match_all('/<img (.*?)\>/', $content, $images);
    if(!is_null($images)) {
        foreach($images[1] as $index => $value){
            $mip_img = str_replace('<img', '<mip-img ', $images[0][$index]);
            $mip_img = str_replace('>', '></mip-img>', $mip_img);
            $mip_img = preg_replace('/ (height|width)=\".*?\"/', '',$mip_img);
            $mip_img = preg_replace('/ style=\".*?\"/', '',$mip_img);
            $mip_img = preg_replace('/ class=\".*?\"/', '',$mip_img);
            $content = str_replace($images[0][$index], $mip_img, $content);
        }
    }
    $content = preg_replace('/<span[^>]*>/', '<span>', $content);
    $content = preg_replace('/<div[^>]*>/', '<div>', $content);
    $content = preg_replace('/<p[^>]*>/', '<p>', $content);
    $content = preg_replace('/<a[^>]*>/', '', $content);
    return $content;
}
?>