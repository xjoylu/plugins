 <?php exit;
$forum = forum_read($fid);
user_update($uid, array('credits-'=>$forum['create_credits'], 'golds-'=>$forum['create_golds']));
user_update_group($uid);
?>