		$return_html = param('return_html', 0);
		$kv = kv_get('sg_group');
		$uid AND user__update($uid, array('credits+'=>$kv['group3']));
		user_update_group($uid);
		if($return_html) {
			$filelist = array();
			ob_start();
			include _include(APP_PATH.'view/htm/post_list.inc.htm');
			$s = ob_get_clean();
						
			message(0, $s);
		} else {
			
			message(0, lang('create_post_sucessfully')." 积分+$kv[group3]分");
		}