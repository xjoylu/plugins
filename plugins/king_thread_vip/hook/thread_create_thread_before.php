<?php exit; 

$status = param('is_vip');
if($status){
	$viprank = param('viprank');
	xn_strlen($viprank) > 255 AND message(-1, lang('viprank_too_long'));
}

?>