<?php exit;
if($thread['red_num']>=0){
    $first['message_fmt'].='<div style="text-align:center; width:100%;"><img style="border:0;cursor:pointer;" src="plugin/tt_redpacket/red.png" id="redpacket"/></div>';
    $load_redpacket_js=1;
    $red_info = db_find_one('thread_red',array('tid'=>$tid));
}
?>