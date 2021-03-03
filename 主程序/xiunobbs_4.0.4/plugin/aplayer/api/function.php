<?php
//本插件由魔趣吧高仿发布，更多下载：http://www.moqu8.com
error_reporting(E_ALL ^ E_NOTICE); 

function music_list($id){	

$url = 'http://music.163.com/api/playlist/detail?id='.$id;     //API接口

$header[] = "Cookie: " . "appver=1.5.0.75771;";

$ch = curl_init();  

curl_setopt ($ch, CURLOPT_URL, $url);

curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt ($ch, CURLOPT_BINARYTRANSFER, true);

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt ($ch, CURLOPT_REFERER, $url);

$file_contents = curl_exec($ch);

curl_close($ch);

//var_dump(json_decode($file_contents ));die;

      $json = json_decode($file_contents,true);

      if($json['code'] == 200){

        $txapi=$json['result']['tracks'];

         $txapi2=$json['result'];

		 $num = $json['result']['trackCount'];

         for ($i = 0; $i < $num; $i++)

		 {

			 	   $list_name =$txapi2['name'];

			 	   $coverImgUrl = $txapi2['coverImgUrl'];

			 	   $tags = $txapi2['tags'];

                   $title = $txapi[$i]['name']; 

		           $artists_name =  $txapi[$i]['artists'][0]['name']; 

				   $blurPicUrl=$txapi[$i]['album']['blurPicUrl'];

				   $mp3Url=$txapi[$i]['mp3Url'];

				   $zongshu = $num;

				   $id = $txapi[$i]['id'];

			$arr[]=array(

			"list_name"=>$list_name,

			"coverImgUrl"=>$coverImgUrl,

			"title"=>$title,

			"artists_name"=>$artists_name,

			"blurPicUrl"=>$blurPicUrl,

			"mp3Url"=>$mp3Url,

			"zongshu"=>$zongshu,

			"id"=>$id,

			"tags"=>$tags,

			);

		   

           } 

          }

		return $arr;

}
function musicApi($id){

$url = "http://music.163.com/api/song/detail/?id=".$id."&ids=%5B".$id."%5D";

$result= file_get_contents($url);

$result=json_decode($result,true);

return   $result['songs'][0];

}

?>