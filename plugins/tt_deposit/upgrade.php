<?php !defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
//20180806
$set = setting_get('tt_deposit');
$set['mail_notify']=0;
$set['mail_to']='123456@qq.com';
setting_set('tt_deposit',$set);

?>