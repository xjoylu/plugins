<?php $ax_index_forum = kv_get('ax_index_forum');?>

<?php if($ax_index_forum['open'] == 1){?>

<?php 
	function last_forum_time($fid){
		$r = db_find_one('thread',array('fid'=>$fid),array('last_date'=>-1));
		$rs = db_find_one('post',array('tid'=>$r['tid']),array('pid'=>-1));
		return $rs['create_date'];
		
	}
?>

<?php include _include(APP_PATH.'view/htm/header.inc.htm');?>
	
<div class="card">
			<div class="card-header bgnone"><?php if($ax_index_forum['forum_name']){?><?php echo $ax_index_forum['forum_name']?><?php }?></div>
			<div class="col-lg-12">
				<Div class="row m-0 p-0">
			<?php foreach($forumlist_show as $_forum) { ?>
			<?php $last_time = last_forum_time($_forum['fid']);?>
				<div class="col-lg-4 row p-3 mr-2">
					<div><a href="<?php echo url("forum-$_forum[fid]");?>"><img class="avatar-4" src="<?php echo $_forum['icon_url']; ?>"></a></div>
					<div class="media-body ml-3">
							<div>
								<a href="<?php echo url("forum-$_forum[fid]");?>"><?php echo $_forum['name']?></a>
							</div>
							<div>
								<span class="text-muted small">主题数：<b style="color:#868e96"><?php echo $_forum['threads']?></b></span>
								<span class="text-muted small">今日发布：<b style="color:#868e96"><?php echo $_forum['todaythreads']?></b></span>
							</div>
							<div class="text-muted smallpt-1">
								最后发表: <?php echo date('Y-m-d h:i:s',$last_time); ?>				
							</div>
					</div>
				</div>
			<?php }?>	
				</Div>
			</div>
		</div>



<!--{hook index_end.htm}-->

<?php include _include(APP_PATH.'view/htm/footer.inc.htm');?>

<script>
$('li[data-active="fid-0"]').addClass('active');
</script>

<!--{hook index_js.htm}-->

<?php }?>