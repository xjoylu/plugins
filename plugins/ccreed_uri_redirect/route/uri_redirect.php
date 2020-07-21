<?php
/*
 * 外链跳转页面
 * @copyright (c) yeliulee all rights reserved
 */

if(strlen($_SERVER['REQUEST_URI']) > 384 ||
    strpos($_SERVER['REQUEST_URI'], "eval(") ||
    strpos($_SERVER['REQUEST_URI'], "base64")) {
    @header("HTTP/1.1 414 Request-URI Too Long");
    @header("Status: 414 Request-URI Too Long");
    @header("Connection: Close");
    @exit;
}
//通过QUERY_STRING取得完整的传入数据，然后取得uri=之后的所有值，兼容性更好
$redirect_uri = param('uri');

if (!empty($redirect_uri)){
    $title = '页面加载中,请稍候...';
    $uri = $redirect_uri;
}else{
    $title = '参数缺失，正在返回首页...';
    $uri = http_url_path();
}

include _include(APP_PATH.'plugin/ccreed_uri_redirect/view/htm/uri_redirect.htm');
?>