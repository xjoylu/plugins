<?php
require_once(dirname(__FILE__)."/Identicon/Identicon.php");

$identicon = new Identicon();
$string = $_user['email'];
$size = 50;
$data = $identicon->getImageData($string, $size);

$filename = "$uid.png";
$dir = substr(sprintf("%09d", $uid), 0, 3).'/';
$path = $conf['upload_path'].'avatar/'.$dir;
$url = $conf['upload_url'].'avatar/'.$dir.$filename;
!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));

file_put_contents($path.$filename, $data) OR message(-1, lang('write_to_file_failed'));

user_update($uid, array('avatar'=>$time));
?>