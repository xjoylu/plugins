else if($action=='pay'){
	include _include(APP_PATH.'plugin/l4c_openpay/view/htm/my_pay.htm');
}
else if($action=='payImg1'){

		
		$width = param('width');
		$height = param('height');
		$data = param('data', '', FALSE);
		
		empty($data) AND message(-1, lang('data_is_empty'));
		$data = base64_decode_file_data($data);
		$size = strlen($data);
		$size > 2048000 AND message(-1, lang('filesize_too_large', array('maxsize'=>'1M', 'size'=>$size)));
		
		$filename = "zfb-$uid.png";
		$path = $_SERVER['DOCUMENT_ROOT'].'/./plugin/l4c_openpay/pay/';
		$url = 'plugin/l4c_openpay/pay/'.$filename;
		!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
		
		file_put_contents($path.$filename, $data) OR message(-1, lang('write_to_file_failed'));		
		message(0, array('url'=>$url));
}
else if($action=='payImg2'){

		
		$width = param('width');
		$height = param('height');
		$data = param('data', '', FALSE);
		
		empty($data) AND message(-1, lang('data_is_empty'));
		$data = base64_decode_file_data($data);
		$size = strlen($data);
		$size > 2048000 AND message(-1, lang('filesize_too_large', array('maxsize'=>'1M', 'size'=>$size)));
		
		$filename = "wx-$uid.png";
		$path = $_SERVER['DOCUMENT_ROOT'].'/./plugin/l4c_openpay/pay/';
		$url = 'plugin/l4c_openpay/pay/'.$filename;
		!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
		
		file_put_contents($path.$filename, $data) OR message(-1, lang('write_to_file_failed'));		
		message(0, array('url'=>$url));
}
else if($action=='payImg3'){

		
		$width = param('width');
		$height = param('height');
		$data = param('data', '', FALSE);
		
		empty($data) AND message(-1, lang('data_is_empty'));
		$data = base64_decode_file_data($data);
		$size = strlen($data);
		$size > 2048000 AND message(-1, lang('filesize_too_large', array('maxsize'=>'1M', 'size'=>$size)));
		
		$filename = "qq-$uid.png";
		$path = $_SERVER['DOCUMENT_ROOT'].'/./plugin/l4c_openpay/pay/';
		$url = 'plugin/l4c_openpay/pay/'.$filename;
		!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
		
		file_put_contents($path.$filename, $data) OR message(-1, lang('write_to_file_failed'));		
		message(0, array('url'=>$url));
}
else if($action=='payImg4'){

		
		$width = param('width');
		$height = param('height');
		$data = param('data', '', FALSE);
		
		empty($data) AND message(-1, lang('data_is_empty'));
		$data = base64_decode_file_data($data);
		$size = strlen($data);
		$size > 2048000 AND message(-1, lang('filesize_too_large', array('maxsize'=>'1M', 'size'=>$size)));
		
		$filename = "paypal-$uid.png";
		$path = $_SERVER['DOCUMENT_ROOT'].'/./plugin/l4c_openpay/pay/';
		$url = 'plugin/l4c_openpay/pay/'.$filename;
		!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
		
		file_put_contents($path.$filename, $data) OR message(-1, lang('write_to_file_failed'));		
		message(0, array('url'=>$url));
}