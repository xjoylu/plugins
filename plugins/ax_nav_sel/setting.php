<?php



!defined('DEBUG') AND exit('Access Denied.'); 
$setting = setting_get('ax_nav_sel');
$action = param(3);

// 自定义链接
$linklist = db_find('ax_nav_sel', array(), array('rank'=>-1), 1, 1000, 'linkid');
$maxid = db_maxid('ax_nav_sel', 'linkid');










if($method == 'GET') {
		 $input = array(); 
		 // 是否启用链接图标
		 $input['icon_io'] = form_radio_yes_no('icon_io', $setting['icon_io']); 
		 $input['link_index_headernav'] = form_radio_yes_no('link_index_headernav', $setting['link_index_headernav']); 
		 $input['link_index_friendlink'] = form_radio('link_index_friendlink', array(0=>'关闭', 1=>'侧边栏', 2=>'底部',3=>'侧边栏+底部'), $setting['link_index_friendlink']);

		 include _include(APP_PATH.'plugin/ax_nav_sel/setting.htm');
					
} elseif($action == 'io') {

	    $setting['icon_io'] = param('icon_io', 0);
	    $setting['link_index_headernav'] = param('link_index_headernav', 0);
	    $setting['link_index_friendlink'] = param('link_index_friendlink', 0);

	    setting_set('ax_nav_sel', $setting);
		message(0, array('a'=>'修改成功','b'=>'修改成功','c'=>'失败'));

}
elseif($action == 'link'){
	    
	    $rowidarr = param('rowid', array(0));
	    $iconarr = param('icon', array(''));
		$namearr = param('name', array(''));
		$notearr = param('note', array(''));
		$urlarr = param('url', array(''));
		$rankarr = param('rank', array(0));
		$typearr = param('type', array(0));
		$targetarr = param('target', array(0));
		
		unset($rowidarr[0]);
		unset($iconarr[0]);
		unset($namearr[0]);
		unset($notearr[0]);
		unset($urlarr[0]);
		unset($rankarr[0]);
		unset($typearr[0]);
		unset($targetarr[0]);
		
		$arrlist = array();
		foreach($rowidarr as $k=>$v) {
			$arr = array(
				'linkid'=>$k,
				'name'=>$namearr[$k],
				'note'=>$notearr[$k],
				'url'=>$urlarr[$k],
				'target'=>$targetarr[$k],
				'rank'=>$rankarr[$k],
				'type'=>$typearr[$k],
			);
			// icon
			if(!empty($iconarr[$k])) {
				
				$s = array_value($iconarr, $k);
				$data = substr($s, strpos($s, ',') + 1);
				$data = base64_decode($data);
                $path = '../upload/ax_nav_sel/';
				!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
				$iconfile = "../upload/ax_nav_sel/$k.png";
				file_put_contents($iconfile, $data);
				db_update('ax_nav_sel', array('linkid'=>$k), array('icon'=>$time));
				
			}
			if(!isset($linklist[$k])) {
				db_create('ax_nav_sel', $arr);
			} else {
				db_update('ax_nav_sel', array('linkid'=>$k), $arr);
			}
		}
		
		// 删除
		$deletearr = array_diff_key($linklist, $rowidarr);
		foreach($deletearr as $k=>$v) {
			db_delete('ax_nav_sel', array('linkid'=>$k));
		}
		
		message(0, '保存成功');
}

?>