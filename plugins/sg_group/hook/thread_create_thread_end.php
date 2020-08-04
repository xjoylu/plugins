 <?php exit;
$credits = $forum['create_credits'];
$golds = $forum['create_golds'];
$message = '';
!empty($credits) AND $message = lang('sg_creditsplus',  array('credits'=>$credits));
!empty($golds) AND $message = lang('sg_goldsplus',  array('golds'=>$golds));
!empty($credits) && !empty($golds) AND $message = lang('sg_creditsplus',  array('credits'=>$credits)).'、'.lang('sg_goldsplus',  array('golds'=>$golds));
if($sg_group['isfirst'] == 1) {
	$t = $user_create_date['create_date'] - runtime_get('cron_2_last_date');
	if($t < 0) {
		$creditsrand = rand($sg_group['creditsfrom'], $sg_group['creditsto']);
		$credits += $creditsrand;
		$goldsrand = rand($sg_group['goldsfrom'], $sg_group['goldsto']);
		$golds += $goldsrand;
		$message = lang('sg_isfirst_creditsplus', array('creditsplus'=>$credits, 'goldsplus'=>$golds));
	}
}
$uid AND user_update($uid, array('credits+'=>$credits, 'golds+'=>$golds));
$uid AND user_update_group($uid);
 message(0, lang('create_thread_sucessfully').$message);
 ?>