elseif($action == 'email') {
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_email/view/htm/my_email.htm');
    elseif($method == 'POST') {
        $op=param('op');
        if($op==0){
                include _include(XIUNOPHP_PATH.'xn_send_mail.func.php');
                $email = param('email');
                empty($email) AND message(-1, lang('please_input_email'));
                empty($uid) AND message(-1, "拉取用户信息失败！");
                !is_email($email, $err) AND message('email', $err);
                $_user = db_find_one('user',array('email'=>$email));
                if(isset($_user)){
                    if($_user['uid']==$uid && $_user['email_v']==1) {message(-1, "该邮箱是您的，并且已经通过验证！");die();}
                    if($_user['uid']!=$uid) {message(-1, lang('email_is_in_use'));die();}
                }
                $code = rand(100000, 999999);
                $_SESSION['user_verify_email'] = $email;
                $_SESSION['user_verify_code'] = $code;
                $subject = lang('send_code_template', array('rand'=>$code, 'sitename'=>$conf['sitename']));
                $message = $subject;
                $smtplist = include _include(APP_PATH.'conf/smtp.conf.php');
                $n = array_rand($smtplist);
                $smtp = $smtplist[$n];
                $r = xn_send_mail($smtp, $conf['sitename'], $email, $subject, $message);
                if($r === TRUE) { db_update('user',array('uid'=>$uid),array('email'=>$email,'email_v'=>'2'));message(0, lang('send_successfully'));} else {xn_log($errstr, 'send_mail_error');
                message(-1, $errstr);}
        }
        elseif($op==1){
                try{$email= $_SESSION['user_verify_email']; $code_true = $_SESSION['user_verify_code'] ; $code = param('code');}
                catch(Exception $e){message(-1,'拉取信息出现了错误!');die();}
                if(empty($email)||empty($uid)||empty($code)||empty($code_true)) {message(-1,'拉取信息出现了错误!');die();}
                $user_v = db_find_one('user',array('uid'=>$uid,'email_v'=>2));
                if(empty($user_v)) {message(-1,'用户电子邮件状态错误!');die();}
                if($code_true!=$code){message(-1,'输入的验证码错误!');die();}
                else{ db_update('user',array('uid'=>$uid),array('email_v'=>'1'));
                message(0,'验证成功!');
}}}
}