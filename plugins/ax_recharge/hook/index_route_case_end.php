case 'alipay_config': include APP_PATH.'plugin/ax_recharge/route/alipay.config.php'; break;
case 'alipay': include APP_PATH.'plugin/ax_recharge/route/alipayapi.php'; break;
case 'notify_url': include APP_PATH.'plugin/ax_recharge/route/notify_url.php'; break;
case 'return_url': include APP_PATH.'plugin/ax_recharge/route/return_url.php'; break;

case 'alipay_conf': include APP_PATH.'plugin/ax_recharge/route/alipay_touch/alipay.config.php'; break;
case 'alipay_touch': include APP_PATH.'plugin/ax_recharge/route/alipay_touch/alipayapi.php'; break;
case 'notify_touch': include APP_PATH.'plugin/ax_recharge/route/alipay_touch/notify_url.php'; break;
case 'return_touch': include APP_PATH.'plugin/ax_recharge/route/alipay_touch/return_url.php'; break;

case 'check': include APP_PATH.'plugin/ax_recharge/route/wxpay/check_order_state.php'; break;
case 'wx_pay': include APP_PATH.'plugin/ax_recharge/route/wxpay/js_api_call.php'; break;
case 'wx_paypc': include APP_PATH.'plugin/ax_recharge/route/wxpay/native_dynamic_qrcode.php'; break;
case 'wx_notify': include APP_PATH.'plugin/ax_recharge/route/wxpay/notify_url.php'; break;




