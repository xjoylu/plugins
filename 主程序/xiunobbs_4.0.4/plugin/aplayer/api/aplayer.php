<?php if($list!=''){?>
<?php $api = music_list($list);$num = $api[0]['zongshu'];?>
  <div id="player4" class="aplayer"></div>
    <script src="plugin/aplayer/js/APlayer.min.js"></script>
    <script >
    
    var ap4 = new APlayer({
    element: document.getElementById('player4'),
    narrow: false,
    autoplay: true,
    showlrc: false,
    mutex: true,
    theme: '#ad7a86',
    mode: 'random',
	listmaxheight: '329px',
    music: [
	 <?php foreach ($api as $i=>$v) {?> 
        {
            title: '<?php echo  str_replace("'","\'",$api[$i]['title'])?>',
             author:'<?php echo str_replace("'","\'",$api[$i]['artists_name']) ?>',
            url: 'http://music.163.com/song/media/outer/url?id=<?php echo $api[$i]['id']?>',
            pic: '<?php echo $api[$i]['blurPicUrl']?>'
        },
	<? }?> 
    ]
});
    </script>
<? }?>
<?php if($song!=''){?>
<?php 
$music_id = strip_tags($song); 
$array = explode(',',$music_id); 
?>
<div id="player4" class="aplayer"></div>
 <script src="plugin/aplayer/js/APlayer.min.js"></script>
 <script>
var ap4 = new APlayer({
    element: document.getElementById('player4'),
    narrow: false,
    autoplay: true,
    showlrc: false,
    mutex: true,
    theme: '#ad7a86',
    music: [
       <?php foreach ($array as $k){?> 
		{
			<?php $music=musicApi($k);?>
            title: '<?php echo str_replace("'","\'",$music['name'])?>',
            author:'<?php echo $music['artists'][0]['name']?>',
            url: 'http://music.163.com/song/media/outer/url?id=<?php echo $k;?>',
            pic: '<?php echo $music['album']['picUrl']?>'
        },
		<? }?> 
    ]
});
 </script>
<? }?>