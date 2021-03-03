$kv = kv_get('sg_group');
if($kv['group1'] == 1) {
	$n = $user['credits']; 
} elseif($kv['group1'] == 2) {
	$n = $user['credits'] + $user['threads'];
} elseif($kv['group1'] == 3) {
	$n = $user['credits'] + $user['posts'];
}