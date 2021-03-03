<?php !defined('DEBUG') AND exit('Forbidden');include _include(ADMIN_PATH.'view/htm/header.inc.htm');
    $num_pid = db_count('seo_log');
	$page = param(1,1);
	$data =  db_find('seo_log',array(), array('seo_id'=>-1), $page, $pagesize = 20);
    $pagination = pagination(url("seo_log-{page}"), $num_pid, $page, $pagesize);
    function username($uid){
        $r = db_find_one('user',array("uid"=>$uid));return $r['username'];
    }
    function thread_subject_get($tid){
        $r = db_find_one('thread',array('tid'=>$tid));
        return $r['subject'];
    }
?>
<div class="row"><div class="col-lg-10 mx-auto"><div class="card"><div class="card-body" >
<table class="table"><tr><th>ID</th><th>操作者</th><th>时间</th><th>主题</th><th>类别</th><th>状态</th></tr>
<?php foreach($data as $v){?>
<tr><td><?php echo $v['seo_id'];?></td><td><?php echo username($v['uid']);?></td><td><?php echo date('Y-m-d H:i:s',$v['time']);?></td><td><?php echo thread_subject_get($v['tid']);?></td><td><?php echo $g_seo_type[$v['type']];?></td>
    <?php if($v['status']=='成功'){?><td style="color:green;">
    <?php }else{ ?><td style="color:red;font-weight:bold;">
    <?php } echo $v['status'];?></td></tr><?php }?></table>
<nav class="text-center"><ul class="pagination"><?php echo $pagination; ?></ul></nav>
</div></div></div></div>
<?php include _include(ADMIN_PATH.'view/htm/footer.inc.htm');?>