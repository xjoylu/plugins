<?php $ax_index_forum = kv_get('ax_index_forum');?>
<?php include _include(APP_PATH.'view/htm/header.inc.htm');?>
<style type="text/css">
.table th, .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.icon_cf_lv {
    width: 43px;
    height: 16px;
    background: url(plugin/ax_index_forum/img/cf_lv.png) no-repeat;
    display: inline-block;
    vertical-align: bottom;
    margin-top: 5px;
}
.a20{background-position:0 0;}
.a19{background-position:0 -16px;}
.a18{background-position:0 -32px;}
.a17{background-position:0 -48px;}
.a16{background-position:0 -64px;}
.a15{background-position:0 -80px;}
.a14{background-position:0 -96px;}
.a13{background-position:0 -112px;}
.a12{background-position:-43px 0;}
.a11{background-position:-43px -16px;}
.a10{background-position:-43px -32px;}
.a9{background-position:-43px -48px;}
.a8{background-position:-43px -64px;}
.a7{background-position:-43px -80px;}
.a6{background-position:-43px -96px;}
.a5{background-position:-43px -112px;}
.a4{background-position:-86px 0px;}
.a3{background-position:-86px -16px;}
.a2{background-position:-86px -32px;}
.a1{background-position:-86px -48px;}
</style>
<div class="mt-3">
        <ol class="breadcrumb mb-sm d-none">
			<li class="breadcrumb-item"><a href="."><i class="fa fa-home"></i> <?php echo $header['title'];?></a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0);">财富榜</a></li>
		</ol>


        <table class="table table-hover my-3" style="background: white; border-radius:5px 5px 5px 5px;">
            <thead class="member_list_th">
                <tr class="text-dark">
                    <th class="text-center">排名</th>
                    <th class="text-center">&nbsp;</th>
                    <th>会员名</th>
                    <th class="text-center">财富值</th>
                    <th class="text-center  d-none d-lg-block">注册时间</th>

                </tr>
            </thead>
            <tbody class="member_list text-dark" style="font-size:13px;">

            <?php $user_rank = user_find(array('gid'=>array('>'=>100)),array('golds'=>-1),1,20);?>
            <?php $i=1;foreach($user_rank as $v){?>
                <tr class="rank_number">
                    <th scope="row" class="text-center">
                        <?php if($i<=20){?>
                            <i class="icon_cf_lv a<?php echo $i;?>" style="vertical-align: middle;"></i>
                        <?php }else{?>
                            <?php echo $i?>
                        <?php }?>
                        
                    </th>
                    <td class="text-center">&nbsp;</td>
                    <td>
                        <a href="<?php echo url("user-$v[uid]");?>">
                            <img src="<?php echo $v['avatar_url']?>" class="img-circle" width="25px" style="width: 26px;border-radius: 15rem;"> <?php echo $v['username']?> 
                        </a>
                    </td>
                    <td class="text-center" style="vertical-align: inherit;"><?php echo $v['golds']?> 金币</td>
                    <td class="text-center   d-none d-lg-block" style="vertical-align: inherit;"><?php echo date('Y/m/d',$v['create_date']); ?></td>
                </tr>
            <?php $i=$i+1;}?>

            </tbody>
        </table>

    </div>

<!--{hook index_end.htm}-->

<?php include _include(APP_PATH.'view/htm/footer.inc.htm');?>

<script>
$('li[data-active="fid-0"]').addClass('active');
</script>

<!--{hook index_js.htm}-->

