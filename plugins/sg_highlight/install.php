<?php

/*
	Xiuno BBS 4.0 主题高亮
	插件由查鸽信息网制作网址：http://cha.sgahz.net/
*/

!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE {$tablepre}thread ADD COLUMN highlight tinyint(3) unsigned NOT NULL default '0';";
$r = db_exec($sql);

$kv = array('highlight1'=>'高亮一', 'highlight2'=>'#ff0000', 'highlight3'=>'高亮二', 'highlight4'=>'#0e990b', 'highlight5'=>'高亮三', 'highlight6'=>'#007ef7', 'highlight7'=>'高亮四', 'highlight8'=>'#f900ff', 'highlight9'=>'高亮五', 'highlight10'=>'#fff000');
kv_set('sg_highlight', $kv);
$r === FALSE AND message(-1, 'highlight字段添加出错');
?>