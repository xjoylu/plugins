<?php
/**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
	//include _include(APP_PATH.'plugin/ax_recharge/route/wxpay/log_.php');
	include _include(APP_PATH.'plugin/ax_recharge/lib/WxPayPubHelper.php');
    //使用通用通知接口
	$notify = new Notify_pub();

	//存储微信的回调
	$xml = file_get_contents('php://input');	
	$notify->saveData($xml);
	
	//验证签名，并回应微信。
	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
	if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
	}
	$returnXml = $notify->returnXml();

	//以log文件形式记录回调信息
	//$log_ = new Log_();
	//$log_name="plugin/ax_recharge/route/wxpay/notify_url.log";//log文件路径
	//$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
	//$log_->log_result($returnXml);
	$out_trade_no=$notify->data["out_trade_no"];		
	$trade_no=$notify->data["transaction_id"];
	//判断该笔订单是否在商户网站中已经做过处理
	$arr = db_find_one('recharge_log', array('out_order_id'=>$out_trade_no));
	//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序	
    if ($arr['status']==0)
		{
			//处理订单信息
			db_update('recharge_log',array('out_order_id'=>$out_trade_no),array('status'=>1, 'plat_order_id'=>$trade_no));
			//获取用户现有余额
			$new_money = db_find_one('user',array('uid'=>$arr['uid']));
			$recharge_money = $new_money['golds'] + $arr['amount'];
			//用户增加余额
			db_update('user',array('uid'=>$arr['uid']),array('golds'=>$recharge_money));
		}   
	
?>