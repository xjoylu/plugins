<?php exit;
//message(-1,$_REQUEST['message']);
$n = preg_match_all("/(?:[^\"]|^)(https?\:\/\/[^\x{4e00}-\x{9fa5}\"\s<]+)/u",$message,$result);
if($n>0){
$newm="\${1}<a href=\"\${2}\" target=\"_blank\" _href=\"\${2}\"><span style=\"color:#0070c0\">\${2}</span></a>";
$message=preg_replace("/([^\"]|^)(https?\:\/\/[^\x{4e00}-\x{9fa5}\"\s<]+)/u",$newm,$message);
}