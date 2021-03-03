/****************************************************************************
*
*
*                       改头换面, 重新做人 DAZE..
*
*
*****************************************************************************/

//为改名功能在个人中心添加路由
elseif($action == 'name') {
	if($method == 'GET') {
		include _include(APP_PATH.'plugin/z_name/htm/my_name.htm');
	} elseif($method == 'POST') {

		// 验证是否拥有需要消耗数量的改名卡 或者 金币 积分
		
		$username_new = param('username_new'); // param('password_new');
		empty($username_new) AND message(-1, '不可以为空');
		//mb_strlen($username_new,"utf-8") > 12 AND message(-1, '不可以超过 12 个字'); // mb_strlen 非核心函数, 可能需要注意是否被禁用了
		utf8_strlen($username_new) > 15 AND message(-1, '不可以超过 15 个字'); // 拆解字符串判断字数而不是字节数
		preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$username_new) AND message(-1,'不可以使用标点字符');
		preg_match('/[(\xc2\xa0)|\s]+/', $username_new) AND message(-1,'不可以使用空格　'); // 还有各种空白字符过滤呐

		// 过滤非法关键词

		$username_new == $user['username'] AND message(-1,'不可以和原来的名字相同');
		$ra = db_find_one('user', array('username' => $username_new));
		$ra != FALSE AND message(-1, '该 ID 已被占用, 请换一个' );
		$rb = user_update($uid, array('username'=>$username_new));
		$rb === FALSE AND message(-1, '修改失败, 请重试..  如果依旧不可以, 请联系管理员 错误状态:updateFALSE');

		// 如果改名成功, 则消耗积分或者金币或者改名卡

		$user['username'] = $username_new; // 使顶部已经获取的 ID 替换为新的, 防止用户再看到原来的 ID
		message(0, '使用了新的名字. 你好, '.$username_new.'.');
	}
}




// 计算中文字符串长度 将字符串分解为单元 返回单元个数
function utf8_strlen($string = null) {
preg_match_all("/./us", $string, $match);
return count($match[0]);
}