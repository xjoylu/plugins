<?php exit;
if($group['allowsell']=="1") {
    $content_num_status = param('content_num_status');
    $content_num = param('content_num');
    $content_type = credits_get_content_type_by_name(param('content_type'));
    if ($content_num_status && $content_num)
        db_update('thread', array('tid' => $tid), array('content_buy' => $content_num, 'content_buy_type' => $content_type));
     else
        db_update('thread', array('tid' => $tid), array('content_buy' => 0));
}
?>