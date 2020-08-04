<?php
/* unstall xiuno TAG
 * delete table
 * delete cache
 */

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;
$sql = "DROP TABLE {$tablepre}git_tags";
db_exec($sql);

$sql = "DROP TABLE {$tablepre}git_tags_thread";
db_exec($sql);

kv_cache_delete('git_tags');

?>
