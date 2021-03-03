<?php

/*
	Xiuno BBS 4.0 大白链接
*/

!defined('DEBUG') AND exit('Access Denied.'); 
$setting = setting_get('huux_os_link');

$action = param(3);

// 自定义链接
$linklist = db_find('huux_os_link', array(), array('rank'=>-1), 1, 1000, 'linkid');
$maxid = db_maxid('huux_os_link', 'linkid');


if($method == 'GET') {
		$input = array();
		//20170808 1.5升级添加新的字段
		$tablepre = $db->tablepre;
		$arr = db_sql_find("DESC {$tablepre}huux_os_link");
		foreach($arr as $row) {$col_field[]=$row['Field'];}
		if(!in_array('str', $col_field)){
				$sql = "ALTER TABLE {$tablepre}huux_os_link ADD COLUMN str mediumtext NOT NULL";
				$r = db_exec($sql);
				if($r === FALSE) {
				    echo $errstr;
				} else {
					message(0, jump('升级成功，新增字段备注str', url("plugin-setting-huux_os_link"), 1));
				}
		}
		// 是否启用链接图标
		$input['icon_io'] = form_radio_yes_no('icon_io', $setting['icon_io']); 
		$input['link_index_headernav'] = form_radio_yes_no('link_index_headernav', $setting['link_index_headernav']); 
		$input['link_index_friendlink'] = form_radio('link_index_friendlink', array(0=>'关闭', 1=>'侧边栏', 2=>'底部',3=>'侧边栏+底部'), $setting['link_index_friendlink']);

		include _include(APP_PATH.'plugin/huux_os_link/setting.htm');
					
} elseif($action == 'io') {

	    $setting['icon_io'] = param('icon_io', 0);
	    $setting['link_index_headernav'] = param('link_index_headernav', 0);
	    $setting['link_index_friendlink'] = param('link_index_friendlink', 0);

	    setting_set('huux_os_link', $setting);
		message(0, array('a'=>'修改成功','b'=>'大白友情提示：修改成功','c'=>'失败'));

}
elseif($action == 'link'){
	    
	    $rowidarr = param('rowid', array(0));
	    $iconarr = param('icon', array(''));
		$namearr = param('name', array(''));
		$notearr = param('note', array(''));
		$strarr = param('str', array(''));
		$urlarr = param('url', array(''));
		$rankarr = param('rank', array(0));
		$typearr = param('type', array(0));
		$targetarr = param('target', array(0));
		
		unset($rowidarr[0]);
		unset($iconarr[0]);
		unset($namearr[0]);
		unset($notearr[0]);
		unset($strarr[0]);
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
				'str'=>$strarr[$k],
				'url'=>$urlarr[$k],
				'target'=>$targetarr[$k],
				'rank'=>$rankarr[$k],
				'type'=>$typearr[$k]
			);

			if(!isset($linklist[$k])) {
				db_create('huux_os_link', $arr);
			} else {
				db_update('huux_os_link', array('linkid'=>$k), $arr);
			}
			// icon
			if(!empty($iconarr[$k])) {
				$s = array_value($iconarr, $k);
				$data = substr($s, strpos($s, ',') + 1);
				$data = base64_decode($data);
                   $path = '../upload/huux_os_link';
				   !is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
				$iconfile = "../upload/huux_os_link/$k.png";
				file_put_contents($iconfile, $data);

				db_update('huux_os_link', array('linkid'=>$k), array('icon'=>$time));
			}
		}
		
		// 删除
		$deletearr = array_diff_key($linklist, $rowidarr);
		foreach($deletearr as $k=>$v) {
			db_delete('huux_os_link', array('linkid'=>$k));
		}
		
		message(0, '保存成功');
}

?>