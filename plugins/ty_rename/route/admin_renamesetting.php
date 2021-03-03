<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = isset($_GET["type"])?$_GET["type"]:"";//param(1);
if(empty($action)) {
	$header['title'] = '改名设置';

	//$kamilist = db_sql_find("SELECT * FROM bbs_kami");

	$path = APP_PATH.'plugin/ty_rename/route/setting.txt';
	$number = file_get_contents($path);
	
	/*
	$myfile = fopen($path, "r") or die("Unable to open file!");
	echo fread($myfile,filesize("webdictionary.txt"));
	fclose($myfile);
	*/

	include APP_PATH.'plugin/ty_rename/view/shezhi.htm';
}else if ($action == 'update') {
	if(isset($_POST['number']))
	{
		$path = APP_PATH.'plugin/ty_rename/route/setting.txt';
		$myfile = fopen($path, "w") or die("Unable to open file!");
		$txt = intval($_POST['number']);
		fwrite($myfile, $txt);
		fclose($myfile);
		message(0, '成功');
	}else{
		message(0, '参数不能为空');
	}
	
};
?>