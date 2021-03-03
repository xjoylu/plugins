<?php
//检测移动设备访问（是否移动设备访问）
function is_phone(){
$touch_arr =array("mobile","android","wap","uc","wml","vnd","adr","mqqbrowser","nokiaBrowser","playbook", "blackberry","bb10","ipad","iphone");
$useragent=$_SERVER["HTTP_USER_AGENT"];//获取浏览器User-Agent (UA)
$th=str_ireplace($touch_arr,'',$useragent);
if($useragent<>$th){
	return "1";
}else{
	return "0";
}
}
?>