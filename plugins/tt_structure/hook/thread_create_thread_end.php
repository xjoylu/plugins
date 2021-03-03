$forum_structure_r = $forumlist[$fid]['structure'];
$forum_structure= explode('|',$forum_structure_r);
$forum_structure_count = count($forum_structure); $update_array = array();
$update_array['tid']= $tid;
for($i=0;$i<$forum_structure_count;$i++)
    $update_array['c'.($i+1)] = param('ini_'.($i+1),'-');
db_insert('thread_structure',$update_array);