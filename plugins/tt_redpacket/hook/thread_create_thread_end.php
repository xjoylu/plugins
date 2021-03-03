if($red_num>0 && $red_total_money>0){
    db_update('thread',array('tid'=>$tid),array('red_num'=>$red_num));
    db_update('user',array('uid'=>$uid),array(get_credits_name_by_type($set_red['money_type']).'-'=>$red_total_money));
    db_insert('thread_red',array('tid'=>$tid,'type'=>$red_type,'total'=>$red_num,'rest'=>$red_num,'total_money'=>$red_total_money,'rest_money'=>$red_total_money,'command'=>$red_command));
    db_insert('user_pay',array('uid'=>$uid,'status'=>1,'num'=>$red_total_money,'type'=>10,'credit_type'=>$set_red['money_type'],'time'=>time(),'code'=>red_get_type_by_id($red_type)));
}