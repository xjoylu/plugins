if(empty($action) || $action == 'simditor') {
	if ($_FILES["onefile"]["error"] > 0){
		$result = array(
			'success'=>false,
			'file_path'=>''
		);
	}else{
		$name = $_FILES["onefile"]["name"];
		$ext = file_ext($name, 7);
		$filetypes = include APP_PATH.'conf/attach.conf.php';
		!in_array($ext, $filetypes['all']) AND $ext = '_'.$ext;
		$tmpanme = $uid.'_'.xn_rand(15).'.'.$ext;
		$tmpfile = $conf['upload_path'].'tmp/'.$tmpanme;
		$tmpurl = $conf['upload_url'].'tmp/'.$tmpanme;
		$filetype = attach_type($name, $filetypes);
		move_uploaded_file($_FILES["onefile"]["tmp_name"],$tmpfile);
		sess_restart();
		empty($_SESSION['tmp_files']) AND $_SESSION['tmp_files'] = array();
		$n = count($_SESSION['tmp_files']);
		$filesize = filesize($tmpfile);
		$attach = array(
			'url'=>$tmpurl, 
			'path'=>$tmpfile, 
			'orgfilename'=>$name, 
			'filetype'=>$filetype, 
			'filesize'=>$filesize, 
			'width'=>0, 
			'height'=>0, 
			'isimage'=>1, 
			'downloads'=>0, 
			'aid'=>'_'.$n
		);
		$_SESSION['tmp_files'][$n] = $attach;
		unset($attach['path']);
		$result = array(
			'success'=>true,
			'file_path'=>$tmpurl
		);
	}
	die(json_encode($result));
}