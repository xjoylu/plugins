 <?php exit;
$set = setting_get('tt_credits');
$credits = $set['thread_exp'];$rmbs = $set['thread_rmb'];$golds = $set['thread_gold'];
$golds_op = $golds>0?'+':'';$credits_op = $credits>0?'+':'';$rmbs_op = $rmbs>0?'+':'';
if(($credits<0&&($user['credits']+$credits<0))||($golds<0&&($user['golds']+$golds<0))||($rmbs<0&&($user['rmbs']+$rmbs<0)))
{message(-1,lang('credit_no_enough'));die();}
$c_limit =$set['limit'] ; $add_credit=1;
?>