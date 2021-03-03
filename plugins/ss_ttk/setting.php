<?php
!defined('DEBUG') AND exit('Access Denied.');

$action = param(3,'edit');

$_tpl = APP_PATH.'plugin/ss_ttk/';

if($action == 'edit'){
	if($method == 'GET') {
		$ss_ttk = setting_get('ss_ttk');

		if(!$ss_ttk){
			$ss_ttk = array('api'=>'http://up.tietuku.com/','webup'=>0,'fileup'=>0,'height'=>280,'token'=>'','urltoken'=>'','tpl'=>'<img src="#linkurl#">','description'=>'温馨提示：图片格式支持JPG、JPEG、GIF、PNG、BMP；一次可添加上传300张图片，单张图片不可超过10M。','finderr'=>'对不起，系统出现异常，查找图片失败！','notabel'=>'呃，看来这不是一个有效的图片地址！','url_in'=>'请输入网址：','findimg'=>'查找图片','up'=>'上传图片','select'=>'选择图片','uploading'=>'正在上传','uploadfailed'=>'上传失败');
			setting_set('ss_ttk', $ss_ttk);
		}
	
		$header['title'] = $header['mobile_title'] ='贴图库插件配置修改 (倚楼观天象)';
	
		$input['api'] = form_text('api', $ss_ttk['api']);
		$input['webup'] = form_select('webup', array(0=>'是',1=>'否'), $ss_ttk['webup']);
		$input['fileup'] = form_select('fileup', array(0=>'是',1=>'否'), $ss_ttk['fileup']);
		$input['height'] = form_text('height', $ss_ttk['height']);
		$input['token'] = form_textarea('token', $ss_ttk['token']);
		$input['urltoken'] = form_textarea('urltoken', $ss_ttk['urltoken']);
		$input['tpl'] = form_textarea('tpl', $ss_ttk['tpl']);
		$input['description'] = form_text('description', $ss_ttk['description']);
		$input['finderr'] = form_text('finderr', $ss_ttk['finderr']);
		$input['notabel'] = form_text('notabel', $ss_ttk['notabel']);
		$input['url_in'] = form_text('url_in', $ss_ttk['url_in']);
		$input['findimg'] = form_text('findimg', $ss_ttk['findimg']);
		$input['up'] = form_text('up', $ss_ttk['up']);
		$input['select'] = form_text('select', $ss_ttk['select']);
		$input['uploading'] = form_text('uploading', $ss_ttk['uploading']);
		$input['uploadfailed'] = form_text('uploadfailed', $ss_ttk['uploadfailed']);

		include _include($_tpl.'edit.htm');
	} elseif($method == 'POST') {
		$ss_ttk = array(
			'api'=>param('api'),
			'webup'=>param('webup'),
			'fileup'=>param('fileup'),
			'height'=>param('height'),
			'token'=>param('token'),
			'urltoken'=>param('urltoken'),
			'tpl'=>param('tpl'),
			'description'=>param('description'),
			'finderr'=>param('finderr'),
			'notabel'=>param('notabel'),
			'url_in'=>param('url_in'),
			'findimg'=>param('findimg'),
			'up'=>param('up'),
			'select'=>param('select'),
			'uploading'=>param('uploading'),
			'uploadfailed'=>param('uploadfailed')
		);
		setting_set('ss_ttk', $ss_ttk);
		
		message(0, '操作成功');
	}
}
?>