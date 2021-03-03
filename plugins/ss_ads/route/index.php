<?php
!defined('DEBUG') AND exit('Forbidden');
$id = param(1, 0);
echo ss_ads_get($id);