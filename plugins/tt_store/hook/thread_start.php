<?php exit;
if($action == 'tRate'){
    $tid = param(2);
    $op = param('op');
    if(empty($uid)||empty($tid)||empty($op)) {message(-1,'拉取信息失败');die();}
    $set = setting_get('tt_store');
    $thread = thread_read($tid);
    if($thread['fid']!=$set['fid']) {message(-1,'板块不符！');die();}
    if($thread['content_buy']<=0){message(-1,'不是付费帖子，无法评价！');die();}
    $purchased = db_count('paylist',array('uid'=>$uid,'tid'=>$tid,'rate'=>0));
    if($purchased<=0){message(-1,'未购买或已经评价过！');die();}
    $store_rate_sql = db_find_one('store_rate',array('tid'=>$tid));
    $paylist_rate = 0; $store_rate_sql['ratenum']++ ;
    switch($op)
    {case 1:$paylist_rate=1;$store_rate_sql['rate1']++ ;break;
        case 2:$paylist_rate=3;$store_rate_sql['rate3']++ ;break;
        case 3:$paylist_rate=5;$store_rate_sql['rate5']++ ;break;}
    $now_1 = $store_rate_sql['rate1']; $now_3 = $store_rate_sql['rate3'];$now_5 = $store_rate_sql['rate5'];
    $rate_number = $store_rate_sql['ratenum'];
    $store_rate_sql['rate_avg'] = round(($now_1+ $now_3*3.0+ $now_5*5.0)/$rate_number,1);
    db_update('store_rate',array('tid'=>$tid),$store_rate_sql);
    db_update('paylist',array('uid'=>$uid,'tid'=>$tid),array('rate'=>$paylist_rate));
    message(0,'评分成功！');
}
?>