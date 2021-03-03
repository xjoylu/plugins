<?php
/*
1、只集成各种函数统计获取图片规则，存取缩略图函数
2、支持原创正版www.432k.cn
3、使用盗版会严重带来风险损失
4、由迷途制作,作者所属
*/
function img($tid){ // 标准匹配封面图
	$r = db_find_one('post', array('tid'=>$tid));
	$content = $r['message_fmt']; //文章内容 

	preg_match_all("/<img.*src=[\'|\"](.*)[\'|\"]\s*.*>/iU", $content, $img);
	foreach($img as $v){
		foreach ($v as $a){
			$oldimg = $a;
			break; 
		}
	}
	preg_match('/((http|https):\/\/)+(\w+\.)+(\w+)[\w\/\.\-]*(jpg|gif|png)/', $content, $imgn);
	foreach($imgn as $va){
		$newimg =  $va;
		break; 
	}

	if(!empty($oldimg)){
		return $oldimg;
	}elseif(!empty($newimg) and empty($oldimg)){
		return $newimg;
	}elseif(!empty($oldimg) and !empty($newimg)){
		return $oldimg;
	}elseif(empty($newimg) and empty($oldimg)){
		return '';
	}else{
		return '';
	}

}
function messagea($tid){
	$r = db_find_one('post',array('tid'=>$tid));
	$message = strip_tags($r['message']);
	return xn_substr($message, 0, 90);
}

//多图开始
function list_pic($tid){
	$arr = db_find_one('post', array('tid'=>$tid));
	$str= $arr['message_fmt'];
	preg_match_all("/<img.*src=[\'|\"](.*)[\'|\"]\s*.*>/iU", $str, $img);
	$imgall = $img[1];
	$num = count($imgall);
	return array(
			'list'=>$imgall,
			'num'=>$num
		);
	
}


function changeSize($picname,$maxx=100,$maxy=100,$pre="s_"){
		header("Content-type: image/jpeg");
		$picinfo = pathinfo($picname);//解析源图像的名字和路径信息
		$is_img = file_exists("upload/small/".$pre.$picinfo["basename"]);//查看文件是否存在
        if($is_img == 1){
        	return "upload/small/".$pre.$picinfo["basename"];
        }else{
        	$info=getimageSize($picname);//获取图片的基本信息 
        	if(!$info){
        		return $picname;exit;
        	}
	        $w=$info[0];//获取宽度
	        $h=$info[1];//获取高度
	        //获取图片的类型并为此创建对应图片资源
	        switch($info[2]){
	            case 1://gif
	                  $im=imagecreatefromgif($picname);    
	                  break;                  
	            case 2://jpg
	                  $im=imagecreatefromjpeg($picname);
	                  break;
	            case 3://png
	                 $im=imagecreatefrompng($picname);  
	                  break;
	            default:
	                 die("图像类型错误");
	        } 
	        //计算缩放比例
	        if(($maxx/$w)>($maxy/$h)){
	            $b=$maxy/$h;
	        }else{
	            $b=$maxx/$w;    
	        }
	        //计算出缩放后的尺寸
	        $nw=floor($w*$b);
	        $nh=floor($h*$b);
	        //创建一个新的图像源（目标图像）
	        $nim=imagecreatetruecolor($nw,$nh);

	        //执行等比缩放
	        imagecopyresampled($nim,$im,0,0,0,0,$nw,$nh,$w,$h);
	        //输出图像（根据源图像的类型，输出为对应的类型）
	        

	        $newpicname = $picinfo["dirname"]."/".$pre.$picinfo["basename"];

	        //新的目录
	        $path = "upload/small/";
	        //创建目录
	        if (is_dir($path) == false) {mkdir($path, 0755, true);}
			
			//移动文件
	        move_uploaded_file("../upload/small/",$newpicname );
	        $newpicname = "upload/small/".$pre.$picinfo["basename"];

	        switch($info[2]){
	            case 1:
	                imagegif($nim,$newpicname);
	                break;
	            case 2:
	                imagejpeg($nim,$newpicname);
	                break;
	            case 3:
	                imagepng($nim,$newpicname);
	           
	                break;                
	            
	        }
	        //释放图片资源
	        imagedestroy($im);
	        imagedestroy($nim);
	        //返回结果
	        return $newpicname;
        }

        
     }



?>