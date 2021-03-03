<?php
!defined('DEBUG') AND exit('Access Denied.');
$act = param('act');
if ($method == 'POST'  && $act  == 'qd')
{	
//查询是否有签到记录,如果有
	$data = db_find_one('sign',array('user_id'=>$uid));
	if ($data['id']>0)
	{
		//查询是否大于1天
		$sign_time = date("Y-m-d",$data['sign_time']);//最近一次签到时间
		$is_continuity= $data['is_continuity'];  //连续签到天数
		$now = date("Y-m-d",time());
		if ($sign_time ==  $now )
		{
			//今日已签到
			echo  json_encode(array('code'=>'1','success'=>'fail','message'=>'今日已签到')); die;		
	    }
		else
		{
		
		//可签到
		//根据会员ID，得到会员名称
		$data_user_name = db_find_one('user',array('uid'=>$uid));
		$user_name = $data_user_name['username'];
		$user_credits = $data_user_name['golds'];
		//获得签到一次所得到的积分
		$data_credits = db_find_one('sign_config',array('id'=>1));
		$sign_onetime = $data_credits['sign_onetime'];
		$sign_alltime_3 = $data_credits['sign_alltime_3'];
		$sign_alltime_7 = $data_credits['sign_alltime_7'];
		$sign_alltime_15 = $data_credits['sign_alltime_15'];
		$sign_alltime_30 = $data_credits['sign_alltime_30'];
		$user_credits2 =0;
		//查询是否断签
		$second1 = strtotime($now);
 		$second2 = strtotime($sign_time);
        if ($second1 < $second2) 
	    {
			$tmp = $second2;
			$second2 = $second1;
			$second1 = $tmp;
		}
		 $xy=($second1 - $second2) / 86400;
		if ($xy<=1)
		{
			
			//查询当前连续签到天数
			if ($is_continuity==2)
			{
				$sign_credits  =  $sign_alltime_3;//获得积分	
				$user_credits2  =  $user_credits + $sign_alltime_3;//最新积分
				$is_continuity =  $is_continuity +1;
			}
			elseif ($is_continuity==6)
			{
				$sign_credits =  $sign_alltime_7;//获得积分
				$user_credits2  =  $user_credits + $sign_alltime_7;//最新积分		
				$is_continuity =$is_continuity +1;
			}
			elseif ($is_continuity==14)
			{
				$sign_credits =  $sign_alltime_15;//获得积分
				$user_credits2  =  $user_credits + $sign_alltime_15;//最新积分		
				$is_continuity =$is_continuity +1;
			}
			elseif ($is_continuity==29)
			{
				$sign_credits = $sign_alltime_30;//获得积分
				$user_credits2  =  $user_credits + $sign_alltime_30;//最新积分
				$is_continuity =$is_continuity +1;
			}
			elseif ($is_continuity==30)
			{
				$sign_credits =  $sign_onetime;//获得积分
				$user_credits2  =  $user_credits + $sign_onetime;//最新积分
				//清空连续签到
				$is_continuity =1;
			}
			else
			{	
				$sign_credits = $sign_onetime;//获得积分
				$user_credits2  =  $user_credits + $sign_onetime;//最新积分
				$is_continuity =$is_continuity +1;		
			}
				
		}
		
		else
		{
			//断签则重新计算
			$sign_credits = $sign_onetime;//获得积分
			$user_credits2  =  $user_credits + $sign_onetime;//最新积分
			$is_continuity =1;
		}
		
	    $array = array('user_id'=>$uid,'user_name'=>$user_name,'sign_time'=>time(),'get_credits'=>$sign_credits,'is_continuity'=>$is_continuity); 
		db_update('sign',array('user_id'=>$uid),$array);
		
		//增加会员积分
	    $array = array('golds'=>$user_credits2); 
		db_update('user',array('uid'=>$uid),$array);
		
		//查询用户现有积分
		$data = db_find_one('user',array('uid'=>$uid));
		$user_credits = $data['golds'];
		$user_now_gid = $data['gid'];



		
		$message= '签到成功,您已经连续签到'.$is_continuity.'天';
		$arr =   array('code'=>'0','success'=>'success','is_continuity'=>$is_continuity,'message'=>$message); 	
		echo json_encode($arr);
			
		}
	}
	//没有签到记录
	else
	{ 
	 
		//根据会员ID，得到会员名称
		$data = db_find_one('user',array('uid'=>$uid));
		$user_name = $data['username'];
		$user_credits=$data['golds'];
		//获得签到一次所得到的积分
		$data_credits = db_find_one('sign_config',array('id'=>1));
		$sign_onetime = $data_credits['sign_onetime'];
	    $array = array('user_id'=>$uid,'user_name'=>$user_name,'sign_time'=>time(),'get_credits'=>$sign_onetime,'is_continuity'=>1); 
		db_insert('sign',$array);
		//增加会员积分
		$user_credits=$user_credits+$sign_onetime;
	    $array = array('golds'=>$user_credits); 
		db_update('user',array('uid'=>$uid),$array);
		


		


		
		
		echo  json_encode(array('code'=>'1','success'=>'fail','message'=>'您已连续签到1天')); die;		
	}
}

if ($method == 'POST'  && $act  == 'cx')

{

		$data = db_find_one('sign',array('user_id'=>$uid));
		if ($data['id']>0)
	    {
		//查询是否大于1天
		$sign_time = date("Y-m-d",$data['sign_time']);//最近一次签到时间
		$now = date("Y-m-d",time());
		$is_continuity= $data['is_continuity'];  //连续签到天数
		if ($sign_time ==  $now )
		{
			$message='已签到'.$is_continuity.'天';
			echo  json_encode(array('code'=>'0','message'=>$message)); die;		
	    }
		else
		{
			echo  json_encode(array('code'=>'1','message'=>'每日签到')); die;			
		}
		
	    }
		else
		{
			echo  json_encode(array('code'=>'1','message'=>'每日签到')); die;				
		}	
	
}
?>