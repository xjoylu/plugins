<?php exit;
$setting_seo = setting_get('tt_seo');
if($setting_seo['sitemap_auto']=='1')
    seo_update_sitemap();
?>