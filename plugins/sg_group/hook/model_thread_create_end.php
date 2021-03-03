$credits = $kv['group2'];
$message = " 积分+$kv[group2]分";
if($kv['group4'] == 1) {
$t = $user_create_date['create_date'] - runtime_get('cron_2_last_date');
if($t < 0) {
	$creditsrand = rand($kv['group5'], $kv['group6']);
	$credits += $creditsrand;
	$message = " 积分+$kv[group2]分，今日首帖额外奖励{$creditsrand}分";
}
}
$_SESSION['message'] = $message;
$uid AND user__update($uid, array('credits+'=>$credits));
$uid AND user_update_group($uid);