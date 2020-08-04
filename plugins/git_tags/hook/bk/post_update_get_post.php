//获取填写框内容，进行字符替换处理
$from_tag=param('tag_post'); //取到填写框的值
$from_tag=str_replace(" ",",",$from_tag);
$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\（|\）|\+|\{|\}|\<|\>|\[|\]|\.|\/|\;|\'|\`|\=|\\\|\s+/";
$from_tag=preg_replace($regex,"",$from_tag);
$from_tag=str_replace("，",",",str_replace(" ",",",$from_tag));
$from_tag=str_replace(",,",",",str_replace(",,,",",",$from_tag));
$tag_arry=array_unique(explode(',',$from_tag)); //最终得到填写框的内容数组
$tag_arry=array_merge($tag_arry);
$from_tag=implode(",",$tag_arry); //将填写框内容分割为逗号隔开的字符串


if($from_tag==true){
	//删除淀余的标签记录
	$aa = db_sql_find("SELECT * FROM bbs_git_tags_thread where tid='$tid'");
	if($aa !== false || count($aa)>0) {
		$db_tagid_arry = array_map('array_shift',$aa); 
		db_delete('git_tags_thread', array('tid'=>$tid));
		
		for($y=0;$y<count($db_tagid_arry);$y++){
			$tagid=$db_tagid_arry[$y];
			$if_g = db_find_one('git_tags_thread', array('tagid'=>$tagid));
			if($if_g === FALSE){
			 db_delete('git_tags', array('tagid'=>$tagid));
			}
		}
	}
	
	
	//将填写框重新编辑的标签，更新进数据库
    db_delete('git_tags_thread', array('tid'=>$tid));
    for($i=0;$i<count($tag_arry) & count($tag_arry)!==0;$i++){
		$arrlist = db_find_one('git_tags', array('name'=>$tag_arry[$i]));
		if($arrlist==FALSE){
			$tagid = db_insert('git_tags',array('tagid'=>null,'name'=>$tag_arry[$i]));
			db_insert('git_tags_thread',array('tagid'=>$tagid,'tid'=>$tid));
		}else{
			db_insert('git_tags_thread',array('tagid'=>$arrlist['tagid'],'tid'=>$tid));
		}
	}
}
