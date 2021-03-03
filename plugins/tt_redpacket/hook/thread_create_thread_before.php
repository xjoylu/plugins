$red_type=param('red_type')+1; $red_num=param('red_num'); $red_total_money=param('red_total_money'); $red_command=param('red_command','0');
if($red_type=='1') $red_total_money*=$red_num;
if($red_total_money<0){message(-1,'输入数字不合法！不能为负。');die();}
if($red_num>0 && $red_total_money>0){
    $set_red = setting_get('tt_redpacket');
    if($user[get_credits_name_by_type($set_red['money_type'])] - $red_total_money <0) { message(-1, '您好，您的余额不足，无法发表该红包！<a href="my-credits.htm" target="_blank">点此充值</a>'); die();}
    if($red_total_money/$red_num < 1.0){ message(-1, '您好，每个红包最低1分,您的输入的金额过少!'); die();}
}