<?php exit;
    if($tid && $forum['allowSEO']=='1' && $group['allowSEO']=='1') {
        $set_seo = setting_get('tt_seo');
        if ($set_seo['auto'] == '1') seo_auto_push(array($tid),$uid,$set_seo);
        if ($set_seo['xzh']=='1') seo_xzh_push(array($tid),$uid,$set_seo,'realtime');
        if ($set_seo['mip_ping']=='1') seo_auto_push_mip(array($tid),$uid,$set_seo);
        if ($set_seo['mip_xzh']=='1') seo_xzh_push_mip(array($tid),$uid,$set_seo);
    }
?>