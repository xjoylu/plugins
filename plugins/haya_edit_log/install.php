<?php

defined('DEBUG') OR exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "
ALTER TABLE {$tablepre}post ADD COLUMN haya_edit_uid int(11) NULL COMMENT '最后编辑用户UID';
ALTER TABLE {$tablepre}post ADD COLUMN haya_edit_time int(11) NULL COMMENT '最后编辑时间';
ALTER TABLE {$tablepre}post ADD COLUMN haya_edit_ip int(11) NULL COMMENT '最后编辑用户IP';
";
$r = db_exec($sql);

$r === FALSE AND message(-1, '安装插件失败');
