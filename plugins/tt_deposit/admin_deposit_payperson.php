<?php !defined('DEBUG') AND exit('Forbidden'); include _include(ADMIN_PATH.'view/htm/header.inc.htm');?>
<?php
$num_pid = db_count('user_pay',array('status'=>'0','type'=>'3'));$page = param(1,1);
$data =  db_find('user_pay',array('type'=>3,'status'=>0), array('time'=>-1), $page, $pagesize = 20);
$pagination = pagination(url("deposit_payperson-{page}"), $num_pid, $page, $pagesize);
function username($uid)
{$r = db_find_one('user',array("uid"=>$uid)); return $r['username'];}
?>
<style>.opt{color:dodgerblue;cursor:pointer;margin:3px 9px;display:inline-block; height:30px; width:auto; }  .opt:hover{color:red;}</style>
<div class="row"><div class="col-lg-10 mx-auto"><div class="card"><div class="card-body" ><h3>审核充值请求</h3>
     <table class="table"><tr><th>cid</th><th>用户</th><th>附加信息</th><th>金额</th><th>时间</th><th>操作</th></tr>
    <?php foreach($data as $v){?><tr id="li<?php echo $v['cid'];?>">
        <td><?php echo $v['cid'];?></td><td><?php echo username($v['uid']);?></td><td><?php echo $v['code']; ?></td><td>¥<?php echo ($v['num']/100.0);?></td><td><?php echo date('Y-m-d H:i:s',$v['time']); ?></td><td><span class="opt" onclick="set(1,<?php echo $v['cid'];?>);">通过</span><span class="opt" onclick="set(-1,<?php echo $v['cid'];?>);">驳回</span></td></tr> <?php }?></table>
    <nav class="text-center"><ul class="pagination"><?php echo $pagination; ?></ul></nav>
</div></div></div></div>
<?php include _include(ADMIN_PATH.'view/htm/footer.inc.htm');?>
<script>
function set(opt,cid) {
    var jli=$("#li"+cid) ;jli.fadeOut();var postdata = new Array();
    postdata['opt']=opt; postdata['cid'] = cid; postdata['op']=2;
    $.xpost("<?php echo url('plugin-setting-tt_deposit');?>", serialize_array(postdata), function(code, message) {
        if(code == 0) return; else {$.alert(message);jli.fadeIn();}
    });
}
function serialize_array(arr) {
    var first = 1; var rtn="";
    for(var key in arr){
        if(first!=1) rtn+="&"; else first=0;
        rtn+= key+"="+arr[key];
    } return rtn;
}
</script>