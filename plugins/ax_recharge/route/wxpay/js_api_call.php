<?php 
/**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/
	include _include(APP_PATH.'plugin/ax_recharge/lib/WxPayPubHelper.php');
	$amount = abs(param(1, 0));
	$_uid = param(2);
	$httpurl = http_url_path();
	$_url = $httpurl.url("wx_pay");
	$notify = url("wx_notify");
		
	//使用jsapi接口
	$jsApi = new JsApi_pub();

	//=========步骤1：网页授权获取用户openid============
	//通过code获得openid
	if (!isset($_GET['code']))
	{
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode("$_url");
		$golds = urlencode($amount);
        $url = str_replace("STATE", $golds, $url);
		Header("Location: $url"); 

	}else
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();						
	}
	
	
	
	//=========步骤2：使用统一支付接口，获取prepay_id============
	//使用统一支付接口
	$unifiedOrder = new UnifiedOrder_pub();
	$total_fee = abs(param('state', 0));
	//设置统一支付接口参数
	//设置必填参数
	//appid已填,商户无需重复填写
	//mch_id已填,商户无需重复填写
	//noncestr已填,商户无需重复填写
	//spbill_create_ip已填,商户无需重复填写
	//sign已填,商户无需重复填写
	$unifiedOrder->setParameter("openid","$openid");//商品描述
	$unifiedOrder->setParameter("body","在线充值");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = $timeStamp;
	$unifiedOrder->setParameter("out_trade_no",$out_trade_no);//商户订单号 
	$unifiedOrder->setParameter("total_fee",$total_fee*100);//总金额
	//$unifiedOrder->setParameter("total_fee",1);//总金额
	$unifiedOrder->setParameter("notify_url",$httpurl.$notify);//通知地址 
	$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
	//非必填参数，商户可根据实际情况选填
	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
	//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
	//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID

	$prepay_id = $unifiedOrder->getPrepayId();
	//插入充值记录
	$add_time = time();
	$arr = array("uid"=>$uid,"amount"=>$total_fee,"pay_date"=>$add_time,"status"=>0,"out_order_id"=>$out_trade_no);
	db_insert("recharge_log",$arr);
	//=========步骤3：使用jsapi调起支付============
	$jsApi->setPrepayId($prepay_id);
	$jsApiParameters = $jsApi->getParameters();
	
	
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>

	<script type="text/javascript">

		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					//alert(res.err_code+res.err_desc+res.err_msg);
					if(res.err_msg == "get_brand_wcpay_request:ok" ) 
					{
						//alert('充值成功');
						window.location.href='<?php echo $httpurl;?>/my.htm';					
					}
					else
					{
						alert('充值失败');	
					}
				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener )
				{
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</head>
<body onLoad="callpay()">
	
</body>
</html>