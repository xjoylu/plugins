    		if(isset($_SESSION['inviteid'])){
			//db_exec("UPDATE bbs_user SET invitenums = invitenums + 1 WHERE uid = {$_SESSION['inviteid']}");
			$r = db_find_one('invite', array('ip'=> $longip) );
			if($r === FALSE){
			db_insert('invite',array('uid'=>$_SESSION['inviteid'], 'ip'=> $longip , 'regtime'=> $time));
			db_update('user',array('uid'=>$_SESSION['inviteid']), array('invitenums+'=> 1));
			}else{
			if((date("Y",$r['regtime']) - date("Y",$time)) >=0 && (date("n",$r['regtime']) - date("n",$time)) >=0 && (date("j",$r['regtime']) - date("j",$time))){
				db_update('user',array('uid'=>$_SESSION['inviteid']), array('invitenums+'=> 1));
				db_update('invite',array('ip'=>$longip), array('uid'=>$_SESSION['inviteid'] ,'regtime'=> $time));
			}
			}
			unset($_SESSION['inviteid']) ;	
		}