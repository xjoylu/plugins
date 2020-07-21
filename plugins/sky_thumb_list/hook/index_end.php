<?php exit;
include APP_PATH.'plugin/sky_thumb_list/lib/func.php';
if ($threadlist) {
    foreach ($threadlist as &$val) {
        $image_number = db_count('attach', array('tid' => $val['tid'], 'filetype' => 'image'));
        $val['image_number'] = $image_number;
        if ($image_number >= 4) {
            $val['thumbs'] = attach__find(array('tid' => $val['tid'], 'filetype' => 'image'), array('aid' => 1), 1, 4);
            foreach ($val['thumbs'] as &$v) {
                $v['filename'] = $conf['upload_url'] . 'attach/' . $v['filename'];
                $v['filename'] = sky_thumb($v['filename']);
            }
        } else {
            //$attr = db_find_one('attach', array('tid'=>$val['tid'], 'filetype'=>'image'));
            $attr = attach__find(array('tid' => $val['tid'], 'filetype' => 'image'), array('aid' => 1), 1, 1);
            if($attr && isset($attr[0]['filename'])) {
                $attr[0]['filename'] = $conf['upload_url'] . 'attach/' . $attr[0]['filename'];
                $attr[0]['filename'] = sky_thumb($attr[0]['filename']);
                $val['thumbs'] = $attr;
            } else {
                $default_img = array('0' => array('filename' => '/plugin/sky_thumb_list/img/default.png'));
                $val['thumbs'] = $default_img;
            }
        }
        $message = db_find_one('post', array('tid'=>$val['tid']), array(), array('message'));
        $message = strip_tags($message['message']);
        $message = mb_substr($message, 0, 120, 'utf-8');
        $val['sky_desc'] = $message;
    }
}
?>