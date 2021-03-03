<?php exit;
if($thread['OK']!='1' && $group['see_check']!='1' && $uid!=$thread['uid']) {
    if($thread['OK']=='0')
        message(-1, "本帖正在审核中，您无权查看！");
    elseif($thread['OK']=='-1')
        message(-1, "本帖未审核通过，您无权查看！");
    elseif($thread['OK']=='-2')
        message(-1, "本帖正在回收站中，您无权查看！");
    die();
}
?>