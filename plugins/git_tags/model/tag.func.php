<?php

/**
 * User: last
 * Date: 2018/5/17
 * Time: 上午4:42
 */


// 标签关联的主题 (先读出相应页数的主题tid， 用tid读出对应数量的主题， 故主题页码只会是1)
function tag_list($tagid, $page, $pagesize,$order){
	$r = db_find('git_tags_thread', array('tagid'=>$tagid),$order,$page,$pagesize);
	$r = arrlist_values($r,'tid');
	$r = db_find('thread', array('tid'=>$r),$order,1,$pagesize);
	return $r;
}



// 标签的完整信息
function tag_info($tagid){
	$r = db_find_one('git_tags', array('tagid'=>$tagid));
	return $r;
}


// 主题对应的标签
function tag_taglist($tid){
	$list = array();
	$r = db_find('git_tags_thread', array('tid'=>$tid), array(), 1, 12);
	if($r){
		$r = arrlist_values($r, 'tagid');
		$list = db_find('git_tags', array('tagid'=>$r), array(), 1, 12);
	}
	return $list;
}


function tag_push($tagid){
	//关联推荐 (取得所有关联的主题, 可能数量庞大, 暂限制1k) (暂弃用)
	$tlist = db_find('git_tags_thread', array('tagid'=>$tagid), array('tid'=>-1), 1 , 1000);
	$tlist = arrlist_values($tlist, 'tid');                      // 取出tid, 可能数量庞大
	$tlist = array_unique($tlist);                               // 移除重复
	$tlist = array_diff($tlist,array('tid'=>$tid));              // 移除自身id
	shuffle($tlist);                                             // 打乱排序(需要保障多标签时不只取前面的)
	$tlist = array_slice($tlist,0,4);                            // 取前 4 个,(可能不足4个)
	if($tlist){ $lists = db_find('thread', array('tid'=>$tlist)); }
	return $list;
}



// add
function tag_add($tid,$tag){
	$r = db_find_one('git_tags',array('name'=>$tag));
	if ($r == FALSE){
		$r = db_insert('git_tags',array('name'=>$tag, 'link'=>1));
		db_insert('git_tags_thread',array('tid'=>$tid, 'tagid'=>$r));
		// 记录到历史
	}else{
		$r = $r['tagid'];
		db_insert('git_tags_thread',array('tid'=>$tid, 'tagid'=>$r));
		db_update('git_tags',array('tagid'=>$r),array('link+'=>1));
		// 记录到历史
	}
	return $r;
}


// del (输入的参数不能为空)
function tag_del($tid,$tagid){
	if($tagid == 'all'){
		$r = db_find('git_tags_thread', array('tid'=>$tid), array(), 1, 12);
		if($r){
			// 删关联 降计数 (批量)
			$arr = arrlist_values($r, 'tagid');
			db_delete('git_tags_thread', array('tid'=>$tid));
			db_update('git_tags', array('tagid'=>$arr), array('link-'=>1));
			db_delete('git_tags', array('tagid'=>$arr, 'link'=>0));
		}
	}else{
		// 删关联 降计数 (单条)
		db_delete('git_tags_thread', array('tid'=>$tid,'tagid'=>$tagid));
		db_update('git_tags', array('tagid'=>$tagid), array('link-'=>1));
		db_delete('git_tags', array('tagid'=>$tagid, 'link'=>0));
	}
}














/**
 * 状态判断
 *
 */

function tag_max($tid){
        $r = db_count('git_tags_thread', array('tid'=>$tid));
        if ($r > 11) return true;
        return  FALSE;
}

function tag_lock($uid,$tid,$gid,$lock) {
	/* 若是管理员或作者
	 * 若是 TAG 全局未锁且作者未锁
	 * $t 是作者锁, 暂未实装
	 */
	$t = '1';
	$k = db_find_one('thread', array('tid'=>$tid, 'uid'=>$uid));

	if ($k != FALSE  || $gid == 1) { return FALSE; }
	if ($lock==1 && $t==1){ return FALSE; }
	return true;
}

function tag_law($tag,$kv){
	/* 验证长度, 小于2和大于设定的最大字符数禁止
	 * 检查危险字符 (首尾空格前端过滤, 此处发现即非法)
	 * 移除两侧空格, 转化所有符号为空格, 不相等则非法
	 * 检查禁用词汇 (回避词 而非脏词过滤, 不宜设置过多)
	 */
	if( mb_strlen($tag)<2 || mb_strlen($tag)>$kv['limit']) return true;
	$r = preg_replace("/[[:punct:]\s]/",' ',trim($tag));
	if ($tag !== $r) return true;
	$r = array_unique(explode(' ',$kv['stop']));
	foreach ($r as $v) { if(strpos($tag,$v)) return true; }
	return FALSE;
}

function tag_rep($tag,$tid){
	/* 重复标签检查 (此处效率略低)
	 * 不要使用反查! 先取出本主题的标签最多 12 个
	 */
	$data = db_find('git_tags_thread', array('tid'=>$tid), array(), 1, 12);
	if($data){
		$tagidlist = arrlist_values($data, 'tagid');
		$kb = db_find('git_tags', array('tagid'=>$tagidlist));
		$kblist  = arrlist_values($kb, 'name');
		if(in_array($tag,$kblist)){
			return true;
		}
	}
	return FALSE;
}

?>
