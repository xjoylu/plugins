<?php 
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);

$auto_down = param('auto_down');
$qiniu_open = param('qiniu_open');
$qiniu_bucket = param('qiniu_bucket');
$qiniu_access = param('qiniu_access');
$qiniu_secret = param('qiniu_secret');
$qiniu_url = param('qiniu_url');
$aci_md_config = kv_get('aci_md_config');

if($method == 'GET') {
    if(empty($aci_md_config)) {
        $aci_md_config = array(
            'auto_down'=>$auto_down, 
            'qiniu_open'=>$qiniu_open,
            'qiniu_bucket'=>$qiniu_bucket,
            'qiniu_access'=>$qiniu_access,
            'qiniu_secret'=>$qiniu_secret,
            'qiniu_url'=>$qiniu_url
        );
        kv_set('aci_md_config', $aci_md_config);
    }
    
    $auto_down = form_radio_yes_no('auto_down', $aci_md_config['auto_down'],0);
	$qiniu_open = form_radio_yes_no('qiniu_open', $aci_md_config['qiniu_open'],0);

	$qiniu_bucket = form_text('qiniu_bucket', $aci_md_config['qiniu_bucket'], '100%','Bucket名称');
    $qiniu_access = form_text('qiniu_access', $aci_md_config['qiniu_access'], '100%','Bucket名称');
    $qiniu_secret = form_text('qiniu_secret', $aci_md_config['qiniu_secret'], '100%','Bucket名称');
    $qiniu_url = form_text('qiniu_url', $aci_md_config['qiniu_url'], '100%','Bucket名称');

	include _include(APP_PATH.'plugin/aci_mdeditor/setting.htm');		
	} else {
		$aci_md_config['auto_down'] = param('auto_down');
		$aci_md_config['qiniu_open'] = param('qiniu_open');
		$aci_md_config['qiniu_bucket'] = param('qiniu_bucket');
		$aci_md_config['qiniu_access'] = param('qiniu_access');
        $aci_md_config['qiniu_secret'] = param('qiniu_secret');
        $aci_md_config['qiniu_url'] = param('qiniu_url');
		kv_set('aci_md_config', $aci_md_config);	
		message(0, '修改成功');
}
?>
