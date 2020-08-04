<?php

function haya_attach_lite_create($arr) {
	$r = db_create('haya_attach_lite', $arr);
	return $r;
}

function haya_attach_lite_update($id, $arr) {
	$r = db_update('haya_attach_lite', array(
		'id' => $id
	), $arr);
	return $r;
}

function haya_attach_lite_read($id) {
	$haya_attach_lite = db_find_one('haya_attach_lite', array(
		'id' => $id
	));
	return $haya_attach_lite;
}

function haya_attach_lite_delete($id) {
	$r = db_delete('haya_attach_lite', array('id' => $id));
	return $r;
}

function haya_attach_lite_read_by_key($key) {
	$haya_attach_lite = db_find_one('haya_attach_lite', array(
		'key' => $key
	));
	return $haya_attach_lite;
}

function haya_attach_lite_find(
	$cond = array(), 
	$orderby = array(), 
	$page = 1, 
	$pagesize = 20
) {
	$haya_attach_lite_list = db_find('haya_attach_lite', $cond, $orderby, $page, $pagesize);
	return $haya_attach_lite_list;
}

function haya_attach_lite_find_key(
	$cond = array(), 
	$orderby = array(), 
	$page = 1, 
	$pagesize = 20
) {
	$haya_attach_lite_list = haya_attach_lite_find($cond, $orderby, $page, $pagesize);
	
	$haya_attach_lite_key_list = array();
	foreach ($haya_attach_lite_list as $haya_attach_lite_list_key => $haya_attach_lite_list_value) {
		$haya_attach_lite_key_list[$haya_attach_lite_list_value['key']] = $haya_attach_lite_list_value;
	}
	return $haya_attach_lite_key_list;
}

function haya_attach_lite_maxid() {
	return db_maxid('haya_attach_lite', 'id');
}

// 系统文件附件
function haya_attach_lite_file_count($cond = array()) {
	$n = db_count('attach', $cond);
	return $n;
}
