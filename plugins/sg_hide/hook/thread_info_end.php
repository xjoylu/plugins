function sg_hide2($message){
	global $uid;
	global $tid;
	$posts = db_find('post', array('tid'=>$tid), array(), 1, 1000000, '', array('uid'));
	foreach($posts  as $_post) {
		if($_post['uid']==$uid && $uid!=0){
			return "<font color='#ff0000'>本帖隐藏的内容：<br>".$message['message']."</font>";
		}	
	}
	return "<br/><font color='#ff0000'>内容隐藏,请回复后可见</font><br/>";
}
function sg_hide1($message){
	global $uid;
		if($uid!=0){
			return "<font color='#ff0000'>本帖隐藏的内容：<br>".$message['message']."</font>";
		}	
	return "<br/><font color='#ff0000'>内容隐藏,请登陆后可见</font><br/>";
}
$hidegid = explode(',',$kvhide['hide4']);
if(in_array($gid,$hidegid)==0){
	
	if(!empty($kvhide['hide3'])){
		if($thread['uid']!=$uid){
			$first['message_fmt'] = preg_replace_callback('/\<pre class\=\"brush:sg_hide2;toolbar:false\"\>(?<message>(?:([\s\S]*)))\<\/pre\>/si','sg_hide2',$first['message_fmt']);
		}
	}
	if(!empty($kvhide['hide2']) && empty($uid)){
			$first['message_fmt'] =  preg_replace("(</?img[^>]*>)","<br/><font color='#ff0000'>图片隐藏,请登陆后可见</font><br/>",$first['message_fmt']);
	}
	if(!empty($kvhide['hide1']) || !empty($kvhide['hide3'])){	
		if(empty($uid)){
			if(!empty($kvhide['hide1'])){
			$first['message_fmt'] = '内容隐藏,请登陆后可见';
			} else{
			$first['message_fmt'] = preg_replace_callback('/\<pre class\=\"brush:sg_hide1;toolbar:false\"\>(?<message>(?:([\s\S]*)))\<\/pre\>/si','sg_hide1',$first['message_fmt']);
			}
		}
	}
}