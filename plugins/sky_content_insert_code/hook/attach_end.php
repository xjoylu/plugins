<?php exit;

if(empty($action) || $action == 'findaid') {
    $aid = param(2);
    $content = param('content', '', false);
    $aid = intval($aid);
    $attach = attach__read($aid);
    $orgfilename = quotemeta($attach['orgfilename']);
    $reg = '/<sky id="sky_attr'.$orgfilename.'">.*<\/sky>/isU';
    $content = preg_replace($reg, '', $content);
    echo $content;exit;
}

?>