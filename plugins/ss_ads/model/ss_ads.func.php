<?php
//##############基础######################
function ss_ads_read($id=0){
	if(empty($id)) return FALSE;
	$id = intval($id);
	return db_find_one('ss_ads', array('aid'=>$id));
}

function ss_ads_get($id=0,$t=0){
	if(!is_numeric($id) || $id <= 0) return '';
	$cache = 'ss_ads_'.$id;
	if($t == 1){
		cache_delete($cache);
		return true;
	}
	$ads = cache_get($cache);
	if($ads === NULL) {
		$ads = ss_ads_read($id);
		if(!$ads){
			$ads = '';
		}else{
			$ads = ss_ads_write($ads);
		}
		cache_set($cache, $ads,0);
	}
	return $ads;
}

function ss_ads_write($data){
	if($data['size'] == 0){
		return ss_ads_code($data['lcode']);
	}
	
	$htm = 'if(document.body.clientWidth';
	$mode = $data['mode'];
	if($mode == 0){
		$htm .= ' > ';
	}elseif($mode == 1){
		$htm .= ' == ';
	}else{
		$htm .= ' < ';
	}
	$htm .= $data['size']."){\r\n";
	$htm .= ss_ads_code($data['lcode']);
	$htm .= "} else {\r\n";
	$htm .= ss_ads_code($data['rcode']);
	$htm .= "}\r\n";
	return $htm;
}

function ss_ads_code($code){
	$code = htmlspecialchars_decode($code);
	$code = str_replace('"', '\"',$code);
    $code = str_replace("\r", "\\r",$code);
    $code = str_replace("\n", "\\n",$code);
    $code = "document.write(\"{$code}\");\r\n";
	return $code;
}
