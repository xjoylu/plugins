if(isset($_SESSION['inviteid'])){
	unset($_SESSION['inviteid']);
}
$inviteparam = intval(param('uid','index'));
if($inviteparam){
	if(isset($user['uid'])){

	}else{
		$_SESSION['inviteid'] = $inviteparam;

	}
}