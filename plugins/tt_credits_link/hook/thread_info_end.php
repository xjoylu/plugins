<?php exit;
if($route=='mip')
    $html_pay='<strong>您好，本帖含有付费内容，请您点击下方“查看完整版网页”获取！</strong>';
else
    $html_pay='<div class="alert alert-warning" role="alert"> <i class="icon-shopping-cart" style="color:gold;" aria-hidden="true" title="ttPay"></i> '.$conf['sitename'].' - 下载链接<hr/> 售价：<span style="font-weight: bold;">'.$thread['content_buy'].lang('credits'.$thread['content_buy_type']).' </span><button id="b_p" type="submit" style="text-decoration: none; color:white;float:right;" class="btn btn-warning mr-2" data-loading-text="'.lang('submiting').'..." data-active="'.url('thread-cPay-'.$tid).'">下载</button><div style="clear:both;"></div></div>';
$preg_pay = preg_match_all('/\[ttDown\](.*?)\[\/ttDown\]/i',$first['message_fmt'],$array);
$first['purchased']='1';
$content_pay = db_find_one('paylist', array('tid' => $tid, 'uid' => $uid, 'type' => 1));
if($thread['content_buy']){
	if($preg_pay){
		$array_count = count($array[0]);
		for($i=0;$i<$array_count;$i++){
			$a = $array[0][$i];
			$b = '<div class="alert alert-success" role="alert"> <i class="icon-shopping-cart" style="color:green;" aria-hidden="true" title="ttPay"></i> '.$conf['sitename'].' - 查看下载链接<div style="float:right;"></div><hr/><button class="btn btn-success" onclick="location = \''.$array[1][$i].'\';">下载</button></div>';
			if($content_pay||$thread['uid']==$uid) $first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
			else $first['message_fmt'] = str_replace($a,$html_pay,$first['message_fmt']); $first['purchased']='0';
		}
	}
}else{
        $first['message_fmt'] = str_replace('[ttDown]','',$first['message_fmt']);
        $first['message_fmt'] = str_replace('[/ttDown]','',$first['message_fmt']);
}
?>