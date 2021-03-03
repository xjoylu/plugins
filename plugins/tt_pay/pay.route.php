<?php !defined('DEBUG') AND exit('Access Denied.');
require_once("plugin/tt_pay/codepay/codepay_config.php");
function createLinkstring($data){
    $sign='';
    foreach ($data AS $key => $val) {
        if ($sign) $sign .= '&';
        $sign .= "$key=$val";
    }
}
function DemoHandle($data){
    $pay_id = $data['pay_id'];
    $money = (float)$data['money'];
    $price = (float)$data['price'];
    $pay_no = $data['pay_no'];
    $pay_time = (int)$data['pay_time'];

    if ($money <= 0 || empty($pay_id) || $pay_time <= 0 || empty($pay_no)) return '缺少必要的一些参数';
    $sql = db_find_one('user_pay',array('code'=>$pay_id,'status'=>2));

    if($sql===NULL || empty($sql)) return 'failed';
    if($price*100.0 != $sql['num']) return 'order_err';
    $_uid = $sql['uid'];
    db_update('user_pay',array('code'=>$pay_id),array('status'=>1));
    user_update($_uid,array('rmbs+'=>$price*100.0));
    return 'success';
}
$codepay_key = $codepay_config['key'];
$isPost = true;
if (empty($_POST)){
    $_POST = $_GET;
    $isPost = false;
}
ksort($_POST);
reset($_POST);
$sign = '';
foreach ($_POST AS $key => $val) {
    if ($val == '' || $key == 'sign') continue;
    if ($sign) $sign .= '&';
    $sign .= "$key=$val";
}
$pay_id = $_POST['pay_id'];
$money = (float)$_POST['money'];
$price = (float)$_POST['price'];
$type = (int)$_POST['type'];
$pay_no = $_POST['pay_no'];
if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) {
    if ($isPost) exit('fail');
    $result = '支付失败';
    $pay_id = "支付失败";
    $pay_no = "支付失败";
    if ($type < 1) $type = 1;
} else {
    $result = DemoHandle($_POST);
    if ($result == 'ok' || $result == 'success') {
        if (!DEBUG) ob_clean();
        if ($isPost) exit($result);
        $result = '支付成功';
    } else {
        $error_msg = defined('DEBUG') && DEBUG ? $result : 'no';
        if ($isPost) exit($error_msg);
        $result = '支付失败';
    }
    $return_url = $_SERVER["SERVER_PORT"] == '80' ? '/' : '//' . $_SERVER['SERVER_NAME'];
}
if ((int)$codepay_config['go_time'] < 1) $codepay_config['go_time'] = 3;
?>