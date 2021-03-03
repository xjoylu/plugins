<?php
//删除标签表及数据
$sql="DROP TABLE bbs_fq_tag";
db_exec($sql);

//删除标签主题关联表及数据
$sql="DROP TABLE bbs_fq_tag_thread";
db_exec($sql);

?>