<?php exit;
    $gid=isset($user['gid'])?$user['gid']:'0'; $my_p=$group['readp']; $target_p=$thread['readp']; $need_refresh=0;
    // hook read_p_check_start.php
    //if($gid!=1&& $my_p<$target_p && $uid!=$thread['uid']){ message(-1, jump(lang('dear_p'), http_referer(), 2));die();}
	$preg_login = preg_match_all('/\[ttlogin\](.*?)\[\/ttlogin\]/i',$first['message_fmt'],$array);
    if($preg_login) {
        $array_count = count($array[0]);
        $html_hide='<div class="alert alert-warning" role="alert">'.lang('dear_guest2').'<a href ="/user-login.htm"><i class="icon-user"></i> '.lang('login').'</a> '.lang('or_').' <a href ="/user-create.htm"><i class="icon-flask"></i> '.lang('register').'</a></div>';
        for($i=0;$i<$array_count;$i++){
            $a = $array[0][$i];
            $b = '<div class="alert alert-success" role="alert">'.$array[1][$i].'</div>';
            if($uid)$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
            else $first['message_fmt'] = str_replace($a,$html_hide,$first['message_fmt']);
        }
    }
    $preg_reply = preg_match_all('/\[ttreply\](.*?)\[\/ttreply\]/i',$first['message_fmt'],$array);
    if($preg_reply) {
        $array_count = count($array[0]);
        $html_reply ='<div class="alert alert-warning" role="alert">'.lang('dear_reply').'</div>';
        if($uid) $replied=db_find_one('post',array('uid'=>$uid,'tid'=>$thread['tid'])); else $replied=array();
        for($i=0;$i<$array_count;$i++){
            $a = $array[0][$i];
            $b = '<div class="alert alert-success" role="alert">'.$array[1][$i].'</div>';
            if($uid AND $replied)$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
            if($uid AND isset($gid) AND $gid==1)$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
            // hook read_p_reply_verify_end.php
            else {$first['message_fmt'] = str_replace($a,$html_reply,$first['message_fmt']);$need_refresh=1;}
        }
    }

    $preg_read = preg_match_all('/\[ttread\](.*?)\[\/ttread\]/i',$first['message_fmt'],$array);
    if($preg_read) {
        $array_count = count($array[0]);
        $html_reply ='<div class="alert alert-warning" role="alert">'.lang('dear_p').'</div>';
        $permission = !($gid!=1&& $my_p<$target_p && $uid!=$thread['uid']) ;
        for($i=0;$i<$array_count;$i++){
            $a = $array[0][$i];
            $b = '<div class="alert alert-success" role="alert">'.$array[1][$i].'</div>';
            if($uid AND $permission)$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
            else {$first['message_fmt'] = str_replace($a,$html_reply,$first['message_fmt']);}
        }
    }

    $set = setting_get('tt_read');
    if($set&& $set['old']==1) {
        $preg_reply2 = preg_match_all('/\[reply\](.*?)\[\/reply\]/i',$first['message_fmt'],$array2);
        if($preg_reply2) {
            $array2_count = count($array2[0]);
            $html_reply ='<div class="alert alert-warning" role="alert">'.lang('dear_reply').'</div>';
            if($uid) $replied=db_find_one('post',array('uid'=>$uid,'tid'=>$thread['tid'])); else $replied=array();
            for($i=0;$i<$array2_count;$i++){
                $a = $array2[0][$i];
                $b = '<div class="alert alert-success" role="alert">'.$array2[1][$i].'</div>';
                if($uid AND $replied)$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
                // hook read_p_reply_verify_end.php
                else {$first['message_fmt'] = str_replace($a,$html_reply,$first['message_fmt']);$need_refresh=1;}
            }
        }
    }
?>