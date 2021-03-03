<?php
!defined('DEBUG') AND exit('Access Denied.');

$action = param(3,'list');

$_tpl = APP_PATH.'plugin/ss_ads/htm/';

if($action == 'list') {
	$list = db_find('ss_ads', array(), array(), 1, 100);
	include _include($_tpl.'list.htm');
}else if($action == 'edit'){
	$_id = param(4, 0);
	$_ads = ss_ads_read($_id);
	
	if($method == 'GET') {
		if(!$_ads){$_id = 0;$_ads = array('name'=>'','mode'=>0,'size'=>750,'lcode'=>'','rcode'=>'');}
	
		$header['title'] = $header['mobile_title'] = $_id == 0 ? '新增' : '修改';
	
		$input['name'] = form_text('name', $_ads['name']);
		$input['mode'] = form_select('mode', array(0=>'大于',1=>'等于',2=>'小于'), $_ads['mode']);
		$input['size'] = form_text('size', $_ads['size']);
		$input['lcode'] = form_textarea('lcode', $_ads['lcode']);
		$input['rcode'] = form_textarea('rcode', $_ads['rcode']);
		
		include _include($_tpl.'edit.htm');
	} elseif($method == 'POST') {
		if(!$_ads){$_id = 0;}
		$name = param('name');
		$mode = param('mode',0);
		$size = param('size',0);
		$lcode = param('lcode');
		$rcode = param('rcode');
		
		empty($name) AND message('name', '名称不能为空');
		empty($lcode) AND message('lcode', '成立代码不能为空');
		
		$data = array('name'=>$name , 'mode'=>$mode , 'size'=>$size , 'lcode'=>$lcode , 'rcode'=>$rcode);
		
		if($_id == 0){
			$data['create_date'] = $time;
			$r = db_insert('ss_ads', $data);
			$r === FALSE AND message(-1, lang('create_failed'));
		}else{
			$update = array_diff_value($data, $_ads);
			empty($update) AND message(-1, lang('data_not_changed'));
	
			$r = db_update('ss_ads', array('aid'=>$_id), $update);
			$r === FALSE AND message(-1, lang('update_failed'));
			ss_ads_get($_id,1);
		}
		
		message(0, '操作成功');
	}
}else if($action == 'del'){
	$_id = param(4, 0);
	$r = db_delete('ss_ads',array('aid'=>$_id));
	$r === FALSE AND message(-1, lang('delete_failed'));
	ss_ads_get($_id,1);
	message(0, '操作成功');
}
?>