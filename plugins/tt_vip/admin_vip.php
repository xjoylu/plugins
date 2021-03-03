<?php !defined('DEBUG') AND exit('Forbidden');
include _include(ADMIN_PATH.'view/htm/header.inc.htm');
$num_pid = db_count('user_vip',array('end'=>array('>'=>time())));
$page = param(1,1);
$data =  db_find('user_vip',array('end'=>array('>'=>time())), array('end'=>-1), $page, $pagesize = 20);
$pagination = pagination(url("vip-{page}"), $num_pid, $page, $pagesize);
function username($uid)
{$r = db_find_one('user',array("uid"=>$uid));return $r['username'];} ?>
<div class="row"><div class="col-lg-10 mx-auto"><div class="card"><div class="card-body" >
<h3>管理用户VIP状态</h3><form action="<?php echo url("plugin-setting-tt_vip");?>" method="post" id="form">
<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">用户名</span></div><input class="form-control" name="_username" id="_username" maxlength="10" value="admin" width="30%"/></div>
<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">VIP到期时间戳</span></div><input class="form-control" name="vip_expire" id="vip_expire" maxlength="20"/></div>时间戳转换请百度搜索，您打开当前页面瞬间的时间戳:&nbsp;&nbsp;<?php echo time();?><br>
<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">VIP成长值</span></div><input class="form-control" name="vip_grow" id="vip_grow" maxlength="10"/></div>
<button type="button" class="btn btn-success" id="inquire" data-loading-text="<?php echo lang('submiting');?>...">查询</button>&nbsp;&nbsp;
<button type="button" class="btn btn-success" id="update" data-loading-text="<?php echo lang('submiting');?>..."><?php echo lang('confirm');?></button></form>
</div></div><div class="card"><div class="card-body" ><h3>VIP用户查询</h3><table class="table"><tr><th>用户名</th><th>到期时间</th><th>成长值</th><th>编辑</th></tr>
<?php if($num_pid>0) { foreach($data as $v){?><tr>
    <td><?php $v['username']=username($v['uid']); echo $v['username'];?></td><td><?php echo date('Y-m-d H:i:s',$v['end']); ?></td><td><?php echo $v['grow'];?></td><td><button onclick="b_click('<?php echo $v['username'];?>','<?php echo $v['end'];?>','<?php echo $v['grow'];?>');">编辑</button></td>
</tr><?php }}?></table>
<nav class="text-center"><ul class="pagination"><?php echo $pagination; ?></ul></nav></div></div>
<?php include _include(ADMIN_PATH.'view/htm/footer.inc.htm');?>
<script>
    var jform = $("#form");var jinquire = $("#inquire"); var jbutton=$("#update");var jexpire=$("#vip_expire"); var jgrow=$("#vip_grow"); var jusername=$("#_username");
    function c_post(op)
    {   jinquire.button('loading'); jbutton.button('loading');
        var postdata = jform.serialize(); postdata+="&op="+op;
        $.xpost(jform.attr('action'), postdata, function(code, message) {  _msg = JSON.parse(message);
            if(code == 0) { jexpire.val(_msg['expire']);jgrow.val(_msg['grow']); $.alert("执行完毕");
            } else {$.alert(message);}
        });
        jinquire.button('reset'); jbutton.button('reset');
    }
    jbutton.on('click', function(){ $.confirm('您是否确认更新该内容？',function(){ c_post('2'); });});//update
    jinquire.on('click',function(){ c_post('1');});//inquire
    function b_click(username,expire,grow)
    { jusername.val(username); jgrow.val(grow); jexpire.val(expire); }
</script>