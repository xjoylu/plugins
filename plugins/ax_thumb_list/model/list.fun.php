<?php
function ax_imglist($tid){

	$r = db_find_one('post', array('tid'=>$tid));

	$content = $r['message_fmt']; //文章内容 

	preg_match_all("/<img.*src=[\'|\"](.*)[\'|\"]\s*.*>/iU", $content, $img);

	return $img[1];

 //	if(isset($imgArr)){ 
 //	  	return $imgArr; 
 //	}else{
 //		return "";
 //	}

}	

function ax_message($tid)
{
	$r = db_find_one('post', array('tid'=>$tid));
	return  xn_substr(strip_tags($r['message_fmt']), 0, 160)."...";
}

function ax_forum_name($fid)
{
	$r = db_find_one('forum', array('fid'=>$fid));
	return  $r['name'];
}


?>