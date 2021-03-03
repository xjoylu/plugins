<?php exit;
if($action == 'tPacket'&&$method=='POST'){
	$tid = param(2);
    if(empty($uid)){message(-2,'请您登录后再领取红包!');die();}
    $r=red_get_packet($uid,$tid);
    $after_html = '<br><a href="'.url('thread-sPacket-'.$tid.'-1').'">查看领取记录</a>';
    if($r==-1) message(-1,'拉取主题信息失败!');
    elseif($r==-2) message(-1,'拉取用户信息失败!');
    elseif($r==-3) message(-4,'红包已经被领光啦!');
    elseif($r==-4) message(-3,'红包已经领过啦!');
    elseif($r==-5) message(-1,'读取用户信息失败!');
    elseif($r==-6) message(-1,'回帖失败,检查权限!');
    elseif($r>=0) {
        $set_red=setting_get('tt_redpacket');
        message(0,'领取成功!<div style="font-weight:bold;font-size:24px;width:100%;text-align:center;color:gold;">'.($set_red['money_type']=='3'? $r/100.0 : $r).lang('credits'.$set_red['money_type']).'</div>');
    }
} elseif($action == 'sPacket') {
    $tid = param(2);
    $r = db_count('thread_red',array('tid'=>$tid));
    if($r<=0) {message(-1,'该主题暂无红包记录!');die();}
    include _include(APP_PATH . 'plugin/tt_redpacket/view/htm/tt_red_list.htm');
    return;
} elseif($action == 'cPacket'&&$method=='POST') {
    $tid = param(2); $__thread = thread_read($tid);
    if(empty($uid)){message(-1,'未登录!');die();}
    if(empty($__thread)){message(-1,'主题不存在!');die();}
    if($__thread['uid']!=$uid && $user['gid']!=1) {message(-1,'非作者本人,非管理员,无权撤回!');die();}
    if(time()-$__thread['create_date']<=86400&& $user['gid']!=1) {message(-1,'只有发表一天后的红包才可以撤回!');die();}
    $now_rest = $__thread['red_num'];
    if($now_rest<=0){message(-1,'红包已经被领光啦!');die();}
    $r_red = db_find_one('thread_red',array('tid'=>$tid));
    if(empty($r_red)) {message(-1,'ERROR!');die();}
    $rest_num = $r_red['rest_money'];
    $set_red = setting_get('tt_redpacket');
    if($set_red['allow_cancel']!='1') {message(-1,'管理员禁止撤回红包!');die();}
    db_update('thread',array('tid'=>$tid),array('red_num'=>0));
    db_update('thread_red',array('tid'=>$tid),array('rest'=>0,'rest_money'=>0));
    db_update('user',array('uid'=>$__thread['uid']),array(get_credits_name_by_type($set_red['money_type']).'+'=>$rest_num));
    db_insert('user_pay',array('uid'=>$__thread['uid'],'status'=>1,'num'=>$rest_num,'type'=>11,'credit_type'=>$set_red['money_type'],'time'=>time(),'code'=>''));
    message(0,'撤回成功!');
}
?>