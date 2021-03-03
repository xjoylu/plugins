$from_tag=param('test_tag');
$from_tag=str_replace(" ",",",str_replace("，",",",$from_tag));
$from_tag=str_replace(",,",",",str_replace("  ",",",$from_tag));
$tag_arry=array_unique(explode(',',$from_tag));
$from_tag=implode(",",$tag_arry);

if($from_tag==true){
for($i=0;$i<count($tag_arry);$i++){
	$arrlist = db_find_one('fq_tag', array('name'=>$tag_arry[$i]));
	if($arrlist === FALSE){
	$tagid = db_insert('fq_tag',array('tagid'=>null,'name'=>$tag_arry[$i]));
	db_insert('fq_tag_thread',array('tagid'=>$tagid,'tid'=>$tid));
	}else{
		db_insert('fq_tag_thread',array('tagid'=>$arrlist['tagid'],'tid'=>$tid));
	}
}
}