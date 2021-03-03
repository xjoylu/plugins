<?php
!defined('DEBUG') AND exit('Forbidden');
//充值记录
#  主键ID
#  会员ID
#  充值金额
#  充值时间
#  充值状态是否成功
#  步返回时间戳
#  支付宝订单号
$tablepre = $db->tablepre;
$sql = "CREATE TABLE IF NOT EXISTS {$tablepre}recharge_log(
	`rechargeid`  int(10) NOT NULL AUTO_INCREMENT , 
	`uid` int(10) NOT NULL DEFAULT '0', 
	`amount` varchar(255) NOT NULL DEFAULT '0', 
	`pay_date` varchar(255) NOT NULL,
	`status` int(10) NOT NULL DEFAULT '0',
	`out_order_id` varchar(255) NOT NULL,
	`plat_order_id` varchar(255) NOT NULL,
	PRIMARY KEY (`rechargeid`) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
db_exec($sql);


?>