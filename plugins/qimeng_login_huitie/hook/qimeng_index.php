<?php echo setting_get('qimeng_login_huitie');?>
<!-- 注册/登录/回帖 -->
<style type="text/css">
.qimeng-contro {
  display: block;
  width: 100%;
  font-size: 0.9rem;
  line-height: 1.5;
  color: #868788;
  background-color: #ffffff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>
<div align="center"><span class="hidden-xs hidden-sm hidden-md"><?php echo setting_get('qimeng_login_huitie_name_htm');?></span>&nbsp;<a href="<?php echo url('user-login');?>"><i class="icon-user"></i>&nbsp;<?php echo setting_get('qimeng_login_huitie_name_1_htm');?></a>丨<a href="<?php echo url('user-create');?>"><i class="icon-user-plus"></i>&nbsp;<?php echo setting_get('qimeng_login_huitie_name_2_htm');?></a>丨<a href="qq_login.htm"><i class="icon-qq"></i>&nbsp;<?php echo setting_get('qimeng_login_huitie_name_3_htm');?></a></div>