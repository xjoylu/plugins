<?php include _include(APP_PATH.'view/htm/header.inc.htm');?>
<?php
include _include(APP_PATH.'plugin/ax_recharge/lib/WxPayPubHelper.php');
$amount = abs(param(1, 0));
$httpurl = http_url_path();
$url = $httpurl.url("wx_notify");
	//使用统一支付接口
	$unifiedOrder = new UnifiedOrder_pub();
	//设置统一支付接口参数
	//设置必填参数
	//appid已填,商户无需重复填写
	//mch_id已填,商户无需重复填写
	//noncestr已填,商户无需重复填写
	//spbill_create_ip已填,商户无需重复填写
	//sign已填,商户无需重复填写
	$unifiedOrder->setParameter("body","在线充值");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = "$timeStamp";
	$unifiedOrder->setParameter("out_trade_no",time() );//商户订单号 
	$unifiedOrder->setParameter("total_fee",$amount*100);//总金额
	$unifiedOrder->setParameter("notify_url",$url);//通知地址 
	$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型		
	//非必填参数，商户可根据实际情况选填
	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
	//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
	//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID	
	//获取统一支付接口结果
	$unifiedOrderResult = $unifiedOrder->getResult();
	//商户根据实际情况设置相应的处理流程
	if ($unifiedOrderResult["return_code"] == "FAIL") 
	{
		//商户自行增加处理流程
		echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
	}
	elseif($unifiedOrderResult["result_code"] == "FAIL")
	{
		//商户自行增加处理流程
		echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
		echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
	}
	elseif($unifiedOrderResult["code_url"] != NULL)
	{
		//从统一支付接口获取到code_url
		$code_url = $unifiedOrderResult["code_url"];
		//商户自行增加处理流程
		//......
		$add_time = time();
		$arr = array("uid"=>$uid,"amount"=>$amount,"pay_date"=>$add_time,"status"=>0,"out_order_id"=>$out_trade_no);
		$wx_pay_id = db_insert("recharge_log",$arr);		
	}
?>
<div class="col-lg main">
		<Div class="wxbg">
		<div align="center" id="qrcode"></div>
		<div class="wxpaytxt"><p>付款金额：<span class="text-danger"><?php echo param(1); ?></span>元</p></div>
		<div class="wxpaytz text-white"><p>页面没跳转请点击，<a href="<?php echo $httpurl;?>my.htm" class="text-white">立即跳转！</a></p></div>
		
</div>
			





<?php include _include(APP_PATH.'view/htm/footer.inc.htm');?>

<script src="plugin/ax_recharge/route/wxpay/qrcode.js"></script>
<script>
	var url = "<?php echo $code_url;?>";
	//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
	var qr = qrcode(10, 'H');
	qr.addData(url);
	qr.make();
	var wording=document.createElement('p');
	wording.innerHTML = "";
	var code=document.createElement('DIV');
	code.innerHTML = qr.createImgTag();
	var element=document.getElementById("qrcode");
	element.appendChild(wording);
	element.appendChild(code);

	$(document).ready(function(){
    setInterval(get_zf_zt,2000);//自动执行get_zf_zt方法
	});
	function get_zf_zt(){
	$.ajax({
	type: "POST",
	url: '<?php echo url("check");?>' ,
	data: "id="+<?php echo $wx_pay_id?>,
	success: function(data){
		if (data==1){
			window.location.href='<?php echo $httpurl;?>my.htm';	 
		}
	}
	});	
	} 
</script>





